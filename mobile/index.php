<?
chdir('..');
include_once('news/news.php');
?>
<?=r2m("Newsgroup", "http://dev.eclipse.org/newslists/news.eclipse.epsilon/maillist.rss", array('epsilon'))?>