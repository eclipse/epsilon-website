<?

class PublicationsManager {

	static function getPublicationSideItem($publicationId) {
		$publications = simplexml_load_file(Epsilon::getIncludeLocation()."/doc/publications/publications.xml")->publication;
		$html = "";
		foreach ($publications as $publication) {
			if ($publication["id"] == $publicationId) {
				ob_start();
				sB('Related Publications');
				?>
				Citing this work in a scientific article? Please consider citing one of the related publications below instead of this web page.
				<ul>
					<li><a href="<?= trim($publication["url"]) ?>"><?= trim($publication["title"]) ?></a>
				</ul>
				<?
				sE();
				$html .= ob_get_contents();
				ob_end_clean();
			}
		}
		return $html;
	}
}
?>