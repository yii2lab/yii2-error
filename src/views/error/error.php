<?php

/* @var $this yii\web\View */
/* @var $exception Exception */

use yii2module\error\helpers\MessageHelper;

$this->title = Yii::t('error/main', 'title');

$translate = MessageHelper::get($exception);

?>
<div class="error">

	<h1>
		<?= $translate['title'] ?>
	</h1>

	<div class="alert alert-danger">
		<?= nl2br($translate['message']) ?>
	</div>

</div>
