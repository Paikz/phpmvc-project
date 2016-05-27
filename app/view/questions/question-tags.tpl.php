<?php if (!empty($tags)) : ?>
  <?php foreach ($tags as $tag) : ?>
  <div class="tag">
    <a class="cleanLink" href='<?=$this->url->create('Tags/view/' . $tag->getProperties()['slug'])?>'><?=$tag->getProperties()['name']?></a>
  </div>
  <?php endforeach; ?>
<?php endif; ?>
