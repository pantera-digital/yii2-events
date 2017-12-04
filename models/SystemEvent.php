<?php

namespace pantera\events\models;

use Yii;
use yii\db\ActiveRecord;
use yii\web\Application;

/**
 * This is the model class for table "user_timeline".
 *
 * @property integer $id
 * @property string $model
 * @property integer $model_id
 * @property string $event
 * @property integer $user_id
 * @property string $created_at
 *
 */
class SystemEvent extends \yii\db\ActiveRecord
{
    /**
     * @param $event
     * @param $sender
     * @param null $user_id
     * @param null $created_at
     * @return SystemEvent
     */
    public static function add($event, ActiveRecord $sender, $user_id = null, $created_at = null)
    {
        if (is_null($user_id) && Yii::$app instanceof Application) {
            $user_id = Yii::$app->user->id;
        }
        $model = new SystemEvent();
        $model->event = $event;
        $model->model = $sender::className();
        $model->model_id = $sender->getPrimaryKey();
        $model->user_id = $user_id;
        if ($created_at) {
            $model->created_at = $created_at;
        }
        $model->save();
        return $model;
    }

    public function getModel()
    {
        $model = Yii::createObject($this->model);
        $model = $model::findOne($this->model_id);
        return $model;
    }

    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return '{{%system_event}}';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['model', 'model_id', 'event'], 'required'],
            [['model_id', 'user_id'], 'integer'],
            [['created_at'], 'safe'],
            [['model', 'event'], 'string', 'max' => 255],
        ];
    }
}
