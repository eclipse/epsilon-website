package org.eclipse.epsilon.examples;

import java.io.File;

import org.eclipse.emf.ecore.resource.Resource;
import org.eclipse.emf.emfatic.core.EmfaticResourceFactory;
import org.eclipse.epsilon.emc.emf.EmfModel;
import org.eclipse.epsilon.epl.EplModule;
import org.eclipse.epsilon.flexmi.FlexmiResourceFactory;

public class Example {
    
    public static void main(String[] args) throws Exception {
        
        // Register the Flexmi and Emfatic parsers with EMF
        Resource.Factory.Registry.INSTANCE.getExtensionToFactoryMap().put("flexmi", new FlexmiResourceFactory());
        Resource.Factory.Registry.INSTANCE.getExtensionToFactoryMap().put("emf", new EmfaticResourceFactory());
        
        // Parse the EPL pattern matching rules
        EplModule module = new EplModule();
        module.parse(new File("program.epl"));
        
        // Load the model from model.flexmi using metamodel.emf as its metamodel
        EmfModel model = new EmfModel();
        model.setName("M");
        model.setModelFile("model.flexmi");
        model.setMetamodelFile("metamodel.emf");
        model.setReadOnLoad(true);
        model.setStoredOnDisposal(false);
        model.load();
        
        // Make the model available to the program
        module.getContext().getModelRepository().addModel(model);
        
        // Execute the EPL pattern matching rules
        module.execute();

        // Print the patterns found
        module.getContext().getPatternMatchTrace().getMatches().forEach(match -> {
            // Print the name of the pattern
            System.out.println(match.getPattern().getName());
            // Print the model elements involved in the match
            match.getRoleBindings().forEach((key, value) -> {
                System.out.println("\t" + key + " = " + value);
            });
        });
        
        // Dispose of the model
        module.getContext().getModelRepository().dispose();
    }
}