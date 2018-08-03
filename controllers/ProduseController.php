<?php

namespace app\controllers;

use Yii;
use app\models\Produse;
use app\models\ProduseSearch;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;

/**
 * ProduseController implements the CRUD actions for Produse model.
 */
class ProduseController extends Controller
{
    /**
     * @inheritdoc
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
     * Lists all Produse models.
     * @return mixed
     */
    public function actionIndex()
    {
        $searchModel = new ProduseSearch();
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams);

        return $this->render('index', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
        ]);
    }

    /**
     * Displays a single Produse model.
     * @param integer $id
     * @return mixed
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionView($id)
    {
        $prod = Produse::find()->where(['id'=>$id])->one();
        $produs = json_decode($prod->descriere);
        switch($produs->produs){
            case 'album':
                $view = '_viewAlbum';
                break;
            case 'mapadvd':
                $view = '_mapaDvd';
                break;
            case 'cutieStick':
                $view = '_cutieStick';
                break;
            default:
                $view = 'view';
        }
        
        return $this->render($view, [
            'id'=>$id,
            'model' => $this->findModel($id),
        ]);
    }
    
    public function actionProdus($id) {
        $produs = Produse::find()->where(['id'=>$id])->one();
        $this->layout = "json.php";
        return $this->render('json',[
            'data' =>  $produs->descriere
        ]);
    }
    
    /**
     * Creates a new Produse model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return mixed
     */
    public function actionCreate()
    {
        $model = new Produse();
        $post = Yii::$app->request->post();
        $json = json_decode($post['descriere']);
        $model->comandaID = $json->idComanda;
        $model->descriere = $post['descriere'];
        if($model->save()) {
            $refresh = new \app\models\Orders();
            $refresh->refreshOrder($json->idComanda);
            //return $this->redirect(['view', 'id' => $model->id]);
            return 1;
        } else {
            return 0;
        }

//        return $this->render('create', [
//            'model' => $model,
//        ]);
    }

    /**
     * Updates an existing Produse model.
     * If update is successful, the browser will be redirected to the 'view' page.
     * @param integer $id
     * @return mixed
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionUpdate($id)
    {
        $model = $this->findModel($id);

        if ($model->load(Yii::$app->request->post()) && $model->save()) {
            return $this->redirect(['view', 'id' => $model->id]);
        }

        return $this->render('update', [
            'model' => $model,
        ]);
    }

    /**
     * Deletes an existing Produse model.
     * If deletion is successful, the browser will be redirected to the 'index' page.
     * @param integer $id
     * @return mixed
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionDelete($id)
    {
        
        $this->findModel($id)->delete();
        return $this->redirect(Yii::$app->request->referrer);
    }
    
    public function actionListapreturi() {
        $this->layout = "json.php";
        return $this->render('listapreturi');
    }
    public function actionPreturimape() {
        $this->layout = "json.php";
        return $this->render('preturimape');
    }
    public function actionPreturicutiutestick() {
        $this->layout = "json.php";
        return $this->render('preturicutiutestick');
    }

    /**
     * Finds the Produse model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param integer $id
     * @return Produse the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id)
    {
        if (($model = Produse::findOne($id)) !== null) {
            return $model;
        }

        throw new NotFoundHttpException('The requested page does not exist.');
    }
    
    
}