<?
include 'EpsilonSyntaxHighlight.php';
include 'EmfaticSyntaxHighlight.php';
include 'JavaSyntaxHighlight.php';
include 'EglSyntaxHighlight.php';
include 'XmlSyntaxHighlight.php';

function highlight($text, $language) {

	if ($language == "eol" || $language == "eunit" || $language == "etl" || $language == "evl" || $language == "ecl" || $language == "eml" || $language == "ewl" || $language == "mig") {
		return EpsilonSyntaxHighlight::process($text, $language);
	}
	else if ($language == "emf") {
		return EmfaticSyntaxHighlight::process($text);
	}
	else if ($language == "egl") {
		return EglSyntaxHighlight::process($text);
	}
	else if ($language == "java") {
		return JavaSyntaxHighlight::process($text);
	}
	//else if ($language == "xml") {
	//	return XmlSyntaxHighlight::process($text, $true);
	//}
	else {
		$text = str_replace ("\t", "  ", $text);
		return '<pre>'.htmlspecialchars($text).'<pre>';
	}
}

function getExtension($url) {
	return substr($url, strrpos($url, '.') + 1);
}
?>
