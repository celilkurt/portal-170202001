<?php

namespace kouosl\profile\controllers\backend;

use Yii;

class DefaultController extends \kouosl\profile\controllers\backend\BaseController
{
     /**
     * Renders the index view for the module
     * @return string
     */
    public function actionIndex()
    {
        return $this->render('index');
    }
}