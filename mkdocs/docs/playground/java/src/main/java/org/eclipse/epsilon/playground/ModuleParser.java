package org.eclipse.epsilon.playground;

import org.eclipse.epsilon.common.parse.problem.ParseProblem;
import org.eclipse.epsilon.eol.EolModule;
import org.json.JSONArray;
import org.json.JSONObject;

class ModuleParser {

    public String parse(String code) throws Exception {
        EolModule module = new EolModule();
        module.parse(code);

        JSONArray annotations = new JSONArray();
        
        for (ParseProblem problem : module.getParseProblems()) {
            JSONObject annotation = new JSONObject();
            annotation.put("row", problem.getLine() - 1);
            annotation.put("column", problem.getColumn());
            annotation.put("text", problem.getReason());
            annotation.put("type", "error");
            annotations.put(annotation);
        }

        return annotations.toString();
    }

}