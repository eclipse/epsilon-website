<?
include ("ArticleReader.php");
$articleId =  $_GET['articleId'];
$articleReader = new ArticleReader();
echo $articleReader->readArticle($articleId, true, true)->getContent();
?>