# Running Epsilon's ANT Tasks from the Command Line

[This example project](https://git.eclipse.org/c/epsilon/org.eclipse.epsilon.git/tree/examples/org.eclipse.epsilon.examples.workflow.standalone.ivy) shows how to download, configure and run [Epsilon's ANT tasks](../../workflow) from the command line. To run this example, you only need to have [Apache ANT](https://ant.apache.org) installed in your system. When you run the `ant` command in the root directory of the project, the following will happen:

- The build file (`build.xml`) will download [Apache Ivy](https://ant.apache.org/ivy/) in a temporary directory
- Ivy will fetch the required Epsilon jars (also in a temporary directory) from Maven Central/Sonatype
- The build file will set up Epsilon's ANT tasks
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

The complete source code is below and in [Epsilon's Git repo](https://git.eclipse.org/c/epsilon/org.eclipse.epsilon.git/tree/examples/org.eclipse.epsilon.examples.workflow.standalone.ivy).

=== "build.xml"

    ```xml
    {{{ example("org.eclipse.epsilon.examples.workflow.standalone.ivy/build.xml", true) }}}
    ```

=== "ivy.xml"

    ```xml
    {{{ example("org.eclipse.epsilon.examples.workflow.standalone.ivy/ivy.xml", true) }}}
    ```

=== "ivysettings.xml"

    ```xml
    {{{ example("org.eclipse.epsilon.examples.workflow.standalone.ivy/ivysettings.xml", true) }}}
    ```

### Maven

Since Maven can run ANT tasks, Epsilon ANT tasks can also be executed from a Maven build as shown below.

=== "pom.xml"

    ```xml
    {{{ example("org.eclipse.epsilon.examples.workflow.standalone.ivy/pom.xml", true) }}}
    ```

## Epsilon 1.x

If you would like to use an older (1.x) version of Epsilon, you can use [this example instead](https://git.eclipse.org/c/epsilon/org.eclipse.epsilon.git/tree/examples/org.eclipse.epsilon.examples.workflow.standalone), which uses a fat jar we used to produce (`epsilon-1.x-kitchensink.jar`) before moving all our jars to Maven Central/Sonatype.

