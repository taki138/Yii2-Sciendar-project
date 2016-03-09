<?php

namespace backend\controllers;

use backend\models\ArticleCreate;
use backend\models\ArticleUpdate;
use kartik\helpers\Html;
use Yii;
use backend\models\Article;
use backend\models\ArticleSearch;
use yii\helpers\Json;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;
use yii\web\UploadedFile;

/**
 * ArticleController implements the CRUD actions for Article model.
 */
class ArticleController extends Controller
{
    public function behaviors()
    {
        return [
            'verbs' => [
                'class' => VerbFilter::className(),
                'actions' => [
                    'delete' => ['post'],
                ],
            ],
        ];
    }

    /**
     * Lists all Article models.
     * @return mixed
     */
    public function actionIndex()
    {
        $searchModel = new ArticleSearch();
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams);

        return $this->render('index', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
        ]);
    }

    /**
     * Displays a single Article model.
     * @param string $id
     * @return mixed
     */
    public function actionView($id)
    {
        $model = $this->findModel($id);
        $post = Yii::$app->request->post();

        if (Yii::$app->request->isAjax && isset($post['kvdelete'])) {
            if ($model && $model->delete()) {
                echo Json::encode([
                    'success'  => true,
                    'messages' => [
                        'kv-detail-info' => 'The article # ' . $model->id . ' was successfully deleted. ' . Html::a('<i class="glyphicon glyphicon-hand-right"></i>  Click here',
                                ['/article/index'], ['class' => 'btn btn-sm btn-info']) . ' to proceed.'
                    ]
                ]);
            } else {
                echo Json::encode([
                    'success'  => false,
                    'messages' => [
                        'kv-detail-warning' => 'Can not delete article',
                    ]
                ]);
            }
            return;
        }

        return $this->render('view', [
            'model' => $this->findModel($id),
        ]);
    }

    /**
     * Creates a new Article model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     *
     * @return mixed
     */
    public function actionCreate()
    {
        $model = new ArticleCreate();

        if ($model->load(Yii::$app->request->post())) {
            $model->previewImageFile = UploadedFile::getInstance($model, 'previewImageFile');

            $article = $model->create();
            if ($article) {
                return $this->redirect(['view', 'id' => $article->id]);
            }
        }

        return $this->render('create', [
            'model' => $model,
        ]);
    }

    /**
     * Updates an existing Article model.
     * If update is successful, the browser will be redirected to the 'view' page.
     *
     * @param string $id
     *
     * @return mixed
     * @throws \yii\web\NotFoundHttpException
     */
    public function actionUpdate($id)
    {
        $model = ArticleUpdate::findOne($id);
        if ($model === null) {
            throw new NotFoundHttpException('The requested page does not exist.');
        }

        $model->scenario = ArticleUpdate::SCENARIO_UPDATE;
        if ($model->load(Yii::$app->request->post())) {
            $model->previewImageFile = UploadedFile::getInstance($model, 'previewImageFile');

            if ($model->save()) {
                return $this->redirect(['view', 'id' => $model->id]);
            }
        }

        return $this->render('update', [
            'model' => $model,
        ]);
    }

    /**
     * Deletes an existing Article model.
     * If deletion is successful, the browser will be redirected to the 'index' page.
     * @param string $id
     * @return mixed
     */
    public function actionDelete($id)
    {
        $this->findModel($id)->delete();

        return $this->redirect(['index']);
    }

    /**
     * Finds the Article model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param string $id
     * @return Article the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id)
    {
        if (($model = Article::findOne($id)) !== null) {
            return $model;
        } else {
            throw new NotFoundHttpException('The requested page does not exist.');
        }
    }
}
