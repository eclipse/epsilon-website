package org.eclipse.epsilon.examples;

import java.io.File;

import org.eclipse.emf.ecore.resource.Resource;
import org.eclipse.emf.emfatic.core.EmfaticResourceFactory;
import org.eclipse.epsilon.emc.emf.EmfModel;
import org.eclipse.epsilon.eol.EolModule;
import org.eclipse.epsilon.flexmi.FlexmiResourceFactory;

public class Example {
    
    public static void main(String[] args) throws Exception {
        
        // Register the Flexmi and Emfatic parsers with EMF
        Resource.Factory.Registry.INSTANCE.getExtensionToFactoryMap().put("flexmi", new FlexmiResourceFactory());
        Resource.Factory.Registry.INSTANCE.getExtensionToFactoryMap().put("emf", new EmfaticResourceFactory());
        
        // Parse the EOL program
        EolModule module = new EolModule();
        module.parse(new File("program.eol"));
        
        // Load the model from model.flexmi using metamodel.emf as its metamodel
        EmfModel model = new EmfModel();
        model.setName("M");
        model.setModelFile(new File("model.flexmi").getAbsolutePath());
        model.setMetamodelFile(new File("metamodel.emf").getAbsolutePath());
        model.setReadOnLoad(true);
        model.setStoredOnDisposal(false);
        model.load();
        
        // Make the model available to the program
        module.getContext().getModelRepository().addModel(model);
        
        // Execute the EOL program
        module.execute();

        // Dispose of the model
        module.getContext().getModelRepository().dispose();
    }
}