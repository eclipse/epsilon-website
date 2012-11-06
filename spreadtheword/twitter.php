<?
function getTwitterFollowers() {
	$twitters = new SimpleXMLElement(
		file_get_contents(Epsilon::getIncludeLocation().'/remote/epsilonews.xml')
	);
	$result = "";
	$i = 0;	
	$max = 27;
  // onegreekstore
	// # Printing the data
	foreach ($twitters->user as $twit) {
	 //if ($i < $max && (!strpos($twit->profile_image_url,"default_profile"))) {
	//if ($i < $max) {
		$result.="<img class=\"twitter_followers\" src=\"".$twit->profile_image_url."\" title=\"".$twit->name."\" alt=\"\" width=\"35\" />\n";
		//$i++;
	 //}
	}
	return $result;
}
?>