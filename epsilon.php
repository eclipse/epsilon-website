<?php

class Epsilon {

	// constructor
	function Epsilon() {

	}

	// call this function with an empty string in order to get the path without the trailing "/"
	static function getRelativeLocation($path) {
		// extract the main Epsilon directory part
		//$main = substr(dirname(__FILE__), strlen($_SERVER['DOCUMENT_ROOT']));
		
		$main = "/epsilon";
		
		if($path != '') {
			return $main.'/'.$path;
		} else {
			return $main;
		}
	}

	static function getRootDir() {
		return $_SERVER['DOCUMENT_ROOT'];
	}

	// this funciton returns the path on the server to the main Epsilon directory
	static function getIncludeLocation() {
		return Epsilon::getRootDir().Epsilon::getRelativeLocation('');
	}

	// define the default js folder, relative to the main directory
	static function getJsDir() {
		return '/js';
	}

	static function getTemplateDir() {
		return '/templates';
	}


	/**
	 * functions copied over from the old project
 	**/

	static function getProjectId() {
		return "modeling.epsilon";
	}
	
	static function getAbsoluteLocation($path) {
		return "http://".$_SERVER["HTTP_HOST"].Epsilon::getRelativeLocation($path);
	}
	
	static function getVersion() {
		return "1.1";
	}
	
	static function getServer() {
		
	}
	
	static function getPath() {
	
	}
	
	static function getFullPath() {
		return Epsilon::getSVNLocation();
	}
	
	static function getSVNLocation() {
		return "http://dev.eclipse.org/svnroot/modeling/org.eclipse.epsilon/";
	}

	static function getCommittersSVNLocation() {
		return "https://dev.eclipse.org/svnroot/modeling/org.eclipse.epsilon/";
	}
	
	static function getSVNExamplesLocation() {
		return "https://git.eclipse.org/c/epsilon/org.eclipse.epsilon.git/plain/examples/"; //Epsilon::getSVNLocation()."trunk/examples/";
	}
	
	static function getBinariesLocation() {
		return "http://www.eclipse.org/downloads/download.php?file=/epsilon/org.eclipse.epsilon_".Epsilon::getVersion().".zip";
	}
	
	static function getUpdateSite() {
		return "http://download.eclipse.org/epsilon/updates/";
	}
	
	static function getInterimUpdateSite() {
		return "http://download.eclipse.org/epsilon/interim/";
	}
	
	static function getEmfaticUpdateSite() {
		return "http://download.eclipse.org/emfatic/update/";
	}
	
	static function getParentPath() {
		return "";
	}
	
	static function getOpenBugLocation() {
		return "https://bugs.eclipse.org/bugs/enter_bug.cgi?product=epsilon";
	}
}

function summary($input, $length = 200) {
	  if(strlen($input) <= $length) {
	    return $input;
	  }

	  $parts = explode(' ', $input);

	  while(strlen(implode(' ', $parts)) > $length)
	    array_pop($parts);
	  return implode(' ', $parts).'...';
	}