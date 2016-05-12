<style type="text/css">
.model-active
{
	font-weight: bold;
}
</style>
<div class="col-xs-3 col-sm-3 col-md-3 col-lg-3">
	<ul id='left-menu'>
		<li class='module'>Models [<a href='<?php echo $exe->url->base('model/add');?>'>add</a>]</li>
		<?php foreach($models as $model):?>
		<li <?php if($exe->isParams(array('model' => $model))):?>class='model-active'<?php endif;?>><a href='<?php echo $exe->url->create('@model.view', array('model' => $model));?>'><?php echo $model;?></a></li>
		<?php endforeach;?>
	</ul>
</div>
<div class="col-xs-9 col-sm-9 col-md-9 col-lg-9">
	<?php if($exe->flash->has('error')):?>
		<div class='alert alert-danger' style="margin-top: 5px;"><?php echo $exe->flash->get('error');?></div>
	<?php endif;?>
	<?php if($exe->flash->has('success')):?>
		<div class='alert alert-success' style="margin-top: 5px;"><?php echo $exe->flash->get('success');?></div>
	<?php endif;?>
	<?php echo $exe->view->create($view, $data)->render();?>
</div>