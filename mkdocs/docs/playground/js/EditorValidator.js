class EditorValidator {

    cj;

    constructor() {
        this.init();
    }

    async init() {
        console.log("init");
        await cheerpjInit();
        this.cj = await cheerpjRunLibrary("/app/playground/java/target/epsilon.jar");
    }

    async validateProgramEditor() {

    }

    async validate(editor) {
        if (! this.cj) {
            console.log("Not ready yet!");
            return;
        }

        editor.session.clearAnnotations();
        
        const JavaEditorValidator = await this.cj.org.eclipse.epsilon.playground.EditorValidator;
        const validator = await new JavaEditorValidator();
        const result = await validator.validateProgram("", "");
        //console.log(result);

        editor.getSession().setAnnotations(JSON.parse(result));

        //const EolModule = await this.cj.org.eclipse.epsilon.eol.EolModule;
        //const m = await new EolModule();
        //const ok = await m.parse("return 'Hello from Epsilon';", null);
        //const result = await m.execute();
        //console.log(result);
    }

}

export { EditorValidator };