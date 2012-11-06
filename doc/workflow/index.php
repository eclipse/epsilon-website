<?php
	require_once('../../template.php');
	require_once('../tools.php');
	h('Workflow');
?>
<div class="row">
	<!-- main part -->
	<div class="span8">
		<h1 class="page-header">Workflow</h1>

		<div class="row">
			<div class="span8">
				<p>Epsilon provides a set of ANT tasks (<a href="http://ant.apache.org">what is ANT?</a>) to enable developers to assemble complex workflows (build scripts) that involve both MDE (e.g. transformation, validation) and non-MDE (e.g. copying files, invoking compilers) tasks. Epsilon tasks are underpined by a communication mechanism that enables them to interact with each other by sharing models and variables.</p>
			</div>
		</div>

		<h3>Features</h3>
		<div class="row">
			<div class="span8">
				<ul>
					<li>Call Epsilon programs from ANT
					<li>Models are loaded once and tasks share them
					<li>Tasks can communicate by exporting/importing variables at runtime
					<li>Dedicated task for loading EMF models
					<li>Dedicated task for loading registered EMF EPackages
					<li>Can specify Epsilon code directly inside the tags of the task
				</ul>
			</div>
		</div>

		<div class="row">
			<div class="span8">
				<div class="alert alert-block">
					<h4 class="alert-heading">Important</h4>
		      		When running an ANT workflow that involves Epsilon tasks, please make sure you select the <strong>Run in the same JRE as the workspace</strong> option under the <strong>JRE</strong> tab of your launch configuration.
		      	</div>
	      	</div>
      	</div>
      	
		<h3>Examples and Screencasts</h3>
		<div class="row">
			<div class="span8">
				<ul>
					<li><a href="http://epsilonblog.wordpress.com/2009/05/24/new-in-epsilon-0-8-5/">Article: New in Epsilon 0.8.5 (ANT tasks for EMF models)</a>
					<li><a href="../../examples/index.php?example=org.eclipse.epsilon.examples.mddtif">Example: MDD-TIF Case study</a>
					<li><a href="../../examples/index.php?example=org.eclipse.epsilon.workflow.extension.example">Example: Provide custom/extended tasks for the workflow</a>
				</ul>
			</div>
		</div>

		<h3>Reference</h3>
		<div class="row">
			<div class="span8">
				<p>Chapter 11 of the <a href="../book">Epsilon book</a> provides a detailed description of the ANT tasks and their supported attributes/nested elements.</p>
			</div>
		</div>

	</div>	
	<!-- end main part -->

	<!-- sidebar -->
	<div class="span4">
		
		<?= toolsSideItem('workflow') ?>
		
	</div>
	<!-- end sidebar -->
</div>
<?php
	f();
?>