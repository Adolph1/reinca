<?php

use yii\helpers\Html;


/* @var $this yii\web\View */
/* @var $model backend\models\TransferedGood */

$this->title = Yii::t('app', 'Create Transfered Good');
$this->params['breadcrumbs'][] = ['label' => Yii::t('app', 'Transfered Goods'), 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="transfered-good-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
