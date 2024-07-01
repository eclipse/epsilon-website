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

        editor.session.clearAnnotations();
        
        try {
            const result = await this.validator.validateEmfatic(editor.getValue());
            // console.log(result);
            editor.getSession().setAnnotations(JSON.parse(result));
        }
        catch (err) {
            // When there are no validation errors, validateEmfatic throws an exception in CheerpJ
            // possibly because Emfatic tries to build some data structure and we're missing a class from
            // the classpath (missing dependency)
        }

               
    }

    async validateProgramEditor(editor, language) {
        if (! this.cj) return;

        editor.session.clearAnnotations();

        const result = await this.validator.validateProgram(editor.getValue(), language);
        // console.log(result);

        editor.getSession().setAnnotations(JSON.parse(result));
    }

}

export { EditorValidator };