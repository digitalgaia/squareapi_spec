<script type="text/javascript">
	
var model = new function()
{
	this.addField = function()
	{
		var row = $($(".data-row")[0]).clone();
		row.find('input, textarea').val('');
		row.find('select').val('string');

		$("#data-table-body").append(row);
	}

	this.addRelation = function()
	{
		var row = $($(".row-relation")[0]).clone();
		row.find('select').val('');

		$("#relation-container").append(row);
	}

	this.deleteField = function(a)
	{
		if($('.data-row').length > 1)
			$(a).parent().parent().remove();
	}
}

</script>
<style type="text/css">
	
#model-table
{
	width: 100%;
}
#model-table input, #model-table select, #model-table textarea
{
	border:1px solid #c7c7c7;
	padding: 3px;
}

</style>
<form action="" method="POST" role="form">
	<legend><h3>Add new model</h3></legend>
	<p>Model here basically mean the standard defined object/format/resource to be returned by some of our endpoints. It is <b>not necessarily</b> a database table or our domain entities.</p>
	<div class="row">
		<div class="col-xs-12 col-sm-12 col-md-12 col-lg-12">
			<table class='table' id='model-table'>
				<tr>
					<td>Name</td><td><?php echo $exe->form->text('name');?></td>
				</tr>
				<tr>
					<td>Relation <a href='javascript: model.addRelation();'>+</a></td><td id='relation-container'>
						<div class='row-relation'><?php echo $exe->form->select('relation[type][]', array(
							'one-to-one' => 'Has one',
							'one-to-many' => 'Has many'), null, null, '[Type]');?>
						<?php echo $exe->form->select('relation[model][]', $exe->modelList, null, null, '[Model]');?> 
						</div></td>
				</tr>
				<tr>
					<td>Description</td><td><?php echo $exe->form->textarea('description')->attr('style="width: 100%; height: 80px;"');?></td>
				</tr>
				<tr>
					<td>Fields</td>
					<td>
						<table class='table' id='data-table'>
							<tr>
								<th style="width: 100px;">Name</th>
								<th>Description</th>
								<th style="width: 100px;">Type</th>
								<th><a href='javascript:model.addField();'>+</a></th>
								<th></th>
							</tr>
							<tbody id='data-table-body'>
							<tr class="data-row">
								<td><?php echo $exe->form->text('data[name][]');?></td>
								<td><?php echo $exe->form->textarea('data[description][]')->attr('style="width: 100%;"');?></td>
								<td>
									<?php echo $exe->form->select('data[type][]');?>
								</td>
								<td><input type='checkbox' name='data[required][]' /></td>
								<td><a href='javascript:void(0);' onclick='model.deleteField(this);'>x</a></td>
							</tr>
							</tbody>
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
<script type="text/javascript">
$("#data-table-body").sortable({
	handle: '.data-row'
});
</script>