<?php echo Form::open(array("class"=>"form-horizontal")); ?>
	<input type="hidden" name="<?php echo \Config::get('security.csrf_token_key');?>" value="<?php echo \Security::fetch_token();?>" />
	<fieldset>
		<div class="form-group">
			<?php echo Form::label('Content', 'content', array('class'=>'control-label')); ?>
			<?php echo Form::textarea('content', Input::post('content', isset($post) ? $post->content : ''), array('class' => 'col-md-8 form-control', 'rows' => 8, 'placeholder'=>'Content')); ?>
		</div>
		<div class="form-group">
			<label class='control-label'>&nbsp;</label>
			<?php echo Form::submit('submit', 'Save', array('class' => 'btn btn-primary')); ?>		</div>
	</fieldset>
<?php echo Form::close(); ?>

