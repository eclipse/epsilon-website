<?php
	require_once('../../template.php');
	require_once('../tools.php');
	h('Epsilon Model Generation Language - Model Generation Language');
?>
<div class="row">
	<!-- main part -->
	<div class="span8">
		<h1 class="page-header">Epsilon Model Generation Language</h1>

		<div class="row">
			<div class="span8">
				<p>EMG addresses the automated generation of complex models. EMG provides a set of predefined annotations that can be added to EOL operations and EPL patterns in order to perform the model generation.</p>
			</div>
		</div>
		
		<h3>Features</h3>
		<div class="row">
			<div class="span8">
				<ul>
					<li>Create fixed or random number of elements of a given type
					<li>Use pseudo-random primitive type generators to populate element attributes
					<li>Use EPL patterns to define element relations	
					<li>Ability to query/navigate other models to retrieve attribute values
				</ul>
			</div>
		</div>

		<?=eolFeatures()?>

		<h3>Examples and Screencasts</h3>
		<div class="row">
			<div class="span8">
				<ul>
					<li><a href="../../examples/index.php?example=org.eclipse.epsilon.examples.emg.petrinet">Generate PetriNet models with EMG</a>
				</ul>
			</div>
		</div>

		<h3>Reference</h3>
		<div class="row">
			<div class="span8">
				<p>Chapter 12 of the <a href="../book">Epsilon book</a> provides a complete reference of the syntax and semantics of EMG.</p>
			</div>
		</div>

	</div>	
	<!-- end main part -->

	<!-- sidebar -->
	<div class="span4">
		
		<?= toolsSideItem('emg') ?>
		
	</div>
	<!-- end sidebar -->
</div>
<?php
	f();
?>