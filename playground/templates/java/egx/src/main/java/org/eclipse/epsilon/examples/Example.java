package org.eclipse.epsilon.examples;

import java.io.File;

import org.eclipse.emf.ecore.resource.Resource;
import org.eclipse.emf.emfatic.core.EmfaticResourceFactory;
import org.eclipse.epsilon.egl.EgxModule;
import org.eclipse.epsilon.emc.emf.EmfModel;
import org.eclipse.epsilon.flexmi.FlexmiResourceFactory;

public class Example {
    
    public static void main(String[] args) throws Exception {
        
        // Register the Flexmi and Emfatic parsers with EMF
        Resource.Factory.Registry.INSTANCE.getExtensionToFactoryMap().put("flexmi", new FlexmiResourceFactory());
        Resource.Factory.Registry.INSTANCE.getExtensionToFactoryMap().put("emf", new EmfaticResourceFactory());

        // Parse the EGX transformation and configure it to produce
        // its output files in the root directory of the project
        EgxModule module = new EgxModule(new File(".").getAbsolutePath());
        module.parse(new File("program.egx"));
        
        // Load the model from model.flexmi using metamodel.emf as its metamodel
        EmfModel model = new EmfModel();
        model.setName("M");
        model.setModelFile("model.flexmi");
        model.setMetamodelFile("metamodel.emf");
        model.setReadOnLoad(true);
        model.setStoredOnDisposal(false);
        model.load();
        
        // Make the model available to the transformation
        module.getContext().getModelRepository().addModel(model);
        
        // Execute the EGX transformation
        module.execute();

        // Dispose of the model
        module.getContext().getModelRepository().dispose();
    }
}