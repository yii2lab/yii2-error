<?php

namespace yii2module\error\helpers;

use Yii;
use yii\helpers\Inflector;

class MessageHelper
{
	
	private static function load($exception) {
		$translateKey = $exception->statusCode ?: $exception->getName();
		$translateKey = Inflector::variablize($translateKey);
		$translateKey = Inflector::underscore($translateKey);
		$translate = Yii::t('error/main', $translateKey);
		if(empty($translate) || ! is_array($translate)) {
			$translate = [];
		}
		if(YII_ENV_PROD && !empty($translate) && empty($translate['message'])) {
			$translate['message'] = Yii::t('this/main', 'error_for_production');
		}
		$translate['title'] = $translate['title'] ?: $exception->getName();
		$translate['message'] = $exception->getMessage() ?: $translate['message'];
		
		if(YII_ENV_DEV) {
			$translate['title'] .= ' (#' . $translateKey . ')';
		}
		return $translate;
	}
	
	static function get($exception) {
		$translate = self::load($exception);
		$translate['message'] = str_replace('. ', '.<br/>',$translate['message']);
		return $translate;
	}
	
}
