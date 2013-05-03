<?php
	require_once('../template.php');
	
	$modelingTools = "http://www.eclipse.org/downloads/download.php?file=/technology/epp/downloads/release/juno/SR1/eclipse-modeling-juno-SR1-";

	$modelingToolsWin = $modelingTools."win32.zip";
	$modelingToolsWin64 = $modelingTools."win32-x86_64.zip";
	$modelingToolsMac = $modelingTools."macosx-cocoa.tar.gz";
	$modelingToolsMac64 = $modelingTools."macosx-cocoa-x86_64.tar.gz";
	$modelingToolsLinux = $modelingTools."linux-gtk.tar.gz";
	$modelingToolsLinux64 = $modelingTools."linux-gtk-x86_64.tar.gz";

	$version = Epsilon::getVersion();
	
	$downloadUrl = "http://www.eclipse.org/downloads/download.php?file=/epsilon/distributions/eclipse-epsilon-".$version."-";
	
	$downloadWin = $downloadUrl."win32.zip";
	$downloadWin64 = $downloadUrl."win32-x86_64.zip";
	$downloadMac = $downloadUrl."macosx-cocoa.zip";
	$downloadMac64 = $downloadUrl."macosx-cocoa-x86_64.zip";
	$downloadLinux = $downloadUrl."linux-gtk.tar.gz";
	$downloadLinux64 = $downloadUrl."linux-gtk-x86_64.tar.gz";
	
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
	
	h();
