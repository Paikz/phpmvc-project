<b><h3 class="optimus">Most active users:</h3></b>
<?php if(!empty($users)) ?>
<ol>
<?php foreach ($users as $user) : ?>
	<?php $id = $user->getProperties()['id']; ?>
	<?php $username = $user->getProperties()['username']; ?>
	<li><a class="cleanLink" href="<?=$this->url->create('users/id/' . $id)?>"><?=$username?></a></li>
<?php endforeach; ?>
</ol>
