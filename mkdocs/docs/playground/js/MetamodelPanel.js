import { ModelPanel } from './ModelPanel.js';

class MetamodelPanel extends ModelPanel {
    constructor(id) {
        super(id, true, null);
        this.element.dataset.customButtons = JSON.stringify(this.getButtons());
        this.setTitleAndIcon("Metamodel", "emfatic");
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
        this.refreshDiagramImpl(backend.getEmfaticToPlantUMLService(), this.id + "Diagram", "metamodel", null, this.getEditor());
    }

}

export { MetamodelPanel };