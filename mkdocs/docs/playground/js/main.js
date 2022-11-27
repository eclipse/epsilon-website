import { ModelPanel } from './ModelPanel.js';
import { ConsolePanel } from "./ConsolePanel.js";
import { ProgramPanel } from "./ProgramPanel.js";
import { OutputPanel } from "./OutputPanel.js";
import { ExampleManager } from './ExampleManager.js';
import { DownloadDialog } from './DownloadDialog.js';
import { MetamodelPanel } from './MetamodelPanel.js';
import { SettingsDialog } from './SettingsDialog.js';

var language = "eol";
var outputType = "text";
var outputLanguage = "text";
var json;
var url = window.location + "";
var questionMark = url.indexOf("?");
var editors;
var backendConfig = {};

var programPanel = new ProgramPanel();
var firstMetamodelPanel = new MetamodelPanel("firstMetamodel");
var secondMetamodelPanel = new MetamodelPanel("secondMetamodel");

var firstModelPanel = new ModelPanel("firstModel", true, firstMetamodelPanel);
var secondModelPanel;
var thirdModelPanel;

var consolePanel = new ConsolePanel();
var examplesManager = new ExampleManager();
var downloadDialog = new DownloadDialog();
var settingsDialog = new SettingsDialog();

examplesManager.fetchExamples();
fetchBackendConfiguration();

var content = "";

if (questionMark > -1) {
    content = url.substring(questionMark+1, url.length);
    if (!examplesManager.hasExample(content)) {
        var xhr = new XMLHttpRequest();
        var url = backendConfig["ShortURLFunction"];
        
        xhr.open("POST", url, false);
        xhr.setRequestHeader("Content-Type", "application/json");
        var data = JSON.stringify({"shortened": content});
        xhr.send(data);
        if (xhr.status === 200) {
            content = atob(JSON.parse(xhr.responseText).content);
            json = JSON.parse(content);
            setup();
        }
    }
    else {
        json = examplesManager.fetchExample(content);
        setup();
    }
}
else {
    json = examplesManager.fetchExample(Object.keys(examples)[0]);        
    setup();
}


/**
 * Fetches the backend configuration from backend.json
 * and populates the backendConfig array
 */
function fetchBackendConfiguration() {
    var xhr = new XMLHttpRequest();
    var url = "backend.json";
    xhr.open("GET", url, false);
    xhr.send();
    if (xhr.status === 200) {    
        var json = JSON.parse(xhr.responseText);
        for (const service of json.services){
            backendConfig[service.name] = service.url;
        }
    }
}

function setup() {
    if (json.eol != null) { json.program = json.eol; language = "eol";}
    else {language = json.language};

    if (json.outputType != null) {outputType = json.outputType;}
    if (json.outputLanguage != null) {outputLanguage = json.outputLanguage;}
    
    
    var secondModelEditable = !(language == "etl" || language == "flock");

    secondModelPanel = new ModelPanel("secondModel", secondModelEditable, secondMetamodelPanel);
    thirdModelPanel = new OutputPanel("thirdModel", outputType, outputLanguage);

    if (language == "etl") {
        document.getElementById("thirdModelSplitter").remove();
    }
    else if (language == "evl" || language == "epl") {
        document.getElementById("secondModelSplitter").remove();    
    }
    else if (language == "eol" || language == "egl") {
        document.getElementById("secondModelSplitter").remove();
        if (outputType == "text" ) {
            document.getElementById("thirdModelSplitter").remove();
        }
    }

    Array.from(document.querySelectorAll('.editor')).forEach(function(e) {
        var editor = ace.edit(e);
        editor.setTheme("ace/theme/eclipse");
        editor.renderer.setShowGutter(false);
        editor.setFontSize("1rem");
        editor.setOptions({
            fontSize: "11pt",
            useSoftTabs: true
        });
    });

    editors = [programPanel.getEditor(), firstModelPanel.getEditor(), firstMetamodelPanel.getEditor(), secondModelPanel.getEditor(), secondMetamodelPanel.getEditor(), consolePanel.getEditor(), thirdModelPanel.getEditor()];

    arrangePanels();

    //TODO: Fix "undefined" when fields are empty
    programPanel.setLanguage(language);

    programPanel.setValue(json.program);
    firstModelPanel.setValue(json.flexmi);
    firstMetamodelPanel.setValue(json.emfatic);
    secondModelPanel.setValue(json.secondFlexmi);
    secondMetamodelPanel.setValue(json.secondEmfatic);

    document.getElementById("navview").style.display = "block";
    
    document.addEventListener('click', function(evt) {
        if (evt.target == document.getElementById("toggleNavViewPane")) {
            setTimeout(function(){ fit(); }, 1000);
        }
    });

    $(window).keydown(function(event) {
      if ((event.metaKey && event.keyCode == 83) || (event.ctrlKey && event.keyCode == 83)) { 
        runProgram();
        event.preventDefault(); 
      }
    });

    Metro.init();
    
}


