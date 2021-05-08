define("ace/mode/egl_highlight_rules",["require","exports","module","ace/lib/oop","ace/mode/text_highlight_rules"], function(require, exports, module) {
"use strict";

var oop = require("../lib/oop");
var TextHighlightRules = require("./text_highlight_rules").TextHighlightRules;

var EglHighlightRules = function() {

    var keywords = (
        "not|delete|import|for|while|in|and|or|operation|return|var|throw|if|new|else|transaction|abort|break|continue|assert|assertError|not|function|default|switch|case|as|ext|driver|alias|model|breakAll|async|group|nor|xor|implies"
    );

    var builtinConstants = (
        "true|false|self"
    );

    var builtinFunctions = (
        ""
    );

    var dataTypes = (
        "Any|String|Integer|Real|Boolean|Native|Bag|Set|List|Sequence|Map|OrderedSet|Collection|Tuple|ConcurrentBag|ConcurrentMap|ConcurrentSet"
    );

    var keywordMapper = this.createKeywordMapper({
        "support.function": builtinFunctions,
        "keyword": keywords,
        "constant.language": builtinConstants,
        "storage.type": dataTypes
    }, "identifier", true);

   this.$rules = {
        "start" : [
            {
                token:  "text",
                regex:  "\\[%",
                next:   "dynamic"
            },
            {
                token:  "comment",
                regex:  "\\[\\*",
                next:   "comment"
            },
            {
                token:  "string",
                regex:  "."
            }
        ],
        "comment" : [
            {
                token:  "comment",
                regex:  "\\*\\]",
                next:   "start"
            },
            {
                token:  "comment",
                regex:  "."
            }
        ],
        "dynamic" : [
        {
            token : "comment",
            regex : "//.*$"
        },  
        {
            token : "comment",
            start : "/\\*",
            end : "\\*/"
        }, 
        {
            token : "string",           // " string
            regex : '".*?"'
        }, 
        {
            token : "string",           // ' string
            regex : "'.*?'"
        }, 
        {
            token : "string",           // ` string (apache drill)
            regex : "`.*?`"
        }, 
        {
            token : "constant.numeric", // float
            regex : "[+-]?\\d+(?:(?:\\.\\d*)?(?:[eE][+-]?\\d+)?)?\\b"
        }, 
        {
            token : keywordMapper,
            regex : "[a-zA-Z_$][a-zA-Z0-9_$]*\\b"
        }, 
        {
            token : "text",
            regex : "\\s+"
        },
        {
            token:  "text",
            regex:  "%\\]",
            next:   "start"
        }]
    };
};

oop.inherits(EglHighlightRules, TextHighlightRules);

exports.EglHighlightRules = EglHighlightRules;

});

define("ace/mode/egl",["require","exports","module","ace/lib/oop","ace/mode/text","ace/tokenizer","ace/mode/egl_highlight_rules"], function(require, exports, module) {
"use strict";

var oop = require("../lib/oop");
var TextMode = require("./text").Mode;
var EglHighlightRules = require("./egl_highlight_rules").EglHighlightRules;

var Mode = function() {
    this.HighlightRules = EglHighlightRules;
    this.$behaviour = this.$defaultBehaviour;
};
oop.inherits(Mode, TextMode);

exports.Mode = Mode;
});