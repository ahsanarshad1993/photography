<?php

namespace app\controllers;

use Yii;
use app\models\Albums;
use app\models\AlbumsSearch;
use app\models\ImagesSearch;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;

/**
 * AlbumsController implements the CRUD actions for Albums model.
 */
class AlbumsController extends Controller
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
     * Lists all Albums models.
     * @return mixed
     */
    public function actionIndex()
    {
        if (!Yii::$app->user->isGuest) {

            $searchModel = new AlbumsSearch();
            $dataProvider = $searchModel->search(Yii::$app->request->queryParams);

            return $this->render('index', [
                'searchModel' => $searchModel,
                'dataProvider' => $dataProvider,
            ]);
        }else{
            return $this->redirect(['images/featured']);
        }
    }

    /**
     * Displays a single Albums model.
     * @param integer $id
     * @return mixed
     */
    public function actionView($id)
    {
        return $this->render('view', [
            'model' => $this->findModel($id),
        ]);
    }

    /**
     * Creates a new Albums model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return mixed
     */
    public function actionCreate()
    {
        if (!Yii::$app->user->isGuest) {

            $model = new Albums();

            if ($model->load(Yii::$app->request->post()) && $model->save()) {
                // return $this->redirect(['view', 'id' => $model->id]);
                return $this->render('create', [
                    'model' => $model,
                    'albumsuccess' => true,
                ]);
            } else {
                return $this->render('create', [
                    'model' => $model,
                    'albumsuccess' => false,
                ]);
            }
        }else{
            return $this->redirect(['images/featured']);
        }
    }

    /**
     * Updates an existing Albums model.
     * If update is successful, the browser will be redirected to the 'view' page.
     * @param integer $id
     * @return mixed
     */
    public function actionUpdate($id)
    {
        if (!Yii::$app->user->isGuest) {

            $model = $this->findModel($id);

            if ($model->load(Yii::$app->request->post()) && $model->save()) {
                return $this->redirect(['view', 'id' => $model->id]);
            } else {
                return $this->render('update', [
                    'model' => $model,
                ]);
            }
        }else{
            return $this->redirect(['images/featured']);
        }
    }

    /**
     * Deletes an existing Albums model.
     * If deletion is successful, the browser will be redirected to the 'index' page.
     * @param integer $id
     * @return mixed
     */
    public function actionDelete($id)
    {
        if (!Yii::$app->user->isGuest) {
            $this->findModel($id)->delete();
            return $this->redirect(['index']);  
        }else{
            return $this->redirect(['images/featured']);
        }
    }

    /**
     * Finds the Albums model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param integer $id
     * @return Albums the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id)
    {
        if (($model = Albums::findOne($id)) !== null) {
            return $model;
        } else {
            throw new NotFoundHttpException('The requested page does not exist.');
        }
    }
    public function actionDisplay()
    {
        $searchModel = new AlbumsSearch();
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams);

        $searchImageModel = new ImagesSearch();
        $imageDataProvider = $searchImageModel->albumcoversearch();

        return $this->render('display', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
            'imageDataProvider' => $imageDataProvider,  
        ]);
    }
    public function actionDisplayone($id)
    {

        $searchModel = new ImagesSearch();
        $dataProvider = $searchModel->albumwisesearch($id);
        return $this->render('displayone', [
            'dataProvider' => $dataProvider,
            // 'model' => $model,
            'model' => $this->findModel($id),
        ]);

    }
}
