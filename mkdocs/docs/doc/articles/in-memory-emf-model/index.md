# Working with custom EMF resources

Epsilon's default EMF driver ([EmfModel](http://download.eclipse.org/epsilon/javadoc/org/eclipse/epsilon/emc/emf/EmfModel.html)), provides little support for customising the underlying EMF resource loading/persistence process (e.g. using custom resource factories, passing parameters to the resources's load/save methods etc.). If you're invoking an Epsilon program from Java and you need more flexibility in this respect, you can use [InMemoryEmfModel](http://download.eclipse.org/epsilon/javadoc/org/eclipse/epsilon/emc/emf/InMemoryEmfModel.html) instead, which is essentially a wrapper for a pre-loaded EMF resource. A skeleton example follows.

```java
Resource resource = ...;
InMemoryEmfModel model = new InMemoryEmfModel(resource);
model.setName("M");
EolModule module = new EolModule();
module.parse(...);
module.getContext().getModelRepository().addModel(model);
module.execute();
resource.save(...);
```
