import { Panel } from "./Panel.js";

class ProgramPanel extends Panel {

    constructor() {
        super("program");
    }

    setLanguage(language) {
        this.editor.getSession().setMode("ace/mode/" + language);
        this.element.dataset.customButtons = JSON.stringify(this.getButtons(language));
    }

    fit() {
        var editorElement = document.getElementById(this.id + "Editor");
        if (editorElement != null) {
            editorElement.parentNode.style = "flex-basis: calc(100% - 4px);";
        }
        this.editor.resize();
    }

    getButtons(language) {
        var languageName = (language == "flock" ? "Flock" : language.toUpperCase());
        return [{
            html: this.buttonHtml("help", languageName + " language reference"),
            cls: "sys-button",
            onclick: "window.open('https://www.eclipse.org/epsilon/doc/'+language);"
        }, {
            html: this.buttonHtml("run", "Run the program (Ctrl/Cmd+S)"),
            cls: "sys-button",
            onclick: "runProgram()"
        }];
    }

    // TODO: Identical to ConsolePanel.createElement()
    createElement() {
        var root = document.createElement("div");
        root.setAttribute("data-role", "panel");
        root.setAttribute("id", this.id + "Panel");

        var editor = document.createElement("div");
        editor.setAttribute("id", this.id + "Editor");
        editor.setAttribute("class", "editor");

        root.appendChild(editor);
        
        return root;
    }
}

export { ProgramPanel };
