<?php

namespace backend\controllers;

use backend\models\Inventory;
use backend\models\TransferedGood;
use Yii;
use backend\models\Adjustment;
use backend\models\AdjustmentSearch;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;

/**
 * AdjustmentController implements the CRUD actions for Adjustment model.
 */
class AdjustmentController extends Controller
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
     * Lists all Adjustment models.
     * @return mixed
     */
    public function actionIndex()
    {
        $searchModel = new AdjustmentSearch();
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams);

        return $this->render('index', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
        ]);
    }

    /**
     * Displays a single Adjustment model.
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
     * Creates a new Adjustment model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return mixed
     */
    public function actionCreate()
    {
        $model = new Adjustment();

        if ($model->load(Yii::$app->request->post())) {
            TransferedGood::updateAll(['qty'=>$_POST['Adjustment']['transfered_qty']], ['id' => $_POST['Adjustment']['transfered_good_id']]);
            $model->save();
            return $this->redirect(['transfered-good/view', 'id' => $model->transfered_good_id]);
        } else {
            return $this->render('create', [
                'model' => $model,
            ]);
        }
    }

    public function actionReverse($id)
    {
        $model=$this->findModel($id);
        $balance=TransferedGood::findOne($model->transfered_good_id);
        $inventory=Inventory::find()->where(['product_id'=>$balance->product_id])->one();
        $inventory_balance=$inventory->qty-$model->transfered_qty;
        Inventory::updateAll(['qty'=>$inventory_balance], ['product_id' => $balance->product_id]);
        $balance=$balance->qty+$model->adjusted_stock;
        TransferedGood::updateAll(['qty'=>$balance], ['id' => $model->transfered_good_id]);

        $this->findModel($id)->delete();
        return $this->redirect(['transfered-good/view','id' =>$model->transfered_good_id]);
    }


    /**
     * Updates an existing Adjustment model.
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

    /**
     * Deletes an existing Adjustment model.
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
     * Finds the Adjustment model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param integer $id
     * @return Adjustment the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id)
    {
        if (($model = Adjustment::findOne($id)) !== null) {
            return $model;
        } else {
            throw new NotFoundHttpException('The requested page does not exist.');
        }
    }
}
