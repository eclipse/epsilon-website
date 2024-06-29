package org.eclipse.epsilon.playground;

public class EditorValidator {

    public String validate() {
        return "hello";
    }

    public String validateProgram(String program, String language) {
        return "[{\"row\": \"1\", \"text\": \"Error in program\", \"type\": \"error\"}]";
    }

}
