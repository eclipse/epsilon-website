import { ModelPanel } from "./ModelPanel.js";

class OutputPanel extends ModelPanel {

    type;
    language;

    constructor(id, type, language) {
        super(id, false, null);
        this.type = type;
        this.language = language;
        this.element.dataset.customButtons = JSON.stringify(this.getButtons());
        this.getEditor().getSession().setMode("ace/mode/" + language.toLowerCase());
    }

    setupSyntaxHighlighting() {}

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
                    onclick: function () {
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

    fit() {
        var diagramElement = document.getElementById(this.id + "Diagram");
        if (diagramElement != null) {
            var svg = diagramElement.firstElementChild;
            if (svg != null && svg.tagName == "svg") {
                diagramElement = diagramElement.parentElement.parentElement;
                svg.style.width = diagramElement.offsetWidth + "px";
                svg.style.height = diagramElement.offsetHeight - 42 + "px";
            }
        }
    }
}

export { OutputPanel };