<?php

use yii\helpers\Html;
use yii\grid\GridView;

/* @var $this yii\web\View */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Shopping page';
$this->params['breadcrumbs'][] = $this->title;

?>




<div class="product-index">

    <h1><?= Html::encode($this->title) ?></h1>
    
    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],

            'name',
            'price',
            'stock',
            ['class' => 'yii\grid\CheckboxColumn',],
            
        ],
        
    ]); ?>

<script type="text/javascript">

function userClicks(target_id) {

	alert("Script works perfectly");

}

</script>
    
    <p>
        <?= Html::a('Buy', ['buy'], ['class' => 'btn btn-success']) ?>
    </p>
</div>

