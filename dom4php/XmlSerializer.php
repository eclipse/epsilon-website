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
 * $Id: XmlSerializer.php,v 1.1 2007/01/27 16:09:58 dkolovos Exp $
 */

class XMLSerializer {

    var $increment      = "    ";
    var $startFunction  = "start";
    var $attrFunction   = "attr";
    var $endFunction    = "end";
    var $textFunction   = "text";
    var $seriFunction   = "seri";

    function XMLSerializer($method = "XML") {
        $this->startFunction .= $method;
        $this->attrFunction .= $method;
        $this->endFunction .= $method;
        $this->textFunction .= $method;
        $this->seriFunction .= $method;
    }

    /** {{{serializeNode
     */
    function serializeNode(&$node, $prefix = "") {
        return $this->{$this->seriFunction}($node, $prefix);
    } //}}}

    // {{{XML Section
    function seriXML(&$node, $prefix) {
        $result = "";
        if ($node->nodeType == DOM_DOCUMENT_NODE) {
            return $this->seriXML($node->documentElement, $prefix);
        }
        switch ($node->nodeType) {
            case DOM_TEXT_NODE:
                $result = htmlspecialchars($node->data);
                break;
            default:
                $result = $this->startXML($node, $prefix);
        }
        foreach (array_keys($node->childNodes) as $key) {
            $result .= $this->seriXML($node->childNodes[$key], $prefix . $this->increment);
        }
        return $result . $this->endXML($node, $prefix);
    }

    function startXML(&$node, $prefix) {
        $result = "";
        switch ($node->nodeType) {
            case DOM_ELEMENT_NODE:
                $result = "\n$prefix<$node->tagName"
                        . $this->attrXML($node, $prefix .  $this->increment);
                if ($node->hasChildNodes()) {
                    $result .= ">";
                }
                break;
            case DOM_TEXT_NODE:
                break;
            default:
                $result = "\n$prefix<$node->tagName>";
        }
        return $result;
    }

    function attrXML(&$node, $prefix) {
        $result = "";
        foreach ($node->attributes as $name => $value) {
            $result .= " $name=\"" . htmlspecialchars($value) . "\"";
        }
        return $result;
    }

    function endXML(&$node, $prefix) {
        switch ($node->nodeType) {
            case DOM_DOCUMENT_NODE:
                break;
            case DOM_TEXT_NODE:
                break;
            default:
                if ($node->hasChildNodes()) {
                    if ($node->childNodes[0]->nodeType == DOM_TEXT_NODE
                            && substr($node->childNodes[0]->data, -1) !== " ") {
                        return "</$node->tagName>";
                    }
                    else {
                        return "\n$prefix</$node->tagName>";
                    }
                }
                else {
                    return "/>";
                }
        }
    }
    // }}}

    // {{{HTML Section
    function seriHTML(&$node, $prefix) {
        $result = "";
        if ($node->nodeType == DOM_DOCUMENT_NODE) {
            return $this->seriHTML($node->documentElement, $prefix);
        }
        switch ($node->nodeType) {
            case DOM_TEXT_NODE:
                $result = htmlspecialchars($node->data);
                break;
            default:
                if ($node->nodeType == DOM_ELEMENT_NODE && $node->getAttribute("hidden")) {
                    return "";
                }
                $result = $this->startHTML($node, $prefix);
        }
        foreach (array_keys($node->childNodes) as $key) {
            $result .= $this->seriHTML($node->childNodes[$key], $prefix . $this->increment);
        }
        return $result . $this->endHTML($node, $prefix);
    }

    function startHTML(&$node, $prefix) {
        $result = "";
        switch ($node->nodeType) {
            case DOM_ELEMENT_NODE:
                $result = "\n$prefix<$node->tagName"
                        . $this->attrHTML($node, $prefix .  $this->increment);
                if ($node->hasChildNodes()) {
                    $result .= ">";
                }
                break;
            case DOM_TEXT_NODE:
                break;
            default:
                $result = "\n$prefix<$node->tagName>";
        }
        return $result;
    }

    function attrHTML(&$node, $prefix) {
        $result = "";
        foreach ($node->attributes as $name => $value) {
            $result .= " $name=\"" . htmlspecialchars($value) . "\"";
        }
        return $result;
    }

    function endHTML(&$node, $prefix) {
        switch ($node->nodeType) {
            case DOM_DOCUMENT_NODE:
                return "";
            case DOM_TEXT_NODE:
                return "";
            default:
                if ($node->hasChildNodes()) {
                    if ($node->childNodes[0]->nodeType == DOM_TEXT_NODE
                            && (count($node->childNodes) == 1
                            || substr($node->childNodes[0]->data, -1) !== " ")) {
                        return "</$node->tagName>";
                    }
                    else {
                        return "\n$prefix</$node->tagName>";
                    }
                }
                else {
                    return ">";
                }
        }
    }
    // }}}

    // {{{Structure Section
    function seriStructure(&$node, $prefix) {
        $result = "";
        switch ($node->nodeType) {
            case DOM_TEXT_NODE:
                $result = "\n$prefix" . "Text node"
                    . "\n$prefix$this->increment$node->data";
                break;
            default:
                $result = $this->{$this->startFunction}($node, $prefix);
        }
        foreach (array_keys($node->childNodes) as $key) {
            $result .= $this->seriStructure($node->childNodes[$key], $prefix . $this->increment);
        }
        return $result . $this->{$this->endFunction}($node, $prefix);
    }

    function startStructure(&$node, $prefix) {
        $result = "";
        switch ($node->nodeType) {
            case DOM_DOCUMENT_NODE:
                $result = "\n$prefix" . "Document Element";
                break;
            case DOM_ELEMENT_NODE:
                $result = "\n$prefix" . "Element [$node->tagName]"
                        . $this->{$this->attrFunction}($node, $prefix .  $this->increment);
                break;
            default:
                $result = "\n$prefix" . "Node of type [$node->nodeType]";
        }
        return $result;
    }

    function attrStructure(&$node, $prefix) {
        $result = "";
        foreach ($node->attributes as $name => $value) {
            $result .= "\n$prefix" . "Attribute '$name' => '$value'";
        }
        return $result;
    }

    function endStructure(&$node, $prefix) {
        switch ($node->nodeType) {
            case DOM_DOCUMENT_NODE:
                break;
            case DOM_TEXT_NODE:
                break;
            default:
        }
    }
    // }}}

}

?>
