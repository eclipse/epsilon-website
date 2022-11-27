class Panel {

    id;
    editor;

    constructor(id) {
        this.id = id;
        this.editor = ace.edit(document.getElementById(this.id + 'Editor'));
        this.editor.setShowPrintMargin(false);
    }

    setTitle(title) {
        $("#" + this.id + "Panel")[0].dataset.titleCaption = title;
    }

    setIcon(icon) {
        $("#" + this.id + "Panel")[0].dataset.titleIcon = "<span class='mif-16 mif-" + icon + "'></span>";
    }

    getEditor() {
        return this.editor;
    }

    getValue() {
        return this.editor.getValue();
    }

    setValue(value) {
        this.editor.setValue((value+""), 1);
    }

    buttonHtml(icon, hint) {
        return "<span class='mif-" + icon + "' data-role='hint' data-hint-text='" + hint + "' data-hint-position='bottom'></span>";
    }
}

class ProgramPanel extends Panel {

    constructor() {
        super("program");
    }

    setLanguage(language) {
        this.editor.getSession().setMode("ace/mode/" + language);
        $('#programPanel')[0].dataset.customButtons = JSON.stringify(this.getButtons(language));
    }

    getButtons(language) {
        var languageName = (language == "flock" ? "Flock" : language.toUpperCase());
        return [{
            html: this.buttonHtml("help", languageName + " language reference"),
            cls: "sys-button",
            onclick: "window.open('https://www.eclipse.org/epsilon/doc/'+language);"
        },{
            html: this.buttonHtml("run", "Run the program (Ctrl/Cmd+S)"),
            cls: "sys-button",
            onclick: "runProgram()"
        }];
    }
}

class ConsolePanel extends Panel {

    constructor() {
        super("console");
        this.editor.setReadOnly(true);
        this.editor.setValue("",1);
        $('#consolePanel')[0].dataset.customButtons = JSON.stringify(this.getButtons()); 
        //TODO: Fix exception thrown when this is enabled
        //this.detectHyperlinks(this.editor);        
    }

    getButtons() {
        return [{
            html: this.buttonHtml("clear", "Clear the console"),
            cls: "sys-button",
            onclick: "consolePanel.setValue('')"
        }];
    }

    setOutput(str) {
        document.getElementById("consoleEditor").style.color = "black";
        this.editor.getSession().setUseWrapMode(false);
        this.editor.setValue(str, 1);

    }
    
    setError(str) {
        document.getElementById("consoleEditor").style.color = "#CD352C";
        this.editor.getSession().setUseWrapMode(true);
        this.editor.setValue(str, 1);
    }

