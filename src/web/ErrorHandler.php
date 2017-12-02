<?php

namespace yii2module\error\web;

use yii2lab\domain\exceptions\UnprocessableEntityHttpException;

class ErrorHandler extends \yii\web\ErrorHandler
{
	
	protected function convertExceptionToArray($exception)
	{
		if ($exception instanceof UnprocessableEntityHttpException) {
			$array = $exception->getErrors();
			return $array;
		}
		return parent::convertExceptionToArray($exception);
	}

}
