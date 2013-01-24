<?php
	require_once('../../template.php');
	require_once('../tools.php');
	h('Epsilon Unit Testing Framework');
?>
<div class="row">
	<!-- main part -->
	<div class="span8">
		<h1 class="page-header">Epsilon Unit Testing Framework</h1>

		<div class="row">
			<div class="span8">
				<p>EUnit is an unit testing framework built on top of the Epsilon platform. It is specifically designed for testing model management tasks, such as model-to-model transformations, model-to-text transformations and model validations, among others. EUnit can be used to test any model management task that is exposed through an Ant task, even if it is not part of the Epsilon platform.</p>
			</div>
		</div>

		<h3>Features</h3>
		<div class="row">
			<div class="span8">
				<ul>
					<li>Reuse tests over different sets of data or models.</li>
					<li>Test setup and model management tasks are performed through <a href="../workflow">ANT</a> tasks.</li>
					<li>Test teardown is implicit: models are reloaded automatically.</li>
					<li>Compare models, files and directories transparently with the included assertions.</li>
					<li>Models are compared using pluggable 'comparators', which allow for extending EUnit for other kinds of models.</li>
					<li>Generate test reports in the widely adopted XML format of the &lt;junit&gt; Ant Task.</li>
					<li>View aggregated test results and compare differences graphically in Eclipse.</li>
					<li>Generate models inside the test using EOL.</li>
					<li>Load models to be used in the test from HUTN fragments.</li>
				</ul>
			</div>
		</div>

		<?=eolFeatures()?>

        <h3>Availability</h3>
        <div class="row">
          <div class="span8">
            <p>
              EUnit can be installed from the regular Epsilon <a href="http://eclipse.org/epsilon/download/#updatesites">update sites</a>.
              These features need to be installed:
            </p>
            <ul>
              <li>Epsilon Core: contains the EUnit execution engine.</li>
              <li>Epsilon Core Development Tools: contains the EUnit Ant task and Eclipse integration.</li>
            </ul>
            <p>
              In addition, these features must be used in order to compare EMF models:
            </p>
            <ul>
              <li>Epsilon EMF Integration: contains the required Epsilon Model Connectivity drivers to load EMF models.</li>
              <li>Epsilon Development Tools for EMF: contains the EUnit comparator for EMF models, based on EMF Compare.</li> 
            </ul>
          </div>
        </div>

		<h3>Examples and Screencasts</h3>
		<div class="row">
			<div class="span8">
				<ul>
					<li><a href="../../examples/index.php?example=org.eclipse.epsilon.eunit.examples.eol">Example: Test EOL scripts with EUnit</a></li>
					<li><a href="../../examples/index.php?example=org.eclipse.epsilon.eunit.examples.bindings">Example: Reuse EUnit tests with model and data bindings</a></li>
					<li><a href="../../examples/index.php?example=org.eclipse.epsilon.eunit.examples.evl">Example: Test a model validation script with EUnit</a></li>
					<li><a href="../../examples/index.php?example=org.eclipse.epsilon.eunit.examples.egl.files">Example: Test a model-to-text transformation with EUnit</a></li>
					<li><a href="../../cinema/#eunit-etl">Screencast: Test an ETL model transformation with EUnit</a></li>
				</ul>
			</div>
		</div>

		<h3>Reference</h3>
		<div class="row">
			<div class="span8">
				<p>Chapter 12 of the <a href="../book">Epsilon book</a> provides a complete reference of how tests are organized and specified in EUnit.</p>
			</div>
		</div>

	</div>	
	<!-- end main part -->

	<!-- sidebar -->
	<div class="span4">
		
		<?= toolsSideItem('eunit') ?>
		
	</div>
	<!-- end sidebar -->
</div>
<?php
	f();
?>