    detectHyperlinks(editor) {

        var locationRegexp = /\(((.+?)@(\d+):(\d+)-(\d+):(\d+))\)/i;
    
        define("hoverlink", [], function(require, exports, module) {
            "use strict";
            
            var oop = require("ace/lib/oop");
            var event = require("ace/lib/event");
            var Range = require("ace/range").Range;
            var EventEmitter = require("ace/lib/event_emitter").EventEmitter;
            
            var HoverLink = function(editor) {
                if (editor.hoverLink)
                    return;
                editor.hoverLink = this;
                this.editor = editor;
            
                this.update = this.update.bind(this);
                this.onMouseMove = this.onMouseMove.bind(this);
                this.onMouseOut = this.onMouseOut.bind(this);
                this.onClick = this.onClick.bind(this);
                event.addListener(editor.renderer.scroller, "mousemove", this.onMouseMove);
                event.addListener(editor.renderer.content, "mouseout", this.onMouseOut);
                event.addListener(editor.renderer.content, "click", this.onClick);
            };
            
            (function(){
                oop.implement(this, EventEmitter);
                
                this.token = {};
                this.range = new Range();
            
                this.update = function() {
                    this.$timer = null;
                    var editor = this.editor;
                    var renderer = editor.renderer;
                    
                    var canvasPos = renderer.scroller.getBoundingClientRect();
                    var offset = (this.x + renderer.scrollLeft - canvasPos.left - renderer.$padding) / renderer.characterWidth;
                    var row = Math.floor((this.y + renderer.scrollTop - canvasPos.top) / renderer.lineHeight);
                    var col = Math.round(offset);
            
                    var screenPos = {row: row, column: col, side: offset - col > 0 ? 1 : -1};
                    var session = editor.session;
                    var docPos = session.screenToDocumentPosition(screenPos.row, screenPos.column);
                    
                    var selectionRange = editor.selection.getRange();
                    if (!selectionRange.isEmpty()) {
                        if (selectionRange.start.row <= row && selectionRange.end.row >= row)
                            return this.clear();
                    }
                    
                    var line = editor.session.getLine(docPos.row);
                    if (docPos.column == line.length) {
                        var clippedPos = editor.session.documentToScreenPosition(docPos.row, docPos.column);
                        if (clippedPos.column != screenPos.column) {
                            return this.clear();
                        }
                    }
                    
                    var token = this.findLink(docPos.row, docPos.column);
                    this.link = token;
                    if (!token) {
                        return this.clear();
                    }
                    this.isOpen = true
                    editor.renderer.setCursorStyle("pointer");
                    
                    session.removeMarker(this.marker);
                    
                    this.range =  new Range(token.row, token.start, token.row, token.start + token.value.length);
                    this.marker = session.addMarker(this.range, "ace_link_marker", "text", true);
                };
                
                this.clear = function() {
                    if (this.isOpen) {
                        this.editor.session.removeMarker(this.marker);
                        this.editor.renderer.setCursorStyle("");
                        this.isOpen = false;
                    }
                };
                
                this.getMatchAround = function(regExp, string, col) {
                    var match;
                    regExp.lastIndex = 0;
                    string.replace(regExp, function(str) {
                        var offset = arguments[arguments.length-2];
                        var length = str.length;
                        if (offset <= col && offset + length >= col)
                            match = {
                                start: offset,
                                value: str
                            };
                    });
                
                    return match;
                };
                
                this.onClick = function() {
                    if (this.link) {
                        this.link.editor = this.editor;
                        this._signal("open", this.link);
                        this.clear()
                    }
                };
                
                this.findLink = function(row, column) {
                    var editor = this.editor;
                    var session = editor.session;
                    var line = session.getLine(row);
                    
                    var match = this.getMatchAround(locationRegexp, line, column);
                    if (!match)
                        return;
                    
                    match.row = row;
                    return match;
                };
                
                this.onMouseMove = function(e) {
                    if (this.editor.$mouseHandler.isMousePressed) {
                        if (!this.editor.selection.isEmpty())
                            this.clear();
                        return;
                    }
                    this.x = e.clientX;
                    this.y = e.clientY;
                    this.update();
                };
            
                this.onMouseOut = function(e) {
                    this.clear();
                };
            
                this.destroy = function() {
                    this.onMouseOut();
                    event.removeListener(this.editor.renderer.scroller, "mousemove", this.onMouseMove);
                    event.removeListener(this.editor.renderer.content, "mouseout", this.onMouseOut);
                    delete this.editor.hoverLink;
                };
            
            }).call(HoverLink.prototype);
            
            exports.HoverLink = HoverLink;
            
            });
            
            HoverLink = require("hoverlink").HoverLink
            editor.hoverLink = new HoverLink(editor);
            editor.hoverLink.on("open", function(e) {
                var location = e.value;
                if (editor.getValue().indexOf(location) > -1) {
                    var matches = location.match(locationRegexp);
                    var Range = require("ace/range").Range;
                    programPanel.getEditor().selection.setRange(new Range(
                        parseInt(matches[3])-1, parseInt(matches[4]), 
                        parseInt(matches[5])-1, parseInt(matches[6])));
                }
            })
    }
}

class ModelPanel extends Panel {

    editable;
    metamodelPanel;

    constructor(id, editable, metamodelPanel) {
        super(id);
        this.editable = editable;
        this.metamodelPanel = metamodelPanel;
        this.setupSyntaxHighlighting();
        $('#' + id + 'Panel')[0].dataset.customButtons = JSON.stringify(this.getButtons());        
    }

    showDiagram() {
        $("#" + this.id + "Diagram").show();
    }

    refreshDiagram() {
        this.refreshDiagramImpl(backendConfig["FlexmiToPlantUMLFunction"], this.id + "Diagram", "model", this.getEditor(), this.metamodelPanel.getEditor());
    }

    setupSyntaxHighlighting() {
        this.editor.getSession().setMode("ace/mode/xml");
        this.updateSyntaxHighlighting();
        var self = this;
        this.editor.getSession().on('change', function() {
            self.updateSyntaxHighlighting();
        });
    }

    /**
     * Updates the syntax highlighting mode of a Flexmi
     * editor based on its content. If the content starts with
     * < then the XML flavour is assumed, otherwise, the YAML
     * flavour is assumed
     */
    updateSyntaxHighlighting() {
        var val = this.editor.getSession().getValue();
        if ((val.trim()+"").startsWith("<")) {
            this.editor.getSession().setMode("ace/mode/xml");
        }
        else {
            this.editor.getSession().setMode("ace/mode/yaml");
        }
    }

