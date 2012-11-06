<?php
	require_once('../../template.php');
	require_once('../tools.php');
	h('Epsilon Merging Language');
?>
<div class="row">
	<!-- main part -->
	<div class="span8">
		<h1 class="page-header">Epsilon Merging Language</h1>

		<div class="row">
			<div class="span8">
				<p>EML is a hybrid, rule-based language for merging homogeneous or heterogeneous models. As a merging language requires all the features of a transformation language (merging model A with an empty model into model B is equivalent to transforming A->B), EML reuses the syntax and semantics of <a href="../etl">ETL</a> and extends it with concepts specific to model merging.</p>
				<p>Before merging can be performed, correspondences between elements of the input models need to be established. This can be achieved using the <a href="../ecl">comparison language</a> of Epsilon (or using Java).
			</div>
		</div>

		<h3>Features</h3>
		<div class="row">
			<div class="span8">
				<ul>
					<li>Merge homegeneous models
					<li>Merge heterogeneous models
					<li>Complete specification of the merging logic
					<li>Declarative rules with imperative bodies
					<li>Export the merge trace to a custom model/format
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
					<li><a href="../../examples/index.php?example=org.eclipse.epsilon.examples.mergeentitywithvocabulary">Merge heterogeneous models with EML</a>
				</ul>
			</div>
		</div>

		<h3>Reference</h3>
		<div class="row">
			<div class="span8">
				<p>Chapter 10 of the <a href="../book">Epsilon book</a> provides a complete reference of the syntax and semantics of EML.</p>
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