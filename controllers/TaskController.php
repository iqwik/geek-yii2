<?php

namespace app\controllers;

use app\components\EventSendMessage;
use Yii;
use app\models\tables\Tasks;
use app\models\filters\TasksFilter;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;
use app\models\tables\Users;
use app\models\tables\Status;

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
            'status' => $this->statusList()
        ]);
    }

    public function actionCreate()
    {
        $model = new Tasks();

        if ($model->load(Yii::$app->request->post()) && $model->save()) {
            return $this->redirect(['view', 'id' => $model->id]);
        }

        return $this->render('create', [
            'model' => $model,
            'usersList' => $this->usersList(),
            'status' => $this->statusList()
        ]);
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
