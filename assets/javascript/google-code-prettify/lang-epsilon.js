// Copyright (C) 2010 Google Inc.
//
// Licensed under the Apache License, Version 2.0 (the "License");
// you may not use this file except in compliance with the License.
// You may obtain a copy of the License at
//
//      http://www.apache.org/licenses/LICENSE-2.0
//
// Unless required by applicable law or agreed to in writing, software
// distributed under the License is distributed on an "AS IS" BASIS,
// WITHOUT WARRANTIES OR CONDITIONS OF ANY KIND, either express or implied.
// See the License for the specific language governing permissions and
// limitations under the License.


/**
 * @fileoverview
 * Registers language handlers for Epsilon.
 *
 *
 * @author dkolovos@cs.york.ac.uk based on work from mikesamuel@gmail.com
 */

registerEpsilonLanguageHandler("eol", "");
registerEpsilonLanguageHandler("eunit", "");
registerEpsilonLanguageHandler("egl", "");

var erlKeywords = "pre|post|guard|extends";
var etlKeywords = erlKeywords + "|transform|rule|to";
var egxKeywords = erlKeywords + "|rule|transform|target|parameters|template|overwrite|merge|formatter";

registerEpsilonLanguageHandler("etl", etlKeywords);
registerEpsilonLanguageHandler("egx", egxKeywords);
registerEpsilonLanguageHandler("evl", erlKeywords + "|context|constraint|critique|check|do|message|title|fix|guard");
registerEpsilonLanguageHandler("eml", etlKeywords + "|with|merge|into");
registerEpsilonLanguageHandler("ecl", erlKeywords + "|rule|compare|match|with");
registerEpsilonLanguageHandler("mig", erlKeywords + "|migrate|to|ignoring|retype|delete|when");
registerEpsilonLanguageHandler("epl", erlKeywords + "|match|onmatch|nomatch|pattern|do|from");

pinsetKeywords = "|dataset|over|from|column|properties|reference|grid|keys|header|body";
registerEpsilonLanguageHandler("pinset", erlKeywords + pinsetKeywords);


function registerEpsilonLanguageHandler(language, keywords) {
if (keywords.length > 0) keywords = "|" + keywords;

PR['registerLangHandler'](
    PR['createSimpleLexer'](
        [
         // Whitespace
         //[PR['PR_PLAIN'],       /^[\t\n\r \xA0]+/, null, '\t\n\r \xA0'],
         // A double or single quoted string
          // or a triple double-quoted multi-line string.
         [PR['PR_STRING'],
          /^(?:"(?:(?:""(?:""?(?!")|[^\\"]|\\.)*"{0,3})|(?:[^"\r\n\\]|\\.)*"?))/,
          null, '"'],
         [PR['PR_LITERAL'],     /^`(?:[^\r\n\\`]|\\.)*`?/, null, '`'],
         [PR['PR_PUNCTUATION'], /^[!#%&()*+,\-:;<=>?\[\\\]^{|}~]+/, null,
          '!#%&()*+,-:;<=>?[\\]^{|}~']
        ],
        [
         // A symbol literal is a single quote followed by an identifier with no
         // single quote following
         // A character literal has single quotes on either side
         [PR['PR_STRING'],      /^'(?:[^\r\n\\']|\\(?:'|[^\r\n']+))'/],
         [PR['PR_LITERAL'],     /^'[a-zA-Z_$][\w$]*(?!['$\w])/],
         [PR['PR_KEYWORD'],     new RegExp("^(?:not|delete|import|for|while|in|and|or|operation|return|var|throw|if|new|else|transaction|abort|break|continue|assert|assertError|not|function|default|switch|case|as|ext|driver|alias|model|breakAll|async|group|nor|xor|implies" + keywords + ")\\b")],
         [PR['PR_LITERAL'],     /^(?:true|false|null|this)\b/],
         [PR['PR_DECLARATION'],     /^(?:self)\b/],
         [PR['PR_LITERAL'],     /^(?:(?:0(?:[0-7]+|X[0-9A-F]+))L?|(?:(?:0|[1-9][0-9]*)(?:(?:\.[0-9]+)?(?:E[+\-]?[0-9]+)?F?|L?|l?|f))|\\.[0-9]+(?:E[+\-]?[0-9]+)?F?)/i],
         // Treat upper camel case identifiers as types.
         // [PR['PR_TYPE'],        /^[$_]*[A-Z][_$A-Z0-9]*[a-z][\w$]*/],
         [PR['PR_COMMENT'],     /^\/(?:\/.*|\*(?:\/|\**[^*/])*(?:\*+\/?)?)/],
         [PR['PR_PUNCTUATION'], /^(?:\.+|\/)/],
         [PR['PR_TYPE'], new RegExp("^(?:Any|String|Integer|Real|Boolean|Native|Bag|Set|List|Sequence|Map|OrderedSet|Collection|Tuple|ConcurrentBag|ConcurrentMap|ConcurrentSet)\\b")],
        [PR['PR_TAG'],      /^(?:(@|\$)\w+)/],
        [PR['PR_PLAIN'],       /^[$a-zA-Z_][\w$]*/],

        ]),
    [language]);
}
