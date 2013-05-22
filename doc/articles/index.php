<?php
	require_once('../../template.php');
	// Create a parser and parse the articles.xml document.
	$categories = simplexml_load_file("articles.xml")->category;
	$articles = simplexml_load_file("articles.xml")->article;

	h('Articles');
?>
<div class="row">
	<!-- main part -->
	<div class="span8">
		<h1 class="page-header">Articles</h1>

		<div class="row">
			<div class="span8">
				<img class="pull-right" src="http://dev.eclipse.org/huge_icons/apps/accessories-text-editor.png" alt="">
				<p>This page contains an index of articles presenting a range of tools and languages in Epsilon. Should you find that an article contains errors or is inconsistent with the current release of Epsilon, please <a href="../../forum">let us know</a>.</p>
			</div>
		</div>

		<? foreach ($categories as $category) { ?>
			<h3 id="<?=$category["name"]?>" style="margin-bottom: 0"><?= $category["title"] ?></h3>
			<div class="row" style="margin-bottom: 25px">
				<div class="span8">
					<ul>
				  		<? foreach ($category->article as $article) { ?>
				  			<li><a href="<?=$article["name"]?>/"><?=$article["title"]?></a>: <?=$article->description?>
				  		<? } ?>
			  		</ul>
			  		
			  		<? foreach ($category->subcategory as $subcategory) { ?>
			  			<h5><?= $subcategory["title"] ?></h5>
			  			<ul>
			  				<? foreach ($subcategory->article as $article) { ?>
			  					<li><a href="<?=$article["name"]?>/"><?=$article["title"]?></a>: <?=$article->description?>
			  				<? } ?>
			  			</ul>
			  		<? } ?>
		  		</div>
			</div>
	    <?}?>

	</div>	
	<!-- end main part -->

	<!-- sidebar -->
	<div class="span4">
		<!-- first element -->
		<div class="row">
			<div id="articleCategories" class="span4 affix">
				<div class="well" style="padding: 8px 0;">
					<ul class="nav nav-list">
						<li class="nav-header">Categories</li>
						<?php
						$first = true;
						foreach ($categories as $category) {
							if($first) {
								$first = false; ?>
						  		<li class="active"><a href="#<?=$category["name"]?>"><?=$category["title"]?></a></li>
						  	<?} else {?>
						  		<li><a href="#<?=$category["name"]?>"><?=$category["title"]?></a></li>
						<?}}?>
					</ul>
		<? sE(); ?>
		<!-- end first element -->

	</div>
	<!-- end sidebar -->
</div>
<?php
	f(array(
	'<script>
		$("body").scrollspy({
			offset: 46
		});
	</script>
'));
?>