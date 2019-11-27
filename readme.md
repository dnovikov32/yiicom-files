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


### Vue application setup

Add files store module to vue application general store

**app/backend/assets/src/store/store.js**
```js
import filesPresets from '../../../../vendor/yiicom/yiicom-files/src/backend/assets/src/store/presets.js'

export default new Vuex.Store({
    modules: {
        'files-presets': filesPresets
    }

});
```

Add files module routes to vue router

**app/backend/assets/src/index.js**
```js
import filesRoutes from '../../../vendor/yiicom/yiicom-files/src/backend/assets/src/routes/files.js';

const router = new VueRouter({
    mode: 'hash',
    linkActiveClass: 'active',
    routes: [
        ... filesRoutes
    ],
});
```

Add extra styles

**app/backend/assets/src/sass/main.scss**
```scss
@import '../../../../vendor/yiicom/yiicom-files/src/backend/assets/src/sass/files';
```
