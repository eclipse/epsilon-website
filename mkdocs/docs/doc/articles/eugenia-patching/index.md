# Customizing the Java source code generated by Eugenia

Occasionally, the Java source code generated by GMF to implement your graphical editor is not quite what you want, and it's not possible to [polish](../eugenia-polishing) the GMF models to incorporate your desired changes. Essentially, you'd like to change the code generation templates used by GMF.

In this situation, you have two options. The first option is to use [GMF dynamic templates](http://www.bonitasoft.org/blog/eclipse/customize-your-gmf-editor-by-customizing-templates/), which requires some knowledge of Xpand (the code generation language used by GMF) and can often involve hunting around in the GMF code generator for the right place to make your changes. Alternatively, you can use Eugenia's patch generation and application functionality (described below).

## Running example

The remainder of this article demonstrates how to customize the source code for a generated GMF editor to change the size of the margins used for external labels. As shown below, the patched version of the GMF editor positions labels closer to their nodes:

![](example.png)

Note that the models used by GMF to generate our editor don't provide a way to control the size of the margins, so we can't use a polishing transformation.

### Automatically patching the source code of a generated GMF editor

After generating the GMF code for your editor, Eugenia will search for a `patches` directory in the same project as your Emfatic source. If the patches directory is found, Eugenia will apply to your workspace any `.patch` file found in that directory.

![](patches.png)

### Creating and applying patches with Eugenia

Create `.patch` files using Eclipse's Team functionality:

- Make your desired changes to the generated Java source code by hand.

- Right-click the project containing your changes, and select
**Team→Create Patch\...**

- Select **Clipboard** and click **Finish**

- Create a `patches` directory in the project containing your Emfatic
source.

- Create a new file (e.g. `patches/MyChanges.patch`), paste your patch
into the new file and save it.

- The next time that you run EuGEnia, your `.patch` file will be
automatically applied to the generated Java source code.

- You can also apply or remove all of your patches by right-clicking your `patches` directory and selecting **Eugenia→Apply patches** or
**Eugenia→Remove applied patches.**

In our running example, we devise the patch below to fix the margins of
externally placed labels for the **State** model element type. We save
the patch into `patches/FixExternalLabelMarginsForState.patch`

```
diff --git org.eclipse.epsilon.eugenia.examples.executablestatemachine.graphical.diagram/src/esm/diagram/edit/parts/StateEditPart.java org.eclipse.epsilon.eugenia.examples.executablestatemachine.graphical.diagram/src/esm/diagram/edit/parts/StateEditPart.java
index d0684d6..f162365 100644
--- org.eclipse.epsilon.eugenia.examples.executablestatemachine.graphical.diagram/src/esm/diagram/edit/parts/StateEditPart.java
+++ org.eclipse.epsilon.eugenia.examples.executablestatemachine.graphical.diagram/src/esm/diagram/edit/parts/StateEditPart.java
@@ -143,7 +143,7 @@
     if (borderItemEditPart instanceof StateNameEditPart) {
       BorderItemLocator locator = new BorderItemLocator(getMainFigure(),
           PositionConstants.SOUTH);
-      locator.setBorderItemOffset(new Dimension(-20, -20));
+      locator.setBorderItemOffset(new Dimension(-5, -5));
       borderItemContainer.add(borderItemEditPart.getFigure(), locator);
     } else {
       super.addBorderItem(borderItemContainer, borderItemEditPart);
```

### Generating patches with Eugenia

It is possible to generate `.patch` files as part of the Eugenia code generation process. This allows you to include in `.patch` files information from your source metamodel, or from the GMF models generated by Eugenia. Generating `.patch` files is particularly useful when you want to apply the same type of change in several places in the Java source code for your GMF editor:

- Create a file named `GeneratePatches.egx` in the same directory as your Emfatic source code.

- In the `GeneratePages.egx` file, write a transformation rule for each element of the ECore or GMF models for which you want to generate a `.patch` file:

- Create one or more EGL templates for use by your `GeneratePages.egx` file. Each EGL template is essentially a parameterised `.patch` file.

- The next time that you run EuGEnia, your `GeneratePatches.egx` file will be automatically invoked to generate one or more `.patch` files, which will then be automatically applied to the generated Java source code.

- You can also test your `GeneratePatches.egx` file, by right-clicking it and selecting **Eugenia→Generate patches.**

In our running example, we can generalise our **State** patch (above) such that it is applied to any element in our metamodel that has an external label. First, we create a `GeneratePatches.egx` file that produces a `.patch` file for every EClass in our ECore file that is annotated with `label.placement` set to `external`:

```egx
// Imports the EClass#getLabelPlacement() operation from Eugenia
import "platform:/plugin/org.eclipse.epsilon.eugenia/transformations/ECoreUtil.eol";

rule FixExternalLabelMargins
  // apply this rule to all EClasses where...
  transform c : ECore!EClass
{

  // ... the EClass is annotated with @gmf.node(label.placement="external")
  guard: c.getLabelPlacement() == "external"

  // invoke the following EGL template on the EClass
  template : "FixExternalLabelMargin.egl"

  // make the source directory and name of the node available to the template
  parameters : Map{ "srcDir" = getSourceDirectory(), "node" = c.name }

  // and save the generated text to the following .patch file
  target : "FixExternalLabelMarginsFor" + c.name + ".patch"
}

// Determine source directory from GMF Gen model
@cache
operation getSourceDirectory() {
  var genEditor = GmfGen!GenEditorGenerator.all.first;
  return genEditor.pluginDirectory.substring(1) + "/" +
         genEditor.packageNamePrefix.replace("\\.", "/");
}
```

We'll also need to provide a parameterised version of our **State**
patch, saving it as an EGL template at `FixExternalLabelMargin.egl`:

```
diff --git [%=srcDir%]/edit/parts/[%=node%]EditPart.java [%=srcDir%]/edit/parts/[%=node%]EditPart.java
index d0684d6..f162365 100644
--- [%=srcDir%]/edit/parts/[%=node%]EditPart.java
+++ [%=srcDir%]/edit/parts/[%=node%]EditPart.java
@@ -143,7 +143,7 @@
     if (borderItemEditPart instanceof [%=node%]NameEditPart) {
       BorderItemLocator locator = new BorderItemLocator(getMainFigure(),
           PositionConstants.SOUTH);
-      locator.setBorderItemOffset(new Dimension(-20, -20));
+      locator.setBorderItemOffset(new Dimension(-5, -5));
       borderItemContainer.add(borderItemEditPart.getFigure(), locator);
     } else {
       super.addBorderItem(borderItemContainer, borderItemEditPart);
```
Note that the above template uses the `srcDir` and `node` variables made
available by our EGX transformation rule.

The next time that Eugenia is invoked, a `.patch` file is generated and
applied for every EClass in our ECore file that has an externally-placed
label:

![](patches.png)

### FAQ

#### Should my patches produce `@generated NOT` annotations?

No, because this can cause subsequent invocations of Eugenia and the GMF code generator to fail \-- the GMF code generator will attempt to preserve code marked as `@generated NOT` and your `.patch` files will likely not apply cleanly to the code that has been preserved. The code that is applied via `.patch` files **is** generated code and should be treated as such.

#### One or more of my patches couldn't be applied. What should I do?

Firstly, check to ensure that Eclipse can apply your patch via the **Team→Apply patch\...** menu item. If not, you'll need to fix your .patch file. Secondly, ensure that the order in which your patches are being applied is not causing problems. By default Eugenia orders patches alphabetically by filename: `a.patch` will be applied before `z.patch`

#### I'm using `git-svn` and my patch files can't be applied by Eugenia or by Eclipse's **Team→Apply patch...** menu item. What should I do?

You should edit the headers of any patch file generated by `git-svn` and remove the dummy `a` and `b` folders. For example:*

```
diff --git a/org.eclipse.epsilon.eugenia.examples.executablestatemachine.graphical.diagram/src/esm/diagram/edit/parts/EndStateEditPart.java b/org.eclipse.epsilon.eugenia.examples.executablestatemachine.graphical.diagram/src/esm/diagram/edit/parts/EndStateEditPart.java
index 65e2685..109b568 100644
--- a/org.eclipse.epsilon.eugenia.examples.executablestatemachine.graphical.diagram/src/esm/diagram/edit/parts/EndStateEditPart.java
+++ b/org.eclipse.epsilon.eugenia.examples.executablestatemachine.graphical.diagram/src/esm/diagram/edit/parts/EndStateEditPart.java
@@ -152,6 +152,8 @@
...
```

becomes:

```
diff --git org.eclipse.epsilon.eugenia.examples.executablestatemachine.graphical.diagram/src/esm/diagram/edit/parts/EndStateEditPart.java org.eclipse.epsilon.eugenia.examples.executablestatemachine.graphical.diagram/src/esm/diagram/edit/parts/EndStateEditPart.java
index 65e2685..109b568 100644
--- org.eclipse.epsilon.eugenia.examples.executablestatemachine.graphical.diagram/src/esm/diagram/edit/parts/EndStateEditPart.java
+++ org.eclipse.epsilon.eugenia.examples.executablestatemachine.graphical.diagram/src/esm/diagram/edit/parts/EndStateEditPart.java
@@ -152,6 +152,8 @@
...
```