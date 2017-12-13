Установка
===

Устанавливаем зависимость:

```
composer require yii2module/yii2-error
```

Объявляем в common модуль:

```php
return [
	'modules' => [
		// ...
		'error' => 'yii2module\error\Module',
		// ...
	],
];
```

Объявляем backend\config\main и frontend\config\main конфиг:

```php
'errorHandler' => [
	'errorAction' => 'error/error/error',
],
```
