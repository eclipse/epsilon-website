import { backend } from "./Playground.js";

class ExampleManager {

    exampleId;
    visibleExamples = 15;
    examplesUrl = new URL("examples/examples.json", document.baseURI).href;
    customExamplesUrl = false;
    examples = {};
    activeSubMenu;

    constructor() {
        var parameters = new URLSearchParams(window.location.search);
        if (parameters.has("examples")) {
            this.customExamplesUrl = true;
            this.examplesUrl = parameters.get("examples");
        }

        var parameterKeys = Array.from(parameters.keys());

        for (const key of parameterKeys) {
            if (!parameters.get(key)) {
                this.exampleId = key;
                break;
            }
        }

        this.fetchExamples();
    }

    /**
     * Fetches all the examples from examplesUrl
     * and pupulates the examples array
     */
    fetchExamples() {
        var xhr = new XMLHttpRequest();
        xhr.open("GET", this.examplesUrl, false);
        xhr.send();
        if (xhr.status === 200) {    
            var json = JSON.parse(xhr.responseText);
            for (const example of json.examples) {

                if (example.id) {
                    this.storeExample(example);
                    this.createExampleMenuEntry(null, example);
                }
                else {
                    var active = false;
                    for (const nestedExample of example.examples) {
                        this.storeExample(nestedExample);
                        if (nestedExample.id == this.exampleId) {
                            active = true;
                        }
                    }

                    var subMenu = this.createExamplesSubMenu(example.title, active);

                    for (const nestedExample of example.examples) {
                        this.createExampleMenuEntry(subMenu, nestedExample);
                    }
                }
            }
        }
    }

    subMenuNumber = 0;

    createExamplesSubMenu(title, active = false) {
        this.subMenuNumber ++;

        var li = document.createElement("li");
        if (active) {
            li.setAttribute("class", "active-container");
        }


        this.appendTopLevelExampleMenuItem(li);
        var a = document.createElement("a");
        if (active) a.setAttribute("id", "activeExamplesSubMenu");
        a.setAttribute("class", "dropdown-toggle");
        
        a.setAttribute("href", "#");
        li.appendChild(a);

        var icon = document.createElement("span");
        icon.setAttribute("class", "icon");
        a.appendChild(icon);
        
        var mif = document.createElement("span");
        mif.setAttribute("class", "mif-folder");
        icon.appendChild(mif);

        var caption = document.createElement("span");
        caption.setAttribute("class", "caption");
        caption.innerText = title;
        a.appendChild(caption);

        var menu = document.createElement("ul");
        menu.setAttribute("class", "navview-menu stay-open");
        menu.setAttribute("data-role", "dropdown");
        li.appendChild(menu);

        return menu;
    }

    openActiveExamplesSubMenu() {
        document.getElementById("activeExamplesSubMenu")?.click();
    }

    createExampleMenuEntry(parent, example) {  

        // Add a link for the example to the left hand side menu
        var li = document.createElement("li");
                
        var a = document.createElement("a");
        a.href = "?" + example.id;
        if (this.customExamplesUrl) {
            a.href += "&examples=" + this.examplesUrl;
        }
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

        if (parent) {
            parent.appendChild(li);
        }
        else {
            this.appendTopLevelExampleMenuItem(li);
        }
    }

    appendTopLevelExampleMenuItem(element) {
        var examplesEnd = document.getElementById("examplesEnd");
        examplesEnd.parentNode.insertBefore(element, examplesEnd);
    }

    storeExample(example) {
        if (!this.exampleId) this.exampleId = example.id;
        this.examples[example.id] = example;
    }

    getSelectedExample() {
        return this.fetchExample(this.exampleId);
    }

    hasExample(id) {
       return this.examples[id] != null;
    }

    getExampleId() {
        return this.exampleId;
    }

    /**
     * Fetches the contents of the example with the provided ID
     */ 
    fetchExample(id) {
        if (!this.hasExample(id)) {
            var xhr = new XMLHttpRequest();
            
            xhr.open("POST", backend.getShortURLService(), false);
            xhr.setRequestHeader("Content-Type", "application/json");
            var data = JSON.stringify({"shortened": id});
            xhr.send(data);
            if (xhr.status === 200) {
                try {
                    var content = atob(JSON.parse(xhr.responseText).content);
                    return JSON.parse(content);
                }
                catch (err) {
                    console.log("Fetching example " + id + " failed");
                    // Ignore the error and return a default example later on
                }
            }
        }
        else {
            var example = this.examples[id];
            if (example.program != null) example.program = this.fetchFile(example.program);
            if (example.secondProgram != null) example.secondProgram = this.fetchFile(example.secondProgram);
            if (example.flexmi != null) example.flexmi = this.fetchFile(example.flexmi);
            if (example.emfatic != null) example.emfatic = this.fetchFile(example.emfatic);
            if (example.secondFlexmi != null) example.secondFlexmi = this.fetchFile(example.secondFlexmi);
            if (example.secondEmfatic != null) example.secondEmfatic = this.fetchFile(example.secondEmfatic);
            return example;
        }

        // If we are here it means that such an example has not been found
        var example = {};
        example.language = "eol";
        example.program = "// Example " + id + " has not been found";
        example.secondProgram = "";
        example.flexmi = "";
        example.secondFlexmi = "";
        example.emfatic = "";
        example.secondEmfatic = "";
        return example;
    }

    /**
     * Fetches the content of a file under the examples folder
     * This could be an Epsilon program, a Flexmi model or an Emfatic metamodel
     */
    fetchFile(name) {
        var xhr = new XMLHttpRequest();
        var url = new URL(name, this.examplesUrl).href;
        xhr.open("GET", url, false);
        xhr.send();
        if (xhr.status === 200) {    
            return xhr.responseText;
        }
    }
}

export {ExampleManager};