<?php
	require_once('../../template.php');
	$pdf = "https://git.eclipse.org/c/epsilon/org.eclipse.epsilon.git/plain/doc/org.eclipse.epsilon.book/EpsilonBook.pdf";
	h('The Epsilon Book');
?>
<div class="row">
	<!-- main part -->
	<div class="span12">
		<h1 class="page-header">The Epsilon Book</h1>

		<!-- row of content with a picture -->
		<div class="row">
			<div class="span10">
				<p>The Epsilon Book provides a complete reference of the syntax and semantics of the languages in Epsilon, the <a href="../emc">model connectivity framework</a> that underpins them, and the <a href="../workflow">ANT-based workflow mechanism</a> that enables assembling complex MDE workflows.</p>
		
				<p>You can browse the book in the embedded viewer below, <a href="<?=$pdf?>">download a PDF copy</a> or check out its LaTeX source from Epsilon's Git repository. Like the rest of Epsilon, the book is free and distributed under the <a href="http://www.eclipse.org/legal/epl-v10.html">Eclipse Public Licence</a>.</p>
			</div>

			<div class="span2">
				<a href="<?=$pdf?>"><img src="../../img/book3.png"/></a>
				<p class="center"><a href="<?=$pdf?>">Download PDF</a></p>
			</div>
		</div>
		<!-- end row of content with a picture -->

		<div class="row">
			<div class="span12">
				<iframe id="bookPreview" src="https://drive.google.com/viewerng/viewer?url=https://git.eclipse.org/c/epsilon/org.eclipse.epsilon.git/plain/doc/org.eclipse.epsilon.book/EpsilonBook.pdf&embedded=true"></iframe>
			</div>
		</div>

	</div>	
	<!-- end main part -->

</div>
<?php
	f();
?>