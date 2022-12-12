import { backend } from "./Playground.js";

class ExampleManager {

    exampleId;
    visibleExamples = 15;
    examplesUrl = new URL("examples/examples.json", document.baseURI).href;
    customExamplesUrl = false;
    examples = {};

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
        if (!this.exampleId) this.exampleId = this.getFirstExample();
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
            var more = document.getElementById("more");
            
            // If we have fewer examples than we can display, we don't need the More menu
            if (json.examples.length <= this.visibleExamples) more.style.display = "none";

            var i = 0;
            for (const example of json.examples) {
                this.examples[example.id] = example;

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

                if (i<this.visibleExamples) {
                    more.parentNode.insertBefore(li, more);
                }
                else {
                    var moreMenu = document.getElementById("moreMenu");
                    moreMenu.appendChild(li);
                }
                i++;
            }
        }
    }

    getSelectedExample() {
        return this.fetchExample(this.exampleId);
    }

    hasExample(id) {
       return this.examples[id] != null;
    }

    getFirstExample() {
        return Object.keys(this.examples)[0];
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