<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model backend\models\TransferedGood */

$this->title = Yii::t('app', 'Update {modelClass}: ', [
    'modelClass' => 'Transfered Good',
]) . $model->id;
$this->params['breadcrumbs'][] = ['label' => Yii::t('app', 'Transfered Goods'), 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->id, 'url' => ['view', 'id' => $model->id]];
$this->params['breadcrumbs'][] = Yii::t('app', 'Update');
?>
<div class="transfered-good-update">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
