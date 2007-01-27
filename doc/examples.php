Version 3

<?php
$indent = "";
$file = "semi.xml";
ini_set("display_errors","1");
$showfile = file_get_contents("examples.xml");  // whatever path
   // maybe the whole path is not important, look it up in other posts
?>
<?=$showfile?>
<?
$newstring=utf8_encode($showfile);          // it's important!
if(!$domDocument = domxml_open_mem1($newstring)) {
   echo "Couldn't load xml...";   
   exit;
}

$rootDomNode = $domDocument->document_element();
print "<pre>";
printElements($rootDomNode);
print "</pre>";

function printElements($domNode)
{
  if($domNode)
  {
   global $indent;
  
   if($domNode->node_type() == XML_ELEMENT_NODE)
   {
     print "<br />".$indent."&lt;".$domNode->node_name();
     if($domNode->has_attributes())
     {
       $attributes = $domNode->attributes();
       foreach($attributes as $domAttribute)
       {
         print " $domAttribute->name=\"$domAttribute->value\"";
       }
     }
     print "&gt;";
     if($domNode->has_child_nodes())
     {
       $indent.="  ";
       $nextNode = $domNode->first_child();
       printElements($nextNode);
       $indent= substr($indent, 0, strlen($indent)-2);
       print "<br />".$indent."&lt;"."/".$domNode->node_name()."&gt;";
     }
     else
     {
       print "$domNode->node_value()&lt;/".$domNode->node_name()."&gt;";
     }                       
   }
  
   $nextNode = $domNode->next_sibling();
   printElements($nextNode);
  }
}
?>