class Panel {

    id;
    editor;

    constructor(id) {
        this.id = id;
        this.editor = ace.edit(document.getElementById(this.id + 'Editor'));
        this.editor.setShowPrintMargin(false);
    }

    setTitle(title) {
        $("#" + this.id + "Panel")[0].dataset.titleCaption = title;
    }

    setIcon(icon) {
        $("#" + this.id + "Panel")[0].dataset.titleIcon = "<span class='mif-16 mif-" + icon + "'></span>";
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
}

export { Panel };