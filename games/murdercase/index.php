<?php
	require_once('../../template.php');
	require_once('../../util.php');
	$game = simplexml_load_file("game.xml");
	h();
?>
<div class="row">
	<!-- main part -->
	<div class="span12">
		<h1 class="page-header"><?=$game["name"]?></h1>
		<p><?=$game->description?></p>
		
		<div class="row">
			<div class="span6">
				<div class="tabbable" style="margin-bottom: 0px;">
					<ul class="nav nav-tabs">
					    <li class="active"><a href="#editor" data-toggle="tab"><h4>Interactive Console</h4></a></li>
					    <li><a href="#hints" data-toggle="tab"><h4>Hints</h4></a></li>
					</ul>
				</div>
				<div class="tab-content">
  					<div id="editor" class="tab-pane active">
						<iframe src="http://epsilon-live.appspot.com/embedded.jsp?source=&button=search" frameborder="0" scrolling="no" style="height:600px;width:100%"></iframe>
					</div>
					<div id="hints" class="tab-pane">
					</div>
				</div>
			</div>
			<div class="span6">
				<div class="tabbable" style="margin-bottom: 0px;">
					<ul class="nav nav-tabs">
					    <li class="active"><a href="#metamodel" data-toggle="tab"><h4>Metamodel</h4></a></li>
					</ul>
					<div class="tab-content">
	  					<div id="metamodel" class="tab-pane active">
	  					<?
	  						$content = readUrlContent(Epsilon::getAbsoluteLocation("/games/murdercase/murdercase.emf"));
						?>
						<pre class="prettyprint lang-emf"><?=$content?></pre>
	  					</div>
	  				</div>
				</div>		
			</div>
		</div>
	</div>
</div>
<?f(array(
		'<script>
			prettyPrint();
		</script>'
	));?>