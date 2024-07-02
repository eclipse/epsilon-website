package org.eclipse.epsilon.playground;

import java.io.ByteArrayInputStream;
import java.util.regex.Matcher;
import java.util.regex.Pattern;

import org.eclipse.emf.common.util.URI;
import org.eclipse.emf.ecore.EPackage;
import org.eclipse.emf.ecore.resource.ResourceSet;
import org.eclipse.emf.ecore.resource.impl.ResourceSetImpl;
import org.eclipse.emf.emfatic.core.EmfaticResource;
import org.eclipse.epsilon.common.parse.problem.ParseProblem;
import org.eclipse.epsilon.ecl.EclModule;
import org.eclipse.epsilon.egl.EglModule;
import org.eclipse.epsilon.egl.EgxModule;
import org.eclipse.epsilon.emg.EmgModule;
import org.eclipse.epsilon.eml.EmlModule;
import org.eclipse.epsilon.eol.EolModule;
import org.eclipse.epsilon.eol.IEolModule;
import org.eclipse.epsilon.epl.EplModule;
import org.eclipse.epsilon.etl.EtlModule;
import org.eclipse.epsilon.evl.EvlModule;
import org.eclipse.epsilon.flexmi.FlexmiParseException;
import org.eclipse.epsilon.flexmi.FlexmiResource;
import org.eclipse.epsilon.flexmi.FlexmiResourceFactory;
import org.eclipse.epsilon.flock.FlockModule;
import org.eclipse.epsilon.pinset.PinsetModule;
import org.eclipse.gymnast.runtime.core.parser.ParseMessage;
import org.eclipse.gymnast.runtime.core.parser.ParseWarning;
import org.json.JSONArray;
import org.json.JSONObject;

public class EditorValidator {

    public static void main(String[] args) {
        String emfatic = """
                package p; 
                class X { 
                    attr int size; 
                }
                """;
        String flexmi = """
                <?nsuri p?>
                <x size="x"/>
                """;
        
        System.out.println(new EditorValidator().getLineFromOffset(emfatic, 22));

        System.out.println(new EditorValidator().validateFlexmi(flexmi, emfatic));
    }

    public String validateFlexmi(String flexmi, String emfatic) {
        JSONArray annotations = new JSONArray();
        ResourceSet resourceSet = new ResourceSetImpl();
        resourceSet.getResourceFactoryRegistry().getExtensionToFactoryMap().put("flexmi", new FlexmiResourceFactory());
        FlexmiResource resource = (FlexmiResource) resourceSet.createResource(org.eclipse.emf.common.util.URI.createURI("flexmi.flexmi"));
        try {

            EmfaticResource emfaticResource = new EmfaticResource(URI.createURI("emfatic.emf"));
            emfaticResource.load(new ByteArrayInputStream(emfatic.getBytes()), null);
            EPackage ePackage = (EPackage) emfaticResource.getContents().get(0);
            EPackage.Registry.INSTANCE.put(ePackage.getNsURI(), ePackage);

            resource.load(new ByteArrayInputStream(flexmi.getBytes()), null);

            for (org.eclipse.emf.ecore.resource.Resource.Diagnostic diagnostic : resource.getWarnings()) {
                JSONObject annotation = new JSONObject();
                annotation.put("row", diagnostic.getLine() - 1);
                annotation.put("text", diagnostic.getMessage());
                annotation.put("type", "warning");
                annotations.put(annotation);
            }

            for (org.eclipse.emf.ecore.resource.Resource.Diagnostic diagnostic : resource.getErrors()) {
                JSONObject annotation = new JSONObject();
                annotation.put("row", diagnostic.getLine() - 1);
                annotation.put("text", diagnostic.getMessage());
                annotation.put("type", "error");
                annotations.put(annotation);
            }
        }
        catch (FlexmiParseException fex) {
            JSONObject annotation = new JSONObject();
            annotation.put("row", fex.getLineNumber() - 1);
            annotation.put("text", fex.getMessage());
            annotation.put("type", "error");
            annotations.put(annotation);
        }
        catch (Exception ex) {
            return "[]";
        }
        return annotations.toString();
    }

    public String validateEmfatic(String emfatic) throws Exception {

        JSONArray annotations = new JSONArray();
        
        try {
            EmfaticResource resource = new EmfaticResource(URI.createURI("emfatic.emf"));
            try {
                resource.load(new ByteArrayInputStream(emfatic.getBytes()), null);
            }
            catch (Exception ex) { return "[]"; }

            if (resource.getParseContext().hasErrors()) {
                
                for (ParseMessage message : resource.getParseContext().getMessages()) {
                    JSONObject annotation = new JSONObject();
                    annotation.put("row", getLineFromOffset(emfatic, message.getOffset()) - 1);
                    annotation.put("text", message.getMessage() + " / " + message.getClass().getCanonicalName());
                    annotation.put("type", message instanceof ParseWarning ? "warning" : "error");
                    annotations.put(annotation);
                }
            }
        }
        catch (Exception ex) {
            JSONObject annotation = new JSONObject();
            annotation.put("row", 0);
            annotation.put("text", ex.getMessage());
            annotation.put("type", "error");
            annotations.put(annotation);
        }

        return annotations.toString();
    }

    protected int getLineFromOffset(String str, int offset) {
        int line = 1;
        for (int i = 0; i <= offset && i < str.length(); i++) {
            char c = str.charAt(i);
            if (c == '\n') line++;
        }

        return line;
    }

    protected int getRowFromEmfaticParseMessage(String message) {
        Pattern pattern = Pattern.compile("at line (\\d+)");
        Matcher matcher = pattern.matcher(message);
        if (matcher.find()) {
            return Integer.parseInt(matcher.group(1)) - 1;
        }
        else return 0;
    }

    public String validateProgram(String program, String language) {
        
        IEolModule module = null;

        switch (language) {
            case "eol": module = new EolModule(); break;
            case "evl": module = new EvlModule(); break;
            case "etl": module = new EtlModule(); break;
            case "eml": module = new EmlModule(); break;
            case "ecl": module = new EclModule(); break;
            case "epl": module = new EplModule(); break;
            case "emg": module = new EmgModule(); break;
            case "egl": module = new EglModule(); break;
            case "egx": module = new EgxModule(); break;
            case "pinset": module = new PinsetModule();
            case "flock": module = new FlockModule();
        }
        
        if (module == null) return "[]";
    
        JSONArray annotations = new JSONArray();
        
        try { module.parse(program); }
        catch (Exception ex) { /* Ignore for now */ return "[]"; }

        for (ParseProblem problem : module.getParseProblems()) {
            JSONObject annotation = new JSONObject();
            annotation.put("row", problem.getLine() - 1);
            annotation.put("text", problem.getReason());
            annotation.put("type", "error");
            annotations.put(annotation);
        }

        return annotations.toString();
    }

}
