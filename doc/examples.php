<?php

# Create a parser and parse a simple document.
include_once("../dom4php/XmlParser.php");
$parser   = new XmlParser($encoding = 'ISO-8859-1'); # encoding is optional
$document = $parser->parse(file_get_contents("examples.xml"));

$exampleNodes = $document->getElementsByTagName("example");

echo "<p>";
echo sizeof($exampleNodes);
echo " examples currently available";

foreach ($exampleNodes as $example) {
	$descriptionNodes = $example->selectElements(array(),"description");
	$descriptionNode = $descriptionNodes[0];
	$description = $descriptionNode->childNodes[0]->data;
	
	echo "<p>";
	echo $description;
	
	$src = $example->getAttribute("src");
	echo "<p>";
	echo $src;
	
	$title = $example->getAttribute("title");
	echo "<p>";
	echo $title;

}

# Add a text node.
#$text =& $document->createTextNode('foozle');
#$document->childNodes[0]->appendChild($text);

# Navigate around the document a bit, starting at the new node we just added.
#$strong =& $text->previousSibling;
#echo "The content of the node is '" . $strong->childNodes->data . "'\n";

# Serialize the XML document to a string.  Do NOT use print_r() as the cyclic
# data structures will cause problems.  Instead, create an instance of the
# XmlSerializer class.
#include_once("XmlSerializer.php");
#$serializer = new XmlSerializer("XML");
#echo $serializer->serializeNode($document);
#echo "\n";

?>