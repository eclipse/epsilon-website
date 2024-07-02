class EditorValidator {

    cj;
    onReadyListeners = [];
    validator;

    constructor() {
        this.init();
    }

    async init() {
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

        var annotationsJson = await this.validator.validateEmfatic(editor.getValue());
        this.setEditorAnnotations(editor, annotationsJson);
    
    }

    async validateFlexmiEditor(flexmiEditor, emfaticEditor) {
        //console.log("Flexmi: " + flexmiEditor.getValue());
        //console.log("Emfatic: " + emfaticEditor.getValue());

        if (! this.cj) return;

        try {
        var annotationsJson = await this.validator.validateFlexmi(flexmiEditor.getValue(), emfaticEditor.getValue());
        this.setEditorAnnotations(flexmiEditor, annotationsJson);
        }
        catch (err) {
            console.log(err);
            //console.log(await err.getMessage());
            //console.log(err.getException());
            //console.log(err.getMessage());
        }
    }

    async validateProgramEditor(editor, language) {
        if (! this.cj) return;

        var annotationsJson = await this.validator.validateProgram(editor.getValue(), language);
        this.setEditorAnnotations(editor, annotationsJson);
    }

    setEditorAnnotations(editor, annotationsJson) {
        // Only set editor annotations if they have actually changed
        if (annotationsJson != JSON.stringify(editor.getSession().getAnnotations())) {
            editor.getSession().clearAnnotations();
            editor.getSession().setAnnotations(JSON.parse(annotationsJson));
        }
    }

}

export { EditorValidator };