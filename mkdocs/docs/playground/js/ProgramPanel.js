import { Panel } from "./Panel.js";

class ProgramPanel extends Panel {

    constructor() {
        super("program");
    }

    setLanguage(language) {
        this.editor.getSession().setMode("ace/mode/" + language);
        $('#programPanel')[0].dataset.customButtons = JSON.stringify(this.getButtons(language));
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
}

export { ProgramPanel };
