package org.eclipse.epsilon.examples;

import java.io.File;

import org.eclipse.emf.ecore.resource.Resource;
import org.eclipse.emf.emfatic.core.EmfaticResourceFactory;
import org.eclipse.epsilon.emc.emf.EmfModel;
import org.eclipse.epsilon.flexmi.FlexmiResourceFactory;
import org.eclipse.epsilon.flock.FlockModule;

public class Example {
    
    public static void main(String[] args) throws Exception {
        
        // Register the Flexmi and Emfatic parsers with EMF
        Resource.Factory.Registry.INSTANCE.getExtensionToFactoryMap().put("flexmi", new FlexmiResourceFactory());
        Resource.Factory.Registry.INSTANCE.getExtensionToFactoryMap().put("emf", new EmfaticResourceFactory());
        
        // Parse the Flock migration transformation
        FlockModule module = new FlockModule();
        module.parse(new File("program.mig"));
        
        // Load the original model from source.flexmi using source.emf as its metamodel
        EmfModel source = new EmfModel();
        source.setName("Source");
        source.setModelFile("source.flexmi");
        source.setMetamodelFile("source.emf");
        source.setReadOnLoad(true);
        source.setStoredOnDisposal(false);
        source.load();

        // Configure the migrated model using target.emf as its metamodel
        EmfModel target = new EmfModel();
        target.setName("Target");
        // We use XMI instead of Flexmi as the format of the target model as Flexmi is a read-only format
        target.setModelFile("target.xmi");
        target.setMetamodelFile("target.emf");
        target.setReadOnLoad(false);
        target.setStoredOnDisposal(true);
        target.load();

        // Make the models available to the migration transformation
        module.getContext().getModelRepository().addModel(source);
        module.getContext().getModelRepository().addModel(target);

        // Configure the original and migrated models of the migration transformation
        module.getContext().setOriginalModel(source);
        module.getContext().setMigratedModel(target);

        // Execute the Flock migration transformation
        module.execute();

        // Save the target model and dispose of both models
        module.getContext().getModelRepository().dispose();
    }
}