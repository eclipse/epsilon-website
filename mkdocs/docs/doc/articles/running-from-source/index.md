# Running Epsilon from Source

To run Epsilon from source, you need to:

- Download a copy of the [latest version of Eclipse](https://www.eclipse.org/downloads) and select the "Eclipse IDE for Eclipse Committers" option when prompted during the installation process. 
- Clone the Git repository (from `ssh://user_id@git.eclipse.org:29418/epsilon/org.eclipse.epsilon.git` if you're an Epsilon committer, or from `git://git.eclipse.org/gitroot/epsilon/org.eclipse.epsilon.git` if you're not). To clone the repository as a committer you first need to add your public key to [Gerrit](https://git.eclipse.org/r/#/settings/ssh-keys). 
- Import all the projects under the `plugins`, `features`, and `tests` folders in your workspace.
- (optional) To organise your workspace, you can create [working sets](http://help.eclipse.org/kepler/index.jsp?topic=%2Forg.eclipse.platform.doc.user%2Fconcepts%2Fcworkset.htm). For example, you could create three working sets that mirror the contents of the folders above (`plugins`, `features`, and `tests`). 
- Open `releng/org.eclipse.epsilon.target/org.eclipse.epsilon.target.target` and click the "Set as Active Target Platform" link on the top right 
- Right-click on any Epsilon plugin project in the Project Explorer and select Run as → Eclipse Application

## Naming Conventions

- The execution engines for the various Epsilon languages are located in `org.eclipse.epsilon.*.engine` plugins. These are Eclipse-independent. 
- Plugins named `*.dt` contain development tools (e.g. editors, run configurations, debuggers) for the respective Epsilon languages. 
- Plugins named `org.eclipse.epsilon.emc.*` contain Epsilon Model Connectivity (EMC) drivers through which Epsilon languages can interact with different types of models (e.g. EMF models, spreadsheets etc.) 
- Plugins named `org.eclipse.epsilon.emc.*.dt` contain development tools (e.g. model configuration dialogs) for the respective EMC drivers. 
- Plugins named `*.workflow` contribute [ANT tasks](../../workflow).

## Modifying the Epsilon parsers

- Before you can regenerate the Epsilon parsers, you need to clone the [epsilon-antlr-dev](https://github.com/epsilonlabs/epsilon-antlr-dev) Git repo into a sibling folder of the Epsilon repo.
- To modify e.g. the EVL parser, you need to change `Evl.g` and/or `EvlParserRules.g`. To re-generate the parser you need to run `build-evl-parser.xml` as an Ant build.
- Since all Epsilon languages extend EOL, if you modify the EOL parser, you'll then need to run `build-all-eol-dependent-parsers.xml`

## Running the Epsilon tests

- After making any changes to the Epsilon source code, you're advised to run the Epsilon test suites to avoid regressions. Epsilon provides two main test suites: `EpsilonTestSuite` and `EpsilonPluggedInTestSuite` (the latter needs to be run as a `JUnit Plug-In Test`)