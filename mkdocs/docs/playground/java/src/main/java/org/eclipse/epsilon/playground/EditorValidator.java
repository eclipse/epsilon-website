package org.eclipse.epsilon.playground;

import java.io.BufferedReader;
import java.io.ByteArrayInputStream;
import java.io.InputStreamReader;
import java.util.regex.Matcher;
import java.util.regex.Pattern;

import org.eclipse.emf.common.util.URI;
import org.eclipse.emf.ecore.util.EcoreValidator;
import org.eclipse.emf.emfatic.core.EmfaticResource;
import org.eclipse.emf.emfatic.core.lang.gen.parser.EmfaticParserDriver;
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
import org.eclipse.epsilon.flock.FlockModule;
import org.eclipse.epsilon.pinset.PinsetModule;
import org.eclipse.gymnast.runtime.core.parser.ParseContext;
import org.eclipse.gymnast.runtime.core.parser.ParseMessage;
import org.json.JSONArray;
import org.json.JSONObject;

public class EditorValidator {

    public static void main(String[] args) {
        String emfatic = "package p";
        System.out.println(new EditorValidator().validateEmfatic(emfatic));
    }

    public String validateEmfatic(String emfatic) {

        JSONArray annotations = new JSONArray();
        
        try {
            EmfaticResource emfaticResource = new EmfaticResource(URI.createURI("emfatic.emf"));
            try {
                emfaticResource.load(new ByteArrayInputStream(emfatic.getBytes()), null);
            }
            catch (Exception ex) { return "[]"; }

            if (emfaticResource.getParseContext().hasErrors()) {
                
                for (ParseMessage message : emfaticResource.getParseContext().getMessages()) {
                    JSONObject annotation = new JSONObject();
                    annotation.put("row", getRowFromEmfaticParseMessage(message.getMessage())); // Search the message as it mentions the line at the end
                    annotation.put("text", message.getMessage());
                    annotation.put("type", "error");
                    annotations.put(annotation);
                }
            }
            else {
                return "[]";
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

    protected int getRowFromEmfaticParseMessage(String message) {
        Pattern pattern = Pattern.compile("at line (\\d+)");
        Matcher matcher = pattern.matcher(message);
        matcher.find();
        return Integer.parseInt(matcher.group(1)) - 1;
    }

    public String validateFlexmi(String flexmi, String emfatic) {
        return "[]";
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
