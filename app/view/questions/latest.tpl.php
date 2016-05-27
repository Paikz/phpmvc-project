<b><h3 class="optimus"><?=$title?></h3></b>
<?php if (is_array($questions)) : ?>
<div class='questions'>
  <?php foreach ($questions as $question) : ?>
  <a class="cleanLink" href='<?=$this->url->create('Questions/view/' . $question->getProperties()['slug'])?>'><?=$question->getProperties()['title']?></a>
  <br>
  <?php endforeach; ?>
</div>
<?php else: ?>
	<p>No questions found</p>
<?php endif; ?>
