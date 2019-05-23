<?php

namespace app\controllers;

use Yii;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;
use app\components\EventSendMessage;
use app\models\filters\TasksFilter;
use app\models\tables\Tasks;
use app\models\tables\Users;
use app\models\tables\Status;
use app\models\tables\TaskComments;
use app\models\TaskAttachmentsAddForm;
use yii\web\UploadedFile;

/**
 * TaskController implements the CRUD actions for Tasks model.
 */
class TaskController extends Controller
{
    const EVENT_TASK_CREATED = 'event-task-created';
    /**
     * {@inheritdoc}
     */
    public function behaviors()
    {
        return [
            'verbs' => [
                'class' => VerbFilter::class,
                'actions' => [
                    'delete' => ['POST'],
                ],
            ],
        ];
    }

    /**
     * Lists all Tasks models.
     * @return mixed
     */
    public function actionIndex()
    {
        $searchModel = new TasksFilter();
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams);

        return $this->render('index', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
        ]);
    }

    public function actionOne($id)
    {
        $model = $this->findModel($id);

        if ($model->load(Yii::$app->request->post()) && $model->save()) {
            return $this->redirect(['one', 'id' => $model->id]);
        }

        return $this->render('one', [
            'model' => $model,
            'usersList' => $this->usersList(),
            'status' => $this->statusList(),
            'taskCommentForm' => new TaskComments(),
            'taskAttachmentForm' => new TaskAttachmentsAddForm(),
            'user_id' => Yii::$app->user->id
        ]);
    }

    public function actionCreate()
    {
        $model = new Tasks();

        if ($model->load(Yii::$app->request->post()) && $model->save()) {
            return $this->redirect(['one', 'id' => $model->id]);
        }

        return $this->render('create', [
            'model' => $model,
            'usersList' => $this->usersList(),
            'status' => $this->statusList()
        ]);
    }

    public function actionAddComment()
    {
        $model = new TaskComments();
        if($model->load(Yii::$app->request->post()) && $model->save()){
            Yii::$app->session->setFlash('success', 'Комментарий добавлен');
        } else {
            Yii::$app->session->setFlash('error', 'Комментарий не добавлен');
        }
        $this->redirect(Yii::$app->request->referrer);
    }

    public function actionAddAttachment()
    {
        $model = new TaskAttachmentsAddForm();
        $model->load(Yii::$app->request->post());
        $model->attachment = UploadedFile::getInstance($model, 'attachment');
        if ($model->save()) {
            Yii::$app->session->setFlash('success', "Файл загружен!");
        } else {
            Yii::$app->session->setFlash('error', "Не удалось загрузить Файл");
        }
        $this->redirect(Yii::$app->request->referrer);
    }

    protected function findModel($id)
    {
        if (($model = Tasks::findOne($id)) !== null) {
            return $model;
        }

        throw new NotFoundHttpException('The requested page does not exist.');
    }

    protected function usersList()
    {
        return Users::find()
                    ->select('username')
                    ->indexBy('id')
                    ->column();
    }

    protected function statusList()
    {
        return Status::find()
                    ->select('title')
                    ->indexBy('id')
                    ->column();
    }
}
