<?php

namespace yii2module\error\domain\helpers;

use Yii;
use yii\helpers\Inflector;
use yii\web\HttpException;
use Exception;

class MessageHelper
{
	
	public static function get(Exception $exception) {
		$translate = self::getTranslate($exception);
		$translate = self::filterTranslate($translate, $exception);
		return $translate;
	}
	
	private static function getTranslateByClassName(Exception $exception) {
		$className = get_class($exception);
		$translate = Yii::t('error/exceptions', $className);
		if(is_array($translate)) {
			return $translate;
		}
		return null;
	}
	
	private static function getExceptionCode(Exception $exception)
	{
		if ($exception instanceof HttpException) {
			return $exception->statusCode;
		}
		return $exception->getCode();
	}
	
	private static function getExceptionName($exception)
	{
		if ($exception instanceof Exception) {
			$name = $exception->getName();
		} else {
			$name = 'Error';
		}
		if (YII_ENV_DEV && $code = self::getExceptionCode($exception)) {
			$name .= " (#$code)";
		}
		return $name;
	}
	
	private static function getTranslateByStatusCode(Exception $exception) {
		$translateKey = self::getExceptionCode($exception) ?: self::getExceptionName($exception);
		$translateKey = self::normalizeTranslateKey($translateKey);
		$translate = Yii::t('error/main', $translateKey);
		if(is_array($translate)) {
			return $translate;
		}
		return null;
	}
	
	private static function filterTranslate($translate, Exception $exception) {
		$translate['class'] = get_class($exception);
		$translate['code'] = self::getExceptionCode($exception);
		$translate['name'] = $translate['name'] ?: self::getExceptionName($exception);
		$translate['message'] = $exception->getMessage() ?: $translate['message'];
		if(YII_ENV_PROD && !empty($translate) && empty($translate['message'])) {
			$translate['message'] = Yii::t('error/main', 'error_for_production');
		}
		$translate['exception'] = $exception;
		return $translate;
	}
	
	private static function getTranslate(Exception $exception) {
		$translate = self::getTranslateByClassName($exception);
		if(!$translate) {
			$translate = self::getTranslateByStatusCode($exception);
		}
		return $translate;
	}
	
	private static function normalizeTranslateKey($translateKey) {
		$translateKey = Inflector::variablize($translateKey);
		$translateKey = Inflector::underscore($translateKey);
		return $translateKey;
	}
	
}
