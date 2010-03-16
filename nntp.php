 <?
	$nntp = imap_open ("{news.eclipse.org:119/nntp}eclipse.epsilon", "exquisitus", "flinder1f7");
	echo imap_num_msg($nntp);
 ?>