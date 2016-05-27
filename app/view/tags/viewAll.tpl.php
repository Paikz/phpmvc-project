<h1 class="marcellus"><?=$title?></h1>
<?php if (is_array($tags)) : ?>
  <?php foreach ($tags as $tag) : ?>
  <div class="tag">
    <a class="cleanLink" href='<?=$this->url->create('Tags/view/' . $tag->getProperties()['slug'])?>'><?=$tag->getProperties()['name']?></a>
  </div>
  <?php endforeach; ?>
<?php else: ?>
	<p>No tags found</p>
<?php endif; ?>
