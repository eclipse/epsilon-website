# EuGENia: Nodes with images defined at run-time

This recipe addresses the case where the end-user needs to set an image for each node at runtime (based on Thomas Beyer's solution presented in the GMF newsgroup). For our example, we'll use the Component class.

## Create an attribute to store the image path

First we need to create an `imagePath` attribute that will store the path of the image for each component.

## Set the figure of Component to a custom ComponentFigure

The next step is to set the figure of Component in EuGENia to a custom figure. After those two steps, our definition of Component looks like this:

```emf
@gmf.node(label="name", figure="ccdl.diagram.figures.ComponentFigure", label.placement="external")
class Component {
  attr String name;
  attr String imagePath;
}
```

Once we generate the diagram code, we'll get an error because `ComponentFigure` has not been found. We need to create the `ComponentFigure` class and set its code to the following:

```java
import java.io.File;
import java.util.HashMap;

import org.eclipse.core.resources.IFile;
import org.eclipse.core.resources.ResourcesPlugin;
import org.eclipse.core.runtime.FileLocator;
import org.eclipse.core.runtime.Path;
import org.eclipse.core.runtime.Platform;
import org.eclipse.draw2d.ImageFigure;
import org.eclipse.jface.resource.ImageDescriptor;
import org.eclipse.swt.graphics.Image;

import ccdl.diagram.part.CcdlDiagramEditorPlugin;

public class ComponentFigure extends ImageFigure  {

  static Image unspecified = null;

  public ComponentFigure() {
      if (unspecified == null) {
      unspecified = ImageDescriptor.createFromURL(
               FileLocator.find(
                       Platform.getBundle(CcdlDiagramEditorPlugin.ID),
                       new Path("icons/ComponentDefault.png"), new HashMap()))
                                             .createImage();
      }
  }

  public static Image createImage(String imagePath) {
      try {
          IFile res=(IFile)ResourcesPlugin.getWorkspace().getRoot().
                               findMember(new Path(imagePath));
          File file = new File(res.getRawLocation().toOSString());
          return ImageDescriptor.createFromURL(file.toURI().toURL()).createImage();
      }
      catch (Exception ex) {
          return unspecified;
      }
  }

  public void setImagePath(String imagePath) {

      try {

          if (getImage()!=null && getImage() !=unspecified) {
              getImage().dispose();
          }

          this.setImage(createImage(imagePath));
      }
      catch (Exception ex) {
          ex.printStackTrace();
      }
  }

}
```

## Create the image path property descriptor


The next step is to create the property descriptor for the image path so that we can eventually get a nice browse button in the properties view. To do this we need to create a new class named `ComponentImagePathPropertyDescriptor`.

```java
import org.eclipse.emf.ecore.EAttribute;
import org.eclipse.emf.edit.provider.IItemPropertyDescriptor;
import org.eclipse.gmf.runtime.emf.ui.properties.descriptors.EMFCompositeSourcePropertyDescriptor;
import org.eclipse.jface.viewers.CellEditor;
import org.eclipse.swt.widgets.Composite;

public class ComponentImagePathPropertyDescriptor  extends
        EMFCompositeSourcePropertyDescriptor {

  public ComponentImagePathPropertyDescriptor(Object object,
          IItemPropertyDescriptor itemPropertyDescriptor, String category) {
      super(object, itemPropertyDescriptor, category);
  }

  protected CellEditor doCreateEditor(Composite composite) {
      try {
          if (((EAttribute) getFeature()).getName().equals("imagePath")) {
              return new ComponentImagePathCellEditor(composite);
          }
      }
      catch (Exception ex){}
      return super.doCreateEditor(composite);
  }
}
```

## Create the image path property cell editor

```java
import org.eclipse.core.resources.IFile;
import org.eclipse.core.resources.IResource;
import org.eclipse.core.resources.ResourcesPlugin;
import org.eclipse.jface.viewers.DialogCellEditor;
import org.eclipse.jface.window.Window;
import org.eclipse.swt.widgets.Composite;
import org.eclipse.swt.widgets.Control;
import org.eclipse.ui.dialogs.ResourceListSelectionDialog;

public class ComponentImagePathCellEditor extends DialogCellEditor  {

  public ComponentImagePathCellEditor(Composite parent) {
      super(parent);
  }

  protected Object openDialogBox(Control cellEditorWindow) {

      ResourceListSelectionDialog elementSelector = new ResourceListSelectionDialog(
                  cellEditorWindow.getShell(), ResourcesPlugin.getWorkspace().getRoot(),
                  IResource.DEPTH_INFINITE | IResource.FILE );
      elementSelector.setTitle("Image");
      elementSelector.setMessage("Please select an image");
      elementSelector.open();

      if (elementSelector.getReturnCode() == Window.OK){
          IFile f = (IFile) elementSelector.getResult()[0];
          return f.getFullPath().toString();
      }
      else {
          return null;
      }


  }

}
```

## Update the XXXPropertySection under xxx.diagram.sheet

Update the `getPropertySource` method as follows:

```java
public IPropertySource getPropertySource(Object object) {
  if (object instanceof IPropertySource) {
    return (IPropertySource) object;
  }
  AdapterFactory af = getAdapterFactory(object);
  if (af != null) {
    IItemPropertySource ips = (IItemPropertySource) af.adapt(object,
        IItemPropertySource.class);

    if (ips != null) {

      if (object instanceof Component) {
        return new PropertySource(object, ips) {
          protected IPropertyDescriptor createPropertyDescriptor(
              IItemPropertyDescriptor itemPropertyDescriptor) {

            EStructuralFeature feature = (EStructuralFeature) itemPropertyDescriptor.getFeature(object);

            if(feature.getName().equalsIgnoreCase("imagePath")) {

              return new ComponentImagePathPropertyDescriptor(
                  object, itemPropertyDescriptor, "Misc");


            }
            else {
              return new EMFCompositeSourcePropertyDescriptor(object, itemPropertyDescriptor, "Misc");
            }
          }
        };
      }

      //return new PropertySource(object, ips);
      return new EMFCompositePropertySource(object, ips, "Misc");
    }
  }
  if (object instanceof IAdaptable) {
    return (IPropertySource) ((IAdaptable) object)
        .getAdapter(IPropertySource.class);
  }
  return null;
  }
```

## Modify the edit part

Modify the `handleNotificationEvent` method so that the figure is updated every time the value of `imagePath` changes

```java
protected void handleNotificationEvent(Notification event) {
  if (event.getNotifier() == getModel()
      && EcorePackage.eINSTANCE.getEModelElement_EAnnotations()
          .equals(event.getFeature())) {
    handleMajorSemanticChange();
  } else {

    if (event.getFeature() instanceof EAttribute) {
      EAttribute eAttribute = (EAttribute) event.getFeature();

      if (eAttribute.getName().equalsIgnoreCase("imagePath")) {
        ComponentFigure figure = (ComponentFigure) this.getPrimaryShape();
        figure.setImagePath(event.getNewStringValue());
      }

    }


    super.handleNotificationEvent(event);
  }
}
```

Modify the `createNodeShape` method so that the figure is initialized from the existing `imagePath` the first time.

```java
protected IFigure createNodeShape() {
  primaryShape = new ComponentFigure();
  Component component = (Component) ((Node)getNotationView()).getElement();
  ((ComponentFigure) primaryShape).setImagePath(component.getImagePath());
  return primaryShape;
}
```
