<?php

namespace app\models;

use Yii;
use yii\base\Model;
use yii\imagine\Image;
use app\models\tables\TaskAttachments;


/**
 * TaskAttachmentsAddForm is the model behind the attach file to form.
 */
class TaskAttachmentsAddForm extends Model
{
    public $task_id;
    /** @var \yii\web\UploadedFile */
    public $attachment;

    private $filename;
    private $filepath;
    private $originalDir = '@img/tasks';
    private $thumbDir = '@img/tasks/thumb';

    public function rules()
    {
        return [
            [['task_id','attachment'], 'required'],
            ['task_id', 'integer'],
            ['attachment', 'file', 'extensions' => ['png','jpeg','jpg']]
        ];
    }

    public function save()
    {
        if($this->validate()){
            $this->saveUploadedFile();
            $this->createThumb();
            return $this->saveData();
        }
        return false;
    }

    private function saveUploadedFile()
    {
        $randomString = Yii::$app->security->generateRandomString();
        $this->filename = $randomString . '.' . $this->attachment->getExtension();
        $this->filepath = Yii::getAlias("{$this->originalDir}/{$this->filename}");
        $this->attachment->saveAs(
            $this->filepath
        );
    }

    private function createThumb()
    {
        Image::thumbnail($this->filepath, 100, 100)
            ->save(Yii::getAlias("{$this->thumbDir}/{$this->filename}"));
    }

    private function saveData()
    {
        $model = new TaskAttachments([
            'task_id' => $this->task_id,
            'filename' => $this->filename
        ]);
        return $model->save();
    }
}