<?php
	require_once('../template.php');

	$releases = simplexml_load_file("releases.xml")->release;
	$release = null;
	$major_release = null;

	if (isset($_GET["version"])) {
		$version = $_GET["version"];
		foreach ($releases as $r) {
			if (strcmp($r["version"], $version) == 0) {
				$release = $r;
				break;
			}
		}
	}

	if (!isset($release)) {
		$release = $releases[0];
	}

	$latest = ($release == $releases[0]);
	$major_release_latest = ($major_release == $releases[0]);

	$major_release = get_major_release($release);

	$fixedBugs = simplexml_load_file("fixed-bugs/".$release["version"].".xml")->bug;

	$modelingTools = $major_release->eclipse["distribution"];

	$modelingToolsWin64 = $modelingTools."win32-x86_64.zip";
	$modelingToolsMac64 = $modelingTools."macosx-cocoa-x86_64.".$major_release->eclipse["mac-extension"];
	$modelingToolsLinux64 = $modelingTools."linux-gtk-x86_64.tar.gz";

	$version = $release["version"];
	$major_release_bread_crumb = "";
	$release_bread_crumb = "";
	
	if (!$major_release_latest) {
		$major_release_bread_crumb = $major_release["version"]."/";
	}
	if (!$latest) {
		$release_bread_crumb = $release["version"]."/";
	}

	$download_server = "download";
	if (strcmp($release["archived"], "yes") == 0) {
		$download_server = "archive";
	}
	
	$distributions = (strcmp($major_release["distributions"], "no") != 0);
	$jars = (strcmp($release["jars"], "yes") == 0);

	$downloadUrl = "https://www.eclipse.org/downloads/download.php?file=/epsilon/".$major_release_bread_crumb."distributions/eclipse-epsilon-".$major_release["version"]."-";

	$downloadWin64 = $downloadUrl."win32-x86_64.zip";
	$downloadMac64 = $downloadUrl."macosx-cocoa-x86_64.".$major_release->eclipse["mac-extension"];
	$downloadLinux64 = $downloadUrl."linux-gtk-x86_64.".$major_release->eclipse["linux-extension"];
	
	$updateSite = "https://".$download_server.".eclipse.org/epsilon/updates/".$release_bread_crumb;
	$zippedUpdateSite = "https://www.eclipse.org/downloads/download.php?file=/epsilon/".$release_bread_crumb."updates/site.zip";
	$zippedInterimUpdateSite = "https://www.eclipse.org/downloads/download.php?file=/epsilon/interim/site.zip";
	
	function getVisitorPlatform()
	{
	    $u_agent = $_SERVER['HTTP_USER_AGENT'];

	    if (preg_match('/linux/i', $u_agent)) {
	        return 'linux';
	    }
	    elseif (preg_match('/macintosh|mac os x/i', $u_agent)) {
	        return 'mac';
	    }
	    elseif (preg_match('/windows|win32/i', $u_agent)) {
	        return 'windows';
	    }
	    else {
	    	return 'unknown';
	    }
	}

	function getStyle($os) {
		$platform = getVisitorPlatform();
		if ($platform == "unknown" || $platform==$os) {
			return "btn btn-primary btn-medium";
		}
		else {
			return "btn btn-medium";
		}
	}

	function onWindows() {
		$platform = getVisitorPlatform();
		if ($platform == "unknown" || $platform=="windows") {
			return true;
		}
		else return false;
	}

	function onMac() {
		$platform = getVisitorPlatform();
		if ($platform == "unknown" || $platform=="mac") {
			return true;
		}
		else return false;
	}

	function jar($flavour, $version, $interim, $src) {
		global $release_bread_crumb;
		$srcLabel = "";
		if ($src) { $srcLabel = "-src"; }

		$jarFolder = "jars";
		if ($interim) { $jarFolder = "interim/jars"; }

		$filename = "epsilon-".$version."-".$flavour.$srcLabel.".jar";
		$link = "https://www.eclipse.org/downloads/download.php?file=/epsilon/".$release_bread_crumb.$jarFolder."/".$filename;
		return "<a href='".$link."'>".$filename."</a>";
	}

	h();
?>

