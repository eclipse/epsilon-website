<?php
	require_once('../../template.php');
	require_once('../tools.php');
	h('EGX co-ordination language - EGL Co-ordinating');
?>
<div class="row">
	<!-- main part -->
	<div class="span8">
		<h1 class="page-header">Epsilon EVL Coordination Language</h1>

		<div class="row">
			<div class="span8">
				<p>EGX is a rule-based language for coordinating the execution of <a href="../egl/">EGL</a> templates. EGX provides an easy way to
				invoke and EGL template with a specific set of parameters, on a specific type
				of model elements and generate output on a paticular location.</p>
			</div>
		</div>

		<h3>Features</h3>
		<div class="row">
			<div class="span8">
				<ul>
					<li>Invoke an EGL template for each model element
					<li>Define parameters per element/template combination
					<li>Specify output file location per element/template combination
					<li>Guarded generation rules
				</ul>
			</div>
		</div>

		<?=eolFeatures()?>

		<h3>Examples and Screencasts</h3>
		<div class="row">
			<div class="span8">
				<ul>
					<li><a href="../articles/egx-parameters/">Co-ordinating EGL template execution with EGX</a>
					<li><a href="../articles/code-generation-tutorial-egl/">Code Generation Tutorial with EGL</a>
				</ul>
			</div>
		</div>

		<h3>Reference</h3>
		<div class="row">
			<div class="span8">
				<p>Chapter 7, Section 7.4 of the <a href="../book">Epsilon book</a> provides a complete reference of the syntax and semantics of EGX.</p>
			</div>
		</div>

	</div>	
	<!-- end main part -->

	<!-- sidebar -->
	<div class="span4">
		
		<?= toolsSideItem('egx') ?>
		
	</div>
	<!-- end sidebar -->
</div>
<?php
	f();
?>