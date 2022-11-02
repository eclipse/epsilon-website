var language = "eol";
var outputType = "text";
var outputLanguage = "text";
var json;
var languageName;
var secondModelEditable;
var url = window.location + "";
var questionMark = url.indexOf("?");
var editors;
var programEditor;
var flexmiEditor;
var emfaticEditor;
var secondFlexmiEditor;
var secondEmfaticEditor;
var consoleEditor;
var backendConfig = {};
fetchBackendConfiguration();

var examples = {};
fetchExamples();

var content = "";

if (questionMark > -1) {
    content = url.substring(questionMark+1, url.length);
    if (examples[content] == null) {
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
        json = fetchExample(content);
        setup();
    }
}
else {
    json = fetchExample(Object.keys(examples)[0]);        
    setup();
}

/**
 * Fetches all the examples from examples/examples.json
 * and pupulates the examples array
 */
function fetchExamples() {
    var xhr = new XMLHttpRequest();
    var url = "examples/examples.json";
    xhr.open("GET", url, false);
    xhr.send(data);
    if (xhr.status === 200) {    
        var json = JSON.parse(xhr.responseText);
        var examplesEnd = document.getElementById("examples-end");
    
        for (const example of json.examples) {
            examples[example.id] = example;

            // Add a link for the example to the left hand side menu
            var li = document.createElement("li");
            examplesEnd.parentNode.insertBefore(li, examplesEnd);
            
            var a = document.createElement("a");
            a.href = "?" + example.id;
            li.appendChild(a);

            var icon = document.createElement("span");
            icon.classList.add("icon");
            a.appendChild(icon);

            var mif = document.createElement("span");
            mif.classList.add("mif-example-16");
            mif.classList.add("mif-" + example.language);
            icon.appendChild(mif);

            var caption = document.createElement("caption");
            caption.innerHTML = example.title;
            caption.classList.add("caption");
            a.appendChild(caption);
        }
    }

}

/**
 * Fetches the backend configuration from backend.json
 * and populates the backendConfig array
 */
function fetchBackendConfiguration() {
    var xhr = new XMLHttpRequest();
    var url = "backend.json";
    xhr.open("GET", url, false);
    xhr.send(data);
    if (xhr.status === 200) {    
        var json = JSON.parse(xhr.responseText);
        for (const service of json.services){
            backendConfig[service.name] = service.url;
        }
    }
}

/**
 * Fetches the contents of the example with the provided ID
 */ 
function fetchExample(id) {
    var example = examples[id];
    if (example.program != null) example.program = fetchFile(example.program);
    if (example.flexmi != null) example.flexmi = fetchFile(example.flexmi);
    if (example.emfatic != null) example.emfatic = fetchFile(example.emfatic);
    if (example.secondFlexmi != null) example.secondFlexmi = fetchFile(example.secondFlexmi);
    if (example.secondEmfatic != null) example.secondEmfatic = fetchFile(example.secondEmfatic);
    return example;
}

/**
 * Fetches the content of a file under the examples folder
 * This could be an Epsilon program, a Flexmi model or an Emfatic metamodel
 */
function fetchFile(name) {
    var xhr = new XMLHttpRequest();
    var url = "examples/" + name;
    xhr.open("GET", url, false);
    xhr.send(data);
    if (xhr.status === 200) {    
        return xhr.responseText;
    }
}

/**
 * Fetches the content of a file under the templates folder
 */
function fetchTemplate(name) {
    var xhr = new XMLHttpRequest();
    var url = "templates/" + name;
    xhr.open("GET", url, false);
    xhr.send(data);
    if (xhr.status === 200) {    
        return xhr.responseText;
    }
}

