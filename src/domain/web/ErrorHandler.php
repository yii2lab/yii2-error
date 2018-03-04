<?php

namespace yii2module\error\domain\web;

use yii2lab\domain\exceptions\UnprocessableEntityHttpException;
use yii2module\error\domain\helpers\UnProcessibleHelper;

class ErrorHandler extends \yii\web\ErrorHandler
{
	
	protected function convertExceptionToArray($exception)
	{
		if ($exception instanceof UnprocessableEntityHttpException) {
			$errors = $exception->getErrors();
			return UnProcessibleHelper::assoc2indexed($errors);
		}
		return parent::convertExceptionToArray($exception);
	}

}
