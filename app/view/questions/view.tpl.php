<h1 class="marcellus"><?=$question->getProperties()['title']?></h1>
<p><?=$question->getProperties()['created']?></p>
	<figure>
		<img src="<?=$user->getProperties()['image']?>" />
			<?=$user->getProperties()['username']?>
      <?php if ($user->isLoggedIn() &&  $user->matchingId($question->getProperties()['userId'])) : ?>
			<br />
			<a class="cleanLink" href="<?=$this->url->create('Questions/update/' . $question->getProperties()['id']) . '/' . $question->getProperties()['userId']?>"><i class="fa fa-pencil"></i></a>
			<a class="cleanLink" href="<?=$this->url->create('Questions/delete/' . $question->getProperties()['id']) . '/' . $question->getProperties()['userId']?>"><i class="fa fa-trash"></i></a>
			<?php endif; ?>
	</figure>
	<div>
	<?php $content = $this->textFilter->doFilter($question->getProperties()['content'], 'shortcode, markdown')?>
	<?=$content?>
