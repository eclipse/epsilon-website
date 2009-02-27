<?

include_once("dom4php/XmlParser.php");

function r2h($title, $feed, $posts, $heading=3, $limit = 5) {
	$parser   = new XmlParser($encoding = 'ISO-8859-1');
	$document = $parser->parse(file_get_contents($feed));
	$channel = $document->documentElement;
	$html = '<h'.$heading.'>';
	$html .= "<a href=\"$feed\" style=\"float:right\"><img src=\"/images/rss.gif\" alt=\"More...\" /></a>";
	$html .= $title.'</h'.$heading.'>';
	$html .= '<ul>';
	$i = 0;
	foreach ($channel->selectElements(array(),"item") as $item) {
		$title = $item->getOneChild("title")->childNodes[0]->data;
		foreach ($posts as $post) {
			if (substr_count($title,$post) > 0 && $i < $limit) {
				$html .= '<li><a href="'.$item->getOneChild("link")->childNodes[0]->data.'">'.$title.'</a>';
				$html .= '<br>'.$item->getOneChild("description")->childNodes[0]->data;
				//$html .= '<b>Posted: </b>'.$item->getOneChild("pubDate")->childNodes[0]->data.'</p>';
				$i++;
			}
		}
	}
	$html .= '</ul>';
	return $html;
}
?>