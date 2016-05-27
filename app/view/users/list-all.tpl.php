<h1 class="marcellus"><?=$title?></h1>

<?php foreach ($users as $user) : ?>

<div>
  <img src="<?=$user->image?>" alt="User Image">
  <div>
    <span>Username: <?=$user->username?></span>
    <br>
    <span>Created: <?=$user->created?></span>
    <br>
    <i class="fa fa-eye" aria-hidden="true"><a class="cleanLink" href='<?=$this->url->create('Users/id/' . $user->id)?>'></i>View detail</a>
    <br>
    <br>
  </div>
</div>

<?php endforeach; ?>