function setup() {
    if (json.eol != null) { json.program = json.eol; language = "eol";}
    else {language = json.language};

    if (json.outputType != null) {outputType = json.outputType;}
    if (json.outputLanguage != null) {outputLanguage = json.outputLanguage;}
    
    languageName = (language == "flock" ? "Flock" : language.toUpperCase());
    secondModelEditable = !(language == "etl" || language == "flock");

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

    programEditor = ace.edit(document.getElementById('programEditor'));
    flexmiEditor = ace.edit(document.getElementById('flexmiEditor'));
    emfaticEditor = ace.edit(document.getElementById('emfaticEditor'));
    secondFlexmiEditor = ace.edit(document.getElementById('secondFlexmiEditor'));
    secondEmfaticEditor = ace.edit(document.getElementById('secondEmfaticEditor'));
    outputEditor = ace.edit(document.getElementById('outputEditor'));
    consoleEditor = ace.edit(document.getElementById('console'));

    editors = [programEditor, flexmiEditor, emfaticEditor, secondFlexmiEditor, secondEmfaticEditor, consoleEditor, outputEditor];

    editors.forEach(e => e.setShowPrintMargin(false));

    emfaticEditor.getSession().setMode("ace/mode/emfatic");
    flexmiEditor.getSession().setMode("ace/mode/xml");

    flexmiEditor.getSession().on('change', function() {
      updateFlexmiEditorSyntaxHighlighting(flexmiEditor);
    });

    updateFlexmiEditorSyntaxHighlighting(flexmiEditor);

    secondEmfaticEditor.getSession().setMode("ace/mode/emfatic");
    secondFlexmiEditor.getSession().setMode("ace/mode/xml");
    consoleEditor.setReadOnly(true);
   
    arrangePanels();

    programPanelButtons = getProgramPanelButtons();
    $('#programPanel')[0].dataset.customButtons = "programPanelButtons";

    secondModelPanelButtons = getSecondModelPanelButtons();
    if (language == "etl") {
        $('#secondModelPanel')[0].dataset.customButtons = "secondModelPanelButtons";
    }

    thirdModelPanelButtons = getThirdModelPanelButtons();

    //TODO: Fix "undefined" when fields are empty
    programEditor.getSession().setMode("ace/mode/" + language);

    setEditorValue(programEditor, json.program);
    setEditorValue(flexmiEditor, json.flexmi);
    setEditorValue(emfaticEditor, json.emfatic);
    setEditorValue(secondFlexmiEditor, json.secondFlexmi);
    setEditorValue(secondEmfaticEditor, json.secondEmfatic);
    consoleEditor.setValue("",1);

    document.getElementById("navview").style.display = "block";
    
    document.addEventListener('click', function(evt) {
        //console.log(evt);
        //console.log(evt.target);
        //console.log(evt.target == document.getElementById("toggleNavViewPane"));

        if (evt.target == document.getElementById("toggleNavViewPane")) {
            console.log("Gotcha!");
            setTimeout(function(){ fit(); }, 1000);
        }
    });

    $(window).keydown(function(event) {
      if ((event.metaKey && event.keyCode == 83) || (event.ctrlKey && event.keyCode == 83)) { 
        runProgram();
        event.preventDefault(); 
      }
    });
}

function setEditorValue(editor, value) {
    editor.setValue((value+""), 1);
}

/**
 * Updates the syntax highlighting mode of a Flexmi
 * editor based on its content. If the content starts with
 * < then the XML flavour is assumed, otherwise, the YAML
 * flavour is assumed
 */
function updateFlexmiEditorSyntaxHighlighting(editor) {
    var val = editor.getSession().getValue();
    if ((val.trim()+"").startsWith("<")) {
        editor.getSession().setMode("ace/mode/xml");
    }
    else {
        editor.getSession().setMode("ace/mode/yaml");
    }
}

function setOutputLanguage() {

    Metro.dialog.create({
        title: "Set Generated Text Language",
        content: "<p>You can set the language of the generated text to <a href='https://github.com/ajaxorg/ace/tree/master/lib/ace/mode'>any language</a> supported by the <a href='https://ace.c9.io/'>ACE editor</a>. </p><br><input type='text' id='language' data-role='input' value='" + outputLanguage + "'>",
        actions: [
            {
                caption: "OK",
                cls: "js-dialog-close success",
                onclick: function(){
                    outputLanguage = document.getElementById("language").value;
                    setOutputEditorLanguage();
                }
            },
            {
                caption: "Cancel",
                cls: "js-dialog-close"
            }
        ]
    });
}

function setOutputEditorLanguage() {
    outputEditor.getSession().setMode("ace/mode/" + outputLanguage.toLowerCase());
}

