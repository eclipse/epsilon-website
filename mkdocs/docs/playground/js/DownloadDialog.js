class DownloadDialog {
    show(event) {
        event.preventDefault();
        var self = this;
        Metro.dialog.create({
            title: "Download",
            content: "<p>You can download this example and run it locally through Gradle or Maven. Please choose your preferred format below. </p><br/><select id='format' data-role='select'><option value='gradle'>Gradle</option><option value='maven'>Maven</option></select>",
            actions: [
               {
                    caption: "Download",
                    cls: "js-dialog-close success",
                    onclick: function(){
                        var zip = new JSZip();
                        zip.file("program." + language, programPanel.getEditor().getValue());
    
                        if (language != "etl") {
                            zip.file("model.flexmi", firstModelPanel.getValue());
                            zip.file("metamodel.emf", firstMetamodelPanel.getValue());
                        }
                        else {
                            zip.file("source.flexmi", firstModelPanel.getValue());
                            zip.file("source.emf", firstMetamodelPanel.getValue());
                            zip.file("target.emf", secondMetamodelPanel.getValue());
                        }
    
                        var format = document.getElementById("format").value;
                        
                        var templateData = {
                            language: language, 
                            etl: language == "etl",
                            egl: language == "egl"
                        };
    
                        if (format == "gradle") {
                            var template = Handlebars.compile(self.fetchTemplate("build.gradle"));
                            zip.file("build.gradle", template(templateData));
                            zip.file("readme.md", self.fetchTemplate("readme-gradle.txt"));
                        }
                        else if (format == "maven") {
                            var template = Handlebars.compile(self.fetchTemplate("pom.xml"));
                            zip.file("pom.xml", template(templateData));
                            zip.file("readme.md", self.fetchTemplate("readme-maven.txt"));
                        }
    
                        // var img = zip.folder("images");
                        zip.generateAsync({type:"blob"})
                        .then(function(content) {
                            var blob = new Blob([content], { type: "application/zip" });
                            var url = window.URL || window.webkitURL;
                            var link = url.createObjectURL(blob);
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

    /**
     * Fetches the content of a file under the templates folder
     */
    fetchTemplate(name) {
        var xhr = new XMLHttpRequest();
        var url = "templates/" + name;
        xhr.open("GET", url, false);
        xhr.send();
        if (xhr.status === 200) {    
            return xhr.responseText;
        }
    }
}

export { DownloadDialog };