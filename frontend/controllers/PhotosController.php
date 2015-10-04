<?php

namespace frontend\controllers;

use Yii;
use frontend\models\Photos;
use frontend\models\PhotosSearch;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;
use yii\web\UploadedFile;
use yii\imagine\Image;

/**
 * PhotosController implements the CRUD actions for Photos model.
 */
class PhotosController extends Controller
{
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
     * Lists all Photos models.
     * @return mixed
     */
    public function actionIndex()
    {
        $searchModel = new PhotosSearch();
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams);

        return $this->render('index', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
        ]);
    }

    /**
     * Displays a single Photos model.
     * @param string $id
     * @return mixed
     */
    public function actionView($id)
    {
        return $this->render('view', [
            'model' => $this->findModel($id),
        ]);
    }

    /**
     * Creates a new Photos model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return mixed
     */
    public function actionCreate()
    {
        $model = new Photos();

        if ($model->load(Yii::$app->request->post())) 
        {
            $model->file = UploadedFile::getInstance($model, 'file');
            
            $fileName = uniqid() . '.' . $model->file->extension;
            if ($model->file)
            {
                $model->file->saveAs('pics/'. $fileName);
                $model->name = $fileName;
                $model->created_at = date('Y-m-d H:i:s');
                if ($model->isAvatar)
                {
                    $model->relative->setImage($fileName);
                    $model->relative->save();
                }
//                $size = getimagesize('pics/'. $fileName);
//                $ratio = $size[0]/$size[1];
//                $width = 30;
//                $height = round($width/$ratio);
//                Image::thumbnail('pics/'. $fileName, $width, $height)->save('/pics/thumb/30_'.$fileName);                
                $model->save();
                return $this->redirect(['/relatives/view', 'id' => $model->relative_id]);
            }
            else 
            {
                return $this->render('create', [
                    'model' => $model,
                ]);                
            }
        } 
        else 
        {
            $relative_id = $_REQUEST['relative_id'];
            $model->relative_id = $relative_id;
            return $this->render('create', [
                'model' => $model,
            ]);
        }
    }

    /**
     * Updates an existing Photos model.
     * If update is successful, the browser will be redirected to the 'view' page.
     * @param string $id
     * @return mixed
     */
    public function actionUpdate($id)
    {
        $model = $this->findModel($id);

        if ($model->load(Yii::$app->request->post()) && $model->save()) {
            return $this->redirect(['view', 'id' => $model->id]);
        } else {
            return $this->render('update', [
                'model' => $model,
            ]);
        }
    }

    /**
     * Deletes an existing Photos model.
     * If deletion is successful, the browser will be redirected to the 'index' page.
     * @param string $id
     * @return mixed
     */
    public function actionDelete($id)
    {
        $record = $this->findModel($id);
        unlink('pics/'.$record->name);
        $record->delete();
        return $this->redirect(['index']);
    }

    /**
     * Finds the Photos model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param string $id
     * @return Photos the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id)
    {
        if (($model = Photos::findOne($id)) !== null) {
            return $model;
        } else {
            throw new NotFoundHttpException('The requested page does not exist.');
        }
    }
}
