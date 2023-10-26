# Example showing how to cross-reference models with Java

In this example we have two flexmi models, one referencing to the other via eReferences (i.e. `persons.flexmi` and `model.flexmi`). In order to process a model with crossreferences with Java , we can use a single ResourceSet and loading resources referring to both the models (an alternative way for doing this is to use the `?import` statement at the beginning of the flexmi model). 
This snippet of code, for instance shows a single ResourceSet, with a Resource loading the instances in the model `persons.flexmi` and then another model `model.flexmi`. 
```java
ResourceSet resourceSet = new ResourceSetImpl();
        resourceSet.getPackageRegistry().put(ePackage.getNsURI(), ePackage);
        Resource personsResource = resourceSet.getResource(URI.createFileURI(new File("persons.flexmi").getAbsolutePath()), true);
        personsResource.load(null);

        System.out.println(personsResource.getContents().get(0));
        
        Resource tasksResource = resourceSet.getResource(URI.createFileURI(new File("model.flexmi").getAbsolutePath()), true);
        personsResource.load(null);

```
The `persons.flexmi` model contains the definition of the persons,
```xml
<?nsuri psl?>
<_>
    <person name="Alice"/>
	<person name="Bob"/>
</_>
```
 whereas the `model.flexmi` model contains the definition of projects, tasks and effort. Please note that the `effort` instances refer to persons that are defined in the `persons.flexmi` model.

```xml
 <?nsuri psl?>
<project title="ACME">
	<task title="Analysis" start="1" dur="3">
		<effort person="Alice"/>
	</task>
	<task title="Design" start="4" dur="6">
		<effort person="Bob"/>
	</task>
	<task title="Implementation" start="7" dur="3">
		<effort person="Bob" perc="50"/>
		<effort person="Alice" perc="50"/>
	</task>
</project>
```
Executing the snippet, the resolution of cross-references is correctly done and an EOL module is also executed to confirm it. 