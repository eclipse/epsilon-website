# Eugenia: Affixed Nodes in GMF
From the following annotated Ecore metamodel (in Emfatic)

```emf
@namespace(uri="components", prefix="components")
package components;

@gmf.diagram
class ComponentDiagram {
   val Component[*] components;
   val Connector[*] connectors;
}

abstract class NamedElement {
   attr String name;
}

@gmf.node(label="name")
class Component extends NamedElement {
   @gmf.affixed
   val Port[*] ports;
}

@gmf.node(figure="rectangle", size="20,20", label="name",
  label.placement="external", label.icon="false")
class Port extends NamedElement {

}

@gmf.link(source="source", target="target", label="name",
  target.decoration="arrow")
class Connector extends NamedElement {
   ref Port source;
   ref Port target;
}
```

Eugenia can automatically generate this GMF editor:

![](Components.jpg)