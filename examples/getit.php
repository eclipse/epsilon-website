<?
include("zipstream/phpHTMLParser.php");
include("../Epsilon.php");
require("zipstream/zipstream.php");

$files = array();
$examples = Epsilon::getSVNExamplesLocation();
$example = strip_tags($_REQUEST['example']);

if (!isset($example)) die;

$root = $examples.$example;

collect($root, "/", $files);
			
# create new zip stream object
$zip = new ZipStream($example.'.zip', array());

# common file options
$file_opt = array(
  # file creation time
  'time'    => time(),
);

foreach ($files as $file) {
	$data = file_get_contents($root.$file);
	$zip->add_file(substr($file,1), $data, $file_opt);
}

# finish archive
$zip->finish();

function collect($basePath, $relativePath, &$files) {
	$content = file_get_contents($basePath.$relativePath);
	$parser = new phpHTMLParser("$content");
	$HTMLObject = $parser->parse_tags(array("a", "title"));
	$aTags = $HTMLObject->getTagsByName("a");
	foreach ($aTags as $a) {
			$href = $a->href;
		 if ($href != "") {
				if ($href != "../" && $href!="http://subversion.tigris.org/") {
					if (substr($href, strlen($href)-1) == "/") {
						collect($basePath, $relativePath.$href, $files);
					}
					else {
						$files[] = $relativePath.$href;
					}
				}
		 }
	}	
}

?>