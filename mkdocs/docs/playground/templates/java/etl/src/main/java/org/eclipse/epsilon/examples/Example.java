package org.eclipse.epsilon.examples;

import java.io.File;

import org.eclipse.emf.ecore.resource.Resource;
import org.eclipse.emf.emfatic.core.EmfaticResourceFactory;
import org.eclipse.epsilon.emc.emf.EmfModel;
import org.eclipse.epsilon.etl.EtlModule;
import org.eclipse.epsilon.flexmi.FlexmiResourceFactory;

public class Example {
    
    public static void main(String[] args) throws Exception {
        
        // Register the Flexmi and Emfatic parsers with EMF
        Resource.Factory.Registry.INSTANCE.getExtensionToFactoryMap().put("flexmi", new FlexmiResourceFactory());
        Resource.Factory.Registry.INSTANCE.getExtensionToFactoryMap().put("emf", new EmfaticResourceFactory());
        
        // Parse the ETL transformation
        EtlModule module = new EtlModule();
        module.parse(new File("program.etl"));
        
        // Load the source model from source.flexmi using source.emf as its metamodel
        EmfModel source = new EmfModel();
        source.setName("Source");
        source.setModelFile(new File("source.flexmi").getAbsolutePath());
        source.setMetamodelFile(new File("source.emf").getAbsolutePath());
        source.setReadOnLoad(true);
        source.setStoredOnDisposal(false);
        source.load();

        // Configure the target model using target.emf as its metamodel
        EmfModel target = new EmfModel();
        target.setName("Target");
        // We use XMI instead of Flexmi as the format of the target model as Flexmi is a read-only format
        target.setModelFile(new File("target.xmi").getAbsolutePath());
        target.setMetamodelFile(new File("target.emf").getAbsolutePath());
        target.setReadOnLoad(false);
        target.setStoredOnDisposal(true);
        target.load();

        // Make the models available to the transformation
        module.getContext().getModelRepository().addModel(source);
        module.getContext().getModelRepository().addModel(target);

        // Execute the ETL transformation
        module.execute();

        // Save the target model and dispose of both models
        module.getContext().getModelRepository().dispose();
    }
}