<div class="row">
	<!-- main part -->
	<div class="span8">
		<h1 class="page-header">Download</h1>
		<div class="row">
			<div class="span12">
				
				<!--div class="alert alert-warning alert-block">
					<b>13/08/2018</b>: We are in the process of releasing version 2.0 and some links or update sites may not work as expected until we are done.
				</div-->
				 
				<div class="tabbable" style="margin-bottom: 0px;">
				  <ul class="nav nav-tabs">
				  	<?if($distributions){?>
				    <li class="active"><a href="#distributions" data-toggle="tab"><h4>Distributions</h4></a></li>
				    <?}?>
				    <li <?if(!$distributions){ echo 'class="active"';}?>><a href="#updatesites" data-toggle="tab"><h4>Update Sites</h4></a></li>
				    <?if ($latest){?>
				    <li><a href="#marketplace" data-toggle="tab"><h4>Marketplace</h4></a></li>
				    <?}?>
				    <li><a href="#sourcecode" data-toggle="tab"><h4>Source code</h4></a></li>
				    <?if ($jars){?>
				    <li><a href="#jars" data-toggle="tab"><h4>JARs</h4></a></li>
				    <?}?>
				    <li><a href="#releasenotes" data-toggle="tab"><h4>Release notes</h4></a></li>
				    <li><a href="#versions" data-toggle="tab"><h4>All versions</h4></a></li>
				  </ul>
				    <div class="tab-content">
				    	<?if($distributions){?>
  						<div id="distributions" class="tab-pane active">
  							<p>
  							Ready-to-use Eclipse <?=$major_release->eclipse["name"]?> (<?=$major_release->eclipse["version"]?>) distributions containing a stable version of Epsilon (v<?=$major_release["version"]?>) and all its mandatory and optional dependencies. You will only need a <a href="https://adoptopenjdk.net/">Java Runtime Environment</a>.
  							</p>
								<?if ($release != $major_release){?>
								<div class="alert alert-error alert-block">
									<b>Important:</b> <?=$release->message?>
								</div>
								<?}?>
  							<p style="padding-top:15px;padding-bottom:15px">
							<a class="btn <?=getStyle('windows')?>" href="<?=$downloadWin64?>">Windows</a>
							<a class="btn <?=getStyle('mac')?>" href="<?=$downloadMac64?>">macOS</a>
							<a class="btn <?=getStyle('linux')?>" href="<?=$downloadLinux64?>">Linux</a>

							</p>
							<?if (onWindows()){?>
							<p><b>Note for Windows users:</b> Please make sure that you extract the downloaded distributions close to the root of a drive (e.g. C:) as
							the maximum path length on Windows may not exceed 255 characters by default.
							</p>
							<?}?>
							</p>
  						</div>
  						<?}?>
  						<div id="updatesites" class="tab-pane <?if(!$distributions){ echo "active";}?>">
  							<form class="form-horizontal" style="padding-left:1px">
  							<div class="control-group">
	  							<div class="input-prepend input-append">
								  <span class="add-on"><div class="span2">Stable</div></span>
								  <input class="span8" id="appendedPrependedInput" type="text" value="<?=$updateSite?>"/>
									<span class="add-on"><div class="span1" style="margin-left:2px;margin-right:7px"><a href="<?=$zippedUpdateSite?>">Archive</a></div></span>
								</div>

								
								<?if ($latest){?>
	  							<div class="input-prepend input-append" style="padding-top:25px">
								  <span class="add-on"><div class="span2">Interim *</div></span>
								  <input class="span8" id="appendedPrependedInput" type="text" value="<?=Epsilon::getInterimUpdateSite()?>"/>
									<span class="add-on"><div class="span1" style="margin-left:2px;margin-right:7px"><a href="<?=$zippedInterimUpdateSite?>">Archive</a></div></span>
								</div>

								<p>

								<br>
								*<a href="https://bugs.eclipse.org/bugs/buglist.cgi?bug_status=RESOLVED&bug_status=VERIFIED&list_id=17694438&product=epsilon&query_format=advanced">
								Bugs fixed in the latest interim version (compared to the latest stable version)
								</a>

								</p>
								<?}?>

								<h4>What do I do with these?</h4>
								<p>
								The development tools of Epsilon come as a set of Eclipse plugins and therefore, to install Epsilon you need to download and install a Java Runtime Environment and Eclipse first. The Eclipse <?=$release->eclipse["name"]?> Modeling Tools distribution contains most of the necessary prerequisites for Epsilon <?=$release["version"]?> and is available for the following platforms.
								</p>
								<p style="padding-top:15px;padding-bottom:15px">
								<a class="btn <?=getStyle('windows')?>" href="<?=$modelingToolsWin64?>">Windows</a>
								<a class="btn <?=getStyle('mac')?>" href="<?=$modelingToolsMac64?>">macOS</a>
								<a class="btn <?=getStyle('linux')?>" href="<?=$modelingToolsLinux64?>">Linux</a>
								</p>

								<h4 style="padding-top:10px;padding-bottom:10px">Dependencies (optional)</h4>
								<p>Below are optional dependencies that are not pre-installed in the Eclipse <?=$release->eclipse["name"]?> Modeling Tools distribution.</p>
								<table class="table table-striped table-bordered">
									<thead>
										<tr><th>Dependency</th><th>Update site</th><th>Notes</th></tr>
									</thead>
									<tbody>
										<?foreach ($major_release->dependency as $dependency){?>
										<tr>
											<td><?=$dependency["name"]?></td>
											<td><input class="span7" style="outline:none;border:0;box-shadow:none;padding:0px" type="text" value="<?=$dependency["location"]?>"></input></td>
											<td><?=$dependency["notes"]?></td>
										</tr>
										<?}?>
									</tbody>
								</table>

								<div class="alert alert-info alert-block">
									<b>Note for Xtext and Papyrus users:</b> Tools such as Xtext and Papyrus may bring in a version of QVTo with which GMF Tooling - and hence Eugenia - won't work. If you wish to use Xtext or Papyrus in the same installation as Eugenia, you should use QVTo 3.9.1 from this update site: https://download.eclipse.org/mmt/qvto/updates/releases/3.9.1</p>
								</div>

								<!--div class="input-prepend input-append">
								  <span class="add-on"><div class="span2">Emfatic</div></span>
								  <input class="span9" id="appendedPrependedInput" type="text" value="<?=Epsilon::getEmfaticUpdateSite()?>">
								</div>
								<div class="input-prepend input-append" style="padding-top:25px">
								  <span class="add-on"><div class="span2">GMF</div></span>
								  <input class="span9" id="appendedPrependedInput" type="text" value="Install through the Help->Install Modeling Components menu.">
								</div-->

								<h4 style="padding-top:10px;padding-bottom:10px">EpsilonLabs (optional)</h4>
								<p>Some of the projects found in the EpsilonLabs <a href="https://github.com/epsilonlabs">repository</a> can be installed from the EpsilonLabs update site.
								<div class="input-prepend input-append">
								  <span class="add-on"><div class="span2">EpsilonLabs</div></span>
								  <input class="span9" id="appendedPrependedInput" type="text" value="https://dl.bintray.com/epsilonlabs/updates">							
								</div>
							</div>
							</form>
							<!--h4>What do I do with these?</h4>
							<p>
							The development tools of Epsilon come as a set of Eclipse plugins and therefore, to install Epsilon you need to download and install a <a href="http://www.oracle.com/technetwork/java/index.html">Java Runtime Environment</a> and Eclipse
							(including EMF, GMF and Emfatic in order to use the full range of its capabilities) first.
							The Eclipse <?=$release->eclipse["name"]?> Modeling Tools distribution contains most of the necessary prerequisites for Epsilon and is available for the following platforms.
							</p>
							<p style="padding-top:15px;padding-bottom:15px">
							<a class="btn <?=getStyle('windows')?>" href="<?=$modelingToolsWin64?>">Windows</a>
							<a class="btn <?=getStyle('mac')?>" href="<?=$modelingToolsMac64?>">macOS</a>
							<a class="btn <?=getStyle('linux')?>" href="<?=$modelingToolsLinux64?>">Linux</a>
							</p>
							Once you have downoaded one of the Modeling distributions above, you will need to
							<ol>
								<li>Install GMF through the <i>Help->Install Modeling Components</i> menu of Eclipse
								<li>Install Emfatic through the <i>Help->Install New Software</i> menu of Eclipse using the Emfatic update site above
								<li>Install Epsilon through the <i>Help->Install New Software</i> menu of Eclipse using one of the Epsilon update sites (stable or interim/bleeding edge)
							</ol>

							<p>If you are not familiar with Eclipse/plugin installation, <a href="http://www.vogella.com/articles/Eclipse/article.html#install">this tutorial</a> provides an excellent crash course.</p>

							<h4>Which features should I install?</h4>

							<p>
							If you are a first-time user, we recommend installing them all. Otherwise, you may want to install only those that you need:
							</p>
							<ul>
							    <li><i>Epsilon Core:</i> provides the execution engines required to run E*L scripts and <a href="../doc/eunit/">EUnit</a> test suites.
							    <li><i>Epsilon Core Development Tools:</i> provides the development tools required to write new E*L scripts (editors, EUnit test results view, <a href="../doc/workflow/">Ant tasks</a>...).
							    <li><i>Epsilon EMF Integration:</i> provides the Epsilon Model Connectivity driver required to use EMF-based models in Epsilon.
							    <li><i>Epsilon Development Tools for EMF:</i> provides useful tools for developing E*L scripts that work with EMF-based models, such as <a href="../doc/exeed">Exeed</a>, <a href="../doc/modelink/">ModeLink</a>, EMF model comparison for EUnit test suites and so on.
							    <li><i>Epsilon Validation Language EMF Integration:</i> allows for integrating EVL scripts with the standard EMF model validation facilities.
							    <li><i>Epsilon Wizard Language EMF Integration:</i> allows for invoking EWL wizards on the appropriate elements in an EMF model, from the standard tree-based editors generated by EMF.
							    <li><i>Epsilon Wizard Language GMF Integration:</i> allows for invoking EWL wizards on the appropriate elements in an EMF model, from the graphical editors generated by GMF.
							    <li><i><a href="../doc/eugenia/">Eugenia</a>:</i> provides an environment for easily creating GMF editors from a set of text files.
							    <li><i><a href="../doc/hutn/">Human Usable Text Notation</a> Core:</i> provides the EMC driver required to load models written in the OMG HUTN textual notation.
							    <li><i>Human Usable Text Notation Development Tools:</i> provides an editor for models written in OMG HUTN.
							    <li><i>Epsilon <a href="../doc/concordance/">Concordance</a>:</i> provides a tool that detects, reconciles and reports broken cross-resource EMF references.
							</ul!-->
  						</div>
  						<?if ($latest){?>
  						<div id="marketplace" class="tab-pane">
  							Drag and drop into a running Eclipse <?=$release->eclipse["name"]?> workspace to
  							<a style="position:relative;top:-2px" href="https://marketplace.eclipse.org/marketplace-client-intro?mpc_install=400" title="install"><img src="https://marketplace.eclipse.org/sites/all/modules/custom/marketplace/images/installbutton.png"/></a> the latest stable version (v <?=$version?>) of Epsilon.
  						</div>
  						<?}?>
  						<div id="sourcecode" class="tab-pane">
  							<p>
  							The source code of Epsilon is stored in the following Git repository.
  							</p>
  							<form class="form-horizontal" style="padding-left:1px">
  							<div class="control-group">
  								<?if ($latest){?>
	  							<div class="input-prepend input-append" style="padding-top:25px">
								  <span class="add-on"><div class="span2">Users</div></span>
								  <input class="span9" id="appendedPrependedInput" type="text" value="git://git.eclipse.org/gitroot/epsilon/org.eclipse.epsilon.git">
								</div>
	  							<div class="input-prepend input-append" style="padding-top:25px">
								  <span class="add-on"><div class="span2">Committers</div></span>
								  <input class="span9" id="appendedPrependedInput" type="text" value="ssh://user_id@git.eclipse.org:29418/epsilon/org.eclipse.epsilon.git">
								</div>
								<?}?>
	  							<div class="input-prepend input-append" style="padding-top:25px">
								  <span class="add-on"><div class="span2">Release tag</div></span>
								  <input class="span9" id="appendedPrependedInput" type="text" value="https://git.eclipse.org/c/epsilon/org.eclipse.epsilon.git/tag/?id=<?=$version?>">
								</div>
							</div>
							</form>
							<br/>
							<p>
								<b>Note:</b> If you need to modify and re-build the parsers of the Epsilon languages, you will also need to clone the following repository next to the Epsilon Git repository on your machine: <code>https://github.com/epsilonlabs/epsilon-antlr-dev.git</code>
							</p>
  						</div>

  						<?if ($jars){?>
  						<div id="jars" class="tab-pane">
	  						<ul class="nav nav-pills">
							    <li class="active"><a href="#stablejars" data-toggle="tab">Stable</a></li>
							    <li><a href="#interimjars" data-toggle="tab">Interim</a></li>
							</ul>
							<div class="tab-content">
								<div id="stablejars" class="tab-pane active">
									<p>
			  							Plain old JARs you can use to embed the latest <b>stable</b> version of Epsilon (<?=$version?>)
			  							<a href="../examples/index.php?example=org.eclipse.epsilon.examples.standalone">as a library</a> in your Java or Android application. You can also use Maven: see instructions below the table.
			  						</p>
	  								<?$jarsUrl = "https://www.eclipse.org/downloads/download.php?file=/epsilon/".$release_bread_crumb.$version."jars";?>
	  								<?include("jars/".$version.".php");?>
                                     <p>
                                     Since 1.4, these JARs are also available from Maven Central. For instance, to use the <code>epsilon-core</code> JAR from your <code>pom.xml</code>:
                                     <pre>&lt;dependencies&gt;
  ...
  &lt;dependency&gt;
    &lt;groupId&gt;org.eclipse.epsilon&lt;/groupId&gt;
    &lt;artifactId&gt;epsilon-core&lt;/artifactId&gt;
    &lt;version&gt;1.5.1&lt;/version&gt;
  &lt;/dependency&gt;
  ...
&lt;/dependencies&gt;</pre>
                                     </p>
	  							</div>
	  							<div id="interimjars" class="tab-pane">
									<p>
			  							Plain old JARs you can use to embed the latest <b>interim</b> version of Epsilon
			  							<a href="../examples/index.php?example=org.eclipse.epsilon.examples.standalone">as a library</a> in your Java or Android application. You can also use Maven: see instructions below the table.
			  						</p>
			  						<?$jarsUrl = "https://www.eclipse.org/downloads/download.php?file=/epsilon/".$release_bread_crumb."interim/jars";?>
			  						<?include("jars/interim.php");?>
									<p>
									You can use the latest SNAPSHOTs at the <a href="https://oss.sonatype.org">Sonatype OSSRH</a> repository. For instance, to use the 1.6 interim <code>epsilon-core</code> JAR from your <code>pom.xml</code>:
									<pre>&lt;repositories&gt;
    &lt;repository&gt;
      &lt;id&gt;ossrh-snapshots&lt;/id&gt;
      &lt;url&gt;https://oss.sonatype.org/content/repositories/snapshots&lt;/url&gt;
    &lt;/repository&gt;
&lt;/repositories&gt;
...
&lt;dependencies&gt;
  &lt;dependency&gt;
    &lt;groupId&gt;org.eclipse.epsilon&lt;/groupId&gt;
    &lt;artifactId&gt;epsilon-core&lt;/artifactId&gt;
    &lt;version&gt;1.6.0-SNAPSHOT&lt;/version&gt;
  &lt;/dependency&gt;
&lt;/dependencies&gt;</pre>
									</p>
	  							</div>
	  						</div>
  						</div>
  						<?}?>

  						<div id="releasenotes" class="tab-pane">
  						<p>
  						Version <?=$version?> fixes the bugs and implements the enhancement requests below.
  						</p>
  						<table class="table table-striped">
  							<thead>
  								<tr>
  									<th>#</th>
  									<th>Description</th>
  									<th>Reporter</th>
  								</tr>
  							</thead>
  							<tbody>
	  							<?foreach ($fixedBugs as $fixedBug){?>
	  							<tr>
	  								<td><?=$fixedBug->bug_id?></td>
	  								<td><a href="https://bugs.eclipse.org/bugs/show_bug.cgi?id=<?=$fixedBug->bug_id?>"><?=$fixedBug->short_desc?></a></td>
	  								<td><?=$fixedBug->reporter?></td>

	  							</tr>
	  							<?}?>
  							</tbody>
						</table>

  						</div>
  						<div id="versions" class="tab-pane">
  						<table class="table table-striped">
  							<thead>
  								<tr>
  									<th>Version</th>
  									<th>Eclipse</th>
  									<th>Released</th>
  									<th>Notes</th>
  								</tr>
  							</thead>
  							<tbody>
  							<?foreach ($releases as $r){
  								$m = get_major_release($r);
  							?>
  							<tr>
  								<td>
  									<a href="?version=<?=$r["version"]?>"><?=$r["version"]?></a>
  								</td>
  								<td>
  									<?=$m->eclipse["version"]?> (<?=$m->eclipse["name"]?>)
  								</td>
  								<td>
  									<?=$r["released"]?>
  								</td>
  								<td>
  									<?=$r->notes?>
  								</td>
  							</tr>
  							<?}?>
  							</tbody>
  						</table>
  						</ul>
  						</div>
  					</div>
				</div>
			</div>
		</div>
	</div>
</div>

<?f();

function get_major_release($the_release) {
	if ($the_release["services"] != null) {
		$candidates = simplexml_load_file("releases.xml")->release;
		foreach ($candidates as $candidate) {
			if (strcmp($candidate["version"], $the_release["services"]) == 0) {
				return $candidate;
			}
		}
	}
	return $the_release;
}
?>
