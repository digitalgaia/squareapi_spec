<?php
$parseParam = function($param) use($exe)
{
	$params = explode(':', $param);

	$type = isset($params[1]) ? $params[0] : "String";
	$param = isset($params[1]) ? $params[1] : $params[0];

	$type = strpos($type, '@') === 0 ? '<a href="'.$exe->url->create('@model.view', array('model' => substr($type, 1))).'">'.substr($type, 1).'</a>' : $type;

	return $type.' '.$param;
};

$parseResponse = function($status, $content)
{
	return '<pre style="background: black; color: white;">HTTP '.$status.'
'.$content.'</pre>';
};

?>
<script type="text/javascript">

// trim <pre>
$(document).ready(function()
{
	$("pre").each(function()
	{
		$(this).html($(this).html().trim());
	});
});

</script>
<style type="text/css">

.submodule.active
{
	font-weight: bold;
}

</style>
<div class="col-xs-3 col-sm-3 col-md-3 col-lg-3">
	<ul id='left-menu'>
		<?php foreach($apis as $module => $submodules):?>
			<li class='module'><?php echo $module;?></li>
			<?php foreach($submodules as $submodule):?>
			<?php $selected = $exe->isRoute('@spec', array('path' => $module.'.'.$submodule)) ? 'active' : '';?>
				<?php if(!$submodule) continue;?>
				<li class='submodule <?php echo $selected;?>'>
					<a href='<?php echo $exe->url->create('spec', $submodule ? array('path' => $module.'.'.$submodule) : array());?>'><?php echo $submodule ? : '[base]';?>
					</a>
				</li>
			<?php endforeach;?>
		<?php endforeach;?>
	</ul>
</div>
<div class="col-xs-9 col-sm-9 col-md-9 col-lg-9">
<h2 style="letter-spacing: 2px; border-bottom: 1px solid #dbdbdb; padding-bottom: 20px;">Square Api Specification</h2>
	<?php if($path == ''):?>
		<?php echo $exe->view->create('api.index')->render();?>
	<?php else:?>
			<h3><b style="color: #b9b9b9;"><?php echo $path;?></b></h3>
		<?php if(!$data):?>
			<h3>The api specification isn't created yet.</h3>
		<?php else:?>
			<div class="row">
				<div class="col-xs-12 col-sm-12 col-md-12 col-lg-12">
					<?php foreach($data as $row):?>
						<table class='api-table'>
							<tr>
								<th>Path</th><td style="font-size: 1.4em; letter-spacing: 1px; font-weight: bold;"><?php echo $row['path'];?></td>
							</tr>
							<tr>
								<th>Description</th><td><?php echo $row['description'];?></td>
							</tr>
							<tr>
								<th>Parameters</th>
								<td>
									<div style="font-weight: bold;">Required</div>
									<ul>
										<?php if(count($row['parameters']['required']) == 0):?>
											<li>[none]</li>
										<?php endif;?>
										<?php foreach($row['parameters']['required'] as $param):?>
										<li><?php echo $parseParam($param);?></li>
										<?php endforeach;?>
									</ul>
									<div style="font-weight: bold;">Optional</div>
									<ul>
										<?php if(count($row['parameters']['optional']) == 0):?>
											<li>[none]</li>
										<?php endif;?>
										<?php foreach($row['parameters']['optional'] as $param):?>
										<li><?php echo $parseParam($param);?></li>
										<?php endforeach;?>
									</ul>
								</td>
							</tr>
							<tr>
								<th>Response</th>
								<td>
								<?php $response = $row['response'];?>
								<pre style="background: black; color: white;">
								<?php if(is_string($response)): // string based pattern ?>
									<?php if(strpos($response, '@') === 0): // return model ?>
									<?php $model = substr($response, 1);?>
Status : 200
Object <a href='<?php echo $exe->url->create("@model.view", array("model"=>$model));?>'><?php echo $response;?></a>
									<?php elseif(strpos($response, 'array:') === 0): // return array ?>
									<?php $model = substr($response, 7);?>
									<?php $url = $exe->url->create("@model.view", array('model' => $model));?>
Status : 200
Collection of Object <a href="<?php echo $url;?>">@<?php echo $model;?></a>
									<?php elseif($response != ''):?>
Status : 200
<?php echo $response;?>
									<?php else:?>
Status : 204
									<?php endif;?>
								<?php else: // array?>
Status : 200
<?php echo json_encode($response);?>
								<?php endif; ?>
								</pre>
								</td>
							</tr>
						</table>
					<?php endforeach;?>
				</div>
			</div>
		<?php endif;?>
	<?php endif;?>
</div>