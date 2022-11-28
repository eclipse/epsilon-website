class ExampleManager {
    examples = {};

    /**
     * Fetches all the examples from examples/examples.json
     * and pupulates the examples array
     */
    fetchExamples() {
        var xhr = new XMLHttpRequest();
        var url = "examples/examples.json";
        xhr.open("GET", url, false);
        xhr.send();
        if (xhr.status === 200) {    
            var json = JSON.parse(xhr.responseText);
            var examplesEnd = document.getElementById("examples-end");
        
            for (const example of json.examples) {
                this.examples[example.id] = example;

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

    hasExample(id) {
       return this.examples[id] != null;
    }

    /**
     * Fetches the contents of the example with the provided ID
     */ 
    fetchExample(id) {
        var example = this.examples[id];
        if (example.program != null) example.program = this.fetchFile(example.program);
        if (example.flexmi != null) example.flexmi = this.fetchFile(example.flexmi);
        if (example.emfatic != null) example.emfatic = this.fetchFile(example.emfatic);
        if (example.secondFlexmi != null) example.secondFlexmi = this.fetchFile(example.secondFlexmi);
        if (example.secondEmfatic != null) example.secondEmfatic = this.fetchFile(example.secondEmfatic);
        return example;
    }

    /**
     * Fetches the content of a file under the examples folder
     * This could be an Epsilon program, a Flexmi model or an Emfatic metamodel
     */
    fetchFile(name) {
        var xhr = new XMLHttpRequest();
        var url = "examples/" + name;
        xhr.open("GET", url, false);
        xhr.send();
        if (xhr.status === 200) {    
            return xhr.responseText;
        }
    }
}

export {ExampleManager};