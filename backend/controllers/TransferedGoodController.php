<?php

namespace backend\controllers;

use backend\models\Adjustment;
use backend\models\Inventory;
use backend\models\StoreInventory;
use Yii;
use backend\models\TransferedGood;
use backend\models\TransferedGoodSearch;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;

/**
 * TransferedGoodController implements the CRUD actions for TransferedGood model.
 */
class TransferedGoodController extends Controller
{
    /**
     * @inheritdoc
     */
    public function behaviors()
    {
        return [
            'verbs' => [
                'class' => VerbFilter::className(),
                'actions' => [
                    'delete' => ['POST'],
                ],
            ],
        ];
    }

    /**
     * Lists all TransferedGood models.
     * @return mixed
     */
    public function actionIndex()
    {
        $searchModel = new TransferedGoodSearch();
        $dataProvider = $searchModel->received(Yii::$app->request->queryParams);

        return $this->render('index', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
        ]);
    }

    public function actionPending()
    {
        $searchModel = new TransferedGoodSearch();
        $dataProvider = $searchModel->pending(Yii::$app->request->queryParams);

        return $this->render('pending', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
        ]);
    }

    public function actionCanceled()
    {
        $searchModel = new TransferedGoodSearch();
        $dataProvider = $searchModel->canceled(Yii::$app->request->queryParams);

        return $this->render('canceled', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
        ]);
    }

    /**
     * Displays a single TransferedGood model.
     * @param integer $id
     * @return mixed
     */
    public function actionView($id)
    {
        return $this->render('view', [
            'model' => $this->findModel($id),
        ]);
    }

    /**
     * Creates a new TransferedGood model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return mixed
     */
    public function actionCreate()
    {
        $model = new TransferedGood();
        $model->maker_id = Yii::$app->user->identity->username;
        $model->maker_time = date('Y-m-d:H:i:s');

        //print_r($model->balance);
        //exit;
        //$updateStock=$this->updateStock($_POST['TransferedGood']['stock_id'],$_POST['TransferedGood']['product_id'],$model->balance);

        if ($model->load(Yii::$app->request->post())) {
            $model->balance=$_POST['TransferedGood']['remaining'];
            StoreInventory::updateAll(['qty'=>$_POST['TransferedGood']['remaining']], ['store_id' => $_POST['TransferedGood']['store_id'],'product_id'=>$_POST['TransferedGood']['product_id']]);
            $model->save();
            return $this->redirect(['view', 'id' => $model->id]);
        } else {
            return $this->render('create', [
                'model' => $model,
            ]);
        }
    }

    /**
     * Updates an existing TransferedGood model.
     * If update is successful, the browser will be redirected to the 'view' page.
     * @param integer $id
     * @return mixed
     */
    public function actionUpdate($id)
    {
        $model = $this->findModel($id);

        if ($model->load(Yii::$app->request->post()) && $model->save()) {
            return $this->redirect(['view', 'id' => $model->id]);
        } else {
            return $this->render('update', [
                'model' => $model,
            ]);
        }
    }

    public function actionConfirm($id)
    {
        $model = $this->findModel($id);
        $getqty=$this->getQty($model->product_id);
        if($model->status!=TransferedGood::RECEIVED) {
            if ($getqty != null) {
                $model->qty = $getqty->qty + $model->qty;
                Inventory::updateAll(['qty' => $model->qty], ['product_id' => $model->product_id]);
                TransferedGood::updateAll(['status' => TransferedGood::RECEIVED], ['id' => $model->id]);
                return $this->redirect(['index']);
            } else {
                $product = new Inventory();
                $product->product_id = $model->product_id;
                $product->buying_price = $this->getBprice($model->product_id, $model->store_id);
                $product->selling_price = $this->getSprice($model->product_id, $model->store_id);
                $product->qty = $model->qty;
                $product->min_level = 5;
                $product->last_updated = date('Y-m-d:H:i:s');
                $product->maker_id = Yii::$app->user->identity->username;
                $product->maker_time = date('Y-m-d:H:i:s');
                if ($product->save()) {
                    TransferedGood::updateAll(['status' => TransferedGood::RECEIVED], ['id' => $model->id]);
                    return $this->redirect(['index']);
                }
            }
        }
        else
        {
            return $this->redirect(['index']);
        }
    }

    public function actionReverse($id)
    {
        $model = $this->findModel($id);
        $getqty=$this->getQty($model->product_id);
        $remainder=$this->getReminder($model->product_id, $model->store_id)+$model->qty;
        if($model->status==TransferedGood::RECEIVED) {
            if ($getqty != null) {
                $getqty->qty = $getqty->qty - $model->qty;
                Inventory::updateAll(['qty' => $getqty->qty], ['product_id' => $model->product_id]);
                TransferedGood::updateAll(['status' => TransferedGood::CANCELED], ['id' => $model->id]);
                StoreInventory::updateAll(['qty' => $remainder], ['product_id' => $model->product_id,'store_id'=>$model->store_id]);
                return $this->redirect(['canceled']);
            } else {

                    return $this->redirect(['canceled']);
            }
        }
        else
        {
            return $this->redirect(['canceled']);
        }
    }

    /*
     * adjusts branch stock
     */

    public function actionAdjust($id)
    {
        $adjustModel=new Adjustment();
        $model = $this->findModel($id);

        return $this->render('adjust', [
            'model' => $model,'adjustModel'=>$adjustModel,
        ]);
    }


    /*
 * Reverse an entry
 */



    /**
     * Deletes an existing TransferedGood model.
     * If deletion is successful, the browser will be redirected to the 'index' page.
     * @param integer $id
     * @return mixed
     */
    public function actionDelete($id)
    {
        $this->findModel($id)->delete();

        return $this->redirect(['index']);
    }

    /**
     * Finds the TransferedGood model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param integer $id
     * @return TransferedGood the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id)
    {
        if (($model = TransferedGood::findOne($id)) !== null) {
            return $model;
        } else {
            throw new NotFoundHttpException('The requested page does not exist.');
        }
    }

    public function getQty($id)
    {
        if (($model = Inventory::find()->where(['product_id' => $id])->one()) !== null) {
            return $model;
        } else {
            return "";
        }
    }

    public function getBprice($id,$stdid)
    {
        if (($model = StoreInventory::find()->where(['product_id'=>$id,'store_id'=>$stdid])->one()) !== null) {
            return $model->buying_price;
        } else {
            return "";
        }
    }
    public function getSprice($id,$stdid)
    {
        if (($model = StoreInventory::find()->where(['product_id'=>$id,'store_id'=>$stdid])->one()) !== null) {
            return $model->selling_price;
        } else {
            return "";
        }
    }

    public function getReminder($id,$stdid)
    {
        if (($model = StoreInventory::find()->where(['product_id'=>$id,'store_id'=>$stdid])->one()) !== null) {
            return $model->qty;
        } else {
            return "";
        }
    }


}
