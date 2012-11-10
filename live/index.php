<?php
	require_once('../template.php');
	$scripts = simplexml_load_file("scripts.xml")->script;
	h();
?>
<div class="row">
	<!-- main part -->
	<div class="span8">
		<h1 class="page-header">Live</h1>

		<div class="row">
			<div class="span8">
				<iframe src="http://epsilon-live.appspot.com/embedded.jsp?source=<?=urlencode(trim($scripts[2]->source))?>" frameborder="0" scrolling="no" style="height:600px;width:100%"></iframe>
				<h2>Live Scripts</h2>
				<p>You can copy/paste any of the following scripts in the editor above, modify them if you want, and finally run them.</p>
			</div>
		</div>

		<div class="row">
			<?php
			foreach ($scripts as $script) {
				$description = $script->description;
				$title = $script["title"];
				$source = (string)$script->source;
				$source = trim($source);
				?>
				<div class="span8">
					<h3 id="<?=$title?>"><?=$title?></h3>
					<p><strong>Description:</strong> <?=$description?></p>
					<pre class="prettyprint lang-eol"><?=$source?></pre>
				</div>
			<?}?>
		</div>
	</div>	
	<!-- end main part -->

	<!-- sidebar -->
	<div class="span4 sidebar">
		<!-- first element -->
		<? sB('Epsilon Live'); ?>
					<p>In the editor on the left, you can <strong>write and run EOL scripts</strong> (<a href="../doc/eol/">what is EOL?</a>) from your browser, without needing to download or install anything in your computer.</p>
					<p>Except for playing with the basic features of the language, you can also query and modify a real EMF model (which for simplicity, is Ecore itself).</p>
					<p>Below are several small EOL scripts which you can try. To try a script, copy/paste it in the editor on the left and then click the Run button to run it and see its output in the console.</p>
		<? sE(); ?>
		<!-- end first element -->

		<? sB('Live Scripts'); ?>
					<ul>
						<?
						foreach ($scripts as $script) {
							$title = $script["title"];
							?>
							<li><a href="#<?=$title?>"><?=$title?></a>
						<?}?>
					</ul>
		<? sE(); ?>

	</div>
	<!-- end sidebar -->
</div>
<?php
	f(array(
		'<script>
			prettyPrint();
			var $sidebar = $(".sidebar");
			$sidebar.find("> div").eq(1).find("div").eq(0).affix({
				offset: {
					top: 410
				}
			});
		</script>'
	));
?>