<?php

use yii\helpers\Html;


/* @var $this yii\web\View */
/* @var $model backend\models\Creditor */

$this->title = Yii::t('app', 'Create Creditor');
$this->params['breadcrumbs'][] = ['label' => Yii::t('app', 'Creditors'), 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="creditor-create">

    <h1><?php // Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
