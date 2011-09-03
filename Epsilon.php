<?
class Epsilon {
	
	static function getProjectId() {
		return "modeling.gmt.epsilon";
	}
	
	static function getRelativeLocation($path) {
		return "/gmt/epsilon/".$path;
	}
	
	static function getAbsoluteLocation($path) {
		return "http://www.eclipse.org".Epsilon::getRelativeLocation($path);
	}
	
	static function getVersion() {
		return "0.9.1";
	}
	
	static function getServer() {
		
	}
	
	static function getPath() {
	
	}
	
	static function getFullPath() {
		return Epsilon::getSVNLocation();
	}
	
	static function getSVNLocation() {
		return "http://dev.eclipse.org/svnroot/modeling/org.eclipse.gmt.epsilon/";
	}
	
	static function getSVNExamplesLocation() {
		return Epsilon::getSVNLocation()."trunk/examples/";
	}
	
	static function getBinariesLocation() {
		return "http://www.eclipse.org/downloads/download.php?file=/modeling/gmt/epsilon/org.eclipse.epsilon_".Epsilon::getVersion()."_incubation.zip";
	}
	
	static function getUpdateSite() {
		return "http://download.eclipse.org/modeling/gmt/epsilon/updates/";
	}
	
	static function getInterimUpdateSite() {
		return "http://download.eclipse.org/modeling/gmt/epsilon/interim/";
	}
	
	static function getParentPath() {
		return "gmt";
		// will return "modeling/emft"
	}
	
	static function getOpenBugLocation() {
		return "https://bugs.eclipse.org/bugs/enter_bug.cgi?product=GMT&component=Epsilon";
	}
	
}
?>