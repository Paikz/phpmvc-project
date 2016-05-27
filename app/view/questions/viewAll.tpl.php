<h1 class="marcellus"><?=$title?></h1>
<?php if (is_array($questions)) : ?>
<div class='questions'>
  <?php foreach ($questions as $question) : ?>

  <a class="cleanLink" href='<?=$this->url->create('Questions/view/' . $question->getProperties()['slug'])?>'><?=$question->getProperties()['title']?></a>
  <?php
  $username = $user->findUsernameById($question->getProperties()['userId']);
  $username = $username[0]->username;
  ?>
  <br>
  <span>By: <a class="cleanLink" href='<?=$this->url->create('Users/id/' . $question->getProperties()['userId'])?>'><?= $username ?></a></span>
  <br>
  <span>Created: <?=$question->getProperties()['created']?></span>
  <br>
  <br>

  <?php endforeach; ?>
</div>
<?php else: ?>
	<p>No questions found</p>
<?php endif; ?>
