import { ModelPanel } from './ModelPanel.js';
import { editorValidator } from './Playground.js';

class MetamodelPanel extends ModelPanel {
    constructor(id) {
        super(id, true, null);
        this.createButtons();
        this.setTitleAndIcon("Metamodel", "emfatic");
    }

    setupSyntaxHighlighting() {
        this.editor.getSession().setMode("ace/mode/emfatic");
    }

    init() {
        super.init();
        editorValidator.addOnReadyListener(this);
    }

    async editorValidatorReady() {
        this.validate();
        var self = this;
        this.editor.on("input", () => {
            self.validate();
        });
    }

    async validate() {
        await editorValidator.validateEmfaticEditor(this.editor);
    }

    getButtons() {
        return [{
            html: this.buttonHtml("help", "Emfatic language reference"),
            cls: "sys-button",
            onclick: "window.open('https://www.eclipse.org/epsilon/doc/articles/playground/#emfatic-metamodels-in-the-playground');"
        },{
            html: this.buttonHtml("diagram", "Show/hide the metamodel class diagram", this.getDiagramButtonId()),
            cls: "sys-button",
            onclick: this.id + "Panel.toggleDiagram()"
        },{
            html: this.buttonHtml("refresh", "Refresh the metamodel class diagram", this.getDiagramRefreshButtonId()),
            cls: "sys-button",
            onclick: this.id + "Panel.refreshDiagram()"
        }, {
            html: this.buttonHtml("fit-diagram", "Fit the metamodel class diagram", this.getFitDiagramButtonId()),
            cls: "sys-button",
            onclick: this.id + "Panel.fitDiagram()"
        }];
    }
    
    refreshDiagram() {
        this.refreshDiagramImpl(backend.getEmfaticToPlantUMLService(), this.id + "Diagram", "metamodel", null, this.getEditor());
    }

}

export { MetamodelPanel };