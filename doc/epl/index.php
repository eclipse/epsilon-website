<?php
	require_once('../../template.php');
	require_once('../tools.php');
	h('Epsilon Pattern Language - Pattern Matching Language');
?>
<div class="row">
	<!-- main part -->
	<div class="span8">
		<h1 class="page-header">Epsilon Pattern Language</h1>

		<div class="row">
			<div class="span8">
				<p>EPL is a pattern matching language built on top of EOL. EPL provides facilities for performing mattern matching on a model and produces a match model than can be used with the other Epsilon langauges in order to query, evaluate, tranform, etc. the found matches. A common scenario is to use the pattern matches as input for model transformations. </p>
			</div>
		</div>
		
		<h3>Features</h3>
		<div class="row">
			<div class="span8">
				<ul>
					<li>Match elements from one or many models
					<li>Ability to query/navigate the source models
					<li>Declarative patterns with imperative bodies
					<li>Automated pattern execution
                    <li>Filtering of pattern roles
                    <li>Support for negative, optional and active roles
					<li>Guarded patterns
				</ul>
			</div>
		</div>

		<?=eolFeatures()?>


		<h3>Examples and Screencasts</h3>
		<div class="row">
			<div class="span8">
				<ul>
                  <li><a href="../../examples/index.php?example=org.eclipse.epsilon.examples.epl">Find pattern matches in railway models using EPL</a>
				</ul>
			</div>
		</div>

		<h3>Reference</h3>
		<div class="row">
			<div class="span8">
				<p>Chapter 11 of the <a href="../book">Epsilon book</a> provides a complete reference of the syntax and semantics of EPL.</p>
			</div>
		</div>

	</div>	
	<!-- end main part -->

	<!-- sidebar -->
	<div class="span4">
		
		<?= toolsSideItem('epl') ?>
		
	</div>
	<!-- end sidebar -->
</div>
<?php
	f();
?>
