class Panel {

    id;
    editor;
    element;
    visible;
    
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

    setTitleAndIcon(title, icon) {
        this.setTitle(title);
        this.setIcon(icon);
    }

    setTitle(title) {
        this.element.dataset.titleCaption = title;
    }

    setIcon(icon) {
        this.element.dataset.titleIcon = "<span class='mif-16 mif-" + icon + "'></span>";
    }

    setVisible(visible) {
        this.visible = visible;
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

}

export { Panel };