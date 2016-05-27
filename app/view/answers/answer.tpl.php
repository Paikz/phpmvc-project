<hr />
<?php if (!empty($answer)) : ?>
<?php
	$isAuthenticated = $user[0]->isLoggedIn();
	$isCurrent = $user[0]->matchingId($answer->getProperties()['userId']);
	$answerId = $answer->getProperties()['id'];

?>
<div class='answer'>


		<img src="<?=$user[0]->getProperties()['image']?>" />
			<br>
			<span><?=$user[0]->getProperties()['username']?> (<?=$answer->getProperties()['created']?>) </span>
			<br>
			<?php if ($isAuthenticated && $isCurrent) : ?>

			<a class="cleanLink" href="<?=$this->url->create('answers/delete/' . $answer->getProperties()['id'] . '/' . $answer->getProperties()['userId'])?>"><i class="fa fa-trash"></i></a>
			<?php endif; ?>
	<div>
		<?php $content = $this->textFilter->doFilter($answer->getProperties()['content'], 'shortcode, markdown'); ?>
		<br>
		<span><?=$content?></span>
	</div>
</div>
<?php endif; ?>
