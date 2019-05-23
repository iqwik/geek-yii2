<?php

namespace app\models\tables;

use yii\db\ActiveRecord;
use yii\db\BaseActiveRecord;
use yii\behaviors\TimestampBehavior;

/**
 * This is the model class for table "tasks".
 *
 * @property int $id
 * @property string $title
 * @property string $text
 * @property int $author_id
 * @property int $responsible_id
 * @property string $deadline
 * @property int $status_id
 *
 * @property Users $responsible
 * @property Users $author
 * @property TaskComments $taskComments
 * @property TaskAttachments $taskAttachments
 */
class Tasks extends ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'tasks';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['title', 'text', 'author_id', 'responsible_id', 'status_id'], 'required'],
            [['author_id', 'responsible_id', 'status_id'], 'integer'],
            [['deadline'], 'safe'],
            [['date_create'], 'safe'],
            [['date_update'], 'safe'],
            [['title'], 'string', 'max' => 150],
            [['text'], 'string', 'max' => 255],
            [['responsible_id'], 'exist', 'skipOnError' => true, 'targetClass' => Users::class, 'targetAttribute' => ['responsible_id' => 'id']],
            [['author_id'], 'exist', 'skipOnError' => true, 'targetClass' => Users::class, 'targetAttribute' => ['author_id' => 'id']],
        ];
    }

    public function behaviors()
    {
        return [
            'timestamp' => [
                'class' => TimestampBehavior::class,
                'attributes' => [
                    BaseActiveRecord::EVENT_BEFORE_INSERT => ['date_create'],
                    BaseActiveRecord::EVENT_BEFORE_UPDATE => ['date_update'],

                ],
                'value' => function(){
                    return gmdate("Y-m-d H:i:s");
                },
            ],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => 'Номер Задачи',
            'title' => 'Заголовок',
            'text' => 'Текст задачи',
            'author_id' => 'Автор',
            'responsible_id' => 'Исполнитель',
            'deadline' => 'Deadline',
            'date_create' => 'Дата создания',
            'date_update' => 'Дата обновления',
            'status_id' => 'Статус Задачи',
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getResponsible()
    {
        return $this->hasOne(Users::class, ['id' => 'responsible_id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getAuthor()
    {
        return $this->hasOne(Users::class, ['id' => 'author_id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getStatus()
    {
        return $this->hasOne(Status::class, ['id' => 'status_id']);
    }

    public function getTaskComments()
    {
        return $this->hasMany(TaskComments::class, ['task_id' => 'id']);
    }

    public function getTaskAttachments()
    {
        return $this->hasMany(TaskAttachments::class, ['task_id' => 'id']);
    }
}
