<h2>Viewing <span class='muted'>#<?php echo $post->id; ?></span></h2>

<p>
	<strong>User id:</strong>
	<?php echo $post->user_id; ?></p>
<p>
	<strong>Content:</strong>
	<?php echo $post->content; ?></p>

<?php echo Html::anchor('posts/edit/'.$post->id, 'Edit'); ?> |
<?php echo Html::anchor('posts', 'Back'); ?>