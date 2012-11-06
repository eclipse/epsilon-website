<?php
	require_once('../template.php');
	h();
?>
<div class="row">
	<!-- main part -->
	<div class="span8">
		<h1 class="page-header">Epsilon Labs</h1>

		<div class="row">
			<div class="span6">
				<p>EpsilonLabs is a satellite project of Epsilon that hosts experimental stuff which may (or may not) end up being part of Epsilon in the future. It also hosts contributions that are incompatible with EPL and therefore cannot be hosted under eclipse.org.</p>
			</div>

			<div class="span2">
				<img src="../resources/epsilonlabs.big.png" alt="">
			</div>
		</div>
		<div class="row">
			<div class="span8">
				<div class="alert alert-block">
                  <h4 class="alert-heading">Warning</h4>
                  Please be aware that the code contributed under EpsilonLabs is <strong>not</strong> part of (or in any other way formally related to) Eclipse, and has <strong>not</strong> been IP-checked by the Eclipse legal team.
              </div>
			</div>

		</div>

	</div>	
	<!-- end main part -->

	<!-- sidebar -->
	<div class="span4">
		<!-- first element -->
		<? sB('External Links'); ?>
					<ul>
						<li>
							<a href="http://code.google.com/p/epsilonlabs/">EpsilonLabs under Google Code</a>
						</li>
						<li>
							<del><a href="http://epsilonlabs.wiki.sourceforge.net/">EpsilonLabs under Sourceforge</a></del>
						</li>
					</ul>
		<? sE(); ?>
		<!-- end first element -->

	</div>
	<!-- end sidebar -->
</div>
<?php
	f();
?>