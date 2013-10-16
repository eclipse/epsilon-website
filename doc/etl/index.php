<?php
	require_once('../../template.php');
	require_once('../tools.php');
	h('Epsilon Transformation Language - Model Transformation Language');
?>
<div class="row">
	<!-- main part -->
	<div class="span8">
		<h1 class="page-header">Epsilon Transformation Language</h1>

		<div class="row">
			<div class="span8">
				<p>ETL is a hybrid, rule-based model-to-model transformation language built on top of EOL.ETL provides all the standard features of a transformation language but also provides enhanced flexibility as it can transform many input to many output models,and can query/navigate/modify both source and target models.</p>
			</div>
		</div>

		<h3>Features</h3>
		<div class="row">
			<div class="span8">
				<ul>
					<li>Transform many input to many output models
					<li>Ability to query/navigate/modify both source and target models
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
					<li><a href="../../examples/index.php?example=org.eclipse.epsilon.examples.tree2graph">Transform a Tree model into a graph model with ETL</a>
					<li><a href="../../examples/index.php?example=org.eclipse.epsilon.examples.oo2db">Transform an OO model to a DB model with ETL</a>
				</ul>
			</div>
		</div>

		<h3>Reference</h3>
		<div class="row">
			<div class="span8">
				<p>Chapter 6 of the <a href="../book">Epsilon book</a> provides a complete reference of the syntax and semantics of ETL.</p>
			</div>
		</div>

	</div>	
	<!-- end main part -->

	<!-- sidebar -->
	<div class="span4">
		
		<?= toolsSideItem('etl') ?>
		
	</div>
	<!-- end sidebar -->
</div>
<?php
	f();
?>