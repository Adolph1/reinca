<?php

namespace backend\controllers;

use backend\models\Debtor;
use Yii;
use backend\models\DebtorRepayment;
use backend\models\DebtorRepaymentSearch;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;

/**
 * DebtorRepaymentController implements the CRUD actions for DebtorRepayment model.
 */
class DebtorRepaymentController extends Controller
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
     * Lists all DebtorRepayment models.
     * @return mixed
     */
    public function actionIndex()
    {
        $searchModel = new DebtorRepaymentSearch();
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams);

        return $this->render('index', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
        ]);
    }

    /**
     * Displays a single DebtorRepayment model.
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
     * Creates a new DebtorRepayment model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return mixed
     */
    public function actionCreate()
    {
        $model = new DebtorRepayment();
        $model->maker_id=Yii::$app->user->identity->username;
        $model->maker_time=date('Y-m-d:H:i:s');

        if ($model->load(Yii::$app->request->post())) {
            Debtor::updateAll(['amount'=>$_POST['DebtorRepayment']['balance']], ['id' => $_POST['DebtorRepayment']['debtor_id']]);
            $model->save();
            return $this->redirect(['debtor/view', 'id' => $model->debtor_id]);
        } else {
            return $this->render('create', [
                'model' => $model,
            ]);
        }
    }

    /**
     * Updates an existing DebtorRepayment model.
     * If update is successful, the browser will be redirected to the 'view' page.
     * @param integer $id
     * @return mixed
     */
    public function actionUpdate($id)
    {
        $model = $this->findModel($id);
        $model->maker_id=Yii::$app->user->identity->username;
        $model->maker_time=date('Y-m-d:H:i:s');

        if ($model->load(Yii::$app->request->post()) && $model->save()) {
            return $this->redirect(['view', 'id' => $model->id]);
        } else {
            return $this->render('update', [
                'model' => $model,
            ]);
        }
    }

    /**
     * Deletes an existing DebtorRepayment model.
     * If deletion is successful, the browser will be redirected to the 'index' page.
     * @param integer $id
     * @return mixed
     */
    public function actionDelete($id)
    {
        $this->findModel($id)->delete();
        return $this->redirect(['index']);
    }

    /*
     * Reverse an entry
     */

    public function actionReverse($id)
    {
       $model=$this->findModel($id);
        $balance=Debtor::getBalance($model->debtor_id);
        $balance=$balance+$model->amount;
            Debtor::updateAll(['amount'=>$balance], ['id' => $model->debtor_id]);
        $this->findModel($id)->delete();
        return $this->redirect(['debtor/view','id' => $model->debtor_id]);
    }

    /**
     * Finds the DebtorRepayment model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param integer $id
     * @return DebtorRepayment the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id)
    {
        if (($model = DebtorRepayment::findOne($id)) !== null) {
            return $model;
        } else {
            throw new NotFoundHttpException('The requested page does not exist.');
        }
    }
}