    getButtons() {
        return this.editable ? [{
            html: this.buttonHtml("help", "Flexmi language reference"),
            cls: "sys-button",
            onclick: "window.open('https://www.eclipse.org/epsilon/doc/flexmi');"
        },{
            html: this.buttonHtml("refresh", "Render the model object diagram"),
            cls: "sys-button",
            onclick: this.id + "Panel.refreshDiagram()"
        },{
            html: this.buttonHtml("diagram", "Show/hide the model object diagram"),
            cls: "sys-button",
            onclick: "toggle('" + this.id + "Diagram', function(){" + this.id + "Panel.refreshDiagram();})"
        }] : [];
    }

    /* TODO: Rename to something more sensible */
    refreshDiagramImpl(url, diagramId, diagramName, modelEditor, metamodelEditor) {
        var xhr = new XMLHttpRequest();
        xhr.open("POST", url, true);
        xhr.setRequestHeader("Content-Type", "application/json");
        xhr.onreadystatechange = function () {
            if (xhr.readyState === 4) {
                if (xhr.status === 200) {
                    var json = JSON.parse(xhr.responseText);
                    var t = d3.transition().ease(d3.easeLinear);
                    
                    // FIXME: Make both functions return the PlantUML diagram in a "diagram" field
                    var jsonField = "modelDiagram";
                    if (diagramId.endsWith("etamodelDiagram")) jsonField = "metamodelDiagram";
                    
                    if (json.hasOwnProperty("error")) {
                        consolePanel.setError(json.error);
                    }
                    else {
                        renderDiagram(diagramId, json[jsonField]);
                    }
    
                    Metro.notify.killAll();
                }
            }
        };
        var data = this.modelToJson(modelEditor, metamodelEditor);
        xhr.send(data);
        longNotification("Rendering " + diagramName + " diagram");
    }

    modelToJson(modelEditor, metamodelEditor) {
        return JSON.stringify(
            {
                "flexmi": modelEditor != null ? modelEditor.getValue() : "", 
                "emfatic": metamodelEditor != null ? metamodelEditor.getValue() : ""
            }
        );
    }
}

// TODO
class OutputPanel extends ModelPanel {

    type;
    language;

    constructor(id, type, language) {
        super(id, false, null);
        this.type = type;
        this.language = language;
        $('#' + id + 'Panel')[0].dataset.customButtons = JSON.stringify(this.getButtons());
        console.log("Output panel editor " + this.getEditor());
        this.getEditor().getSession().setMode("ace/mode/" + language.toLowerCase());
    }

    setupSyntaxHighlighting() {
        console.log("Setting syntax highlighting of output panel");
    }

    getButtons() {
        return (this.type == "code") ? [{
            html: this.buttonHtml("highlight", "Set generated text language"),
            cls: "sys-button",
            onclick: this.id + "Panel.setOutputLanguage()"
        }] : [];
    }

    setOutputLanguage() {
        var self = this;
        Metro.dialog.create({
            title: "Set Generated Text Language",
            content: "<p>You can set the language of the generated text to <a href='https://github.com/ajaxorg/ace/tree/master/lib/ace/mode'>any language</a> supported by the <a href='https://ace.c9.io/'>ACE editor</a>. </p><br><input type='text' id='language' data-role='input' value='" + self.language + "'>",
            actions: [
                {
                    caption: "OK",
                    cls: "js-dialog-close success",
                    onclick: function(){
                        var outputLanguage = document.getElementById("language").value;
                        self.getEditor().getSession().setMode("ace/mode/" + outputLanguage.toLowerCase());
                    }
                },
                {
                    caption: "Cancel",
                    cls: "js-dialog-close"
                }
            ]
        });
    }
}

class MetamodelPanel extends ModelPanel {
    constructor(id) {
        super(id, true, null);
        $('#' + id + 'Panel')[0].dataset.customButtons = JSON.stringify(this.getButtons());
    }

    setupSyntaxHighlighting() {
        this.editor.getSession().setMode("ace/mode/emfatic");
    }

    getButtons() {
        return [{
            html: this.buttonHtml("help", "Emfatic language reference"),
            cls: "sys-button",
            onclick: "window.open('https://www.eclipse.org/epsilon/doc/articles/playground/#emfatic-metamodels-in-the-playground');"
        },{
            html: this.buttonHtml("refresh", "Render the metamodel class diagram"),
            cls: "sys-button",
            onclick: this.id + "Panel.refreshDiagram()"
        },{
            html: this.buttonHtml("diagram", "Show/hide the metamodel class diagram"),
            cls: "sys-button",
            onclick: "toggle('" + this.id + "Diagram', function(){" + this.id + "Panel.refreshDiagram();})"
        }];
    }
    
    refreshDiagram() {
        this.refreshDiagramImpl(backendConfig["EmfaticToPlantUMLFunction"], this.id + "Diagram", "metamodel", null, this.getEditor());
    }

}

export {Panel, ModelPanel, MetamodelPanel, ConsolePanel, ProgramPanel, OutputPanel};