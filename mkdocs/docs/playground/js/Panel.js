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

    getTitle() {
        return this.element.dataset.titleCaption;
    }

    setIcon(icon) {
        this.element.dataset.titleIcon = "<span class='mif-16 mif-" + icon + "'></span>";
    }

    setVisible(visible) {
        if (this.visible != visible) {
            var display = "none";
            if (visible) {
                display = "flex";
            }
            var parent = document.getElementById(this.getId() + "Panel").parentNode;
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

    getId() {
        return this.id;
    }

}

export { Panel };