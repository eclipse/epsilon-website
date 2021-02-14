# Running Epsilon's Ant Tasks from Command Line

[This example project](https://git.eclipse.org/c/epsilon/org.eclipse.epsilon.git/tree/examples/org.eclipse.epsilon.examples.workflow.standalone) shows how to download, configure and run [Epsilon's Ant tasks](../../workflow) from the command line using Ant, Maven and Gradle. To run the examples below, you **only** need to have [Ant](https://ant.apache.org), [Maven](https://maven.apache.org/) or [Gradle](https://gradle.org/) installed in your system. 

## Ant

When you run the `ant` command in the root directory of the project, the following will happen:

- The build file (`build.xml`) will download [Apache Ivy](https://ant.apache.org/ivy/) in a temporary directory
- Ivy will fetch the required Epsilon jars (also in a temporary directory) from Maven Central/Sonatype
- The build file will set up Epsilon's Ant tasks
- The following part of the build file will be executed, which will load an EMF-based model and then run an EOL program against it

```xml
<epsilon.emf.loadModel name="Library" modelfile="library.model" 
	metamodelfile="library.ecore"/>

<epsilon.eol>
    for (writer in Writer.all) {
        (writer.name + " wrote " + writer.books.title.concat(", ")).println();
    }
    <model ref="Library"/>
</epsilon.eol>
```

If everything goes well, the last few lines of the output of the `ant` command should look like this:

```
run-epsilon:
[epsilon.eol] Agatha Christie wrote Endless Night

BUILD SUCCESSFUL
```

The complete source code is below and in [Epsilon's Git repo](https://git.eclipse.org/c/epsilon/org.eclipse.epsilon.git/tree/examples/org.eclipse.epsilon.examples.workflow.standalone).

=== "build.xml"

    ```xml
    {{{ example("org.eclipse.epsilon.examples.workflow.standalone/build.xml", true) }}}
    ```

=== "ivy.xml"

    ```xml
    {{{ example("org.eclipse.epsilon.examples.workflow.standalone/ivy.xml", true) }}}
    ```

=== "ivysettings.xml"

    ```xml
    {{{ example("org.eclipse.epsilon.examples.workflow.standalone/ivysettings.xml", true) }}}
    ```

## Maven 

Since Maven can run Ant tasks, Epsilon Ant tasks can also be executed from a Maven build (`mvn clean install`) as shown below. 

=== "pom.xml"

    ```xml
    {{{ example("org.eclipse.epsilon.examples.workflow.standalone/pom.xml", true) }}}
    ```

## Gradle

Since Gradle can also [run Ant tasks](https://docs.gradle.org/current/userguide/ant.html), Epsilon Ant tasks can also be executed from a Gradle build (`gradle run`) as shown below.

=== "build.gradle"

    ```groovy
    {{{ example("org.eclipse.epsilon.examples.workflow.standalone/build.gradle", true) }}}
    ```

## Flexmi and Emfatic

You can also use [Flexmi](../../flexmi) instead of XMI (`library.flexmi` instead of `library.model`) for the model, and [Emfatic](https://eclipse.org/emfatic) instead of Ecore (`library.emf` instead of `library.ecore`) by adding the following dependency to your ANT/Maven/Gradle build.

=== "Ivy/ANT"

    ```xml
    <dependency org="org.eclipse.emfatic" name="org.eclipse.emfatic.core" rev="0.8.0-SNAPSHOT" conf="binaries->default"/>
    ```

=== "Maven"

    ```xml
    <dependency>
        <groupId>org.eclipse.emfatic</groupId>
        <artifactId>org.eclipse.emfatic.core</artifactId>
        <version>0.8.0-SNAPSHOT</version>
    </dependency>
    ```

=== "Gradle"
    
    ```groovy
    epsilon 'org.eclipse.emfatic:org.eclipse.emfatic.core:0.8.0-SNAPSHOT'
    ```

## Epsilon 1.x

If you would like to use an older (1.x) version of Epsilon, you can use [this example instead](https://git.eclipse.org/c/epsilon/org.eclipse.epsilon.git/tree/examples/org.eclipse.epsilon.examples.workflow.standalone.1x), which uses a fat jar we used to produce (`epsilon-1.x-kitchensink.jar`) before moving all our jars to Maven Central/Sonatype.

