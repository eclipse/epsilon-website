<?

require_once 'wikitexttohtml.php';
		
class ArticleReader {
	
	// Returns an Article
	function readArticle($articleId, $absoluteLinks = false) {
		$contentFile = $articleId.'/content.wiki';
		$contentType = "wiki";
		$content = "";
		$title = "Article ".$articleId." not found";
		
		if (file_exists($contentFile)) {
			$lines = file($contentFile);
			$line = trim($lines[0]);
			$title = substr($line, 1, strlen($line) - 2);
		} else {
			$contentFile = $articleId.'/content.html';
			$lines = file($contentFile);
			$matches = preg_grep("/^<h1>(.*?)<\/h1>/", $lines);
			if (sizeof($matches) > 0) {
				$title = substr($matches[0], 4, strlen($matches[0]) - 10);
			}
			$contentType = "html";
		}
		
		$content = file_get_contents($contentFile);
		
		if ($contentType == "wiki") {
			$converter = new WikiTextToHTML();
			$content = $converter->convertWikiTextToHTML($content);
		}
		
		if ($absoluteLinks) {
			//Replace relative img src- a hrefs
			$content=preg_replace('#(href|src)="([^:"]*)("|(?:(?:%20|\s|\+)[^"]*"))#','$1="http://eclipse.org/epsilon/doc/articles/'.$articleId.'/$2$3',$content);
		}
		
		$article = new Article();
		$article->setTitle($title);
		$article->setContent($content);
		return $article;
	}
}

class Article {
	
	var $content;
	var $title;
	
	function setTitle($title) {
		$this->title = $title;
	}
	
	function getTitle() {
		return $this->title;
	}
	
	
	function setContent($content) {
		$this->content = $content;
	}
	
	function getContent() {
		return $this->content;
	}
	
	
	
}

?>