<?php
	require_once('../../template.php');
	require_once('../tools.php');
	h('Epsilon Model Connectivity');
?>
<div class="row">
	<!-- main part -->
	<div class="span8">
		<h1 class="page-header">Epsilon Model Connectivity</h1>

		<div class="row">
			<div class="span8">
				<p>The vast majority of examples in this website demonstrate using  languages from Epsilon to manage EMF-based models. While Epsilon provides robust support for EMF models, it is not tied to EMF at all. In fact, Epsilon is underpined by an open model connectivity framework which developers can extend with support for additional types of models/modeling technologies by providing respective drivers. </p>
				<img src="../epsilon-architecture.png" style="padding-top:10px"/>		
				<p>For example, in EpsilonLabs, drivers are provided for managing <a href="http://epsilonlabs.wiki.sourceforge.net/MDR+driver">MDR models</a> and <a href="http://epsilonlabs.wiki.sourceforge.net/Z+driver">Z specifications</a> (which cannot be hosted in Epsilon's Eclipse Git repository due to licencing issues). As most people use the EMF driver, there is not much documentation about the other drivers. However, if you're interested in using/extending them (or even providing new drivers for other modeling technologies), we'll be more than happy to help if you let us know through the <a href="../../forum">forum</a>.</p>
			</div>

		</div>

		<h3>Features</h3>
		<div class="row">
			<div class="span8">
				<ul>
					<li>Manage models of different technologies (e.g. EMF and MDR) in the same program
					<li>Cross-technology transformations (e.g. transform an MDR model into an EMF model)
					<li>Provide drivers for additional modeling technologies
					<li>Runtime and user interface integration through a dedicated Eclipse extension point
				</ul>
			</div>

		</div>

		<h3>Reference</h3>
		<div class="row">
			<div class="span8">
				<p>Chapter 3 of the <a href="../book">Epsilon book</a> provides a complete 
		reference of the EMC.</p>
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