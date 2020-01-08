


<?php
   use yii\bootstrap\Alert;
   Yii::$app->session->setFlash('buy', 'Good work. Buy more, now!');
   echo Alert::widget([
      'options' => ['class' => 'alert-info'],
      'body' => Yii::$app->session->getFlash('buy'),
      
   ]);
?>

<?= $this->render('index', [
            'dataProvider' => $dataProvider,
        ]) ?>