function showDownloadOptions(event) {
    event.preventDefault();
    Metro.dialog.create({
        title: "Download",
        content: "<p>You can download this example and run it locally through Gradle or Maven. Please choose your preferred format below. </p><br/><select id='format' data-role='select'><option value='gradle'>Gradle</option><option value='maven'>Maven</option></select>",
        actions: [
           {
                caption: "Download",
                cls: "js-dialog-close success",
                onclick: function(){
                    var zip = new JSZip();
                    zip.file("program." + language, programEditor.getValue());

                    if (language != "etl") {
                        zip.file("model.flexmi", flexmiEditor.getValue());
                        zip.file("metamodel.emf", emfaticEditor.getValue());
                    }
                    else {
                        zip.file("source.flexmi", flexmiEditor.getValue());
                        zip.file("source.emf", emfaticEditor.getValue());
                        zip.file("target.emf", secondEmfaticEditor.getValue());
                    }

                    var format = document.getElementById("format").value;
                    
                    var templateData = {
                        language: language, 
                        etl: language == "etl",
                        egl: language == "egl"
                    };

                    if (format == "gradle") {
                        var template = Handlebars.compile(fetchTemplate("build.gradle"));
                        zip.file("build.gradle", template(templateData));
                        zip.file("readme.md", fetchTemplate("readme-gradle.txt"));
                    }
                    else if (format == "maven") {
                        var template = Handlebars.compile(fetchTemplate("pom.xml"));
                        zip.file("pom.xml", template(templateData));
                        zip.file("readme.md", fetchTemplate("readme-maven.txt"));
                    }

                    // var img = zip.folder("images");
                    zip.generateAsync({type:"blob"})
                    .then(function(content) {
                        var blob = new Blob([content], { type: "application/zip" });
                        var url = window.URL || window.webkitURL;
                        link = url.createObjectURL(blob);
                        var a = document.createElement("a");
                        a.setAttribute("download", "playground-example.zip");
                        a.setAttribute("href", link);
                        a.click();
                    });
                }
            },
           {
                caption: "Cancel",
                cls: "js-dialog-close"
            }
        ]
    });
}

function showSettings(event) {
    event.preventDefault();

    var panels = ["program", "console", "model", "metamodel"];

    if (language == "etl" || language == "flock") panels.push("secondModel", "secondMetamodel");
    else if (language == "evl" || language == "epl" || language == "egl") panels.push("thirdModel");

    var visibilityCheckboxes = "";

    for (const panel of panels) {
        visibilityCheckboxes += createPanelVisibilityCheckbox(panel, true) + "<br/>";
    }
    
    Metro.dialog.create({
        title: "Settings",
        content: 
        `
        <h6>Visible Panels</h6>
        `
        + visibilityCheckboxes +
        `
        `,
        actions: [
           {
                caption: "Apply",
                cls: "js-dialog-close success",
                onclick: function(){
                    for (const panel of panels) {
                        applyPanelVisibility(panel);
                    }
                    updateGutterVisibility();
                    fit();
                }
            },
           {
                caption: "Cancel",
                cls: "js-dialog-close"
            }
        ]
    });
}

