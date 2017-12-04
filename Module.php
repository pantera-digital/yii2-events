<?php

namespace pantera\events;

use Yii;
use yii\web\Application;
use yii\base\Event;

class Module extends \yii\base\Module
{
    public $events = [];

    public function init()
    {
        parent::init();
        if (!empty($this->events)) {
            foreach ($this->events as $model => $events) {
                foreach ($events as $event) {
                    Event::on($model, $event, function ($e) {
                        \pantera\events\models\SystemEvent::add($e->name, $e->sender);
                    });
                }
            }
        }
    }
}
