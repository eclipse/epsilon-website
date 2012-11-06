<?php
	require_once('../template.php');
	require_once('twitter.php');
	h();
?>
<div class="row">
	<!-- main part -->
	<div class="span8">
		<h1 class="page-header">Spread the Word</h1>
		
		<h3>Epsilon at Eclipse Marketplace</h3>
		<div class="row">
			<div class="span8">
				<img class="pull-right" src="http://dev.eclipse.org/custom_icons/marketplace.png" alt="">
				<p>The Eclipse Marketplace is the most comprehensive source of Eclipse plugins. You can help spread the word by <a href="http://marketplace.eclipse.org/content/epsilon">adding Epsilon</a> to your list of favorite Eclipse tools.</p>
			</div>
				
		</div>

		<h3>Add Epsilon to your Ohloh stack</h3>
		<div class="row">
			<div class="span8">
				<span class="pull-right"><script type="text/javascript" src="http://www.ohloh.net/p/8615/widgets/project_users.js"></script></span>
				<p>Ohloh is an increasingly popular social networking site that connects software with the people that develop and use it. You can click on the widget on the right to add <a href="http://www.ohloh.net/projects/8615">Epsilon</a> to the stack of applications you are using and let other developers looking in the MDE direction know that you are finding it useful.</p>
			</div>
		</div>

		<h3>Follow @epsilonews on Twitter</h3>
		<div class="row">
			<div class="span8">
				<img class="pull-right" src="../img/twitter.png" alt="">
				<p>Follow <a href="http://www.twitter.com/epsilonews">@epsilonews</a> on Twitter to keep in touch with the latest news and developments in Epsilon.</p>
			</div>
		</div>

		<h3>Share your experiences</h3>
		<div class="row">
			<div class="span8">
				<img class="pull-right" src="http://dev.eclipse.org/huge_icons/devices/network-wireless.png" alt="">
				<p>Please consider spending some time to share your experiences with Epsilon in your blog, website, or in the <a href="../forum">forum</a>. Here are some examples of blog articles that discuss different bits of Epsilon:
				<ul>
					<li> <a href="http://www.randomice.net/2008/08/gmf-toolkits/">GMF Toolkits</a>
					<li> <a href="http://kbm.blogspot.com/2009/05/cool-live-mda-via-google-app-engine.html">Cool - live MDE via Google App Engine</a>
					<li> <a href="http://blog.pyramism.net/2008/01/blog-filter-epsilon-and-glimmer.html">Blog filter: Epsilon and Glimmer</a>
					<li> <a href="http://famelis.wordpress.com/2009/09/27/mmtf-heavy-model-types-made-a-bit-lighter/">MMTF heavy model types made a bit lighter</a>
					<li> <a href="http://stephaneerard.wordpress.com/2009/06/09/symfony-model-editor/">Symphony Model Editor</a> (in French)
					<li> <a href="http://stephaneerard.wordpress.com/2009/06/04/les-epsilons-endoctrines-generent-pour-se-liberer/">Les Epsilons endoctrin&eacute;s g&eacute;n&egrave;rent pour se liberer</a> (in French)
					<li> <a href="http://stephaneerard.wordpress.com/2009/06/06/les-epsilons-transforment-pour-etre/">Les Epsilons transforment pour &Ecirc;tre</a> (in French)
					<li> <a href="http://stephaneerard.wordpress.com/2009/06/03/les-epsilons-endoctrines/">Les Epsilons endoctrin&eacute;s</a> (in French)
					<li> <a href="http://stephaneerard.wordpress.com/2009/06/04/les-epsilons-endoctrines-generent-pour-se-liberer/">Les Epsilons endoctrin&eacute;s g&eacute;n&egrave;rent pour se lib&eacute;rer</a> (in French)
					<li> <a href="http://entwickler.com/itr/news/psecom,id,47401,nodeid,82.html">Neues bei Eclipse-Modeling: Projekt Epsilon</a> (in German)
				</ul>
				</p>
			</div>
		</div>
	</div>
	<!-- end main part -->

	<!-- sidebar -->
	<div class="span4">
		<!-- first element -->
		<? sB('Spread the word'); ?>
					<p>If you like Epsilon, you can use one (or more) of the options in this page to spread the word.</p>
		<? sE(); ?>
		<!-- end first element -->

		<!-- second element -->
		<? sB('Twitter Followers'); ?>
					<?php echo getTwitterFollowers(); ?>
		<? sE(); ?>
		<!-- end second element -->
		
	</div>
	<!-- end sidebar -->
</div>
<?php
	f();
?>