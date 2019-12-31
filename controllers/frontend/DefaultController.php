<?php

namespace kouosl\main\controllers\frontend;

use Yii;
use kouosl\main\models\product;
use yii\data\ActiveDataProvider;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;

/**
 * DefaultController implements the CRUD actions for product model.
 */
class DefaultController extends Controller
{
    /**
     * {@inheritdoc}
     */
    public function behaviors()
    {
        return [
            'verbs' => [
                'class' => VerbFilter::className(),
                'actions' => [
                    'delete' => ['POST'],
                ],
            ],
        ];
    }

    /**
     * Lists all product models.
     * @return mixed
     */
    public function actionIndex()
    {
        $dataProvider = new ActiveDataProvider([
            'query' => product::find(),
        ]);//Bütün kayıtları $dataProvider'e atar.

        return $this->render('index', [
            'dataProvider' => $dataProvider,
        ]);//İndex sayfasına $dataProvider değişkenini döndürür.
    }

    /**
     * Displays a single product model.
     * @param string $id
     * @return mixed
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionView($id)
    {//View sayfasına $id'ye sahip kaydı döndürür ve sergilenmesini sağlar.
        return $this->render('view', [
            'model' => $this->findModel($id),
        ]);
    }


    /**
     * Updates an existing product model.
     * If update is successful, the browser will be redirected to the 'view' page.
     * @param string $id
     * @return mixed
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionAdd($id)
    {
        $model = $this->findModel($id);

        //$newmodel = new product();Sipariş tablosuna kaydedilir
        //Yada ürünün stoğu düşülür.


        if (($model = product::findOne($id)) !== null) {
            //Bu id'ye sahip bir kayıt varsa stoğu düşülür veya kopyası sipariş listesine eklenir.
            //return $model;

        }

        /*return $this->render('update', [
            'model' => $model,
        ]);*/
    }
    

    /**
     * Finds the product model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param string $id
     * @return product the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id)
    {
        if (($model = product::findOne($id)) !== null) {
            return $model;
        }

        throw new NotFoundHttpException('The requested page does not exist.');
    }
}
