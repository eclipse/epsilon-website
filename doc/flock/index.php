<?php
	require_once('../../template.php');
	require_once('../tools.php');
	h('Epsilon Flock');
?>
<div class="row">
	<!-- main part -->
	<div class="span8">
		<h1 class="page-header">Epsilon Flock</h1>

		<div class="row">
			<div class="span8">
				<p>Epsilon Flock is a model migration language built atop EOL, for updating models in response to metamodel changes. Flock provides a rule-based transformation language for specifying model migration strategies. A conservative copying algorithm automatically migrates model values and elements that are not affected by the metamodel changes.</p>
			</div>
		</div>

		<h3>Features</h3>
		<div class="row">
			<div class="span8">
				<ul>
					<li>Migrate models to re-establish consistency with an evolved metamodel</li>
					<li>Automatic copying of unaffected data</li>
					<li>Simple distribution of migration strategies using Eclipse extension point</li>
					<li>Declarative rules with imperative bodies</li>
					<li>Guarded rules</li>
				</ul>
			</div>
		</div>

		<?=eolFeatures()?>

		<h3>Examples and Screencasts</h3>
		<div class="row">
			<div class="span8">
				<ul>
					<li><a href="../../examples/index.php?example=org.eclipse.epsilon.examples.flock.petrinets">Example: Migrate Petri net models with Epsilon Flock</a>
					<li><a href="../../cinema/#FlockPetrinets">Screencast: Migrate Petri net models with Epsilon Flock</a>
					<li><a href="http://www.cs.york.ac.uk/ftpdir/reports/2010/YCS/450/YCS-2010-450.pdf">Technical Report: Motivation and aims of Flock, along with an example of using Flock to migrate a UML class diagram.</a>
				</ul>
			</div>
		</div>

	</div>	
	<!-- end main part -->

	<!-- sidebar -->
	<div class="span4">
		
		<?= toolsSideItem('flock') ?>
		
	</div>
	<!-- end sidebar -->
</div>
<?php
	f();
?>