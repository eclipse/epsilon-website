import { Panel } from "./Panel.js";

class ProgramPanel extends Panel {

    language;

    constructor(id = "program") {
        super(id);
    }

    setLanguage(language) {
        this.language = language;
        this.editor.getSession().setMode("ace/mode/" + language);
        this.createButtons();
        var title = "";
        
        switch (language) {
            case "eol": title = "Program"; break;
            case "etl": title = "Transformation"; break;
            case "flock": title = "Migration"; break;
            case "egl": title = "Template"; break;
            case "evl": title = "Constraints"; break;
            case "epl": title = "Patterns"; break;
            case "egx": title = "Template Coordination"; break;
            case "ecl": title = "Match Rules"; break;
            case "eml": title = "Merge Rules"; break;
        }

        this.setTitleAndIcon(title + " (" + (language == "flock" ? "Flock" : language.toUpperCase()) + ")", language);

        var self = this;
        this.editor.getSession().on('change', function () {
            //var Range = ace.require("ace/range").Range;
            //self.editor.session.addMarker(new Range(0, 0, 1, 5), "parse-error", "text");
            self.parse();
        });
    }

    cj;

    async parse() {
        if (!this.cj) {
            await cheerpjInit();
            this.cj = await cheerpjRunLibrary("/app/java/target/epsilon.jar");
        }
        var ModuleParser = await this.cj.org.eclipse.epsilon.playground.ModuleParser;
        var m = await new ModuleParser();
        var annotations = await m.parse(this.getValue());
        this.editor.getSession().setAnnotations(JSON.parse(annotations));
        
        //console.log(ok);
        /*
        for (const parseProblem of await m.getParseProblems()) {
            annotations.push({
                row: await parseProblem.getLine(),
                column: await parseProblem.getColumn(),
                text: await parseProblem.getReason(),
                type: "error"
            });
        }
        editor.getSession().setAnnotations(annotations);*/
        //
        //console.log("Parsed " + ok);
    }

    fit() {
        var editorElement = document.getElementById(this.id + "Editor");
        if (editorElement != null) {
            editorElement.parentNode.style = "flex-basis: calc(100% - 4px);";
        }
        this.editor.resize();
    }

    getButtons() {
        var languageName = (this.language == "flock" ? "Flock" : this.language.toUpperCase());
        var buttons = [{
            html: this.buttonHtml("help", languageName + " language reference"),
            cls: "sys-button",
            onclick: "window.open('https://www.eclipse.org/epsilon/doc/" + this.language + "');"
        }];
        if (this.id == "program") {
            buttons.push({
                html: this.buttonHtml("run", "Run the program (Ctrl/Cmd+S)"),
                cls: "sys-button",
                onclick: "runProgram()"
            });
        }
        return buttons;
        /*
        return [{
            html: this.buttonHtml("help", languageName + " language reference"),
            cls: "sys-button",
            onclick: "window.open('https://www.eclipse.org/epsilon/doc/'+language);"
        }, {
            html: this.buttonHtml("run", "Run the program (Ctrl/Cmd+S)"),
            cls: "sys-button",
            onclick: "runProgram()"
        }];*/
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
