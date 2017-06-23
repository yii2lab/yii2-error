<?php

namespace yii2module\error\controllers;

use yii\web\Controller;

/**
 * Error controller
 */
class ErrorController extends Controller
{

	/**
	 * @inheritdoc
	 */
	public function actions()
	{
		return [
			'error' => [
				'class' => 'yii\web\ErrorAction',
			],
		];
	}

}
