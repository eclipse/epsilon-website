<?php
	require_once('../../template.php');
	require_once('ArticleReader.php');
	require_once(Epsilon::getIncludeLocation().'/doc/publications/PublicationsManager.php');
	
	$articleId =  strip_tags($_GET['articleId']);
	$articleReader = new ArticleReader();
	$article = $articleReader->readArticle($articleId);

	h($article->getTitle());
?>
<div class="row">
	<!-- main part -->
	<div class="span8">

		<div class="row">
			<div class="span8">
				<?if($article){?>
					<?=$article->getContent()?>
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

	<!-- sidebar -->
	<div class="span4">
		<!-- first element -->
		<?if($article){
			$publications = $articleReader->getArticle($articleId);
			if($publications) {
				$publications = $publications->publication;
				foreach ($publications as $publication){
					echo PublicationsManager::getPublicationSideItem(trim($publication));
			}
		}
		?>

		<?sB('Actions', true); ?>
					<ul>
						<li><a target="_blank" href="../print.php?articleId=<?=$articleId?>">Printer-friendly version</a>
						<li><a href="../../../forum/">Get help with this article</a>
						<li><a href="../">Back to the article index</a>
						<!--li><a href="../feed">RSS feed</a-->
					</ul>
		<? sE();?>
		
		<? } ?>

	</div>
	<!-- end sidebar -->
</div>
<?php
	f(array(
		'<script>
			prettyPrint();
		</script>'
	));
?>