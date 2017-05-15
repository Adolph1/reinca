<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model backend\models\Creditor */

$this->title = Yii::t('app', 'Update {modelClass}: ', [
    'modelClass' => 'Creditor',
]) . $model->name;
$this->params['breadcrumbs'][] = ['label' => Yii::t('app', 'Creditors'), 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->name, 'url' => ['view', 'id' => $model->id]];
$this->params['breadcrumbs'][] = Yii::t('app', 'Update');
?>
<div class="creditor-update">

    <h1><?php // Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
