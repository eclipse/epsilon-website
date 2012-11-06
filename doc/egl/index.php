<?php
	require_once('../../template.php');
	require_once('../tools.php');
	h('Epsilon Generation Language');
?>
<div class="row">
	<!-- main part -->
	<div class="span8">
		<h1 class="page-header">Epsilon Generation Language</h1>

		<div class="row">
			<div class="span8">
				<p>EGL is a template-based model-to-text language for generating code, documentation and other textual artefacts from models. EGL supports content-destination decoupling, protected regions for mixing generated with hand-written code, and template coordination</p>
			</div>
		</div>

		<h3>Features</h3>
		<div class="row">
			<div class="span8">
				<ul>
					<li>Decouple content from destination (can be used to generate text to files, to the <a href="https://sourceforge.net/apps/mediawiki/kolovos/index.php?title=MiniGen">clipboard</a>, or as a <a href="http://code.google.com/p/epsilonlabs/wiki/EGLinTomcat">server-side scripting language</a> etc.)
					<li>Call templates (with parameters) from other templates
					<li>Define and call sub-templates
					<li>Mix generated with hand-written code
				</ul>
			</div>
		</div>

		<?=eolFeatures()?>

		<h3>Examples and Screencasts</h3>
		<div class="row">
			<div class="span8">
				<ul>
					<li><a href="http://code.google.com/p/epsilonlabs/wiki/EGLinTomcat">Tutorial: Using EGL as a server-side scripting language in Tomcat</a>
					<li><a href="../../examples/index.php?example=org.eclipse.epsilon.examples.egldoc">Example: Generate HTML from an Ecore metamodel</a>
					<li>Screencast: Generating an HTML report (<a href="../../cinema/#EglIntroduction">part 1</a>, <a href="../../cinema/#EglVariables">part 2</a>)
				</ul>
			</div>
		</div>

		<h3>Reference</h3>
		<div class="row">
			<div class="span8">
				<p>Chapter 7 of the <a href="../book">Epsilon book</a> provides a complete reference of the syntax and semantics of EGL.</p>
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