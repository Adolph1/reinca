<?php

use yii\helpers\Html;


/* @var $this yii\web\View */
/* @var $model backend\models\Cashbook */

$this->title = Yii::t('app', 'Post Cashbook');
$this->params['breadcrumbs'][] = ['label' => Yii::t('app', 'Cashbooks'), 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="cashbook-create">

    <h1><?php // Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
