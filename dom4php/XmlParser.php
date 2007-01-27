<?php
/*
 * This software implements a simplified DOM interface for PHP.
 * Copyright (C) 2004 Baron Schwartz <baron at xaprb dot com>
 * 
 * This program is free software; you can redistribute it and/or modify it under
 * the terms of the GNU Lesser General Public License as published by the Free
 * Software Foundation, version 2.1.
 *
 * This program is distributed in the hope that it will be useful, but WITHOUT
 * ANY WARRANTY; without even the implied warranty of MERCHANTABILITY or FITNESS
 * FOR A PARTICULAR PURPOSE.  See the GNU Lesser General Public License for more
 * details.
 * 
 * $Id: XmlParser.php,v 1.1 2007/01/27 16:09:57 dkolovos Exp $
 */

include_once("Document.php");

class XMLParser {

    var $parser;
    var $document;
    var $currentNode;
    var $cdata;

    function XMLParser($encoding = 'ISO-8859-1') {
        $this->parser = xml_parser_create($encoding);
        xml_set_object($this->parser, &$this);
        xml_parser_set_option($this->parser, XML_OPTION_CASE_FOLDING, 0);
        xml_set_element_handler($this->parser, "startTag", "endTag");
        xml_set_character_data_handler($this->parser, "characterData");
    }

    function &parse($data) {
        $this->document =& new Document();
        $this->currentNode =& $this->document;
        if (!xml_parse($this->parser, $data)) {
            trigger_error("XML Parsing error at line "
                . xml_get_current_line_number($this->parser) . ", column "
                . xml_get_current_column_number($this->parser) . ": "
                . xml_error_string(xml_get_error_code($this->parser)),
                E_USER_ERROR);
        }
        return $this->document;
    }

    function startTag($parser, $tag, $attributes) {
        $this->coalesceCData();
        $element =& $this->document->createElement($tag);
        foreach ($attributes as $name => $value) {
            $element->setAttribute($name, $value);
        }
        $this->currentNode->appendChild($element);
        $this->currentNode =& $element;
    }

    function characterData($parser, $cdata) {
        // Character data is parsed in chunks, which start and end at special
        // characters like entities, newlines, tabs etc, and also at increments
        // as the parser reads the data in chunks.  To concatenate all of these
        // chunks into one, it is necessary to just save the data passed to this
        // function and deal with it after all the cdata has been read.
        $this->cdata .= $cdata;
    }

    function endTag($parser, $tag) {
        $this->coalesceCData();
        $this->currentNode =& $this->currentNode->parentNode;
    }

    function coalesceCData() {
        // Handle the cdata that's been saved.  If it's whitespace, but not
        // empty, treat it as a single space.  Otherwise treat it as is; trim
        // leading and trailing whitespace to a single space.
        if (is_null($this->cdata)) {
            return;
        }
        if ($this->cdata !== "" && trim($this->cdata) === "") {
            $this->cdata = " ";
        }
        else {
            $this->cdata = preg_replace("/(^ +)|( +$)/s", " ", $this->cdata);
        }
        $text =& $this->document->createTextNode($this->cdata);
        $this->currentNode->appendChild($text);
        $this->cdata = null;
    }

}

?>
