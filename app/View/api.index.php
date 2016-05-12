<p>This document serves an API design specification and development guidelines (not documentation) for Square. Number of things here are still undecided, and unreviewed. </p>
<p>Below are some specification decision taken previously (subject to changes)</p>
<h3>Request Response format</h3>
<ul>
	<li>Closely follow REST standards.</li>
	<li>Response on json (undecided whether it's negotiable)</li>
	<li>To envelop response or not.</li>
</ul>
<h3>Endpoints</h3>
<p>There're basically two major points in square. [public] end, and [user] end.</p>
<h4>Public end</h4>
<p>The question whether to expose public information (without token of authentication) or not is actually still subject to discussion.</p>
<h4>User end</h4>
<ul>
	<li>Every access to any user endpoints <b>must</b> be authenticated.</li>
	<li>API design on user /shop endpoint looks modular rather than resourceful.</li>
</ul>
<h3>Authentication on user endpoint</h3>
<p>Undecided</p>