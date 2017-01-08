<?php

namespace app\controllers;

use Yii;
use app\models\Images;
use app\models\Albums;
use app\models\ImagesSearch;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;
use dosamigos\fileupload\FileUploadUI;
use app\models\UploadForm;
use yii\web\UploadedFile;

/**
 * ImagesController implements the CRUD actions for Images model.
 */
class ImagesController extends Controller
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
     * Lists all Images models.
     * @return mixed
     */
    public function actionIndex()
    {
        $searchModel = new ImagesSearch();
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams);
        if (!Yii::$app->user->isGuest) {
            return $this->render('index', [
                'searchModel' => $searchModel,
                'dataProvider' => $dataProvider,
            ]);
        }else{
            return $this->redirect(['images/featured']);
        }
    }

    /**
     * Displays a single Images model.
     * @param integer $id
     * @param integer $albums_id
     * @return mixed
     */
    public function actionView($id, $albums_id)
    {
        return $this->render('view', [
            'model' => $this->findModel($id, $albums_id),
        ]);
    }

    public function actionUpload(){
        echo "abc";
        print('arg');

        $fileName = 'file';
        $uploadPath = 'uploads';

       // die();
        if (isset($_FILES[$fileName])) {

            $file = \yii\web\UploadedFile::getInstanceByName($fileName);

            //Print file data
            //print_r('filesss: '.$file);

            if ($file->saveAs($uploadPath . '/' . $file->name)) {
                //Now save file data to database
                if($file->getHasError()){
                    $imageunsucessful = true;
                }else{
                    $imageunsucessful = false;
                }

                echo \yii\helpers\Json::encode($file);
                //die();
            }
        }

        return true;
    }

    /**
     * Creates a new Images model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return mixed
     */
    public function actionCreate()
    {
        $model = new Images();

        if ($model->load(Yii::$app->request->post())) {
            $filearray = array_unique($_POST['Images']['file']);
            // echo var_dump($filearray);
            // echo var_dump($imageunsucessful);
            // echo ;
            // die();
            for ($i=0; $i < count($filearray) ; $i++) {
                //$model->load(Yii::$app->request->post()) && $model->save()
                $im = new Images(); 
                $im->featured = $_POST['Images']['featured'];
                $im->albums_id = $_POST['Images']['albums_id'];
                $im->imageUrl = $filearray[$i];
                $im->save();
            }

            return $this->render('create', [
                'model' => $model,
                'imagesuccess' => true,
            ]);  

        }

        else{
            if (!Yii::$app->user->isGuest) {
                return $this->render('create', [
                    'model' => $model,
                    'imagesuccess' => false,
                ]);     
            }else{
                return $this->redirect(['images/featured']);
            }            
           
        }    

    }



    /**
     * Updates an existing Images model.
     * If update is successful, the browser will be redirected to the 'view' page.
     * @param integer $id
     * @param integer $albums_id
     * @return mixed
     */
    public function actionUpdate($id, $albums_id)
    {
        $model = $this->findModel($id, $albums_id);
        
        if (!Yii::$app->user->isGuest) {
            if ($model->load(Yii::$app->request->post()) && $model->save()) {
                return $this->redirect(['view', 'id' => $model->id, 'albums_id' => $model->albums_id]);
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
     * Deletes an existing Images model.
     * If deletion is successful, the browser will be redirected to the 'index' page.
     * @param integer $id
     * @param integer $albums_id
     * @return mixed
     */
    public function actionDelete($id, $albums_id)
    {
        if (!Yii::$app->user->isGuest) {
            $this->findModel($id, $albums_id)->delete();
            return $this->redirect(['index']);
        }else{
                return $this->redirect(['images/featured']);
        } 
    }


    /**
     * Finds the Images model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param integer $id
     * @param integer $albums_id
     * @return Images the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id, $albums_id)
    {
        if (($model = Images::findOne(['id' => $id, 'albums_id' => $albums_id])) !== null) {
            return $model;
        } else {
            throw new NotFoundHttpException('The requested page does not exist.');
        }
    }

    public function actionFeatured(){
        // $model = Images::find()->where(['featured' => 1]);


        $searchModel = new ImagesSearch();
        
        // $dataProvider = $searchModel->search(Yii::$app->request->queryParams);
        $dataProvider = $searchModel->featuredsearch(Yii::$app->request->queryParams);
        return $this->render('featured', [
            'dataProvider' => $dataProvider,
            // 'model' => $model,
        ]);
    }
}
