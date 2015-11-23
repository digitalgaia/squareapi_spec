<style type="text/css">

.container
{
	width: 50%;
}

h3, h4
{
	margin-top: 20px;
}

h3
{
	background: #dfdfdf;
	padding:10px;
}

.http-status-table tr td:first-child
{
	width: 250px;
}

.http-status-table td
{
	border-bottom: 1px solid #dfdfdf;
	padding: 5px;
	font-family: "courier new";
}

</style>
<div class="row" style="margin-bottom: 100px;">
	<div style="margin-left: auto; margin-right: auto;" class="col-xs-12 col-sm-12 col-md-12 col-lg-12">
		<h2>API Development rule of thumbs</h2>
		<p>An itemized standards according to <a href='http://www.vinaysahni.com/best-practices-for-a-pragmatic-restful-api' target="_blank">this article</a>.</p>
		<h3>1. Version</h3>
		<p>Will be specified through <b>header</b>.</p>
		<h3>2. Authentication</h3>
		<p>- <b>access_token</b> is <a href='#'>required</a> on every request<br>
		- Token can be generated through <a href='<?php echo $exe->url->create('@spec', array('path' => 'user.auth'));?>'>authentication API</a>
		</p>
		<h3>3. Request</h3>
		<h4>3.1 Format</h4>
		<p>To be added later</p>
		<!-- Response -->
		<h3>4. Response</h3>
		<table>
			<tr>
				<th>Format</th><td>JSON</td>
			</tr>
			<tr>
				<th style="padding-right: 10px;">Response Status</th><td>Follow HTTP status code standard</td>
			</tr>
		</table>
		<h4>4.1. Error Response</h4>
		<p>
		HTTP Status code : <b>4XX</b><br>
		Response body with return field : <b>message</b><br>
		For response with multiple errors, return under field : <b>errors</b>
		</p>
		<h4>4.2. HTTP Status Code</h4>
		<table class='http-status-table'>
			<tr>
				<td>200 OK</td><td>Used on every successful GET, POST, PUT, DELETE request.</td>
			</tr>
			<tr>
				<td>201 Created</td><td>Used when a new content is created. Will respond with created object.</td>
			</tr>
			<tr>
				<td>204 No Content</td><td>Success but no content returned</td>
			</tr>
			<tr>
				<td>304 Not Modified</td><td>Only when cache is returned (later)</td>
			</tr>
			<tr>
				<td>401 Unauthorized</td><td>Non authorized request</td>
			</tr>
			<tr>
				<td>403 Forbidden</td><td>Authenticated user have no access to the resource. Maybe usable for premium case.</td>
			</tr>
			<tr>
				<td>404 Not Found</td><td>API endpoint Not found</td>
			</tr>
			<tr>
				<td>422 Unprocessable Entity</td><td>Used for validation errors</td>
			</tr>
			<tr>
				<td>429 Too Many Requests</td><td>Rate limiting error</td>
			</tr>
		</table>
		<h4>4.3 Response envelope</h4>
		<p>To be used only on certain occasion.</p>
	</div>
</div>