# Running Epsilon from Java

While Epsilon's development tools are based on Eclipse, its runtime is not, and can be used from any (headless) Java application. For example, the back-end of the [Epsilon Playground](../../../live) is a headless, server-less Java application that runs on Google's Cloud Platform.

!!! info "Did you know that ..."
    Contrary to popular belief, EMF is **not** tightly coupled to the Eclipse IDE either, and can also be embedded in any Java application by importing a couple of dependencies from [MavenCentral](https://mvnrepository.com/artifact/org.eclipse.emf).

## Dependencies

Epsilon libraries are available on [MavenCentral](https://mvnrepository.com/artifact/org.eclipse.epsilon). Below is a fragment of a `pom.xml` file, where we declare dependencies to the execution engine of Epsilon's [core expression language](../../eol) and on Epsilon's driver for EMF-based models. As the EMF driver has a dependency on EMF, we don't need to declare a dependency to the EMF libraries on MavenCentral; Maven will fetch these automatically for us.

```xml
<dependencies>
	<dependency>
		<groupId>org.eclipse.epsilon</groupId>
		<artifactId>org.eclipse.epsilon.emc.emf</artifactId>
		<version>2.2.0</version>
	</dependency>
	<dependency>
		<groupId>org.eclipse.epsilon</groupId>
		<artifactId>org.eclipse.epsilon.eol.engine</artifactId>
		<version>2.2.0</version>
	</dependency>
	...
</dependencies>
```

## Parsing and Executing Epsilon Programs

Having declared a dependency to the EOL engine, parsing and executing an EOL program is as simple as that.

```java
EolModule module = new EolModule();
module.parse(new File("program.eol"));
module.execute();
```

!!! tip
    By replacing `EolModule` with `EtlModule`, `EvlModule` etc. you can parse and execute [ETL transformations](../../etl), [EVL validation constraints](../../evl) etc. [EGL](../../egl) deviates from this pattern and if you wish to execute a single template you should use the `EglTemplateFactoryModuleAdapter` class.

## Loading Models

Most of your Epsilon programs will need to run against models of some sort. To run an EOL program against a model (`model.xmi`) that conforms to a file-based Ecore metamodel (`metamodel.ecore`), you can extend the code above as follows.

```java
// Loads the EMF model
EmfModel model = new EmfModel();
model.setMetamodelFile("metamodel.ecore");
model.setModelFile("model.xmi");
model.load();

// Parses and executes the EOL program
EolModule module = new EolModule();
module.parse(new File("program.eol"));
// Makes the model accessible from the program
module.getContext().getModelRepository().addModel(model);
module.execute();

// Saves any changes to the model
// and unloads it from memory
model.dispose();
```

## More Examples

In Epsilon's Git repository, there are two example projects that show how to run [Epsilon from Java](https://git.eclipse.org/c/epsilon/org.eclipse.epsilon.git/tree/examples/org.eclipse.epsilon.examples.standalone), and the [ANT Epsilon tasks in a headless environment](https://git.eclipse.org/c/epsilon/org.eclipse.epsilon.git/tree/examples/org.eclipse.epsilon.examples.workflow.standalone) (i.e. from command line).