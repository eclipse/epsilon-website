# Epsilon and EMF
Below are some frequently-asked questions related to querying and modifying EMF-based models with Epsilon.
 
## What is the difference between containment and non-containment references in EMF?
Briefly, a model element can belong to as most one containment reference at a time. Containment references also demonstrate a cascade-delete behaviour. For example, consider the following Ecore metamodel (captured in Emfatic).

```emf
package cars;

class Person {
  ref Person[*] friends; //non-containment reference
  val Car[*] cars; // containment reference
}

class Car { }
```
 
Now consider the following EOL code which demonstrates the similarities/differences of containment and non-containment references.
 
```eol
// Set up a few model elements to play with
var c1 = new Car;
var c2 = new Car;
var p1 = new Person;
var p2 = new Person;
var p3 = new Person;

// p1's car is c1 and p2's car is c2
p1.cars.add(c1);
p2.cars.add(c2);

// p3 is a friend of both p1 and p2
p1.friends.add(p3);
p2.friends.add(p3);

p1.friends.println(); // prints {p3}
p2.friends.println(); // prints {p3}

//add c2 to p1's cars
p1.cars.add(c2);
p1.cars.println(); // prints {c1, c2}
 
// The following statement prints an empty set! 
// As discussed above, model elements can belong to at 
// most 1 containment reference. As such, by adding c2 to
// the cars of p1, EMF removes it from the cars of p2
p2.cars.println();

// Delete p1 from the model
delete p1;

Person.all.println(); // prints {p2, p3}

// The following statement prints an empty set!
// As discussed above, containment references demonstrate
// a cascade-delete behaviour. As such, when we deleted p1,
// all the model elements contained in its cars containment reference
// were also deleted from the model. Note how the friends of p1 (p2 and p3)
// were not deleted from the model, since they were referenced through a 
// non-containment reference (friends)
Car.all.println();
```
 
## How can I get all children of a model element?
Epsilon does not provide a built-in method for this but you can use EObject's `eContents()` method if you're working with EMF. To get all descendants of an element, something like the following should do the trick: `o.asSequence().closure(x | x.eContents())`. See [https://www.eclipse.org/forums/index.php/t/855628/](https://www.eclipse.org/forums/index.php/t/855628/) for more details.
 
## How can I get the container of a model element?
Epsilon does not provide a built-in method for this but you can use EObject's `eContainer()` method if you're working with EMF.

## How can I use an existing EMF Resource in Epsilon?
To use an existing EMF Resource in your Epsilon program, you should wrap it as an [InMemoryEmfModel](http://download.eclipse.org/epsilon/javadoc/org/eclipse/epsilon/emc/emf/InMemoryEmfModel.html) first.

## How can I access the EMF resource that underpins an EMFModel?

You can use the `getResource()` method of `AbstractEmfModel` for this.

## How can I use custom load/save options for my EMF model?
You need to un-tick the "Read on load"/"Store on disposal" options in your model configuration dialog and use the underlying EMF resource's load/save methods directly from your EOL code. For example, to turn off the OPTION_DEFER_IDREF_RESOLUTION option, which is on by default in Epsilon's EMF driver and has been reported to [slow down loading of models that use "id" attributes](https://www.eclipse.org/forums/index.php/m/1754026/#msg_1754026), you can use the following EOL statement.

```java
M.resource.load(Map{"DEFER_IDREF_RESOLUTION" = false});
```

## How do I load an Ecore metamodel?

If you're developing a standalone application, before you can load an EMF model, you will need to put its metamodel (`EPackage`) in the global EMF EPackage registry, or in the local package registry of the model resource. The following snippet shows how you can parse an Ecore metamodel from a file (`my.ecore`) and put its root EPackage in the global EMF registry.

```java
// Parse the metamodel file into an EMF resource
ResourceSet ecoreResourceSet = new ResourceSetImpl();
ecoreResourceSet.getResourceFactoryRegistry().
	getExtensionToFactoryMap().put("ecore", new XMIResourceFactoryImpl());
ecoreResourceSet.getPackageRegistry().
	put(EcorePackage.eINSTANCE.getNsURI(), EcorePackage.eINSTANCE);	
Resource ecoreResource = ecoreResourceSet.createResource(
	URI.createFileURI(new File("my.ecore").getAbsolutePath()));
ecoreResource.load(null);

// Ecore files usually contain one EPackage
EPackage ePackage = (EPackage) ecoreResource.getContents().get(0);
// Put the EPackage in the global EMF EPackage registry
EPackage.Registry.INSTANCE.put(ePackage.getNsURI(), ePackage);
```
