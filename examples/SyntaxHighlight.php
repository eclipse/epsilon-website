<?
include 'EpsilonSyntaxHighlight.php';
include 'EmfaticSyntaxHighlight.php';
include 'JavaSyntaxHighlight.php';
include 'EglSyntaxHighlight.php';

function highlight($text, $language) {

	if ($language == "eol" || $language == "etl" || $language == "evl" || $language == "ecl" || $language == "eml" || $language == "ewl") {
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
	else {
		return '<pre>'.htmlspecialchars($text).'<pre>';
	}
}

function getExtension($url) {
	return substr($url, strrpos($url, '.') + 1);
}
?>