function applyPanelVisibility(panel) {
    var display = "none";
    if (document.getElementById(panel + "Visible").checked) {
        display = "flex";
    }
    var parent = document.getElementById(panel + "Panel").parentNode;
    parent.style.display = display;
    
    // If all the panels in the splitter panel are hiden, hide the splitter panel too
    if (Array.prototype.slice.call(parent.parentNode.children).every(
            child => child.style.display == "none" || child.className == "gutter")) {   
            parent.parentNode.style.display = "none";
    }
    else {
        parent.parentNode.style.display = "flex";
    }
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

function getSiblings(element) {
    var siblings = [];
    var sibling = elem.parentNode.firstChild;

    while (sibling) {
        if (sibling.nodeType === 1 && sibling !== elem) {
            siblings.push(sibling);
        }
        sibling = sibling.nextSibling
    }

    return siblings;
}

function createPanelVisibilityCheckbox(panel) {

    var checked = document.getElementById(panel + "Panel").parentNode.style.display == "none" ? "" : "checked";

    return '<input type="checkbox" id="' + panel + 'Visible" data-role="checkbox" data-caption="' +  getPanelTitle(panel + "Panel")+ '" ' + checked + '>';
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

function getProgramPanelButtons() {
    return [{
        html: buttonHtml("help", languageName + " language reference"),
        cls: "sys-button",
        onclick: "window.open('https://www.eclipse.org/epsilon/doc/'+language);"
    },{
        html: buttonHtml("run", "Run the program (Ctrl/Cmd+S)"),
        cls: "sys-button",
        onclick: "runProgram()"
    }];
}

function getThirdModelPanelButtons() {
    return (outputType == "code") ? [{
        html: buttonHtml("highlight", "Set generated text language"),
        cls: "sys-button",
        onclick: "setOutputLanguage()"
    }] : [];
}

function getSecondModelPanelButtons() {
    return secondModelEditable ? [{
        html: buttonHtml("help", "Flexmi language reference"),
        cls: "sys-button",
        onclick: "window.open('https://www.eclipse.org/epsilon/doc/flexmi');"
    },{
        html: buttonHtml("refresh", "Render the model object diagram"),
        cls: "sys-button",
        onclick: "refreshSecondModelDiagram()"
    },{
        html: buttonHtml("diagram", "Show/hide the model object diagram"),
        cls: "sys-button",
        onclick: "toggle('secondModelDiagram', function(){})"
    }] : [];
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
        setPanelTitle("programPanel", "Program (EOL)");
    }
    else if (language == "egl") {
        if (outputType == "dot") {
            toggle("secondModelSplitter");
            $("#thirdModelDiagram").show();       
            setPanelTitle("thirdModelPanel", "Graphviz");
            setPanelIcon("thirdModelPanel", "diagram");
        }
        else if (outputType == "html") {
            toggle("secondModelSplitter");
            $("#thirdModelDiagram").show();
            setPanelTitle("thirdModelPanel", "HTML");
            setPanelIcon("thirdModelPanel", "html");
        }
        else if (outputType == "puml") {
            toggle("secondModelSplitter");
            $("#thirdModelDiagram").show();
            setPanelTitle("thirdModelPanel", "PlantUML");
            setPanelIcon("thirdModelPanel", "diagram");
        }
        else if (outputType == "code") {
            toggle("secondModelSplitter");
            $("#thirdModelDiagram").hide();
            $("#outputEditor").show();
            setOutputEditorLanguage();
            setPanelTitle("thirdModelPanel", "Generated Text");
            setPanelIcon("thirdModelPanel", "editor");                
        }
        else {
            toggle("secondModelSplitter");
            toggle("thirdModelSplitter");
        }
        setPanelTitle("programPanel", "Template (EGL)");
    }
    else if (language == "etl" || language == "flock") {
        $("#thirdModelSplitter").hide();
        $("#secondModelDiagram").show();
        $("#secondFlexmiEditor").hide();

        setPanelTitle("programPanel", "Transformation (ETL)");
        setPanelTitle("modelPanel", "Source Model");
        setPanelTitle("metamodelPanel", "Source Metamodel");
        setPanelTitle("secondModelPanel", "Target Model");
        setPanelTitle("secondMetamodelPanel", "Target Metamodel");
        setPanelIcon("secondModelPanel", "diagram");
    }
    else if (language == "evl" || language == "epl") {
        toggle("secondModelSplitter");
        $("#thirdModelDiagram").show();
        if (language == "evl") {
            setPanelTitle("programPanel", "Constraints (EVL)");
            setPanelTitle("thirdModelPanel", "Problems");
            setPanelIcon("thirdModelPanel", "problems");
        }
        else {
            setPanelTitle("programPanel", "Patterns (EPL)");
            setPanelTitle("thirdModelPanel", "Pattern Matches");
            setPanelIcon("thirdModelPanel", "diagram");
        }
    }
    else if (language == "ecl") {
        // Hide nothing; we need everything
    }
    setPanelIcon("programPanel", language);
}

function emptyButtons() {
    return [];
}

function setPanelTitle(panelId, title) {
    $("#" + panelId)[0].dataset.titleCaption = title;
}

function getPanelTitle(panelId) {
    return $("#" + panelId)[0].dataset.titleCaption;
}

function setPanelIcon(panelId, icon) {
    $("#" + panelId)[0].dataset.titleIcon = "<span class='mif-16 mif-" + icon + "'></span>";
}

function editorsToJsonObject() {
    return {
            "language": language,
            "outputType": outputType,
            "outputLanguage": outputLanguage,
            "program": programEditor.getValue(), 
            "emfatic": emfaticEditor.getValue(), 
            "flexmi": flexmiEditor.getValue(),
            "secondEmfatic": secondEmfaticEditor.getValue(),
            "secondFlexmi": secondFlexmiEditor.getValue()
        };
}

function editorsToJson() {
    return JSON.stringify(editorsToJsonObject());
}

function modelToJson(modelEditor, metamodelEditor) {
    return JSON.stringify(
        {
            "flexmi": modelEditor.getValue(), 
            "emfatic": metamodelEditor.getValue()
        }
    );
}

function fit() {

    document.getElementById("splitter").style.minHeight = window.innerHeight + "px";
    document.getElementById("splitter").style.maxHeight = window.innerHeight + "px";

    for (const editorId of ["programEditor", "console"]) {
        var editorElement = document.getElementById(editorId);
        if (editorElement != null) {
            editorElement.parentNode.style = "flex-basis: calc(100% - 4px);";
        }
    }

    for (const editorId of ["flexmiEditor", "emfaticEditor", "secondFlexmiEditor", "secondEmfaticEditor"]) {
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

    for (const diagramId of ["modelDiagram", "metamodelDiagram", "secondModelDiagram", "secondMetamodelDiagram"]) {
        var diagramElement = document.getElementById(diagramId);
        if (diagramElement != null) {
            var svg = diagramElement.firstElementChild;
            if (svg != null) {
                console.log(svg);
                if (svg.tagName == "svg") {
                    diagramElement = diagramElement.parentElement.parentElement.parentElement;
                    svg.style.width = diagramElement.offsetWidth + "px";
                    svg.style.height = diagramElement.offsetHeight - 42 + "px";
                }
            }
        }
    }

}

function setConsoleOutput(str) {
    document.getElementById("console").style.color = "black";
    consoleEditor.getSession().setUseWrapMode(false);
    consoleEditor.setValue(str, 1);
}

function setConsoleError(str) {
    document.getElementById("console").style.color = "#CD352C";
    consoleEditor.getSession().setUseWrapMode(true);
    consoleEditor.setValue(str, 1);
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
                    setConsoleError(json.error);
                }
                else {
                    setConsoleOutput(json.output);
                    
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
                            outputEditor.getSession().setUseWrapMode(false);
                            outputEditor.setValue(json.generatedText, 1);
                            setConsoleOutput(json.output);
                        }
                        else if (outputType == "html") {
                            setConsoleOutput(json.output);
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

                            setConsoleOutput(json.output);
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
                            setConsoleOutput(json.output + json.generatedText);
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

function refreshModelDiagram() {
    refreshDiagram(backendConfig["FlexmiToPlantUMLFunction"], "modelDiagram", "model", flexmiEditor, emfaticEditor);
}

function refreshMetamodelDiagram() {
    refreshDiagram(backendConfig["EmfaticToPlantUMLFunction"], "metamodelDiagram", "metamodel", flexmiEditor, emfaticEditor);
}

function refreshSecondModelDiagram() {
    refreshDiagram(backendConfig["FlexmiToPlantUMLFunction"], "secondModelDiagram", "model", secondFlexmiEditor, secondEmfaticEditor);
}

function refreshSecondMetamodelDiagram() {
    refreshDiagram(backendConfig["EmfaticToPlantUMLFunction"], "secondMetamodelDiagram", "metamodel", secondFlexmiEditor, secondEmfaticEditor);
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

function refreshDiagram(url, diagramId, diagramName, modelEditor, metamodelEditor) {
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
                    setConsoleError(json.error);
                }
                else {
                    renderDiagram(diagramId, json[jsonField]);
                }

                Metro.notify.killAll();
            }
        }
    };
    var data = modelToJson(modelEditor, metamodelEditor);
    xhr.send(data);
    longNotification("Rendering " + diagramName + " diagram");
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