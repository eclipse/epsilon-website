# Exeed Reference
 
Exeed (standing for **Ex**tended **E**MF **Ed**itor) is an extended version of the built-in tree-based reflective editor provided by EMF.

The aim of Exeed is to enable developers to customize the appearance of the editor (labels and icons) by annotating Ecore metamodels. As a result, developers can enjoy the benefits of a customized editor for their models without needing to generate one and then customize it using Java.

## Exeed Annotations Keys
The *source* for exeed annotations is `exeed`. Exeed annotations are only supported in `EClass`, `EEnumLiteral` and `EStructuralFeature` elements of the metamodel. For each element the following keys are supported:

### EClass
* `label`: Defines the label that will be used to for the element when it is displayed on all views related to the editor (editing tree, properties view, etc.)
* `referenceLabel`: Defines the label for a reference to an instance of this `EClass` ((e.g. in the properties view).
* `icon`: Defines the icon to use to display alongside the element on all views related to the editor (editing tree, properties view, etc.). If specified, it overrides the `classIcon` annotation.
* `classIcon`: Defines the icon of the instances of the `EClass`.

### EEnumLiteral
* `label`: Defines the label that will be used for the enumeration literal when it is displayed on all views related to the editor (editing tree, properties view, etc.)

### EStructuralFeature
* `featureLabel`: Defines the label that will be used for the structural feature when it is displayed on all views related to the editor (editing tree, properties view, etc.)

## Exeed Annotations Values
All keys, except for `classIcon`, accept an EOL script as their value. This allows labels and icons to be dynamically allocated based on the properties of the instance. The EOL script is evaluated in the context of each instance, that is, the current instance can be accessed via the `self` keyword. Further, all other model elements are accessible via navigation (i.e. references from the instance) or by getting all elements of a type (e.g. MyType.all). 

For the `icon` and `classIcon` keys the expected value is the name of one of the icons available in Exeed. Thus, for `icon` the EOL script must return a string with the name of the icon and for `classIcon` the value must be the name of the icon. The following icons are available (the extension should not be included):

![Available Icons](icons.png)

## Example
The images show the tree view of a OO Model with the EMF Reflective Editor (left) and the Exeed Editor (right).

![EMF Reflective Editor](normaltree.png)![Exeed Editor](exeedtree.png)

The following code presents the annotated OO metamodel (in Emfatic) that was used to obtain the Exeed result above (the example is available from the [examples](https://git.eclipse.org/c/epsilon/org.eclipse.epsilon.git/plain/examples/org.eclipse.epsilon.examples.exeedoo) folder of the Git repository):

```emf
@namespace(uri="OO", prefix="")
package OO;

@exeed(classIcon="model")
class Model extends Package {
}

@exeed(referenceLabel="
var str : String;
str = self.closure(pe:PackageableElement|pe.package).collect(p|p.name).invert().concat('.');
if (self.package.isDefined()){
	str = str + '.';
}
str = str + self.name;
return str;
")
abstract class PackageableElement extends NamedElement {
   ref Package#contents ~package;
}

abstract class AnnotatedElement {
  val Annotation[*] annotations;
}

@exeed(label="return self.key + ' -> ' + self.value;", classIcon="annotation")
class Annotation {
  attr String key;
  attr String value;
}

@exeed(label="return self.name;")
abstract class NamedElement extends AnnotatedElement {
  attr String name;
}

@exeed(classIcon="package", label="return self.name;")
class Package extends PackageableElement {
  val PackageableElement[*]#~package contents;
  ref Package[*] uses;
}

abstract class Classifier extends PackageableElement { }

class ExternalClass extends Class { }

@exeed(classIcon="class", label="
var label : String;
label = self.name;
if (self.extends.isDefined()){
	label = label + ' extends ' + self.extends.name;
}
return label;
")
class Class extends Classifier {
  ref Class#extendedBy ~extends;
  ref Class[*]#~extends extendedBy;
  val Feature[*]#owner features;
  attr Boolean isAbstract;
}

@exeed(classIcon="datatype")
class Datatype extends Classifier {
}

abstract class Feature extends NamedElement {
  ref Class#features owner;
  ref Classifier type;
  attr VisibilityEnum visibility;
}

@exeed(label="
var label : String;
label = self.name;
if (self.type.isDefined()){
	if (self.isMany) {
		label = label + ' [*]';
	}
	label = label + '  : ' + self.type.name;
}
return label;", 
icon="
if (self.visibility = VisibilityEnum#private) {
	return 'private';
}
else {
	return 'public';
}
")
abstract class StructuralFeature extends Feature {
    attr Boolean isMany;
}

@exeed(label="
var label : String;
label = self.name + ' (';
for (p in self.parameters) {
	label = label + p.name;
	if (p.type.isDefined()) {
		label = label + ' : ' + p.type.name;
	}
	if (hasMore) {
		label = label + ', ';
	}
}
label = label + ')';
if (self.type.isDefined()) {
	label = label + ' : ' + self.type.name;
}
return label;
", classIcon="operation")
class Operation extends Feature {
   val Parameter[*]#owner parameters;
}

@exeed(label="
var label : String;
label = self.name;
if (self.type.isDefined()){
	label = label + ' : ' + self.type.name;
}
return label;
", classIcon="parameter")
class Parameter extends NamedElement {
  ref Classifier type;
  ref Operation#parameters owner;
}

class Reference extends StructuralFeature { }

class Attribute extends StructuralFeature { }

enum VisibilityEnum {
  public = 1;
  private = 2;
}

```

## Resources
- [Article: Inspecting EMF Models with Exeed](../articles/inspect-models-exeed)