function copyShortenedLink(event) {
    event.preventDefault();
    var content = btoa(editorsToJson());
    var xhr = new XMLHttpRequest();
    var url = backendConfig["ShortURLFunction"];
    
    xhr.open("POST", url, true);
    xhr.setRequestHeader("Content-Type", "application/json");
    xhr.onreadystatechange = function () {
        if (xhr.readyState === 4) {
            if (xhr.status === 200) {
                var json = JSON.parse(xhr.responseText);

                if (questionMark > 0) {
                    var baseUrl = (window.location+"").substring(0, questionMark);
                }
                else {
                    baseUrl = window.location;
                }
                Metro.notify.killAll();
                Metro.dialog.create({
                    title: "Share link",
                    content: "<p>The link below contains a snapshot of the contents of all the editors in the playground. Anyone who visits this link should be able to view and run your example.</p><br/> <input style='width:100%' value='" + baseUrl + "?" + json.shortened + "'>",
                    closeButton: true,
                    actions: [
                    {
                        caption: "Copy to clipboard",
                        cls: "js-dialog-close success",
                        onclick: function(){
                            copyToClipboard(baseUrl + "?" + json.shortened);
                        }
                    }]
                });
            }
            Metro.notify.killAll();
        }
    };
    var data = JSON.stringify({"content": content});
    xhr.send(data);
    longNotification("Generating short link");
    return false;
}

function copyToClipboard(str) {
    var el = document.createElement('textarea');
    el.value = str;
    document.body.appendChild(el);
    el.select();
    document.execCommand('copy');
    document.body.removeChild(el);
}

function arrangePanels() {
    if (language == "eol") {
        toggle("secondModelSplitter");
        toggle("thirdModelSplitter");
        programPanel.setTitle("Program (EOL)");
    }
    else if (language == "egl") {
        if (outputType == "dot") {
            toggle("secondModelSplitter");
            thirdModelPanel.showDiagram();
            thirdModelPanel.setTitle("Graphviz");
            thirdModelPanel.setIcon("diagram");
        }
        else if (outputType == "html") {
            toggle("secondModelSplitter");
            thirdModelPanel.showDiagram();
            thirdModelPanel.setTitle("HTML");
            thirdModelPanel.setIcon("html");
        }
        else if (outputType == "puml") {
            toggle("secondModelSplitter");
            thirdModelPanel.showDiagram();
            thirdModelPanel.setTitle("PlantUML");
            thirdModelPanel.setIcon("diagram");
        }
        else if (outputType == "code") {
            toggle("secondModelSplitter");
            $("#thirdModelDiagram").hide();
            $("#thirdModelEditor").show();
            thirdModelPanel.setTitle("Generated Text");
            thirdModelPanel.setIcon("editor");            
        }
        else {
            toggle("secondModelSplitter");
            toggle("thirdModelSplitter");
        }
        programPanel.setTitle("Template (EGL)");
    }
    else if (language == "etl" || language == "flock") {
        $("#thirdModelSplitter").hide();
        $("#secondModelDiagram").show();
        $("#secondModelEditor").hide();

        programPanel.setTitle("Transformation (ETL)");
        firstModelPanel.setTitle("Source Model");
        firstMetamodelPanel.setTitle("Source Metamodel");
        secondModelPanel.setTitle("Target Model");
        secondMetamodelPanel.setTitle("Target Metamodel");
        secondModelPanel.setIcon("diagram");
    }
    else if (language == "evl" || language == "epl") {
        toggle("secondModelSplitter");
        $("#thirdModelDiagram").show();
        if (language == "evl") {
            programPanel.setTitle("Constraints (EVL)");
            thirdModelPanel.setTitle("Problems");
            thirdModelPanel.setIcon("problems");
        }
        else {
            programPanel.setTitle("Patterns (EPL)");
            thirdModelPanel.setTitle("Pattern Matches");
            thirdModelPanel.setIcon("diagram");
        }
    }
    else if (language == "ecl") {
        // Hide nothing; we need everything
    }
    programPanel.setIcon(language);
}

export function getPanelTitle(panelId) {
    return $("#" + panelId)[0].dataset.titleCaption;
}

