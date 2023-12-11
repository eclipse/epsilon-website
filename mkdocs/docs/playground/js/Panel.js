import { fit } from './Playground.js'

class Panel {

    id;
    editor;
    element;
    visible;
    parent; // The parent splitter

    constructor(id) {
        this.id = id;
        this.getElement();

        // Set up the panel's editor
        this.editor = ace.edit(this.element.querySelector('.editor'));
        this.editor.setShowPrintMargin(false);
        this.editor.setTheme("ace/theme/eclipse");
        this.editor.renderer.setShowGutter(false);
        this.editor.setFontSize("1rem");
        this.editor.setOptions({
            fontSize: "11pt",
            useSoftTabs: true
        });

        this.visible = true;
    }

    createButtons() {
        this.element.dataset.customButtons = JSON.stringify(this.getAllButtons());
    }

    getAllButtons() {
        var buttons = this.getButtons();
        return [{
            html: this.buttonHtml("close", "Close panel"),
            cls: "sys-button",
            onclick:  this.id + "Panel.setVisible(false)"
        }].concat(buttons);
    }

    setTitleAndIcon(title, icon) {
        this.setTitle(title);
        this.setIcon(icon);
    }

    setTitle(title) {
        this.element.dataset.titleCaption = title;
    }

    getTitle() {
        return this.element.dataset.titleCaption;
    }

    setIcon(icon) {
        this.element.dataset.titleIcon = "<span class='mif-16 mif-" + icon + "'></span>";
    }

    setVisible(visible) {
        if (this.visible != visible) {
            this.visible = visible;

            this.element.parentNode.style.display = visible ? "flex" : "none";
            
            if (this.parent) {
                this.parent.childVisibilityChanged();
            }
            window.fit();
        }
    }

    isVisible() {
        return this.visible;
    }

    getEditor() {
        return this.editor;
    }

    getValue() {
        return this.editor.getValue();
    }

    setValue(value) {
        this.editor.setValue((value+""), 1);
        // Reset undo manager
        this.editor.session.getUndoManager().reset(); 
    }

    buttonHtml(icon, hint) {
        return "<span class='mif-" + icon + "' data-role='hint' data-hint-text='" + hint + "' data-hint-position='bottom'></span>";
    }

    fit() {}

    createElement() {}

    getElement() {
        if (!this.element) {
            this.element = this.createElement();
        }
        return this.element;
    }

    getId() {
        return this.id;
    }

    setParent(parent) {
        this.parent = parent;
    }

    getParent() {
        return this.parent;
    }

}

export { Panel };