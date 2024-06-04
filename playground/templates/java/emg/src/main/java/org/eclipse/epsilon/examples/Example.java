package org.eclipse.epsilon.examples;

import java.io.File;

import org.eclipse.emf.ecore.resource.Resource;
import org.eclipse.emf.emfatic.core.EmfaticResourceFactory;
import org.eclipse.epsilon.emc.emf.EmfModel;
import org.eclipse.epsilon.emg.EmgModule;
import org.eclipse.epsilon.flexmi.FlexmiResourceFactory;

public class Example {

    public static void main(String[] args) throws Exception {

        // Register the Flexmi and Emfatic parsers with EMF
        Resource.Factory.Registry.INSTANCE.getExtensionToFactoryMap().put("flexmi", new FlexmiResourceFactory());
        Resource.Factory.Registry.INSTANCE.getExtensionToFactoryMap().put("emf", new EmfaticResourceFactory());

        // Parse the EMG program
        EmgModule module = new EmgModule();
        module.parse(new File("program.emg"));

        // Create a model in model.xmi using metamodel.emf as its metamodel
        EmfModel model = new EmfModel();
        model.setName("Model");
        // We use XMI instead of Flexmi as the format of the target model as Flexmi is a read-only format
        model.setModelFile(new File("model.xmi").getAbsolutePath());
        model.setMetamodelFile(new File("metamodel.emf").getAbsolutePath());
        model.setReadOnLoad(false);
        model.setStoredOnDisposal(true);
        model.load();

        // Make the models available to the generation
        module.getContext().getModelRepository().addModel(model);

        // Execute the EMG program
        module.execute();

        // Save the target model and dispose of both models
        module.getContext().getModelRepository().dispose();
    }
}