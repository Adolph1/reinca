<?php

use yii\helpers\Html;


/* @var $this yii\web\View */
/* @var $model backend\models\Adjustment */

$this->title = Yii::t('app', 'Create Adjustment');
$this->params['breadcrumbs'][] = ['label' => Yii::t('app', 'Adjustments'), 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="adjustment-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
