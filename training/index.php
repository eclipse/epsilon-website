<?php
	require_once('../template.php');

	function tr($t1, $t2) {
		return "<tr><td>".$t1."</td><td>".$t2."</td></tr>";
	}

	h();
?>

<div class="row">
	<!-- main part -->
	<div class="span12">
		<h1 class="page-header">Training</h1>
		<div class="row">
			<div class="span12">
				<p>
				Following unprecedented levels of unverifiable requests, we plan to start offering hands-on training courses
				on Epsilon and on supporting Eclipse modeling technologies. Each course will consist of short lectures, live demonstrations 
				and hands-on sessions spread over 2 days and will cover the following topics.
				</p>

				<table class="table table-striped">
					<thead>
						<tr>
							<th>Day 1</th>
							<th>Day 2</th>
						</tr>
					</thead>
					<tbody>
					<?=tr("Introduction to Model Driven Engineering", "Model migration with Epsilon Flock")?>
					<?=tr("Modelling with the Eclipse Modeling Framework", "Model comparison and merging with the Epsilon Comparison/Merging Languages")?>
					<?=tr("Graphical editor development with the Graphical Modeling Framework and Eugenia", "In-place model transformation with the Epsilon Wizard Language")?>
					<?=tr("Foundations of programmatic model management with the Epsilon Object Language", "Model management workflows with Epsilon and ANT")?>
					<?=tr("Model-to-text transformation (code generation) with the Epsilon Generation Language", "Using Epsilon with non-EMF models")?>
					<?=tr("Model validation with the Epsilon Validation Language", "Embedding Epsilon in Java applications and Eclipse plugins (Epsilon API)")?>
					<?=tr("Model-to-model transformation with the Epsilon Transformation Language", "Extending and customising Epsilon")?>
					
					</tbody>
				</table>	

				<p>
				The first training course is planned to take place in York (UK) in late 2013 - early 2014 and will be
				<b>limited to 20 participants</b> on a first-come first-served basis. Please register your interest using
				the link below and we will get in touch with you soon.
				</p>
				<a class="btn btn-primary btn-large" href="https://docs.google.com/forms/d/1OPyXmyKEf6LNKWNXNSemI9Cs-KD_UIqIMi4gKY1uIEg/viewform" style="float:right">Register your interest &raquo;</a>
		

			</div>
		</div>
	</div>
</div>

<?f();?>