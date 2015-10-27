<!DOCTYPE html>
<html lang="en">
	<head>
		<meta charset="utf-8">
		<meta http-equiv="X-UA-Compatible" content="IE=edge">
		<meta name="viewport" content="width=device-width, initial-scale=1">
		<title>Square API : <?php echo '/'.str_replace('.', '/', $path);?></title>

		<!-- Bootstrap CSS -->
		<link href="//netdna.bootstrapcdn.com/bootstrap/3.2.0/css/bootstrap.min.css" rel="stylesheet">

		<!-- HTML5 Shim and Respond.js IE8 support of HTML5 elements and media queries -->
		<!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
		<!--[if lt IE 9]>
			<script src="https://oss.maxcdn.com/libs/html5shiv/3.7.0/html5shiv.js"></script>
			<script src="https://oss.maxcdn.com/libs/respond.js/1.4.2/respond.min.js"></script>
		<![endif]-->
		<style type="text/css">
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
		<div class='container' style="margin-top: 80px;">
		<div class="row">
			<div class="col-xs-2 col-sm-2 col-md-2 col-lg-2">
				<ul id='left-menu'>
					<?php foreach($apis as $module => $submodules):?>
						<li class='module'><?php echo $module;?></li>
						<?php foreach($submodules as $submodule):?>
							<li class='submodule'><a href='<?php echo $exe->url->create('spec', $submodule ? array('path' => $module.'.'.$submodule) : array());?>'><?php echo $submodule ? : '[base]';?></a></li>
						<?php endforeach;?>
					<?php endforeach;?>
				</ul>
			</div>
			<div class="col-xs-10 col-sm-10 col-md-10 col-lg-10">
				<h2>Square Api Specification</h2>
				<?php if($path == ''):?>
				<?php else:?>
						<h3><?php echo $path;?></h3>
					<?php if(!$data):?>
						<h3>The api isn't created yet.</h3>
					<?php else:?>
						<div class="row">
							<div class="col-xs-12 col-sm-12 col-md-12 col-lg-12">
								<?php foreach($data as $row):?>
									<table class='api-table'>
										<tr>
											<th>Path</th><td><?php echo $row['path'];?></td>
										</tr>
										<tr>
											<th>Description</th><td><?php echo $row['description'];?></td>
										</tr>
										<tr>
											<th>Parameters</th>
											<td>
												<div>Required</div>
												<ul>
													<?php if(count($row['parameters']['required']) == 0):?>
														<li>[none]</li>
													<?php endif;?>
													<?php foreach($row['parameters']['required'] as $param):?>
													<li><?php echo $param;?></li>
													<?php endforeach;?>
												</ul>
												<div>Optional</div>
												<ul>
													<?php if(count($row['parameters']['optional']) == 0):?>
														<li>[none]</li>
													<?php endif;?>
													<?php foreach($row['parameters']['optional'] as $param):?>
													<li><?php echo $param;?></li>
													<?php endforeach;?>
												</ul>
											</td>
										</tr>
									</table>
								<?php endforeach;?>
							</div>
						</div>
					<?php endif;?>
				<?php endif;?>
			</div>
		</div>
		</div>
	</body>
</html>