<?php

namespace app\controllers;

use Yii;
use app\models\Orders;
use app\models\OrdersSearch;
use app\models\Statuses;
use app\models\StatusesSearch;
use app\models\Produse;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;
use yii\filters\AccessControl;

/**
 * OrdersController implements the CRUD actions for Orders model.
 */
class OrdersController extends Controller
{
    /**
     * @inheritdoc
     */
    public function behaviors()
    {
        return [
            'access' => [
                'class' => AccessControl::className(),
                'rules' => [
                    [ //cei logati au voie sa vada tot
                        //'actions' => ['index','view','update','delete'],
                        'allow' => true,
                        'roles' => ['@'],
                    ],
                    [ //cei ce nu sunt logati sunt blocati
                        'allow' => false,
                        //'actions' => [],
                        'roles' => ['?'],
                    ],
                ],
            ],
            'verbs' => [
                'class' => VerbFilter::className(),
                'actions' => [
                    'delete' => ['POST'],
                ],
            ],
        ];
    }

    /**
     * Lists all Orders models.
     * @return mixed
     */
    public function actionIndex()
    {
        $searchModel = new OrdersSearch();
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams);

        return $this->render('index', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
        ]);
    }

    /**
     * Displays a single Orders model.
     * @param integer $id
     * @return mixed
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionView($id)
    {
        $session = Yii::$app->session;
        $session['order'] = [
            'id' => $id, //comanda curenta
        ];
        $status = new Statuses();
        $produs = new Orders();
        $produs->refreshOrder($id);
        $produse = new \app\models\ProduseSearch();
        $produseModel = $produse->search(['comandaID'=>$id]);
        $produseModel->query->andFilterWhere(['comandaID'=>$id]);
        return $this->render('view', [
            'model' => $this->findModel($id),
            'status' =>$status->find()->all(),
            'produse' =>$produseModel,
            'response'=>'',
        ]);
    }

    /**
     * Creates a new Orders model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return mixed
     */
    public function actionCreate()
    {
        $model = new Orders();
        $status = new \app\models\Statuses();

        if (Yii::$app->request->isPost) {
            $model->clientID = Yii::$app->user->identity->id;
            $model->workerID = NULL;
            $model->dataPlasat = date('Y-m-d');
            $model->status = $status->getDefault();
            $model->pretTotal = 0.0;
            if($model->save()) {
                return $this->redirect(['view', 'id' => $model->id]);
            } else {
                Yii::$app->session->setFlash('error', 'Eroare de sistem, nu s-a putut salva comanda. Te rugam sa incerci mai tarziu');
            }
        }
        return $this->render('create', [
            'model' => $model,
        ]);
    }

    /**
     * Updates an existing Orders model.
     * If update is successful, the browser will be redirected to the 'view' page.
     * @param integer $id
     * @return mixed
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionUpdate($id)
    {
        $model = $this->findModel($id);

        if ($model->load(Yii::$app->request->post()) && $model->save()) {
            $produs = new Orders();
            $produs->refreshOrder($id);
            return $this->redirect(['view', 'id' => $model->id]);
        }

        return $this->render('update', [
            'model' => $model,
        ]);
    }

    /**
     * Deletes an existing Orders model.
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
    
    public function actionModifica($id,$status) {
        $reg = Orders::findOne($id);
        $reg->status = $status;
        $reg->workerID = Yii::$app->user->identity->id;
        if($reg->update()) {
            $produs = new Orders();
            $produs->refreshOrder($id);
            Yii::$app->session->setFlash('success', 'Comanda a fost actualizata cu succes');
        } else {
            Yii::$app->session->setFlash('error', 'Eroare la salvarea modificarilor');
        }
        return $this->redirect(['view','id'=>$id]);
    }
    
    public function actionPjax($id) {
        $elComanda = new \app\models\Elementecomanda();
        $prods = new \app\models\Produse();
        return $this->renderPartial('_adaugaProdus',[
            'response' => $elComanda->findAll(['produsID'=>$id]),
            'model' => $prods,
        ],true);
    }

    public function actionAdaugaalbum($id) {
        return $this->render('_adaugaProdus',[
            'id' => $id
        ]);
    }
    
    public function actionAdaugamapadvd($id) {
        return $this->render('mapedvd',[
            'id' => $id
        ]);
    }
    
    public function actionAdaugacutie($id) {
        return $this->render('mapedvd',[
            'id' => $id
        ]);
    }
    public function actionAdaugaprint($id) {
        return $this->render('mapedvd',[
            'id' => $id
        ]);
    }
    public function actionAdaugacutiestick($id) {
        return $this->render('cutieStick',[
            'id' => $id
        ]); 
    }
    
    /**
     * Finds the Orders model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param integer $id
     * @return Orders the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id)
    {
        if (($model = Orders::findOne($id)) !== null) {
            return $model;
        }

        throw new NotFoundHttpException('Pagina cautata nu exista!');
    }
}
