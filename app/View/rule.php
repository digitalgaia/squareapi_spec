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

.wrap-code
{
	 background: black;
	 color: white;
	 tab-size: 4;
}

</style>
<div class="row" style="margin-bottom: 100px;">
	<div style="margin-left: auto; margin-right: auto;" class="col-xs-12 col-sm-12 col-md-12 col-lg-12">
		<h2>API Development rule of thumbs</h2>
		<p>A lot of things are still undecided. <a href='http://www.vinaysahni.com/best-practices-for-a-pragmatic-restful-api' target="_blank">This article</a> <b>may</b> provides some guideline to proper api design. Lot of api design spec on API tab is undecided.
		<p>Other great references :
			<ul>
				<li><a target="_blank" href='http://restcookbook.com/'>http://restcookbook.com</a></li>
				<li><a href='http://www.restapitutorial.com/lessons/httpmethods.html'>http://www.restapitutorial.com/lessons/httpmethods.html</a></li>
			</ul>
		</p>
		</p>
		<h3>1. Version</h3>
		<p>Will be specified through <b>header</b> or probably through uri <b>path</b> [undecided].</p>
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
				<th style="width: 150px;">Format</th><td>JSON</td>
			</tr>
			<tr>
				<th>Format negotiable?</th><td>Not sure.</td>
			</tr>
		</table>
		<h4>4.1 Response envelope</h4>
		<p>Whether to nicely envelop our response body or not is actually <b>still undecided</b>. However, below is what it may look like if we choose to envelop our response.</p>
		<p>Every response whether it's a success or error must return 200. And every successful response should be enveloped with <b>data</b> key. Sample response :</p>
		<pre class='wrap-code'><code>
{
	"data" : {
		"name" : "Blue Clothes",
		"image" : "http://img.square.my/product/12345.jpg",
		"price" : "25.50"
	}
}
		</code></pre>
		<p>Error and exception should be enveloped with <b>error</b> key, with another additional key like <b>message</b>, <b>fields</b> (optional), and <b>code</b>.<br>Sample response :</p>
		<pre class='wrap-code'><code>
{
	"error" : {
		"message" : "Some field is missing.",
		"code" : "101"
	}
}
		</code></pre>
		<p>There're actually another strict formats we can consider if we choose to envelop, <a href='http://jsonapi.org/format'>JSON API</a> for example.</p>
		<h4>4.2 To not envelop</h4>
		<p>The different is, the API user will deal directly with http standards. The same goes to the API developer (us). Below is usable status code on non enveloped response.</p>
		<h4 style="font-size: 1.3em;">4.2.1 HTTP Status Code</h4>
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
	</div>
</div>
<script type="text/javascript">

$('.wrap-code code').each(function()
{
	$(this).html($(this).html().trim());
});

</script>