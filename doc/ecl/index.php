<?php
	require_once('../../template.php');
	require_once('../tools.php');
	h('Epsilon Comparison Language');
?>
<div class="row">
	<!-- main part -->
	<div class="span8">
		<h1 class="page-header">Epsilon Comparison Language</h1>

		<div class="row">
			<div class="span8">
				<p>ECL is a hybrid, rule-based language for comparing homogeneous or heterogeneous models. ECL can be used to establish the correspondences on which models can be merged using the <a href="../eml">merging language</a> of Epsilon, or for transformation testing.</p>
			</div>
		</div>

		<h3>Features</h3>
		<div class="row">
			<div class="span8">
				<ul>
					<li>Compare homegeneous models
					<li>Compare heterogeneous models
					<li>Complete specification of the comparison logic
					<li>Export comparison results to <a href="../eml">EML</a> for merging
					<li>Export comparison results to a custom model/format
					<li>Declarative rules with imperative bodies
					<li>Automated rule execution
					<li>Lazy and greedy rules
					<li>Multiple rule inheritance
					<li>Guarded rules
				</ul>
			</div>
		</div>

		<?=eolFeatures()?>

		<h3>Examples and Screencasts</h3>
		<div class="row">
			<div class="span8">
				<ul>
					<li><a href="../../examples/index.php?example=org.eclipse.epsilon.examples.mergeentitywithvocabulary">Merge heterogeneous models with ECL/EML</a>
				</ul>
			</div>
		</div>

		<h3>Reference</h3>
		<div class="row">
			<div class="span8">
				<p>Chapter 9 of the <a href="../book">Epsilon book</a> provides a complete reference of the syntax and semantics of ECL.</p>
			</div>
		</div>

	</div>	
	<!-- end main part -->

	<!-- sidebar -->
	<div class="span4">
		
		<?= toolsSideItem('ecl') ?>
		
	</div>
	<!-- end sidebar -->
</div>
<?php
	f();
?>