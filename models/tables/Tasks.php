<?php

namespace app\models\tables;

use Yii;

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
 */
class Tasks extends \yii\db\ActiveRecord
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
            [['title'], 'string', 'max' => 150],
            [['text'], 'string', 'max' => 255],
            [['responsible_id'], 'exist', 'skipOnError' => true, 'targetClass' => Users::class, 'targetAttribute' => ['responsible_id' => 'id']],
            [['author_id'], 'exist', 'skipOnError' => true, 'targetClass' => Users::class, 'targetAttribute' => ['author_id' => 'id']],
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
}
