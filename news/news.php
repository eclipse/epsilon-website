<?

include_once("dom4php/XmlParser.php");

function r2h($title, $feed, $posts, $heading=3, $limit = 5, $chopAt = 400) {
	$parser   = new XmlParser($encoding = 'ISO-8859-1');
	$document = $parser->parse(file_get_contents($feed));
	$channel = $document->documentElement;
	$html = '<h'.$heading.'>';
	$html .= "<a href=\"$feed\" style=\"float:right\"><img src=\"/images/rss.gif\" alt=\"More...\" /></a>";
	$html .= $title.'</h'.$heading.'><div class="modal">';
	$html .= '<ul>';
	$i = 0;
	foreach ($channel->selectElements(array(),"item") as $item) {
		$title = $item->getOneChild("title")->childNodes[0]->data;
		foreach ($posts as $post) {
			if (($post == "" || substr_count($title,$post) > 0) && $i < $limit) {
				$html .= '<li><a href="'.$item->getOneChild("link")->childNodes[0]->data.'">'.$title.'</a>';
				$html .= '   <span style="color:#939393"><i>('.$item->getOneChild("pubDate")->childNodes[0]->data.')</i></span>';
				//$content = $item->getOneChild("description")->childNodes[0]->data;
				//if (trim($content) == "") {
					$content = strip_tags($item->getOneChild("content:encoded")->childNodes[0]->data);
					$more = " [...]";
					if (trim($content) == "") { $content = $item->getOneChild("description")->childNodes[0]->data; }

					if (strlen($content) < $chopAt) {
						$chopAt = strlen($content);
						$more = "";
					}
					else {
						$space = strpos($content, " ", $chopAt);
						if ($space > $chopAt) { $chopAt = $space;}
					}
					$content = substr($content, 0, $chopAt);
					//$content = "nothing...";
				//}
				
				$html .= '<br>'.$content.$more;
				//$html .= '<p><b>Posted: </b>'.$item->getOneChild("pubDate")->childNodes[0]->data.'</p>';
				$i++;
			}
		}
	}
	$html .= '</ul></div>';
	return $html;
}

function rdf2h($title, $feed, $posts, $heading=3, $limit = 5, $chopAt = 400) {
	$parser   = new XmlParser($encoding = 'ISO-8859-1');
	$document = $parser->parse(file_get_contents($feed));
	$channel = $document->documentElement;
	$html = '<h'.$heading.'>';
	$html .= "<a href=\"$feed\" style=\"float:right\"><img src=\"/images/rss.gif\" alt=\"More...\" /></a>";
	$html .= $title.'</h'.$heading.'><div class="modal">';
	$html .= '<ul>';
	$i = 0;
	foreach ($channel->selectElements(array(),"item") as $item) {
		$title = $item->getOneChild("title")->childNodes[0]->data;
		foreach ($posts as $post) {
			if (($post == "" || substr_count($title,$post) > 0) && $i < $limit) {
				$html .= '<li><a href="'.$item->getOneChild("link")->childNodes[0]->data.'">'.$title.'</a>';
				$html .= '   <span style="color:#939393"><i>('.$item->getOneChild("dc:date")->childNodes[0]->data.')</i></span>';
				//$content = $item->getOneChild("description")->childNodes[0]->data;
				//if (trim($content) == "") {
					$content = strip_tags($item->getOneChild("content:encoded")->childNodes[0]->data);
					$more = " [...]";
					if (trim($content) == "") { $content = $item->getOneChild("description")->childNodes[0]->data; }

					if (strlen($content) < $chopAt) {
						$chopAt = strlen($content);
						$more = "";
					}
					else {
						$space = strpos($content, " ", $chopAt);
						if ($space > $chopAt) { $chopAt = $space;}
					}
					$content = strip_tags(substr($content, 0, $chopAt));
					//$content = "nothing...";
				//}
				
				$html .= '<br>'.$content.$more;
				//$html .= '<p><b>Posted: </b>'.$item->getOneChild("pubDate")->childNodes[0]->data.'</p>';
				$i++;
			}
		}
	}
	$html .= '</ul></div>';
	return $html;
}


