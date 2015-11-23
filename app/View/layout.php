<!DOCTYPE html>
<html lang="en">
	<head>
		<meta charset="utf-8">
		<meta http-equiv="X-UA-Compatible" content="IE=edge">
		<meta name="viewport" content="width=device-width, initial-scale=1">
		<title>Square API : <?php echo '/'.str_replace('.', '/', $path);?></title>

		<!-- Bootstrap CSS -->
		<?php echo $exe->asset->js('js/jquery-1.11.3.min.js');?>
		<title>Square API : <?php echo '/'.str_replace('.', '/', $path);?></title>

		<!-- Bootstrap CSS -->
		<?php echo $exe->asset->css('css/bootstrap.min.css');?>

		<!-- HTML5 Shim and Respond.js IE8 support of HTML5 elements and media queries -->
		<!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
		<!--[if lt IE 9]>
			<script src="https://oss.maxcdn.com/libs/html5shiv/3.7.0/html5shiv.js"></script>
			<script src="https://oss.maxcdn.com/libs/respond.js/1.4.2/respond.min.js"></script>
		<![endif]-->
		<style type="text/css">
		*
		{
		}
		#left-menu
		{
			list-style: none;
			padding: 0px;
		}

		#left-menu li
		{
			padding: 5px 0 5px 0;
			border-bottom: 1px solid #dbdbdb;
		}
		.module
		{
			font-size: 1.3em;
		}
		.submodule
		{
			padding-left: 10px !important;
		}

		.api-table
		{
			width: 100%;
			margin-bottom: 20px;
			border-bottom: 1px solid #eeeeee;
		}

		.api-table th
		{
			vertical-align: top;
			width: 100px;
			background: #e1e1e1;
		}

		.api-table td
		{
			border-bottom: 1px solid #e1e1e1;
		}

		.api-table td, .api-table th
		{
			padding: 5px;
		}
		</style>
	</head>
	<body>
		<div class='container' style="margin-top: 40px;">
		<div class="row">
			<div class="col-xs-12 col-sm-12 col-md-12 col-lg-12">
				<?php $route = $exe->getRoute();?>
				<div>
					<ul class="nav nav-tabs">
  						<li <?php if($exe->hasRoute('@spec')):?>class="active"<?php endif;?>><a href="<?php echo $exe->url->base();?>">API</a></li>
  						<!-- <li <?php if($exe->hasRoute('@model')):?>class="active"<?php endif;?>><a href="<?php echo $exe->url->create('@model.add');?>">Response</a></li> -->
  						<li <?php if($exe->hasRoute('@model')):?>class="active"<?php endif;?>><a href="<?php echo $exe->url->create('@model.add');?>">Models</a></li>
  						<li <?php if($exe->hasRoute('@rule')):?>class="active"<?php endif;?>><a href="<?php echo $exe->url->create('@rule');?>">Rule of thumbs</a></li>
  					</ul>
				</div>
			</div>
		</div>
		<div class="row">
			<?php $view->render();?>
		</div>
		</div>
	</body>
</html>