function editorsToJsonObject() {
    return {
        "language": language,
        "outputType": outputType,
        "outputLanguage": outputLanguage,
        "program": programPanel.getValue(), 
        "emfatic": firstMetamodelPanel.getValue(), 
        "flexmi": firstModelPanel.getValue(),
        "secondEmfatic": secondMetamodelPanel.getValue(),
        "secondFlexmi": secondModelPanel.getValue()
    };
}

function editorsToJson() {
    return JSON.stringify(editorsToJsonObject());
}

export function fit() {
    
    document.getElementById("splitter").style.minHeight = window.innerHeight + "px";
    document.getElementById("splitter").style.maxHeight = window.innerHeight + "px";

    for (const editorId of ["programEditor", "consoleEditor"]) {
        var editorElement = document.getElementById(editorId);
        if (editorElement != null) {
            editorElement.parentNode.style = "flex-basis: calc(100% - 4px);";
        }
    }

    for (const editorId of ["firstModelEditor", "firstMetamodelEditor", "secondModelEditor", "secondMetamodelEditor"]) {
        var editorElement = document.getElementById(editorId);
        if (editorElement != null) {
            editorElement.parentNode.parentNode.style = "flex-basis: calc(100% - 4px); padding: 0px";
            var parentElement = editorElement.parentElement.parentElement.parentElement;
            editorElement.style.width = parentElement.offsetWidth + "px";
            editorElement.style.height = parentElement.offsetHeight - 42 + "px";
        }
    }

    editors.forEach(e => e.resize());

    for (const diagramId of ["thirdModelDiagram"]) {
        var diagramElement = document.getElementById(diagramId);
        if (diagramElement != null) {
            var svg = diagramElement.firstElementChild;
            if (svg != null && svg.tagName == "svg") {
                diagramElement = diagramElement.parentElement.parentElement;
                svg.style.width = diagramElement.offsetWidth + "px";
                svg.style.height = diagramElement.offsetHeight - 42 + "px";
            }
        }
    }

    for (const diagramId of ["firstModelDiagram", "firstMetamodelDiagram", "secondModelDiagram", "secondMetamodelDiagram"]) {
        var diagramElement = document.getElementById(diagramId);
        if (diagramElement != null) {
            var svg = diagramElement.firstElementChild;
            if (svg != null) {
                if (svg.tagName == "svg") {
                    diagramElement = diagramElement.parentElement.parentElement.parentElement;
                    svg.style.width = diagramElement.offsetWidth + "px";
                    svg.style.height = diagramElement.offsetHeight - 42 + "px";
                }
            }
        }
    }

    // Hide the preloader div if it's still visible
    setTimeout(function(){ 
        document.getElementById("preloader").style.display = "none"; 
    }, 1000);

}

function runProgram() {
	
    var xhr = new XMLHttpRequest();
    var url = backendConfig["RunEpsilonFunction"];
    
    xhr.open("POST", url, true);
    xhr.setRequestHeader("Content-Type", "application/json");
    xhr.onreadystatechange = function () {
        if (xhr.readyState === 4) {
            if (xhr.status === 200) {
                var json = JSON.parse(xhr.responseText);

                if (json.hasOwnProperty("error")) {
                    consolePanel.setError(json.error);
                }
                else {
                    consolePanel.setOutput(json.output);
                    
                    if (language == "etl") {
                        renderDiagram("secondModelDiagram", json.targetModelDiagram);
                    }
                    else if (language == "evl") {
                        renderDiagram("thirdModelDiagram", json.validatedModelDiagram);
                    }
                    else if (language == "epl") {
                        renderDiagram("thirdModelDiagram", json.patternMatchedModelDiagram);
                    }
                    else if (language == "egl") {
                        if (outputType == "code") {
                            thirdModelPanel.getEditor().getSession().setUseWrapMode(false);
                            thirdModelPanel.getEditor().setValue(json.generatedText, 1);
                            consolePanel.setOutput(json.output);
                        }
                        else if (outputType == "html") {
                            consolePanel.setOutput(json.output);
                            var iframe = document.getElementById("htmlIframe");
                            if (iframe == null) {
                                iframe = document.createElement("iframe");
                                iframe.id = "htmlIframe"
                                iframe.style.height = "100%";
                                iframe.style.width = "100%";
                                document.getElementById("thirdModelDiagram").appendChild(iframe);
                            }
                            
                            iframe.srcdoc = json.generatedText;
                        }
                        else if (outputType == "puml" || outputType == "dot") {

                            consolePanel.setOutput(json.output);
                            var krokiEndpoint = "";
                            if (outputType == "puml") krokiEndpoint = "plantuml";
                            else krokiEndpoint = "graphviz/svg"

                            var krokiXhr = new XMLHttpRequest();
                            krokiXhr.open("POST", "https://kroki.io/" + krokiEndpoint, true);
                            krokiXhr.setRequestHeader("Accept", "image/svg+xml");
                            krokiXhr.setRequestHeader("Content-Type", "text/plain");
                            krokiXhr.onreadystatechange = function () {
                                if (krokiXhr.readyState === 4) {
                                    if (krokiXhr.status === 200) {
                                        renderDiagram("thirdModelDiagram", krokiXhr.responseText);
                                    }
                                }
                            };
                            krokiXhr.send(json.generatedText);
                        }
                        else {
                            consolePanel.setOutput(json.output + json.generatedText);
                        }
                    }
                }

            }
            Metro.notify.killAll();
        }
    };
    var data = editorsToJson();
    xhr.send(data);
    longNotification("Executing program");
}

