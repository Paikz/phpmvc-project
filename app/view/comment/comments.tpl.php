<h3 class="marcellus">Comments</h3>
<?php if (!empty($comments)) : ?>
  <?php foreach ($comments as $id => $comment) : ?>

    <?php $content = $this->textFilter->doFilter($comment->getProperties()['content'], 'shortcode, markdown'); ?>

    <?php $image = $user->getImageById($comment->getProperties()['userId']); ?>
  	<figure>
  		<img src='<?=$image?>?s=40'>
  	</figure>
  	<div>
    	<p><?=$user->getUserNameById($comment->userId)?>
      <span class='smaller'>(<?=$comment->timestamp?>)</span></p>
    	<?=$content?>
  	</div>
	<?php if ($user->isLoggedIn() && $user->matchingId($comment->userId)) : ?>
  	<div>
  		<p>
  			<a class="cleanLink" href='<?=$this->url->create('Comments/delete/' . $comment->id . '/' . $comment->userId)?>'>Delete</a>
  		</p>
  	</div>
  <?php endif; ?>
<?php endforeach; ?>
<?php else : ?>
<p>No comments</p>
<?php endif; ?>

<?php if ($this->session->has('user')) : ?>
  <?php if (isset($_GET['comment-reply']) && $_GET['comment-reply'] != $questionId && $_GET['type'] != $type)  : ?>
  <p style="font-size: .9em"><a class='cleanLink' href="?comment-reply=<?=$questionId?>&amp;type=<?=$type?>#comment-form">Leave a comment</a></p>
  <?php elseif (isset($_GET['comment-reply']) && $_GET['comment-reply'] == $questionId && $_GET['type'] == $type) : ?>
  <?php
  	$url = current(explode('?', $this->di->request->getCurrentUrl()));
  	$redirect = $this->url->create($url);
  ?>
  <p style="margin-left: 2.1em; font-size: .9em"><a class='cleanLink' href="<?=$redirect?>">Hide</a></p>
  <?php else : ?>
  <p style="font-size: .9em"><a class='cleanLink' href="?comment-reply=<?=$questionId?>&amp;type=<?=$type?>#comment-form">Leave a comment</a></p>
  <?php endif; ?>
<?php endif; ?>

<?php if(!empty($form)) : ?>
  <?=$form?>
<?php endif; ?>
