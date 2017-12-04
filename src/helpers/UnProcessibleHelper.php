<?php

namespace yii2module\error\helpers;

use yii\base\Model;
use yii\helpers\ArrayHelper;

class UnProcessibleHelper
{
	
	public static function assoc2indexed($errors) {
		if(ArrayHelper::isIndexed($errors)) {
			return $errors;
		}
		if($errors instanceof Model) {
			$errors = $errors->getErrors();
		}
		return self::normalizeArray($errors);
	}
	
	private static function normalizeArray($errors) {
		$result = [];
		foreach($errors as $field => $error) {
			foreach ($error as $message) {
				$result[] = [
					'field' => $field,
					'message' => $message,
				];
			}
		}
		return $result;
	}
	
}
