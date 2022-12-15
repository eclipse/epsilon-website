import {define} from "ace-builds";

define("ace/mode/emfatic_highlight_rules",["require","exports","module","ace/lib/oop","ace/mode/text_highlight_rules"], function(require, exports, module) {
"use strict";

var oop = require("../lib/oop");
var TextHighlightRules = require("./text_highlight_rules").TextHighlightRules;

var emfaticHighlightRules = function() {

    var keywords = (
        "abstract|attr|class|enum|extends|import|package|ref|val|op|readonly|volatile|transient|unsettable|derived|unique|ordered|resolve|id"
    );

    var builtinConstants = (
        "true|false|self"
    );

    var builtinFunctions = (
        ""
    );

    var dataTypes = (
        "boolean|Boolean|byte|Byte|char|Character|double|Double|float|Float|int|Integer|long|Long|short|Short|Date|String|Object|Class|EObject|EClass"
    );

    var keywordMapper = this.createKeywordMapper({
        "support.function": builtinFunctions,
        "keyword": keywords,
        "constant.language": builtinConstants,
        "storage.type": dataTypes
    }, "identifier", true);

    this.$rules = {
        "start" : [ {
            token : "comment",
            regex : "//.*$"
        }, {
            token : "comment",
            regex : "@.*$"
        }, {
            token : "comment",
            start : "/\\*",
            end : "\\*/"
        }, {
            token : "string",           // " string
            regex : '".*?"'
        }, {
            token : "string",           // ' string
            regex : "'.*?'"
        }, {
            token : "constant.numeric", // float
            regex : "[+-]?\\d+(?:(?:\\.\\d*)?(?:[eE][+-]?\\d+)?)?\\b"
        }, {
            token : "text",
            regex : "~[a-zA-Z_$][a-zA-Z0-9_$]*\\b"
        }, {
            token : keywordMapper,
            regex : "[a-zA-Z_$][a-zA-Z0-9_$]*\\b"
        }, {
            token : "text",
            regex : "\\s+"
        } ]
    };
    this.normalizeRules();
};

oop.inherits(emfaticHighlightRules, TextHighlightRules);

exports.emfaticHighlightRules = emfaticHighlightRules;
});

define("ace/mode/emfatic",["require","exports","module","ace/lib/oop","ace/mode/text","ace/mode/emfatic_highlight_rules"], function(require, exports, module) {
"use strict";

var oop = require("../lib/oop");
var TextMode = require("./text").Mode;
var emfaticHighlightRules = require("./emfatic_highlight_rules").emfaticHighlightRules;

var Mode = function() {
    this.HighlightRules = emfaticHighlightRules;
    this.$behaviour = this.$defaultBehaviour;
};
oop.inherits(Mode, TextMode);

(function() {
    this.$id = "ace/mode/emfatic";
    this.snippetFileId = "ace/snippets/emfatic";
}).call(Mode.prototype);

exports.Mode = Mode;
});