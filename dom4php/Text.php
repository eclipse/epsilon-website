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
 * $Id: Text.php,v 1.1 2007/01/27 16:09:58 dkolovos Exp $
 */

include_once("CharacterData.php");

class Text extends CharacterData {
        
    // {{{Text
    function Text() {
        $this->CharacterData();
        $this->nodeType = DOM_TEXT_NODE;
    } //}}}

    // {{{splitText
    function splitText($offset) {
        // Check whether to throw Exceptions
        if ($offset < 0 || $offset > $this->length) {
            trigger_error("DOM_INDEX_SIZE_ERR", E_USER_ERROR);
        }
        if ($this->readOnly) {
            trigger_error("DOM_NO_MODIFICATION_ALLOWED_ERR", E_USER_ERROR);
        }
        // Split the text, create a new node, and insert it after this one
        $afterText = substr($this->data, $offset);
        $this->setData(substr($this->data, $offset));
        $newChild =& new Text($afterText);
        return $this->parentNode->insertBefore($newChild, $this->nextSibling);
    } //}}}

}

?>
