# Documentation

Epsilon is a family of languages and tools for code generation,
model-to-model transformation, model validation, comparison, migration
and refactoring that work out-of-the-box with EMF [and other types
of](emc) of models.

At the core of Epsilon is the [Epsilon Object Language (EOL)](eol), an
imperative model-oriented language that combines the procedural style of
JavaScript with the powerful model querying capabilities of OCL.

<style>
td {
	border : 1px solid #808080;
	text-align: center;
	padding:5px;
}
.separator {
	border : 0px;
	padding-top:10px;
	padding-bottom:10px;
}
.driver{
	background-color: #E8E8E8;
}
</style>
<table class="table" style="width:100%;table-layout:fixed;margin-top:10px;margin-bottom:10px">
<tr>
	<td colspan="4">Model Refactoring (EWL)</td>
	<td colspan="4">Model comparison (ECL)</td>
	<td colspan="3">Unit testing (EUnit)</td>
	<td colspan="1">...</td>
</tr>
<tr>
	<td colspan="4">Pattern matching (EPL)</td>
	<td colspan="4">Model merging (EML)</td>
	<td colspan="4">Model migration (Flock)</td>
</tr>
<tr>
	<td colspan="4">Model validation (EVL)</td>

	<td colspan="4">Code generation (EGL)</td>
	<td colspan="4">Model transformation (ETL)</td>
</tr>
<tr>
	<td colspan="12" class="separator"> &darr; extend </td>
</tr>
<tr>
	<td colspan="12" style="background-color:#494949;color:white;">Epsilon Object Language (EOL)</td>
</tr>
<tr>
	<td colspan="12" style="background-color:#1E1E1E;color:white">Epsilon Model Connectivity (EMC)</td>
</tr>
<tr>
	<td colspan="12" class="separator"> &uarr; implement </td>
</tr>
<tr>
	<td colspan="6" class="driver">Eclipse Modeling Framework (EMF)</td>
	<td colspan="2" class="driver">Simulink</td>
	<td colspan="4" class="driver">PTC Integrity Modeller</td>
</tr>
<tr>
	<td colspan="4" class="driver">Excel/Google Spreadsheets</td>
	<td colspan="2" class="driver">GraphML</td>
	<td colspan="4" class="driver">Schema-less XML</td>
	<td colspan="2" class="driver">CSV</td>
</tr>
<tr>
	<td colspan="2" class="driver">Z (CZT)</td>
	<td colspan="3" class="driver">ArgoUML</td>
	<td colspan="2" class="driver">MongoDB</td>
	<td colspan="3" class="driver">CDO</td>
	<td colspan="2" class="driver">JSON</td>
</tr>
<tr>
	<td colspan="3" class="driver">XSD-backed XML</td>
	<td colspan="2" class="driver">MySQL</td>
	<td colspan="3" class="driver">MetaEdit+</td>
	<td colspan="4" class="driver">...</td>
</tr>	
</table>

### Task-Specific Languages

Epsilon provides several task-specific languages, which use EOL as an expression language. Each task-specific language provides constructs and syntax that are tailored to the specific task. The task-specific languages provided by Epsilon are:

-   [Epsilon Transformation Language (ETL)](etl): A rule-based model-to-model transformation language that supports transforming many input to many output models, rule inheritance, lazy and greedy rules, and the ability to query and modify both input and output models.
-   [Epsilon Validation Language (EVL)](evl): A model validation language that supports both intra and inter-model consistency checking, constraint dependency management and specifying fixes that users can invoke to repair identified inconsistencies. EVL is integrated with EMF/GMF and as such, EVL constraints can be evaluated from within EMF/GMF editors and generate error markers for failed constraints.
-   [Epsilon Generation Language (EGL)](egl): A template-based model-to-text language for generating code, documentation and other textual artefacts from models. EGL supports content-destination decoupling, protected regions for mixing generated with hand-written code. EGL also provides a rule-based coordination language ([EGX](egx)), that allows specific EGL templates to be executed for a specific model element type, with the ability to guard rule execution and specify generation target location by type/element.
-   [Epsilon Wizard Language (EWL)](ewl): A language tailored to interactive in-place model transformations on model elements selected by the user. EWL is integrated with EMF/GMF and as such, wizards can be executed from within EMF and GMF editors.
-   [Epsilon Comparison Language (ECL)](ecl): A rule-based language for discovering correspondences (matches) between elements of models of diverse metamodels.
-   [Epsilon Merging Language (EML)](eml): A rule-based language for merging models of diverse metamodels, after first identifying their correspondences with [ECL](ecl) (or otherwise).
-   [Epsilon Pattern Language (EPL)](epl): A pattern language for matching model elements based on element relations and characteristics.
-   [Epsilon Model Generation Language (EMG)](emg): A language for semi-automated model generation.
-   [Epsilon Flock](flock): A rule-based transformation language for updating models in response to metamodel changes.
-   [EUnit](eunit): EUnit is a unit testing framework specialized on testing model management tasks, such as model-to-model transformations, model-to-text transformations or model validation. It is based on Epsilon, but it can be used for model technologies external to Epsilon. Tests are written by combining an EOL script and an [ANT](workflow) buildfile.

### Tools

In addition to the languages above, Epsilon also provides several tools
and utilities for working with models.

-   [EuGENia](eugenia): EuGENia is a front-end for GMF. Its aim is to speed up the process of developing a GMF editor and lower the entrance barrier for new developers. To this end, EuGENia enables developers to generate a fully-functional GMF editor only by specifying a few high-level annotations in the Ecore metamodel. 
-   [Exeed](exeed): Exeed is an enhanced version of the built-in EMF reflective tree-based editor that enables developers to customize the labels and icons of model elements simply by attaching a few simple annotations to the respective EClasses in the Ecore metamodel. Exeed also supports setting the values of references using drag-and-drop instead of using the combo boxes in the properties view.
-   [ModeLink](modelink): ModeLink is an editor consisting of 2-3 side-by-side EMF tree-based editors, and is very convenient for establishing (weaving) links between different models using drag-and-drop.
-   [Workflow](workflow): Epsilon provides a set of ANT tasks to enable developers assemble complex workflows that involve both MDE and non-MDE tasks.
-   [Human Usable Textual Notation](hutn): An implementation of the OMG standard for representing models in a human understandable format. HUTN allows models to be written using a text editor in a C-like syntax.

