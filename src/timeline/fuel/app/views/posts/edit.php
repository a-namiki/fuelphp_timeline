<h2>Editing <span class='muted'>Post</span></h2>
<br>

<?php echo render('posts/_form'); ?>
<p>
	<?php echo Html::anchor('posts/view/'.$post->id, 'View'); ?> |
	<?php echo Html::anchor('posts', 'Back'); ?></p>
