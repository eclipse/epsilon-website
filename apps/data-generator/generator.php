<?php
	require_once('../../template.php');
	require_once('../../util.php');
	require_once('util.php');
	
	$generatorId = isset($_REQUEST['generator']) ? strip_tags($_REQUEST['generator']) : "";
	
	$generator = simplexml_load_file($generatorId."/generator.xml");
		
	$metamodel = $generator["metamodel"]."?version=".$generator["version"];
	$model = $generator["model"]."?version=".$generator["version"];
	$emfatic = $generator["emfatic"];
	
	h("Epsilon - Apps - ".$generator["name"]);
?>
<div class="row" id="iewarning">
	<div class="span12">
	<div class="alert alert-info" style1="font-weight:normal; background-color: rgb(214,238,247); color: rgb(24,136,173); border-color: rgb(181,233,241)">
		Like any decent web application, this game does not work on Internet Explorer.
    </div>
    </div>
</div>
<script>
if (navigator.userAgent.indexOf("MSIE") == -1) {
	document.getElementById("iewarning").style.display = 'none';
}
</script>
	<div class="row">
	<!-- main part -->
	
	<div class="span7">
		<legend><?=$generator["name"]?></legend>
		<p><?=$generator->description?></p>
	</div>

	<div class="span5">
		<legend>What is this?</legend>
		<p>This app demonstrates using the <a href="/epsilon/doc/egl">EGL model-to-text transformation language</a> for generating text from EMF models. You can download the <a href="<?=$generator["model"]?>">model</a> and the <a href="<?=$generator["metamodel"]?>">metamodel</a> behind this app and experiment with EGL <a href="/epsilon/download/">offline</a>.</p>
	</div>

	</div>
	<div class="row">
			<div class="span7">
				<div class="tabbable" style="margin-bottom: 0px;">
					<ul class="nav nav-tabs">
					    <li class="active"><a href="#editor" data-toggle="tab"><h4>Template</h4></a></li>
					</ul>
				</div>
				<div class="tab-content">
  					<div id="editor" class="tab-pane active">
						<iframe src="https://epsilon-live.appspot.com/embedded.jsp?language=egl&source=<?=urlencode(str_replace("\t", "  ", $generator->example))?>&button=play&editorHeight=200&consoleHeight=300&metamodel=<?=urlencode($metamodel)?>&model=<?=urlencode($model)?>" frameborder="0" scrolling="no" style="height:800px;width:100%"></iframe>
					</div>
				</div>
			</div>

			<div class="span5">
				<div class="tabbable" style="margin-bottom: 0px;">
					<ul class="nav nav-tabs">
					    <li class="active"><a href="#metamodel" data-toggle="tab"><h4>Metamodel</h4></a></li>
					</ul>
				</div>
				<div class="tab-content">
	  				<div id="metamodel" class="tab-pane active">
	  				<?
	  					$content = readEmfaticContent($emfatic);
					?>
					<pre class="prettyprint lang-emf"><?=$content?></pre>
	  				</div>
				</div>
			</div>
		
</div>

<?f(array(
		'<script>
			prettyPrint();
		</script>'
	));?>