<h3><?php echo $name;?> [<a href='<?php echo $exe->url->create('@model.edit', array('model' => $name));?>'>edit</a>]
<span class='pull-right'>[<a onclick="return confirm('Delete this model?');" href='<?php echo $exe->url->create('@model.delete', array('model' => $name));?>'>delete</a>]</span>
</h3>
<style type="text/css">
	
#data-table th
{
	border:0px;
}
</style>
<div class="row">
		<div class="col-xs-12 col-sm-12 col-md-12 col-lg-12">
			<table class='table' id='model-table'>
				<tr>
					<td>Name</td><td><?php echo $name;?></td>
				</tr>
				<tr>
					<td>Relation</td><td>
						<?php $relationTypes = array(
							'one-to-one' => 'Has one',
							'one-to-many' => 'Has many'
						);?>
						<?php if(count($relation) > 0):?>
							<?php foreach($relation as $rel):?>
							<div>- <?php echo $relationTypes[$rel['type']].' ';?><a href="<?php echo $exe->url->create('@model.view', array('model' => $rel['model']));?>"><?php echo '@'.$rel['model'];?></a></div>
							<?php endforeach;?>
						<?php else:?>
						- no relation found for this model -
						<?php endif;?>
					</td>
				</tr>
				<tr>
					<td>Description</td><td><?php echo $description;?></td>
				</tr>
				<tr>
					<td>Fields</td>
					<td>
						<table class='table' id='data-table'>
							<tr>
								<th style="width: 100px;">Name</th>
								<th>Description</th>
								<th style="width: 100px;">Type</th>
								<th>Required</th>
							</tr>
							<?php foreach($data as $row):?>
							<tr>
								<td><?php echo $row['name'];?></td>
								<td><?php echo $row['description'];?></td>
								<td><?php echo $row['type'];?></td>
								<td><?php echo $row['required'] ? 'true' : 'false';?></td>
							</tr>
							<?php endforeach;?>
						</table>
					</td>
				</tr>
				<tr>
					<td colspan="2"><input type='submit' class='btn btn-primary' style="background: #5f7dc5;" /></td>
				</tr>
			</table>
		</div>
	</div>