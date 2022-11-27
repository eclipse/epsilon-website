import { Panel } from "./Panel.js";

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
        this.editor.getSession().on('change', function () {
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
        if ((val.trim() + "").startsWith("<")) {
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
        }, {
            html: this.buttonHtml("refresh", "Render the model object diagram"),
            cls: "sys-button",
            onclick: this.id + "Panel.refreshDiagram()"
        }, {
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

                    // FIXME: Make both functions return the PlantUML diagram in a "diagram" field
                    var jsonField = "modelDiagram";
                    if (diagramId.endsWith("etamodelDiagram"))
                        jsonField = "metamodelDiagram";

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

export { ModelPanel };