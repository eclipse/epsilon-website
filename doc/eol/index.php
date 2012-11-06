<?php
	require_once('../../template.php');
	require_once('../tools.php');
	h('Epsilon Object Language');
?>
<div class="row">
	<!-- main part -->
	<div class="span8">
		<h1 class="page-header">Epsilon Object Language</h1>

		<div class="row">
			<div class="span8">
				
				  <a class="btn btn-primary pull-right" href="../../live">Try EOL in your browser! »</a>
				
				
				<p>EOL is an imperative programming language for creating, querying and modifying EMF models. You can think of it as a mixture of Javascript and OCL, combining the best of both worlds. As such, it provides all the usual imperative features found in Javascript (e.g. statement sequencing, variables, for and while loops, if branches etc.) and all the nice features of OCL such as those handy collection querying functions (e.g. <code>Sequence{1..5}.select(x|x>3))</code>.</p>
			</div>

		</div>

		<?=eolFeatures("Features")?>

		<h3>Examples and Screencasts</h3>
		<div class="row">
			<div class="span8">
				<ul>
					<li><a href="../../cinema/#BuildOOInstance_part2">Screencast: Writing and executing an EOL program</a>
					<li><a href="../../examples/index.php?example=org.eclipse.epsilon.examples.buildooinstance">Example: A simple EOL program that constructs an OO model</a>
					<li><a href="../../examples/index.php?example=org.eclipse.epsilon.examples.shortestpath">Example: Dijkstra's shortest path algorithm in EOL</a>
					<li><a href="../../examples/index.php?example=org.eclipse.epsilon.examples.calljava">Example: Call Java from EOL</a>
					<li><a href="../EpsilonTools.pdf">Article: Epsilon Tools Documentation (registering/accessing Java classes in Epsilon)</a>
					<li><a href="../EpsilonProfilingTools.pdf">Article: Epsilon Profiling Tools Documentation</a>
				</ul>
			</div>

		</div>

		<h3>Reference</h3>
		<div class="row">
			<div class="span8">
				<p>Chapter 4 of the <a href="../book">Epsilon book</a> provides a complete reference of the syntax and semantics of EOL.</p>
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