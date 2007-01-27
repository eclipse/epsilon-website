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
 * $Id: Node.php,v 1.1 2007/01/27 16:09:58 dkolovos Exp $
 */

define("DOM_ELEMENT_NODE",                    1);
define("DOM_ATTRIBUTE_NODE",                  2);
define("DOM_TEXT_NODE",                       3);
define("DOM_CDATA_SECTION_NODE",              4);
define("DOM_ENTITY_REFERENCE_NODE",           5);
define("DOM_ENTITY_NODE",                     6);
define("DOM_PROCESSING_INSTRUCTION_NODE",     7);
define("DOM_COMMENT_NODE",                    8);
define("DOM_DOCUMENT_NODE",                   9);
define("DOM_DOCUMENT_TYPE_NODE",              10);
define("DOM_DOCUMENT_FRAGMENT_NODE",          11);
define("DOM_NOTATION_NODE",                   12);

class Node {

    var $nodeName;
    var $nodeValue;
    var $nodeType;
    var $parentNode;
    var $childNodes = array();
    var $firstChild;
    var $lastChild;
    var $previousSibling;
    var $nextSibling;
    var $attributes;
    var $ownerDocument;
    // Items not defined in the DOM
    var $guid;
    var $idName = "id";

    function Node() {
        $this->setGuid();
    }

    /** {{{insertBefore
     * @desc Inserts the node newChild before the existing child node refChild.
     * @param newChild Node
     * @param refChild Node
     * @return Node
     */
    function &insertBefore(&$newChild, &$refChild) {
        // Search for $refChild in the childNodes list.  If it is null, append
        // $newChild to the list.  If it's found, insert $newChild before it.
        $existingNode = $this->findIndex($refChild);
        // Check if an exception must be thrown
        if ($this->isDescendantOf($newChild)
                || !$this->canAcceptChildNodeOfType($newChild->nodeType)) {
            trigger_error("DOM_HIERARCHY_REQUEST_ERR", E_USER_ERROR);
        }
        if ($this->ownerDocument && !$this->ownerDocument->equals($newChild->ownerDocument)) {
            trigger_error("DOM_WRONG_DOCUMENT_ERR", E_USER_ERROR);
        }
        if ($this->isReadOnly() || $newChild->isReadOnly()) {
            trigger_error("DOM_NO_MODIFICATION_ALLOWED_ERR", E_USER_ERROR);
        }
        if ($existingNode < 0 && !is_null($refChild)
                && $newChild->nodeType !== DOM_DOCUMENT_FRAGMENT_NODE) {
            trigger_error("DOM_NOT_FOUND_ERR", E_USER_ERROR);
        }
        // Insert the new node
        if (is_null($refChild)) {
            if ($newChild->nodeType === DOM_DOCUMENT_FRAGMENT_NODE) {
                foreach (array_keys($newChild->childNodes) as $key) {
                    $this->appendChild($newChild->childNodes[$key]);
                }
            }
            else {
                return $this->appendChild(&$newChild);
            }
        }
        elseif ($newChild->nodeType === DOM_DOCUMENT_FRAGMENT_NODE) {
            // Insert each of the fragment's child nodes; handle exceptions by
            // just moving on to the next child node.
            foreach (array_keys($newChild->childNodes) as $key) {
                $this->insertBefore($newChild->childNodes[$key], $refChild);
            }
        }
        else {
            // If the new child already exists, remove it from the tree
            $newChild =& $this->removeChildIfExists($newChild);
            // We might have modified the array... re-calculate the index of the
            // one to insert before.
            $existingNode = $this->findIndex($refChild);
            $this->insertBeforeIndex($newChild, $existingNode);
        }
        return $newChild;
    } // }}}

    /** {{{replaceChild
     * @return Node The old child
     * @param newChild Node
     * @param oldChild Node
     * @desc Replaces the child node oldChild with newChild
     */
    function &replaceChild(&$newChild, &$oldChild) {
        $result =& $this->insertBefore($newChild, $oldChild);
        return $this->removeChild($oldChild);
    } // }}}

    /** {{{removeChild
     * @desc Removes oldChild from the tree and returns it.
     * @return Node
     * @param oldChild The node to remove.
     */
    function &removeChild(&$oldChild) {
        if ($this->isReadOnly()) {
            trigger_error("DOM_NO_MODIFICATION_ALLOWED_ERR", E_USER_ERROR);
        }
        $index = $this->findIndex($oldChild);
        if ($index < 0) {
            trigger_error("DOM_NOT_FOUND_ERR", E_USER_ERROR);
        }
        $result =& $this->removeChildAtIndex($index);
        return $result;
    } // }}}

