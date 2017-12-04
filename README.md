# yii2-events
Events management module for Yii Framework 2.x

## Установка
Предпочтительно через composer:
```
$ composer require pantera-digital/yii2-events "dev-master"
```

## Использование
Запустить миграции:
```
$ php yii migrate/up --migrationPath=@vendor/pantera-digital/yii2-events/migrations
```

Добавить в YOUR_APP/config/main.php (или YOUR_APP/config/main-local.php) в параметр modules:
```
'modules' => [
    ...
    'events' => [
        'class' => 'pantera\events\Module',
        'events' => [
            \your\model\namespace\YourModel::className() => [
                \your\model\namespace\YourModel::YOUR_MODEL_EVENT_KEY
            ],
        ],
    ],
    ...
],
```

Добавить в YOUR_APP/config/main.php (или YOUR_APP/config/main-local.php) в параметр bootstrap:
```
'bootstrap' => [..., 'events'],
```

При этом все вызовы сконфигурированных событий будут записаны в таблицу {{%system_event}}
