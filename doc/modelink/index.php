<?php
	require_once('../../template.php');
	require_once('../tools.php');
	h('ModeLink');
?>
<div class="row">
	<!-- main part -->
	<div class="span8">
		<h1 class="page-header">ModeLink</h1>

		<div class="row">
			<div class="span8">
				<p>ModeLink is an editor consisting of 2-3 side-by-side EMF tree-based editors, and in combination with the reflective <a href="../exeed">Exeed</a> editor, it is very convenient for establishing links between different models using drag-and-drop. ModeLink uses native EMF cross-resource references to capture links between different models and as such, models constructed with it can be then used by any EMF-compliant tool/language.</p>
			</div>
		</div>

		<h3>Screenshots</h3>
		<div class="row">
			<div class="span8">
				<img src="img/modelink.png" alt="">
			</div>
		</div>

		<h3>Examples and Screencasts</h3>
		<div class="row">
			<div class="span8">
				<ul>
					<li><a href="../../cinema/#ModeLink_part1">Screencast: Establishing links between models</a>
				</ul>
			</div>
		</div>

	</div>	
	<!-- end main part -->

	<!-- sidebar -->
	<div class="span4">
		
		<?= toolsSideItem() ?>
		
	</div>
	<!-- end sidebar -->
</div>
<?php
	f();
?>