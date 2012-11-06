<?php
	require_once('../../template.php');
	require_once('../tools.php');
	h('Epsilon Validation Language');
?>
<div class="row">
	<!-- main part -->
	<div class="span8">
		<h1 class="page-header">Epsilon Validation Language</h1>

		<div class="row">
			<div class="span8">
				<p>EVL is a validation language built on top of EOL. In their simplest form, EVL constraints are quite similar to OCL constraints. However, EVL also supports dependencies between constraints (e.g. if constraint A fails, don't evaluate constraint B), customizable error messages to be displayed to the user and specification of fixes (in EOL) which users can invoke to repair inconsistencies. Also, as EVL builds on EOL, it can evaluate inter-model constraints (unlike OCL).</p>
			</div>
		</div>

		<h3>Features</h3>
		<div class="row">
			<div class="span8">
				<ul>
					<li>Distinguish between errors and warnings during validation (constraints and critiques)
					<li>Specify quick fixes for failed constraints
					<li>Guarded constraints
					<li>Specify constraint dependencies
					<li>Break down complex constraints to sequences of simpler statements
					<li>Automated constraint evaluation
					<li><a href="../articles/evl-gmf-integration/">Out-of-the-box integration with the EMF validation framework and GMF</a>
				</ul>
			</div>
		</div>

		<?=eolFeatures()?>

		<h3>Examples and Screencasts</h3>
		<div class="row">
			<div class="span8">
				<ul>
					<li><a href="../../cinema/#EVLGMFValidation">Screencast: Demonstrating the integration of EVL with GMF</a>
					<li><a href="../articles/evl-gmf-integration/">Article: Integrating EVL with an EMF/GMF editor</a>
					<li><a href="http://epsilonblog.wordpress.com/2008/11/09/error-markers-and-quick-fixes-in-gmf-editors-using-evl/">Blog: Error markers and quick fixes in GMF editors using EVL</a>
					<li><a href="../../examples/index.php?example=org.eclipse.epsilon.examples.validateoo">Example: Validate an OO model with EVL</a>
					<li><a href="../../cinema/#ModeLink_part2">Screencast: Evaluting inter-model constraints with EVL</a>
				</ul>
			</div>
		</div>

		<h3>Reference</h3>
		<div class="row">
			<div class="span8">
				<p>Chapter 5 of the <a href="../book">Epsilon book</a> provides a complete reference of the syntax and semantics of EVL.</p>
			</div>
		</div>

	</div>	
	<!-- end main part -->

	<!-- sidebar -->
	<div class="span4">
		
		<?= toolsSideItem('evl') ?>
		
	</div>
	<!-- end sidebar -->
</div>
<?php
	f();
?>