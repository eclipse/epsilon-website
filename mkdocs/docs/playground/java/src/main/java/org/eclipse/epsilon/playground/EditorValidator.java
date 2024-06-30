package org.eclipse.epsilon.playground;

import java.io.ByteArrayInputStream;

import org.eclipse.emf.common.util.URI;
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
import org.eclipse.epsilon.flock.FlockModule;
import org.eclipse.epsilon.pinset.PinsetModule;
import org.eclipse.gymnast.runtime.core.parser.ParseMessage;
import org.json.JSONArray;
import org.json.JSONObject;

public class EditorValidator {

    public String validateEmfatic(String emfatic) {

        try {
            EmfaticResource emfaticResource = new EmfaticResource(URI.createURI("emfatic.emf"));
            try {
                emfaticResource.load(new ByteArrayInputStream(emfatic.getBytes()), null);
            }
            catch (Exception ex) { return "[]"; }

            if (emfaticResource.getParseContext().hasErrors()) {
                JSONArray annotations = new JSONArray();
            
                for (ParseMessage message : emfaticResource.getParseContext().getMessages()) {
                    JSONObject annotation = new JSONObject();
                    annotation.put("row", 0);
                    annotation.put("text", message.getMessage());
                    annotation.put("type", "error");
                    annotations.put(annotation);
                }

                return annotations.toString();
            }
        }
        catch (Exception ex) {
            return ex.getMessage();
        }

        return "[]";
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
