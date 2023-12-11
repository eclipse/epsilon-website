import { Panel } from "./Panel.js";

class Splitter {

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
                this.element.appendChild(component.getElement());
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
        this.element.setAttribute("class", "h-100");
        this.element.setAttribute("id", "splitter");
        this.element.setAttribute("style", "min-height:800px");
    }

    setParent(parent) {
        this.parent = parent;
    }

    getParent() {
        return this.parent;
    }

}

export { Splitter };