<?php
	require_once('../template.php');
	$news = simplexml_load_file(Epsilon::getIncludeLocation().'/news/epsilonNewsArchive.rss')->channel->item;

	$modelingTools = "http://www.eclipse.org/downloads/download.php?file=/technology/epp/downloads/release/indigo/R/eclipse-modeling-indigo-";
	
	$modelingToolsWin = $modelingTools."win32.zip";
	$modelingToolsWin64 = $modelingTools."win32-x86_64.zip";
	$modelingToolsMac = $modelingTools."macosx-cocoa.tar.gz";
	$modelingToolsMac64 = $modelingTools."macosx-cocoa-x86_64.tar.gz";
	$modelingToolsLinux = $modelingTools."linux-gtk.tar.gz";
	$modelingToolsLinux64 = $modelingTools."linux-gtk-x86_64.tar.gz";


	h();
?>
<div class="row">
	<!-- main part -->
	<div class="span8">
		<h1 class="page-header">Download</h1>
		<div class="row">
			<div class="span8">
				<div class="alert alert-info alert-block">
                  <h4 class="alert-heading">Ready to use Epsilon distributions</h4>
                  <p style="padding-top:10px">
                  <a href="http://www.epsilon-project.org/download/index.php?version=<?= Epsilon::getVersion() ?>">Click here to download ready to use Eclipse distributions containing EMF, GMF, Epsilon and Emfatic</a>. Please note that these distributions are not hosted under eclipse.org and contain a fork of Emfatic that has not been IP-checked.
        	  	  </p>
        	  	</div>
        	  	<p>If on the other hand you prefer to download and install Epsilon manually please follow the steps below:</p>
			</div>
		</div>

		<div class="row">
			<div class="span8">
				<img class="pull-right" src="../img/modeling64.png" alt="">
				<h3>Step 1: Download Eclipse</h3>
				<p>The development tools of Epsilon come as a set of Eclipse plugins and therefore, to install Epsilon you need to download and install <a href="http://java.sun.com">Java 1.6+</a> and Eclipse (including GMF and EMF) first. The Eclipse Indigo Modeling Tools distribution contains most of the necessary prerequisites for Epsilon and is available for the following platforms:</p>
				<!-- make this table 100% wide! -->
				<table class="row-fluid">
					<tr>
					<td>
						<ul>
							<li><a href="<?= $modelingToolsWin ?>" target="_blank">Windows 32bit</a>
							<li><a href="<?= $modelingToolsWin64 ?>" target="_blank">Windows 64bit</a>
						</ul>
					</td>
					<td>
						<ul>
							<li><a href="<?= $modelingToolsLinux ?>" target="_blank">Linux 32bit</a>
							<li><a href="<?= $modelingToolsLinux64 ?>" target="_blank">Linux 64bit</a>
						</ul>
					</td>
					<td>
						<ul>
							<li><a href="<?= $modelingToolsMac ?>" target="_blank">Mac OS X 32bit</a>
							<li><a href="<?= $modelingToolsMac64 ?>" target="_blank">Mac OS X 64bit</a>

						</ul>
					</td>
					</tr>
				</table>
				<hr>
			</div>

		</div>

		<div class="row">
			<div class="span8">
				<h3>Step 2: Install Epsilon, GMF and Emfatic</h3>
				<ul>
					<li>Install <b>GMF Tooling</b> through the <i>Help->Install Modeling Components</i> menu</li>
					<li>Install <b>Emfatic</b> through the following update site <?= linkify(Epsilon::getEmfaticUpdateSite()) ?> (optional)</li>
					<li>Install <b>Epsilon</b> through the following update site <?= linkify(Epsilon::getUpdateSite()) ?></li>
				</ul>

				<div class="alert alert-info alert-block">
              		If GMF cannot be installed following these instructions, or Epsilon fails to install after installing GMF, please download one of the pre-bundled distributions above and <a href="../forum">let us know</a> so that we can investigate.
              	</div>
				<hr>
			</div>
			
		</div>

		<div class="row">
			<div class="span8">
				<h3>Interim update site, binaries and source code</h3>
				<p>The bleeding edge version of Epsilon is available in the interim update site
					<ul>
						<li><?= linkify(Epsilon::getInterimUpdateSite()) ?>
					</ul>
					<a href="<?= Epsilon::getBinariesLocation() ?>">Binaries</a>: 
					A zip-file containing the features and plugins of Epsilon (you can use this to create a local update site or you can just 
					copy all the plugins and features to the dropins folder of your Eclipse installation).
				</p>
				<p>
				<a href="../doc/articles/epsilon-source-svn/">Source code</a>:
				This article describes how you can obtain the latest version of the source code of Epsilon from the Eclipse SVN server.
				</p>
				<p>SVN Repository: <em><?= linkify(Epsilon::getSVNLocation()) ?></em></p>
			</div>
			
		</div>
	</div>
	<!-- end main part -->

	<!-- sidebar -->
	<div class="span4">
		<!-- first element -->
		<? sB('Quick Links'); ?>
					<h5>Download Eclipse</h5>
					<ul>
						<li><a href="<?= $modelingToolsWin ?>" target="_blank">Windows 32bit</a>
						<li><a href="<?= $modelingToolsWin64 ?>" target="_blank">Windows 64bit</a>
						<li><a href="<?= $modelingToolsMac ?>" target="_blank">Mac OS X</a>
						<li><a href="<?= $modelingToolsLinux ?>" target="_blank">Linux 32bit</a>
						<li><a href="<?= $modelingToolsLinux64 ?>" target="_blank">Linux 64bit</a>
					</ul>
					<h5>Download Epsilon</h5>
					<ul>
						<li> <a href="<?= Epsilon::getUpdateSite() ?>">Stable update site</a>
						<li> <a href="<?= Epsilon::getInterimUpdateSite() ?>">Interim update site</a>
						<li> <a href="<?= Epsilon::getBinariesLocation() ?>">Zipped binaries</a>
						<li> <a href="../doc/articles/epsilon-source-svn/">Source code</a>
					</ul>
					<h5>Download Emfatic</h5>
					<ul>
						<li><a href="<?= Epsilon::getEmfaticUpdateSite() ?>">Emfatic update site</a>
					</ul>
		<? sE(); ?>
		<!-- end first element -->
		
		<?
			sB();
			$limit = 5;
		?>
		<a href="<?= Epsilon::getRelativeLocation('news/epsilonNewsArchive.rss') ?>" class="pull-right"></a>
		<h4>Updates</h4>
		<ul>
			<? foreach($news as $item) { ?>
				<li>
					<a href="<?= $item->link ?>"><?= $item->title ?></a>
					<ul>
						<li><small><?= $item->pubDate ?></small></li>
						<li><?= summary(strip_tags($item->description), 60) ?></li>
					</ul>
				</li>
			<?
				$limit--;
				if($limit < 1) break;
			} ?>
		</ul>
		<? sE(); ?>

	</div>
	<!-- end sidebar -->
</div>
<?php
	f();

	function linkify($str) {
		return "<a href='".$str."'>".$str."</a>";
	}
?>