<h1 class="marcellus"><?=$title?></h1>

<?=$content?>

<?php if (isset($links)) : ?>
<ul>
<?php foreach ($links as $link) : ?>
<li><a href="<?=$link['href']?>"><?=$link['text']?></li>
<?php endforeach; ?>
</ul>
<?php endif; ?>
<br>
<a class="cleanLink" href="Login/register">Register</a>
