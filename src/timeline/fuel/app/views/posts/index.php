<h2>Listing <span class='muted'>Posts</span></h2>
<br>
<?php if ($posts): ?>
<table class="table table-striped">
	<thead>
		<tr>
			<th>Content</th>
			<th>&nbsp;</th>
		</tr>
	</thead>
	<tbody>
		<?php foreach ($posts as $item): ?>
		<tr>
			<td><?php echo $item->content; ?></td>
			<td>
				<div class="btn-toolbar">
					<div class="btn-group">
						<?php echo Html::anchor('posts/view/'.$item->id, '<i class="icon-eye-open"></i> View', array('class' => 'btn btn-small')); ?>
						<?php echo Html::anchor('posts/edit/'.$item->id, '<i class="icon-wrench"></i> Edit', array('class' => 'btn btn-small')); ?>	
						<?php echo Html::anchor('posts/delete/'.$item->id, '<i class="icon-trash icon-white"></i> Delete', array('class' => 'btn btn-small btn-danger', 'onclick' => "return confirm('Are you sure?')")); ?>
					</div>
				</div>
			</td>
		</tr>
		<?php endforeach; ?>
	</tbody>
</table>

<?php else: ?>
<p>No Posts.</p>

<?php endif; ?><p>
	<?php echo Html::anchor('posts/create', 'Add new Post', array('class' => 'btn btn-success')); ?>

</p>
