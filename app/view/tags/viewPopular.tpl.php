<b><h3 class="optimus">Popular Tags:</h3></b>
<?php if(!empty($tags)) ?>
<?php foreach ($tags as $tag) : ?>
<div class="tag">
	<a class="cleanLink" href="<?=$this->url->create('Tags/view/' . $tag->getProperties()['slug'])?>"><?=$tag->getProperties()['name']?></a>
</div>
<?php endforeach; ?>