function r2m($title, $feed, $posts, $heading=3, $limit = 5) {
	$parser   = new XmlParser($encoding = 'ISO-8859-1');
	$document = $parser->parse(file_get_contents($feed));
	$channel = $document->documentElement;
	$html = '<h'.$heading.'>';
	$html .= $title.'</h'.$heading.'>';
	$i = 0;
	foreach ($channel->selectElements(array(),"item") as $item) {
		$title = $item->getOneChild("title")->childNodes[0]->data;
		foreach ($posts as $post) {
			if (($post == "" || substr_count($title,$post) > 0) && $i < $limit) {
				$html .= '<a href="'.$item->getOneChild("link")->childNodes[0]->data.'">'.$title.'</a><p>';
				//$html .= '   <span style="color:#939393"><i>('.$item->getOneChild("pubDate")->childNodes[0]->data.')</i></span>';
				//$content = $item->getOneChild("description")->childNodes[0]->data;
				//if (trim($content) == "") {
					$content = strip_tags($item->getOneChild("content:encoded")->childNodes[0]->data);
					$more = " [...]";
					if (trim($content) == "") { $content = $item->getOneChild("description")->childNodes[0]->data; }
					$chopAt = 400;
					if (strlen($content) < $chopAt) {
						$chopAt = strlen($content);
						$more = "";
					}
					else {
						$space = strpos($content, " ", $chopAt);
						if ($space > $chopAt) { $chopAt = $space;}
					}
					$content = strip_tags(substr($content, 0, $chopAt));
					//$content = "nothing...";
				//}
				
				$html .= $content.$more.'</p>';
				//$html .= '<p><b>Posted: </b>'.$item->getOneChild("pubDate")->childNodes[0]->data.'</p>';
				$i++;
			}
		}
	}
	$html .= '<br>';
	return $html;
}

function r2i($title, $feed, $limit = 5) {
	$parser   = new XmlParser($encoding = 'ISO-8859-1');
	$title = "Epsilon Forum";
	$document = $parser->parse(file_get_contents($feed));
	$channel = $document->documentElement;
	$html = '<ul id="home" title="'.$title.'" selected="true" otherButtonLabel="Home" otherButtonHref="http://www.eclipse.org/gmt/epsilon/">';

	$i = 0;
	foreach ($channel->selectElements(array(),"item") as $item) {
		$title = $item->getOneChild("title")->childNodes[0]->data;
		$content = strip_tags($item->getOneChild("content:encoded")->childNodes[0]->data);
		$date = $item->getOneChild("dc:date")->childNodes[0]->data;
		if (trim($content) == "") { $content = $item->getOneChild("description")->childNodes[0]->data; }
		$html.= '<li><a href="#article'.$i.'" style="font-size:16px">'.$title;
		$html.= '<div style="font-size:12px;font-weight:normal">'.$date.'</div></a>';
		$html.= '</li>';
		$i++;
	}
	$html .= '</ul>';

	$i = 0;
	foreach ($channel->selectElements(array(),"item") as $item) {
		$title = $item->getOneChild("title")->childNodes[0]->data;
		$content = strip_tags($item->getOneChild("content:encoded")->childNodes[0]->data);
		$date = $item->getOneChild("dc:date")->childNodes[0]->data;
		if (trim($content) == "") { $content = $item->getOneChild("description")->childNodes[0]->data; }
		$html.= '<div id="article'.$i.'" style="margin-left:10px" title="Article" backButtonLabel="Back" otherButtonLabel="Full"
otherButtonHref="'.$item->getOneChild("link")->childNodes[0]->data.'">';

		$html.= '<h3>'.$title.'</h3>';
		$content = strip_tags($content);
		$content = wordwrap($content, 30, "\n", 1);
		//$html.= ''.wordwrap($content,35, "<break/>", 1).'';
		$html.= '<pre>'.$content.'</pre>';
		$html.= '</div>';
		$i++;
	}

	return $html;
}
?>