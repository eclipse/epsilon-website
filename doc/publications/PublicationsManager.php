<?

include_once("../../Epsilon.php");

class PublicationsManager {

	static function getPublicationSideItem($publicationId, $sideItemExtras = "") {
		$publications = simplexml_load_file(Epsilon::getAbsoluteLocation("doc/publications/publications.xml"))->publication;
		$html = "";
		foreach ($publications as $publication) {
			if ($publication["id"] == $publicationId) {
				$html = '<div class="sideitem" '.$sideItemExtras.'>';
				$html .= '<h6>Related Publications</h6>';
				$html .= '<div class="modal">';
				$html .= "Citing this work in a scientific article? Please consider citing one of the related publications below instead of this web page.";
				$html .= "<ul>";
				$html .= "<li><a href='".trim($publication["url"])."'>".trim($publication["title"])."</a>";
				$html .= "</ul>";
				$html .= "</div>";
				$html .= "</div>";
			}
		}
		return $html;
	}
}
?>