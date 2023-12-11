import { Panel } from "./Panel.js";

class Splitter {

    visible = true;
    root = false;
    components;
    element;
    parent; // The splitter's parent splitter

    constructor(first, second, direction = "horizontal", split = "50, 50") {
        this.components = []
        if (first) this.components.push(first);
        if (second) this.components.push(second);
        
        this.element = document.createElement("div");
        this.element.setAttribute("data-role", "splitter");
        this.element.setAttribute("data-on-resize-stop", "fit()");
        this.element.setAttribute("data-on-resize-split", "fit()");
        this.element.setAttribute("data-on-resize-window", "fit()");
        this.element.setAttribute("data-split-sizes", split);
        
        this.element.setAttribute("data-split-mode", direction);
        for (const component of this.components) {
            if (component instanceof Panel || component instanceof Splitter) {
                component.setParent(this);
                this.element.appendChild(component.getElement());
                this.childVisibilityChanged();
            }
            else {
                this.element.appendChild(component);
            }
        }
    }

    getElement() {
        return this.element;
    }

    setRoot() {
        this.root = true;
        this.element.setAttribute("class", "h-100");
        this.element.setAttribute("id", "splitter");
        this.element.setAttribute("style", "min-height:800px");
    }

    isRoot() {
        return this.root;
    }

    setParent(parent) {
        this.parent = parent;
    }

    getParent() {
        return this.parent;
    }

    setVisible(visible) {
        if (visible != this.visible) {
            this.visible = visible;
            this.element.style.display = visible ? "flex" : "none";
            if (this.parent) {
                this.parent.childVisibilityChanged();
            }
        }
    }

    isVisible() {
        return this.visible;
    }

    childVisibilityChanged() {
        this.setVisible(this.isRoot() || !this.components.every(item => !item.isVisible()));
        if (this.isVisible()) {
            if (this.components.length == 1) {
                this.setGutterVisible(false);
            }
            else {
                this.setGutterVisible(this.components.every(item => item.isVisible()));
            }
        }
    }

    setGutterVisible(visible) {
        for (const child of this.element.children) {
            console.log(child);
            if (child.classList.contains("gutter")) {
                console.log("Found gutter!");
                child.style.display = visible ? "flex" : "none";
            }
        }
    }

}

export { Splitter };