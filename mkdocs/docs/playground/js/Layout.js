import {programPanel, consolePanel, firstModelPanel, firstMetamodelPanel, secondModelPanel, secondMetamodelPanel, thirdModelPanel} from './Playground.js';

class Layout {

    create(rootId) {
        var root = document.getElementById(rootId);
        var splitter = Layout.createHorizontalSplitter(
            [
                Layout.createVerticalSplitter([programPanel.getElement(), consolePanel.getElement()]),
                Layout.createVerticalSplitter([firstModelPanel.getElement(), firstMetamodelPanel.getElement()]),
                Layout.createVerticalSplitter([secondModelPanel.getElement(), secondMetamodelPanel.getElement()], "secondModelSplitter"),
                Layout.createVerticalSplitter([thirdModelPanel.getElement()], "thirdModelSplitter")
            ]
        );

        splitter.setAttribute("class", "h-100");
        splitter.setAttribute("id", "splitter");
        splitter.setAttribute("style", "min-height:800px");
        root.appendChild(splitter);
    }

    static createHorizontalSplitter(components, id = "") {
        return Layout.createSplitter(true, components, id);
    }

    static createVerticalSplitter(components, id = "") {
        return Layout.createSplitter(false, components, id);
    }

    static createSplitter(horizontal, components, id = "") {
        var splitter = document.createElement("div");
        splitter.setAttribute("data-role", "splitter");
        splitter.setAttribute("data-on-resize-stop", "fit()");
        splitter.setAttribute("data-on-resize-split", "fit()");
        splitter.setAttribute("data-on-resize-window", "fit()");

        if (!horizontal) splitter.setAttribute("data-split-mode", "vertical");
        if (id != "") splitter.setAttribute("id", id);
        components.forEach(component => splitter.appendChild(component));
        return splitter;
    }

}

export { Layout };