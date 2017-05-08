<?php

use yii\helpers\Html;


/* @var $this yii\web\View */
/* @var $model backend\models\StoreInventory */

$this->title = Yii::t('app', 'Transfer stock to main store');
$this->params['breadcrumbs'][] = ['label' => Yii::t('app', 'Store Inventories'), 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="store-inventory-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_transferedform', [
        'transfered' => $transfered,
        'model'=>$model,
    ]) ?>

</div>
