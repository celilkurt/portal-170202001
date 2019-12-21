<?php

namespace kouosl\profile\controllers\frontend;

use Yii;

class DefaultController extends \kouosl\profile\controllers\frontend\BaseController
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