   /** {{{appendChild
    * @return Node
    * @param $newChild Node
    * @desc Appends $newChild to the node's list of child nodes.
    */
    function &appendChild(&$newChild) {
        if ($this->isDescendantOf($newChild)
                || !$this->canAcceptChildNodeOfType($newChild->nodeType)) {
            trigger_error("DOM_HIERARCHY_REQUEST_ERR", E_USER_ERROR);
        }
        if ($this->ownerDocument && !$this->ownerDocument->equals($newChild->ownerDocument)) {
            trigger_error("DOM_WRONG_DOCUMENT_ERR", E_USER_ERROR);
        }
        if ($this->isReadOnly()) {
            trigger_error("DOM_NO_MODIFICATION_ALLOWED_ERR", E_USER_ERROR);
        }
        // There are two cases: the node is a DocumentFragment, or a Node.
        if ($newChild->nodeType === DOM_DOCUMENT_FRAGMENT_NODE) {
            // Append each of the fragment's child nodes; handle exceptions by
            // just moving on to the next child node.
            foreach (array_keys($newChild->childNodes) as $key) {
                $this->appendChild($newChild->childNodes[$key]);
            }
        }
        else {
            // If newChild is already in the tree, it is first removed.
            $newChild =& $this->removeChildIfExists($newChild);
            $this->childNodes[] =& $newChild;
            $numNodes = count($this->childNodes);
            if ($numNodes > 1) {
                $newChild->previousSibling =& $this->childNodes[$numNodes - 2];
                $this->childNodes[$numNodes - 2]->nextSibling =& $newChild;
            }
            $this->lastChild =& $newChild;
            $this->firstChild =& $this->childNodes[0];
            $newChild->parentNode =& $this;
            $this->ownerDocument->addNodeToLookupCache($newChild);
        }
        return $newChild;
    } // }}}

    // {{{hasChildNodes
    function hasChildNodes() {
        return (count($this->childNodes) > 0);
    } // }}}

    // {{{cloneNode
    function &cloneNode($deep) {
    } // }}}

    // {{{normalize
    function normalize() {
    } // }}}

    // {{{isSupported
    function isSupported($feature, $version) {
        // FIXME: use method_exists
    } // }}}

    // Functions not defined in the DOM standard

    // {{{equals
    function equals(&$otherNode) {
        // Return true if these are the same object (as determined by checking
        // their guid attribute, which may be the same but shouldn't since it
        // is random)
        return ($this->guid === $otherNode->guid);
    } // }}}

    // {{{isDescendantOf
    function isDescendantOf(&$node) {
        if (is_null($this->parentNode)) {
            return false;
        }
        if ($this->parentNode->equals($node)) {
            return true;
        }
        return $this->parentNode->isDescendantOf($node);
    } //}}}

    /** {{{insertBeforeIndex
     * @desc Inserts $node before position $index
     */
    function insertBeforeIndex(&$node, $index) {
        // Two cases: the node goes at the beginning of the list, or it goes
        // somewhere in the middle.
        $this->ownerDocument->addNodeToLookupCache($node);
        if ($index == 0) {
            array_unshift($this->childNodes, &$node);
            $node->nextSibling =& $this->firstChild;
            $this->firstChild->previousSibling =& $node;
            $this->firstChild =& $node;
        }
        else {
            // Move each of the following nodes "up" one in the childNodes
            // array, and insert this node into the "hole" that was left
            for ($i = count($this->childNodes); $i > $index; --$i) {
                $this->childNodes[$i] =& $this->childNodes[$i - 1];
            }
            $node->nextSibling =& $this->childNodes[$i + 1];
            $node->previousSibling =& $this->childNodes[$i - 1];
            $this->childNodes[$i] =& $node;
            $node->nextSibling->previousSibling =& $node;
            $node->previousSibling->nextSibling =& $node;
        }
    } // }}}

    // {{{isReadOnly
    function isReadOnly() {
        return false;
    } // }}}

    // {{{canAcceptChildNodeOfType
    function canAcceptChildNodeOfType($nodeType) {
        return true;
    } // }}}

