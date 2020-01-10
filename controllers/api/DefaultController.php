<?php
namespace kouosl\main\controllers\api;


/**
 * Default controller for the `main` module
 */
class DefaultController extends ActiveController
{
    public $modelClass = 'kouosl\main\models\Product';
    
    public function actionIndex()
    {
        return $this->render('index');
    }
}