function longNotification(title, cls="light") {
    Metro.notify.create(/*"This may take a few seconds to complete.",*/ "<b>" + title + "...</b><br>This may take a few seconds to complete if the back end is not warmed up.", null, {keepOpen: true, cls: cls, width: 300});
}

function toggle(elementId, onEmpty) {
    var element = document.getElementById(elementId);
    if (element == null) return;

    if (getComputedStyle(element).display == "none") {
        element.style.display = "flex";
        if (element.innerHTML.length == 0) {
            onEmpty();
        }
    }
    else {
        element.style.display = "none";
    }
    updateGutterVisibility();
}

function renderDiagram(diagramId, svg) {
    var diagramElement = document.getElementById(diagramId);
    diagramElement.innerHTML = svg;
    var svg = document.getElementById(diagramId).firstElementChild;

    if (diagramId == "thirdModelDiagram") {
        diagramElement.parentElement.style.padding = "0px";
    }

    svg.style.width = diagramElement.offsetWidth + "px";
    svg.style.height = diagramElement.offsetHeight + "px";

    svgPanZoom(svg, {
      zoomEnabled: true,
      fit: true,
      center: true
    });
}

function updateGutterVisibility() {
    for (const gutter of Array.prototype.slice.call(document.getElementsByClassName("gutter"))) {

        var visibleSiblings = Array.prototype.slice.call(gutter.parentNode.children).filter(
            child => child != gutter && getComputedStyle(child).display != "none");
        
        if (visibleSiblings.length > 1) {
            var nextVisibleSibling = getNextVisibleSibling(gutter);
            var previousVisibleSibling = getPreviousVisibleSibling(gutter);
            if (nextVisibleSibling != null && nextVisibleSibling.className != "gutter" && previousVisibleSibling != null) {
                gutter.style.display = "flex";
            }
            else {
                gutter.style.display = "none";
            }
        }
        else {
            gutter.style.display = "none";
        }
    }
}

function getNextVisibleSibling(element) {
    var sibling = element.nextElementSibling;
    while (sibling != null) {
        if (getComputedStyle(sibling).display != "none") return sibling;
        sibling = sibling.nextElementSibling;
    }
}

function getPreviousVisibleSibling(element) {
    var sibling = element.previousElementSibling;
    while (sibling != null) {
        if (getComputedStyle(sibling).display != "none") return sibling;
        sibling = sibling.previousElementSibling;
    }
}

function showDownloadOptions(event) {
    downloadDialog.show(event);
}

function showSettings(event) {
    settingsDialog.show(event);
}

window.fit = fit;
window.updateGutterVisibility = updateGutterVisibility;
window.runProgram = runProgram;

window.programPanel = programPanel;
window.consolePanel = consolePanel;
window.firstModelPanel = firstModelPanel;
window.secondModelPanel = secondModelPanel;
window.thirdModelPanel = thirdModelPanel;
window.firstMetamodelPanel = firstMetamodelPanel;
window.secondMetamodelPanel = secondMetamodelPanel;

window.backendConfig = backendConfig;
window.toggle = toggle;
window.renderDiagram = renderDiagram;
window.longNotification = longNotification;
window.showDownloadOptions = showDownloadOptions;
window.showSettings = showSettings;
window.copyShortenedLink = copyShortenedLink;

window.downloadDialog = downloadDialog;

// Needed by DownloadDialog
window.language = language;

// Needed by SettinsDialog
window.getPanelTitle = getPanelTitle;
window.editors = editors;