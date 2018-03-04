<?php

/* @var $this yii\web\View */
/* @var $exception Exception */
/* @var $name string */
/* @var $message string */

$this->title = Yii::t('error/main', 'title');

?>
<div class="error">

	<h1>
		<?= $name ?>
	</h1>

	<div class="alert alert-danger">
		<?= nl2br($message) ?>
	</div>

</div>
