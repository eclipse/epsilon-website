class EditorValidator {

    cj;
    onReadyListeners = [];
    validator;

    constructor() {
        this.init();
    }

    async init() {
        console.log("init");
        await cheerpjInit();
        this.cj = await cheerpjRunLibrary("/app/playground/java/target/epsilon.jar");
        const JavaEditorValidator = await this.cj.org.eclipse.epsilon.playground.EditorValidator;
        this.validator = await new JavaEditorValidator();
        
        this.onReadyListeners.forEach(listener => listener.editorValidatorReady());
    }

    addOnReadyListener(onReadyListener) {
        this.onReadyListeners.push(onReadyListener);
    }

    async validateEmfaticEditor(editor) {
        if (! this.cj) return;

        try {
            var annotationsJson = await this.validator.validateEmfatic(editor.getValue());
            this.setEditorAnnotations(editor, annotationsJson);
        }
        catch (err) {
            // When there are no validation errors, validateEmfatic throws an exception in CheerpJ
            // possibly because Emfatic tries to build some data structure and we're missing a class from
            // the classpath (missing dependency)
            this.setEditorAnnotations(editor, "[]");
        }

               
    }

    async validateProgramEditor(editor, language) {
        if (! this.cj) return;

        var annotationsJson = await this.validator.validateProgram(editor.getValue(), language);
        this.setEditorAnnotations(editor, annotationsJson);
    }

    setEditorAnnotations(editor, annotationsJson) {
        //console.log("Existing: " + JSON.stringify(editor.getSession().getAnnotations()));
        //console.log("New: " + JSON.stringify(annotations));
        
        if (annotationsJson != JSON.stringify(editor.getSession().getAnnotations())) {
            //console.log("Setting annotations...");
            editor.session.clearAnnotations();
            editor.getSession().setAnnotations(JSON.parse(annotationsJson));
        }
    }

}

export { EditorValidator };