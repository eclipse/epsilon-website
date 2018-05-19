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
				<iframe src="https://epsiloncloud.appspot.com/embedded2.html" frameborder="0" scrolling="no" style="height:600px;" class="span8"></iframe>
			</div>
		</div>


	</div>
	<!-- end main part -->

	<!-- sidebar -->
	<div class="span4">
		<!-- first element -->
		<div class="row">
			<div class="span4">
				<div class="well">
					<h6>Epsilon Live</h6>
					<p>In the editor on the left, you can <strong>write and run EOL scripts</strong> (<a href="../doc/eol/">what is EOL?</a>) from your browser, without needing to download or install anything in your computer.</p>
					<p>Except for playing with the basic features of the language, you can also query and modify a real EMF model (which for simplicity, is Ecore itself).</p>
					<p>Below are several small EOL scripts which you can try. To try a script, copy/paste it in the editor on the left and then click the Run button to run it and see its output in the console.</p>
				</div>
			</div>
		</div>
		<!-- end first element -->

		<div class="row">
			<div class="span4">
				<div class="well">
					<h6>Live Scripts</h6>
					<ul>
						<?
						foreach ($scripts as $script) {
							$description = $script->description;
							$title = $script["title"];
							$source = $script->source;
							?>
							<li><a href="#<?=$title?>"><?=$title?></a>
						<?}?>
					</ul>
				</div>
			</div>
		</div>

	</div>
	<!-- end sidebar -->
</div>

<div class="row">
	<div class="span12">
		<h2>Live Scripts Alternative 1</h2>
		<p>You can copy/paste any of the following scripts in the editor above, modify them if you want, and finally run them.</p>
	</div>
	<?php
	foreach ($scripts as $script) {
		$description = $script->description;
		$title = $script["title"];
		$source = (string)$script->source;
		$source = trim($source);
		?>
		<div class="span6">
			<h3 id="<?=$title?>"><?=$title?></h3>
			<p><strong>Description:</strong> <?=$description?></p>
			<pre class="prettyprint">
<?=$source?>
			</pre>
		</div>
	<?}?>
</div>

<div class="row">
	<div class="span12">
		<h2>Live Scripts Alternative 2</h2>
		<p>You can copy/paste any of the following scripts in the editor above, modify them if you want, and finally run them.</p>
	</div>
</div>
	<?php
	$i = 1;
	foreach ($scripts as $script) {
		$description = $script->description;
		$title = $script["title"];
		$source = (string)$script->source;
		$source = trim($source);
		if($i % 2) { ?>
	<div class="row">
		<?}
		?>
		<div class="span6">
			<h3 id="<?=$title?>"><?=$title?></h3>
			<p><strong>Description:</strong> <?=$description?></p>
			<pre class="prettyprint">
<?=$source?>
			</pre>
		</div>
	<?
	if(!($i % 2)) { ?>
	</div>
	<?}
	$i++;
	}
	if(!($i % 2)) { ?>
</div>
<? } ?>

<?php
	f(array(
		'<script>
			prettyPrint();
		</script>'
	));
?>