    // {{{findIndex
    function findIndex(&$node) {
        if (!is_null($node)) {
            for ($i = 0; $i < count($this->childNodes); ++$i) {
                if ($this->childNodes[$i]->equals($node)) {
                    return $i;
                }
            }
        }
        return -1;
    } //}}}

    /** {{{removeChildIfExists
     * @return Node The Node that was removed if it existed
     * @param child The node to remove
     * @desc Removes the child if it exists in childNodes
     */
    function &removeChildIfExists(&$child) {
        $index = $this->findIndex($child);
        if ($index != -1) {
            return $this->removeChildAtIndex($index);
        }
        return $child;
    } //}}}

    /** {{{removeChildAtIndex
     * @return Node The node that was removed
     * @param index The index to remove
     * @desc Removes the given node from the list of child nodes
     */
    function &removeChildAtIndex($index) {
        $result =& $this->childNodes[$index];
        // There are four cases.  The node to remove is at the front, at the
        // back, in the middle, or the only node.
        $numNodes = count($this->childNodes);
        if ($numNodes === 1) {
            $this->firstChild = $this->lastChild = null;
            array_pop($this->childNodes);
        }
        elseif ($index === 0) {
            array_shift($this->childNodes);
            $this->firstChild =& $this->childNodes[0];
            $this->firstChild->previousSibling =& $null;
        }
        elseif ($index === $numNodes - 1) {
            array_pop($this->childNodes);
            $this->lastChild =& $this->childNodes[$numNodes - 2];
            $this->lastChild->nextSibling =& $null;
        }
        else {
            // Re-link the linked list around the node to remove, then move all
            // the elements of the childNodes array up one position
            $this->childNodes[$index - 1]->nextSibling =& $this->childNodes[$index + 1];
            $this->childNodes[$index + 1]->previousSibling =& $this->childNodes[$index - 1];
            for ($i = $index; $i < $numNodes - 1; $i++) {
                $this->childNodes[$i] =& $this->childNodes[$i + 1];
            }
            // The array's last two elements now both point to the same Node.
            // Get rid of the last one:
            array_pop($this->childNodes);
        }
        // Get rid of any entries in the id lookup table:
        if (isset($this->ownerDocument->idCache[$node->attributes['id']])) {
            unset($this->ownerDocument->idCache[$node->attributes['id']]);
        }
        $result->parentNode =& $null;
        return $result;
    } //}}}

    /** {{{setGuid
     * @return null
     * @desc Sets a random number on this Node for a global identifier
     */
    function setGuid() {
        $this->guid = rand(0, 2147483647);
    } //}}}

    // {{{containsInvalidCharacter
    function containsInvalidCharacter($text) {
        return FALSE;
    } //}}}

    // {{{getElementByID
    function &getElementByID($elementID) {
        if ($this->nodeType == DOM_ELEMENT_NODE) {
            if (isset($this->attributes[$this->idName])
                    && $this->attributes[$this->idName] === $elementID) {
                return $this;
            }
        }
        foreach (array_keys($this->childNodes) as $key) {
            @$result =& $this->childNodes[$key]->getElementByID($elementID);
            if (!is_null($result)) {
                return $result;
            }
        }
        return null;
    } //}}}

    // {{{getElementsByAttributeValue
    function getElementsByAttributeValue($name, $value) {
        $result = array();
        if ($this->nodeType == DOM_ELEMENT_NODE) {
            if (isset($this->attributes[$name])
                    && $this->attributes[$name] === $value) {
                $result[] =& $this;
            }
        }
        foreach (array_keys($this->childNodes) as $key) {
            if ($this->childNodes[$key]->nodeType == DOM_ELEMENT_NODE) {
                $result = array_merge($result,
                    $this->childNodes[$key]->getElementsByAttributeValue($name, $value));
            }
        }
        return $result;
    } //}}}

    // {{{selectElements
    function selectElements($criteria = array(), $tagName = "*") {
        $result = array();
        $arr = $this->getElementsByTagName($tagName);
        foreach (array_keys($arr) as $key) {
            $matches = 1;
            foreach ($criteria as $name => $value) {
                if ($arr[$key]->getAttribute($name) !== $value) {
                    $matches = 0;
                    break;
                }
            }
            if ($matches) {
                $result[] =& $arr[$key];
            }
        }
        return $result;
    } //}}}

}

?>
