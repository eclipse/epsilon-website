<?
	include("FeedWriter.php");
	require_once("../../../Epsilon.php");
	
	chdir("..");
	include("ArticleReader.php");
	$categories = simplexml_load_file("articles.xml")->category;
		
	$feed = new FeedWriter(RSS2);
	$feed->setTitle("Epsilon Articles");
	$feed->setLink(Epsilon::getAbsoluteLocation("doc/articles/"));
	
	$articleReader = new ArticleReader();

	foreach ($categories as $category) {
		foreach ($category->article as $articleElement) {
			
			if ($articleElement["date"]) {
			
				$article = $articleReader->readArticle($articleElement["name"], true);
				
				if ($article) {
					$newsItem = $feed->createNewItem();
					$newsItem->setTitle($article->getTitle());
					$newsItem->setLink(Epsilon::getAbsoluteLocation("doc/articles/").$articleElement["name"]);
					$newsItem->setDescription($article->getContent());
					$newsItem->setDate(strtotime($articleElement["date"]));
					$feed->addItem($newsItem);
				}
			}
		}
	}
	
	function getArticle($id, $categories) {
		foreach ($categories as $category) {
			foreach ($category->article as $article) {
				if (strcmp($article["name"],$id) == 0) {
					return $article;
				}
			}
		}
	}
	
	echo $feed->genarateFeed();
?>