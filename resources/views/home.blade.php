<!DOCTYPE html>
<html>
	<head>
		<meta charset="utf-8">
		<meta name="viewport" content="width=device-width, initial-scale=1.0">
		<title>Nonprofits API</title>
		<meta name="description" content="Search Nonprofit organizations">
		<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/css/bootstrap.min.css" integrity="sha384-1q8mTJOASx8j1Au+a5WDVnPi2lkFfwwEAa8hDDdjZlpLegxhjVME1fgjWPGmkzs7" crossorigin="anonymous">
		<style>
			tt, pre, code { font-family: Consolas, "Liberation Mono", Courier, monospace; background-color: transparent !important; }
			pre.prettyprint { border: 0px !important; background-color: #fff; margin-bottom: -0.5em; }
			table { width: 100%; border-collapse: collapse; margin-bottom: 1.3em; }
			th { background: #ededed; }
			td, th { padding: 6px 9.5px; border: 1px solid #ddd; text-align: left; }
			tbody tr:nth-of-type(even){ background:rgba(220,220,220,0.2); }
			.panel-heading h2 { margin-top: 0.5em; }
			.bg-default { background-color: #F8F8F8; }
			.snippet { background: #F8F8; list-style: none; display: none; }
			.snippet-toggle { margin-top: -0.3em; }
			.panel-body tbody tr td:first-child strong { padding-right: 0.8em; }
		</style>
	</head>
	<body>
		<div class="container">
			<div class="row">
				<div class="col-md-12">
					<div class="page-header">
						<h1>Nonprofits API</h1>
						<h2><small><p>Search Nonprofit organizations</p>
</small></h2>
					</div>
				</div>
			</div>
			<div class="row" style="margin-bottom: 2em;">
				<div class="col-md-12">
<ul class="nav nav-pills" id="group-tab">
	
		<li><a href="#nonprofits" data-toggle="tab"><strong>Nonprofits</strong></a></li>
	
</ul>
</div>
			</div>
			<div class="row">
				<div class="col-xs-12 col-sm-12 col-md-12">
					<div class="tab-content">

	<div class="tab-pane" id="nonprofits">
		<div class="panel panel-default">
			<div class="panel-heading">
				<h2 id="nonprofits">Nonprofits</h2>
			</div>
			<div class="panel-body">
				<p class="lead"><small></small></p>
				

	
	
	
	<div class="panel panel-info">
		<div class="panel-heading">
			<span class="btn btn-primary">GET</span>
			<code>/api/nonprofits/search{?q}</code>
		</div>
		<div class="panel-body">
			<p>Retrieves the coupon with the given ID.</p>

		</div>
		<ul class="list-group">
			
				<li class="list-group-item bg-default"><strong>Parameters</strong></li>
				<li class="list-group-item">
<dl class="dl-horizontal">
	
		<dt>q</dt>
		<dd>
		
			<strong>(required)</strong>
		
		<code>string</code> Search Query for the nonprofits

		</dd>
	
</dl>
</li>
			
			
	
		
	

		
	
		<li class="list-group-item bg-default response">
			<strong>Response <code>200</code></strong>
			<a href="javascript:;" class="pull-right btn btn-link btn-sm snippet-toggle">SHOW</a>
		</li>
		<li class="list-group-item snippet">
			
				<code>&lt; Content-Type: application/json</code><br>
			
			
				<pre class="prettyprint">{
  &#34;data&#34;: [
    {
      &#34;id&#34;: 25,
      &#34;ein&#34;: &#34;0012343&#34;,
      &#34;name&#34;: &#34;Chicago Art House&#34;,
      &#34;city&#34;: &#34;Chicago&#34;,
      &#34;state&#34;: &#34;IL&#34;,
      &#34;deductibility_status_code&#34;: [
        &#34;PE&#34;,
        &#34;SOUNK&#34;
      ]
    }
  ]
}</pre>
			
		</li>
	

	

		</ul>
	</div>
	


			</div>
		</div>
	</div>

</div>
				</div>
			</div>
		</div>
		<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/2.2.3/jquery.min.js"></script>
		<script src="https://cdn.rawgit.com/google/code-prettify/master/loader/run_prettify.js"></script>
		<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/js/bootstrap.min.js" integrity="sha384-0mSbJDEHialfmuBBQP6A4Qrprq5OVfW37PRR3j5ELqxss1yVqOtnepnHVP9aJ7xS" crossorigin="anonymous"></script>
		<script>
			jQuery(function($) {
 				$('#group-tab a[data-toggle="tab"]').on("click", function(e) {
 					window.location.hash = $(this).attr("href");
 				});

 				if(window.location.hash){
 					$('#group-tab a:first').tab('show');
 					$('#group-tab a[href$="'+ window.location.hash +'"]').tab("show");
 				} else {
 					$('#group-tab a:first').tab('show');
 				}

				$('.snippet-toggle').on("click", function(e) {
					e.preventDefault();
					var target = $(this).data('target');
					$(this).parent().next().toggle();
					if ($(this).text() == "SHOW") {
						$(this).text("HIDE");
					} else {
						$(this).text("SHOW");
					}
				});
			});
		</script>
	</body>
</html>






