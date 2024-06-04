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
        
        // Load the original model from original.flexmi using original.emf as its metamodel
        EmfModel original = new EmfModel();
        original.setName("Original");
        original.setModelFile(new File("original.flexmi").getAbsolutePath());
        original.setMetamodelFile(new File("original.emf").getAbsolutePath());
        original.setReadOnLoad(true);
        original.setStoredOnDisposal(false);
        original.load();

        // Configure the migrated model using migrated.emf as its metamodel
        EmfModel migrated = new EmfModel();
        migrated.setName("Migrated");
        // We use XMI instead of Flexmi as the format of the migrated model as Flexmi is a read-only format
        migrated.setModelFile(new File("migrated.xmi").getAbsolutePath());
        migrated.setMetamodelFile(new File("migrated.emf").getAbsolutePath());
        migrated.setReadOnLoad(false);
        migrated.setStoredOnDisposal(true);
        migrated.load();

        // Make the models available to the migration transformation
        module.getContext().getModelRepository().addModel(original);
        module.getContext().getModelRepository().addModel(migrated);

        // Configure the original and migrated models of the migration transformation
        module.getContext().setOriginalModel(original);
        module.getContext().setMigratedModel(migrated);

        // Execute the Flock migration transformation
        module.execute();

        // Save the migrated model and dispose of both models
        module.getContext().getModelRepository().dispose();
    }
}