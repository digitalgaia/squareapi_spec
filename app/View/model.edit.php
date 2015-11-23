<script type="text/javascript">
	
var model = new function()
{
	this.addData = function()
	{
		var row = $($(".data-row")[0]).clone();
		row.find('input, textarea').val('');
		row.find('select').val('string');

		$("#data-table").append(row);
	}

	this.addRelation = function()
	{
		var row = $($(".row-relation")[0]).clone();
		row.find('select').val('');
		row.find('a').remove();

		$("#relation-container").append(row);
	}
}

</script>
<h3><?php echo $name;?> (editing)</h3>
<form action="" method="post">
<div class="row">
	<div class="col-xs-12 col-sm-12 col-md-12 col-lg-12">
		<table class='table' id='model-table'>
			<tr>
				<td>Name</td><td><?php echo $name;?>
				<input type='hidden' name='name' value="<?php echo $name;?>" />
				</td>
			</tr>
			<tr>
				<td>Relation <a href='javascript: model.addRelation();'>+</a></td><td id='relation-container'>
					<?php if(count($relation) > 0):?>
						<?php foreach($relation as $rel):?>
						<div class='row-relation'>
						<?php echo $exe->form->select('relation[type][]', array(
							'one-to-one' => 'Has one',
							'one-to-many' => 'Has many'), null, $rel['type'], '[Type]');?>
						<?php echo $exe->form->select('relation[model][]', $exe->modelList, null, $rel['model'], '[Model]');?> 
						</div>
						<?php endforeach;?>
					<?php else:?>
						<div class='row-relation'>
						<?php echo $exe->form->select('relation[type][]', array(
							'one-to-one' => 'Has one',
							'one-to-many' => 'Has many'), null, $rel['type'], '[Type]');?>
						<?php echo $exe->form->select('relation[model][]', $exe->modelList, null, $rel['model'], '[Model]');?> 
					<?php endif;?>
					</td>
			</tr>
			<tr>
				<td>Description</td><td><?php echo $exe->form->textarea('description', 'style="width: 100%; height: 80px;"');?></td>
			</tr>
			<tr>
				<td>Fields</td>
				<td>
					<table class='table' id='data-table'>
						<tr>
							<th style="width: 100px;">Name</th>
							<th>Description</th>
							<th style="width: 100px;">Type</th>
							<th><a href='javascript:model.addData();'>+</a></th>
						</tr>
						<?php foreach($data as $row):?>
						<tr class="data-row">
							<td><?php echo $exe->form->text('data[name][]', null, $row['name']);?></td>
							<td><?php echo $exe->form->textarea('data[description][]', 'style="width: 100%;"', $row['description']);?></td>
							<td>
								<?php echo $exe->form->select('data[type][]', null, null, $row['type']);?>
							</td>
							<td><input type='checkbox' name='data[required][]' <?php if($row['required']):?>checked<?php endif;?> /></td>
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
</form>