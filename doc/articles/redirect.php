<?
require_once('../../../epsilon.php');
require_once('../../../template.php');
require_once('../ArticleReader.php');
require_once(Epsilon::getIncludeLocation().'/doc/publications/PublicationsManager.php');
	
function redirect() {
	$serverName = $_SERVER['SERVER_NAME'];
	if ($serverName == "eclipse.org") {
		//FIX if server == eclipse.org it doesn't work - for some reason
		$serverName = "www.eclipse.org";
	}
	if ($_SERVER['SERVER_PORT'] != 80) {
		// Useful if we're working locally on the website, with a custom port number
		$serverName = "$serverName:" . $_SERVER['SERVER_PORT'];
	}
	$requestUrl = $_SERVER["REQUEST_URI"];
	$requestUrl = trim($requestUrl,"/");
	$articleId = substr($requestUrl, strrpos($requestUrl,"/")+1);
	$articleReader = new ArticleReader();
	$article = $articleReader->readArticle($articleId);

	h($article->getTitle());
?>
<div class="row">
	<!-- main part -->
	<div class="span8">

		<div class="row">
			<div class="span12">
				<?if($article){?>
					<?=$article->getContent()?>
					<p>
					<div style="float:right"><i class="icon-print"></i>&nbsp;<a target="_blank" href="../print.php?articleId=<?=$articleId?>">Printer-friendly version</a></div>
					</p>
				<?} else {?>
					<div class="alert alert-block">
                      <h4 class="alert-heading">Warning</h4>
                      Article <?=$articleId?> not found. Go back to the <a href="..">index of articles</a>.
                  </div>
				<?}?>
				
			</div>
		</div>

	</div>	
	<!-- end main part -->

	
</div>
<?php
	f(array(
		'<script>
			prettyPrint();
		</script>'
	));
?>
<?
}
?>
