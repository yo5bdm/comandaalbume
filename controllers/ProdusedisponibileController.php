<?php

namespace app\controllers;

use Yii;
use app\models\Produsedisponibile;
use app\models\ProdusedisponibileSearch;
use app\models\Elementecomanda;
use app\models\ElementecomandaSearch;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;

/**
 * ProdusedisponibileController implements the CRUD actions for Produsedisponibile model.
 */
class ProdusedisponibileController extends Controller
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
     * Lists all Produsedisponibile models.
     * @return mixed
     */
    public function actionIndex()
    {
        $searchModel = new ProdusedisponibileSearch();
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams);

        return $this->render('index', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
        ]);
    }

    /**
     * Displays a single Produsedisponibile model.
     * @param integer $id
     * @return mixed
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionView($id)
    {
        $elcom = new Elementecomanda();
        if ($elcom->load(Yii::$app->request->post())) {
            $elcom->produsID = $id;
            if($elcom->save()) {
                Yii::$app->session->setFlash('success', 'Modificarile au fost salvate');
            } else {
                Yii::$app->session->setFlash('error', 'Eroare la salvare');
            }
            
        }
        
        $dat = new ElementecomandaSearch();
        $listEl = $dat->search(['produsID'=>$id]);
        return $this->render('view', [
            'model' => $this->findModel($id),
            'modelElement' => $elcom,
            'listaElement' => $listEl,
        ]);
    }

    /**
     * Creates a new Produsedisponibile model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return mixed
     */
    public function actionCreate()
    {
        $model = new Produsedisponibile();

        if ($model->load(Yii::$app->request->post()) && $model->save()) {
            return $this->redirect(['view', 'id' => $model->id]);
        }

        return $this->render('create', [
            'model' => $model,
        ]);
    }

    /**
     * Updates an existing Produsedisponibile model.
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
     * Deletes an existing Produsedisponibile model.
     * If deletion is successful, the browser will be redirected to the 'index' page.
     * @param integer $id
     * @return mixed
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionDelete($id)
    {
        $this->findModel($id)->delete();

        return $this->redirect(['index']);
    }

    /**
     * Finds the Produsedisponibile model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param integer $id
     * @return Produsedisponibile the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id)
    {
        if (($model = Produsedisponibile::findOne($id)) !== null) {
            return $model;
        }

        throw new NotFoundHttpException('The requested page does not exist.');
    }
}
