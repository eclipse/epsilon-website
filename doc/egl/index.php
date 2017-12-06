<?php
	require_once('../../template.php');
	require_once('../tools.php');
	h('Epsilon Generation Language - Code Generation Language');
?>
<div class="row">
	<!-- main part -->
	<div class="span8">
		<h1 class="page-header">Epsilon Generation Language</h1>

		<div class="row">
			<div class="span8">
				<p>EGL is a template-based model-to-text language for generating code, documentation and other textual artefacts from models. EGL supports content-destination decoupling, protected regions for mixing generated with hand-written code, and provides a rule-based template coordination language (EGX).</p>
			</div>
		</div>

		<h3>Features</h3>
		<div class="row">
			<div class="span8">
				<ul>
					<li>Decouple content from destination (can be used to generate text to files, to the <a href="https://github.com/kolovos/minigen">clipboard</a>, or as a <a href="../articles/egl-server-side/">server-side scripting language</a> etc.)
					<li>Call templates (with parameters) from other templates
					<li>Define and call sub-templates
					<li>Mix generated with hand-written code
					<li>Coordinate template execution using a <a href="../articles/code-generation-tutorial-egl/">rule-based sub-language</a> (EGX)
				</ul>
			</div>
		</div>

		<?=eolFeatures()?>

		<h3>Examples and Screencasts</h3>
		<div class="row">
			<div class="span8">
				<ul>
					<li><a href="../articles/code-generation-tutorial-egl/">Code Generation Tutorial with EGL</a>
					<li><a href="../articles/egx-parameters/">Co-ordinating EGL template execution with EGX</a>
					<li><a href="../articles/egl-server-side/">Tutorial: Using EGL as a server-side scripting language in Tomcat</a>
					<li><a href="../../examples/index.php?example=org.eclipse.epsilon.examples.egldoc">Example: Generate HTML from an Ecore metamodel</a>
				</ul>
			</div>
		</div>

		<h3>Reference</h3>
		<div class="row">
			<div class="span8">
				<p>Chapter 7 of the <a href="../book">Epsilon book</a> provides a complete reference of the syntax and semantics of EGL and its rule-based template coordination language.</p>
			</div>
		</div>

	</div>	
	<!-- end main part -->

	<!-- sidebar -->
	<div class="span4">
		
		<?= toolsSideItem('egl') ?>
		
	</div>
	<!-- end sidebar -->
</div>
<?php
	f();
?>