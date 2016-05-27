<h1 class="marcellus">User details</h1>
<div>
<img src="<?=$user->image?>" alt="User Image">
<br>
<span>Username: <?=$user->username?></span>
<br>
<span>Name: <?=$user->name?></span>
<br>
<span>Email: <?=$user->email?></span>
<br>
<span>Created: <?=$user->created?></span>
<br><br>

<h4><b>Questions Asked:</b></h4>
<?php if(!empty($questions)) : ?>
		<?php foreach ($questions as $question) : ?>
		<a class="cleanLink" href='<?=$this->url->create('Questions/view/' . $question->getProperties()['slug'])?>'><?=$question->getProperties()['title']?></a><br />
		<?php endforeach; ?>
		<?php else : ?>
		<p>No questions asked.</p>
<?php endif; ?>

<br>

<h4><b>Answers written:</b></h4>
		<?php if(!empty($answers)) : ?>
		<?php foreach ($answers as $answer) : ?>
		<?php
			$title = $answer->getProperties()['content'];
			if (strlen($title) >= 30) {
				$title = substr_replace($title, "[...]", 35, -1);
			}
		?>
		<?php $slug = $questionForSlug->getSlugByQuestionId($answer->getProperties()['idQuestion']); ?>
		<a class="cleanLink" href='<?=$this->url->create('Questions/view/' . $slug)?>'><?=$title?></a><br />
		<?php endforeach; ?>
		<?php else : ?>
		<p>No answers written.</p>
<?php endif; ?>

<?php if($username == $user->username) : ?>
<p><i class="fa fa-pencil" aria-hidden="true"><a class="cleanLink" href='<?=$this->url->create('Users/update/' . $user->id)?>'>Edit User</a></i></p>
<i class="fa fa-trash" aria-hidden="true"><a class="cleanLink" href='<?=$this->url->create('Users/delete/' . $user->id)?>'></i>
    Delete
</a>
<?php endif; ?>
</div>
