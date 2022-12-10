class SettingsDialog {

    showEditorLineNumbers = false;

    show(event) {
        event.preventDefault();

        var panels = ["program", "console", "firstModel", "firstMetamodel"];

        if (language == "etl" || language == "flock")
            panels.push("secondModel", "secondMetamodel");
        else if (language == "evl" || language == "epl" || language == "egl" || language == "egx") {
            panels.push("thirdModel");
            if (language == "egx") {
                panels.push("secondProgram");
            }
        }
        

        var visibilityCheckboxes = "";

        for (const panel of panels) {
            visibilityCheckboxes += this.createPanelVisibilityCheckbox(panel, true) + "<br/>";
        }

        var self = this;
        Metro.dialog.create({
            title: "Settings",
            content: `
            <h6>Editors</h6>
            `
                + self.createEditorLineNumbersCheckbox() +
                `
            <h6>Visible Panels</h6>
            `
                + visibilityCheckboxes +
                `
            `,
            actions: [
                {
                    caption: "Apply",
                    cls: "js-dialog-close success",
                    onclick: function () {
                        for (const panel of panels) {
                            self.applyPanelVisibility(panel);
                        }
                        self.updateEditorLineNumbers();
                        updateGutterVisibility();
                        fit();
                    }
                },
                {
                    caption: "Cancel",
                    cls: "js-dialog-close"
                }
            ]
        });
    }

    applyPanelVisibility(panel) {
        var display = "none";
        if (document.getElementById(panel + "Visible").checked) {
            display = "flex";
        }
        var parent = document.getElementById(panel + "Panel").parentNode;
        parent.style.display = display;

        // If all the panels in the splitter panel are hiden, hide the splitter panel too
        if (Array.prototype.slice.call(parent.parentNode.children).every(
            child => child.style.display == "none" || child.className == "gutter")) {
            parent.parentNode.style.display = "none";
        }
        else {
            parent.parentNode.style.display = "flex";
        }
    }

    updateEditorLineNumbers() {
        this.showEditorLineNumbers = document.getElementById("editorLineNumbers").checked;
        panels.forEach(p => p.getEditor().renderer.setShowGutter(this.showEditorLineNumbers));
    }

    createEditorLineNumbersCheckbox() {
        var checked = this.showEditorLineNumbers ? "checked" : "";

        return '<input type="checkbox" id="editorLineNumbers" data-role="checkbox" data-caption="Show line numbers" ' + checked + '>';
    }

    createPanelVisibilityCheckbox(panel) {
        var checked = document.getElementById(panel + "Panel").parentNode.style.display == "none" ? "" : "checked";

        return '<input type="checkbox" id="' + panel + 'Visible" data-role="checkbox" data-caption="' + getPanelTitle(panel + "Panel") + '" ' + checked + '>';
    }
}

export { SettingsDialog };