?>
<div class="row">
	<!-- main part -->
	<div class="span8">
		<h1 class="page-header">Download</h1>
		<div class="row">
			<div class="span12">
				<!--
				<div class="alert alert-info alert-block">
					<button type="button" class="close" data-dismiss="alert">×</button>
					If you've downloaded one of the 1.0 distributions or installed 1.0 from the main update site before Friday Nov 9,
					please update Epsilon from the stable update site (or download a fresh copy of the distributiuon) to pick up a fix for <a href="https://bugs.eclipse.org/bugs/show_bug.cgi?id=393941">bug 393941</a>.
				</div>
				 -->
				 
				<div class="tabbable" style="margin-bottom: 0px;">
				  <ul class="nav nav-tabs">
				    <li class="active"><a href="#distributions" data-toggle="tab"><h4>Eclipse Distributions</h4></a></li>
				    <li><a href="#updatesites" data-toggle="tab"><h4>Update Sites</h4></a></li>
				    <li><a href="#marketplace" data-toggle="tab"><h4>Eclipse Marketplace</h4></a></li>
				    <li><a href="#sourcecode" data-toggle="tab"><h4>Source Code</h4></a></li>
				  </ul>
				    <div class="tab-content">
  						<div id="distributions" class="tab-pane active">
  							<p>
  							Ready to use Eclipse distributions containing the latest stable version of Epsilon (v<?=Epsilon::getVersion()?>), EMF, GMF, and Emfatic. You will only need a <a href="http://www.oracle.com/technetwork/java/index.html">Java Runtime Environment</a>.  
  							</p>
  							<p style="padding-top:15px;padding-bottom:15px">
							<a class="btn <?=getStyle('windows')?>" href="<?=$downloadWin?>">Windows 32bit</a>
							<a class="btn <?=getStyle('windows')?>" href="<?=$downloadWin64?>">Windows 64bit</a>
							<a class="btn <?=getStyle('mac')?>" href="<?=$downloadMac?>">Mac OS X 32bit</a>
							<a class="btn <?=getStyle('mac')?>" href="<?=$downloadMac64?>">Mac OS X 64bit</a>
							
							<a class="btn <?=getStyle('linux')?>" href="<?=$downloadLinux?>">Linux 32bit</a>
							<a class="btn <?=getStyle('linux')?>" href="<?=$downloadLinux64?>">Linux 64bit</a>
							
							</p>
							<?if (onWindows()){?>
							<p><b>Note for Windows users:</b> Please make sure that you extract the downloaded distributions close to the root of a drive (e.g. C:/D:) as
							the maximum path length on Windows may not exceed 256 characters.
							</p>
							<?}?>
							</p>
							<?if (onMac()){?>

							<p><b>Note for Mac OSX Snow Leopard users:</b> The above distributions require Java 1.7 which is not 
							available for Mac OSX Snow Leopard. To assemble a 1.6-compatible version of the Epsilon distribution,
							please download one of the distributions above, and re-install Emfatic from the following update site:
							<?=Epsilon::getEmfaticUpdateSite()?>
							</p>
							<?}?>
							
							
  						</div>
  						<div id="updatesites" class="tab-pane">
  							<form class="form-horizontal" style="padding-left:1px">
  							<div class="control-group">
	  							<div class="input-prepend input-append">
								  <span class="add-on"><div class="span2">Stable (v<?=Epsilon::getVersion()?>)</div></span>
								  <input class="span9" id="appendedPrependedInput" type="text" value="<?=Epsilon::getUpdateSite()?>">
								</div>
								
	  							<div class="input-prepend input-append" style="padding-top:25px">
								  <span class="add-on"><div class="span2">Interim*</div></span>
								  <input class="span9" id="appendedPrependedInput" type="text" value="<?=Epsilon::getInterimUpdateSite()?>">
								</div>
								<p>
								
								<br>
								*<a href="https://bugs.eclipse.org/bugs/buglist.cgi?query_format=advanced;field0-0-0=status_whiteboard;bug_status=RESOLVED;bug_status=VERIFIED;type0-0-0=equals;value0-0-0=interim;product=epsilon">
								Bugs fixed in the latest interim version (compared to the latest stable version)
								</a>
								
								</p>
								
								<h4 style="padding-top:10px;padding-bottom:10px">Dependencies (optional)</h4>
								
								<div class="input-prepend input-append">
								  <span class="add-on"><div class="span2">Emfatic</div></span>
								  <input class="span9" id="appendedPrependedInput" type="text" value="<?=Epsilon::getEmfaticUpdateSite()?>">
								</div>
								<div class="input-prepend input-append" style="padding-top:25px">
								  <span class="add-on"><div class="span2">GMF</div></span>
								  <input class="span9" id="appendedPrependedInput" type="text" value="Install through the Help->Install Modeling Components menu.">
								</div>								
								
							</div>
							</form>
							<h4>What do I do with these?</h4>
							<p>
							The development tools of Epsilon come as a set of Eclipse plugins and therefore, to install Epsilon you need to download and install a <a href="http://www.oracle.com/technetwork/java/index.html">Java Runtime Environment</a> and Eclipse 
							(including EMF, GMF and Emfatic in order to use the full range of its capabilities) first. 
							The Eclipse Juno Modeling Tools distribution contains most of the necessary prerequisites for Epsilon and is available for the following platforms.
							</p>
							<p style="padding-top:15px;padding-bottom:15px">
							<a class="btn <?=getStyle('windows')?>" href="<?=$modelingToolsWin?>">Windows 32bit</a>
							<a class="btn <?=getStyle('windows')?>" href="<?=$modelingToolsWin64?>">Windows 64bit</a>
							<a class="btn <?=getStyle('mac')?>" href="<?=$modelingToolsMac?>">Mac OS X 32bit</a>
							<a class="btn <?=getStyle('mac')?>" href="<?=$modelingToolsMac64?>">Mac OS X 64bit</a>
							<a class="btn <?=getStyle('linux')?>" href="<?=$modelingToolsLinux?>">Linux 32bit</a>
							<a class="btn <?=getStyle('linux')?>" href="<?=$modelingToolsLinux64?>">Linux 64bit</a>
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
							</ul>
  						</div>
  						<div id="marketplace" class="tab-pane">
  							Drag and drop into a running Eclipse Indigo workspace to 
  							<a style="position:relative;top:-2px" href="http://marketplace.eclipse.org/marketplace-client-intro?mpc_install=400" title="install"><img src="http://marketplace.eclipse.org/sites/all/modules/custom/marketplace/images/installbutton.png"/></a> the latest stable version (v <?=Epsilon::getVersion()?>) of Epsilon.
  						</div>
  						<div id="sourcecode" class="tab-pane">
  							<p>
  							The source code of Epsilon is stored in the following SVN repository. 
  							<a href="../doc/articles/epsilon-source-svn/">This article</a> provides step-by-step instructions for checking out the code from the repository 
  							into your Eclipse workspace.
  							</p>
  							<form class="form-horizontal" style="padding-left:1px">
  							<div class="control-group">
	  							<div class="input-prepend input-append" style="padding-top:25px">
								  <span class="add-on"><div class="span2">Users</div></span>
								  <input class="span9" id="appendedPrependedInput" type="text" value="<?=Epsilon::getSVNLocation()?>">
								</div>
								
	  							<div class="input-prepend input-append" style="padding-top:25px">
								  <span class="add-on"><div class="span2">Committers</div></span>
								  <input class="span9" id="appendedPrependedInput" type="text" value="<?=Epsilon::getCommittersSVNLocation()?>">
								</div>
							</div>
							</form>  							
  						</div>
  					</div>
				</div>
			</div>
		</div>
	</div>
</div>

<?f();?>