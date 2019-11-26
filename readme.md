# Yii commerce files module

### Install

**app/backend/config/main.php**
```php
// Enable backend routes
'modules' => [
    ...
    'files' => [
        'class' => yiicom\files\backend\Module::class
    ],
],

```
**app/console/config/main.php**
```php
// Enable module commands
'modules' => [
    ...
    'files' => [
        'class' => yiicom\files\console\Module::class
    ],
],

// Enable module migrations 
'params' => [
    ...
    'yii.migrations' => [
        ...
        '@yiicom/files/migrations',
    ],
],
```

Run migrations to create tables **files** and **files_presets**
```bash
php yii migrate
```
