package org.eclipse.epsilon.examples;

import java.io.File;

import org.eclipse.emf.ecore.resource.Resource;
import org.eclipse.emf.emfatic.core.EmfaticResourceFactory;
import org.eclipse.epsilon.ecl.EclModule;
import org.eclipse.epsilon.emc.emf.EmfModel;
import org.eclipse.epsilon.eml.EmlModule;
import org.eclipse.epsilon.flexmi.FlexmiResourceFactory;

public class Example {
    
    public static void main(String[] args) throws Exception {
        
        // Register the Flexmi and Emfatic parsers with EMF
        Resource.Factory.Registry.INSTANCE.getExtensionToFactoryMap().put("flexmi", new FlexmiResourceFactory());
        Resource.Factory.Registry.INSTANCE.getExtensionToFactoryMap().put("emf", new EmfaticResourceFactory());

        // Parse the ECL matching rules
        EclModule eclModule = new EclModule();
        eclModule.parse("program.ecl");

        // Parse the EML merging rules
        EmlModule emlModule = new EmlModule();
        emlModule.parse(new File("program.eml"));
        
        // Load the left model from left.flexmi using left.emf as its metamodel
        EmfModel left = new EmfModel();
        left.setName("Left");
        left.getAliases().add("Source");
        left.setModelFile("left.flexmi");
        left.setMetamodelFile("left.emf");
        left.setReadOnLoad(true);
        left.setStoredOnDisposal(false);
        left.load();

        // Load the left model from left.flexmi using left.emf as its metamodel
        EmfModel right = new EmfModel();
        right.setName("Right");
        right.getAliases().add("Source");
        right.setModelFile("right.flexmi");
        right.setMetamodelFile("right.emf");
        right.setReadOnLoad(true);
        right.setStoredOnDisposal(false);
        right.load();

        // Configure the merged model using target.emf as its metamodel
        EmfModel merged = new EmfModel();
        merged.setName("Merged");
        merged.getAliases().add("Target");
        // We use XMI instead of Flexmi as the format of the merged model as Flexmi is a read-only format
        merged.setModelFile("merged.xmi");
        merged.setMetamodelFile("target.emf");
        merged.setReadOnLoad(false);
        merged.setStoredOnDisposal(true);
        merged.load();

        // Make the left and right models available to the comparison rules
        eclModule.getContext().getModelRepository().addModels(left, right);

        // Execute the comparison
        eclModule.execute();

        // Pass the match trace, which records matches found by ECL
        // to the merging program
        emlModule.getContext().setMatchTrace(eclModule.getContext().getMatchTrace().getReduced());

        // Make all models available to the merging rules
        // Make the left and right models available to the comparison rules
        emlModule.getContext().getModelRepository().addModels(left, right, merged);

        // Execute the EML merging rules
        emlModule.execute();

        // Save the target model and dispose of both models
        emlModule.getContext().getModelRepository().dispose();
    }
}