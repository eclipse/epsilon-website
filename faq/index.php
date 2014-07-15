<?php
	require_once('../template.php');
	$faqs = simplexml_load_file("faqs.xml")->faq;
	h('Frequently Asked Questions (FAQs)');
?>
<div class="row">
	<!-- main part -->
	<div class="span8">
		<h1 class="page-header">Frequently Asked Questions</h1>

		<!-- first row of content - change loop to div -->
		<div class="row">
			<div class="span8">
				<img class="pull-right" src="http://dev.eclipse.org/huge_icons/apps/help-browser.png" alt="">
				<p>In this page we provide answers to common questions about Epsilon. If your question is not answered here, please feel free to <a href="../forum">ask in the forum</a>.</p>
		
			</div>
		</div>
		<!-- end first row of content -->

		<?foreach ($faqs as $faq){?>
		<div class="row">
			<div class="span8">
				<h3 id="<?=$faq["id"]?>"><?=$faq->title?></h3>
				<p>
					<?=$faq->answer?>
				</p>
				<br/><br/>
			</div>
		</div>
		
		<?}?>

	</div>	
	<!-- end main part -->

	<!-- sidebar -->
	<div class="span4">
		<!-- first element -->
		<div class="row">
			<div id="faqs" class="span4 affix">
				<div class="well" style="padding: 8px 0;">
      				<ul class="nav nav-list">
      					<li class="nav-header">Overview</li>
						<?php
						$first = true;
						foreach ($faqs as $faq){
							if($first) {
								$first = false;?>
								<li class="active"><a href="#<?=$faq["id"]?>"><?=$faq->title?></a></li>
							<?} else {?>
							<li><a href="#<?=$faq["id"]?>"><?=$faq->title?></a></li>
						<?}}?>
					</ul>
		<? sE(); ?>
		<!-- end first element -->

	</div>
	<!-- end sidebar -->
</div>
<?php
$script = array(
	'<script>
		$("body").scrollspy({
			offset: 46
		});
	</script>
');
	f($script);
?>