# Call Java from Epsilon

Model management languages such as those provided by Epsilon are by design not general purpose languages. Therefore, there are features that such languages do not support inherently (mainly because such features are typically not needed in the context of model management). However, there are cases where a feature that is not built-in may be necessary for a specific task. 

To address such issues and enable developers to implement non-standard functionality, Epsilon supports the Tool concept. A tool is a normal Java class that (optionally) conforms to a specific interface (`org.eclipse.epsilon.eol.tools.ITool`) and which can be instantiated and accessed from the context of an EOL (or any other EOL-based language such as EML, ETL, EVL etc) program. After instantiation, EOL can be used to invoke methods and access properties of the object. In this article we show how to create and declare a new tool (`org.eclipse.epsilon.examples.tools.SampleTool`), and then use it from an EOL program.

### Create the tool

The first step is to create a new plugin project named `org.eclipse.epsilon.examples.tools`. Then create a class named `SampleTool` with the following content.

```java
package org.eclipse.epsilon.examples.tools;

public class SampleTool {
  
  protected String name;
  
  public void setName(String name) {
    this.name = name;
  }
  
  public String getName() {
    return name;
  }
  
  public String sayHello() {
    return "Hello " + name;
  }
  
}
```

### Declare the tool

-   Add `org.eclipse.epsilon.common.dt` to the dependencies of your plugin
-   Create an extension to the `org.eclipse.epsilon.common.dt.tool`
extension point
-   Set the class to `org.eclipse.epsilon.examples.tools.SampleTool`
-   Set the name to `SampleTool`
-   Add `org.eclipse.epsilon.examples.tools` to the exported packages list in the Runtime tab

### Invoke the tool

To invoke the tool you have two options: You can either run a new Eclipse instance, or export the plugin and place it in the `dropins` folder of your installation. Then you can invoke the tool using the following EOL program.

```eol
var sampleTool = 
  new Native("org.eclipse.epsilon.examples.tools.SampleTool");
sampleTool.name = "George";
sampleTool.sayHello().println(); // Prints Hello George
```

### Standalone setup

To use tools contributed via extensions in a standalone Java setup within Eclipse you'll need to add the following line of code.

```java
context.getNativeTypeDelegates().
  add(new ExtensionPointToolNativeTypeDelegate());
```

You can get the source code of this example
[here](https://github.com/eclipse/epsilon/tree/main/examples/org.eclipse.epsilon.examples.tools).
