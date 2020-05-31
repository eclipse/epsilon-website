# Download

The simplest way to install a fully-functional instance of Eclipse with Epsilon 2.0 and all its dependencies, is to download the [Eclipse Installer](https://wiki.eclipse.org/Eclipse_Installer) and select Epsilon. Note that you will need a [Java Runtime Environment](https://adoptopenjdk.net/) installed on your system.

![Epsilon in Eclipse Installer](../assets/images/eclipse-installer.png)

| OS | Location |
| - | - |
| Windows | <http://www.eclipse.org/downloads/download.php?file=/oomph/products/eclipse-inst-win64.exe> |
| Mac | <http://www.eclipse.org/downloads/download.php?file=/oomph/products/eclipse-inst-mac64.dmg> |
| Linux | <http://www.eclipse.org/downloads/download.php?file=/oomph/products/eclipse-inst-linux64.tar.gz> |

## Update Sites

Alternatively, you can use the following update sites through the `Help->Install new software` menu in Eclipse to install (parts of) Epsilon.

| Site | Location |
| - | - |
| Stable | `https://download.eclipse.org/epsilon/updates/`|
| Interim | `https://download.eclipse.org/epsilon/interim/`|

### Archived Update Sites

Below are also links to compressed versions of the Epsilon update sites for long-term archival and to support users who are behind corporate firewalls.

| Site | Zip Archive |
| - | - |
| Stable | <https://www.eclipse.org/downloads/download.php?file=/epsilon/updates/2.0/site.zip>|
| Interim | <https://www.eclipse.org/downloads/download.php?file=/epsilon/interim/site.zip>|

## Eclipse Marketplace

If you prefer to install Epsilon through the Eclipse Marketplace, you can drag and drop <a style="position:relative;top:7px" href="https://marketplace.eclipse.org/marketplace-client-intro?mpc_install=400" title="install"><img src="https://marketplace.eclipse.org/sites/all/modules/custom/marketplace/images/installbutton.png"/></a> into a running instance of Eclipse.

## Source Code

The source code of Epsilon is stored in the following Git repository. 

| Type | Location |
| - | - |
| Users | `git://git.eclipse.org/gitroot/epsilon/org.eclipse.epsilon.git`|
| Committers | `ssh://user_id@git.eclipse.org:29418/epsilon/org.eclipse.epsilon.git`|
| Release tag | `https://git.eclipse.org/c/epsilon/org.eclipse.epsilon.git/tag/?id=2.0`|

 Additional projects which are experimental or not formally approved due to licensing constraints are available in [Epsilon Labs](https://github.com/epsilonlabs). 

## JARs

Plain old JARs you can use to embed the latest stable version of Epsilon (2.0) as a library in your Java or Android application. You can also use [Maven](#maven). 

### Stable

<table>
	<thead>
		<tr>
			<th>Description</th>
			<th>Binary</th>
			<th>Binary + Source</th>
			<th>Dependencies</th>
		</tr>
	</thead>
	<tbody>
		<tr>
			<td>The execution engines of all Epsilon languages,
			    		as well as the plain XML and CSV drivers.</td>
			<td><a href="https://www.eclipse.org/downloads/download.php?file=/epsilon/2.0/jars/epsilon-2.0.0-core.jar">epsilon-2.0.0-core.jar</a>
			<td><a href="https://www.eclipse.org/downloads/download.php?file=/epsilon/2.0/jars/epsilon-2.0.0-core-src.jar">epsilon-2.0.0-core-src.jar</a>
			<td>
				<ul>
					<li> To use this JAR, you will also need to have at least these <a href="https://www.eclipse.org/downloads/download.php?file=/epsilon/2.0/jars/epsilon-2.0.0-core-dependencies.zip">external dependencies</a>
					in your classpath.
				</ul>
			</td>
		</tr>
		<tr>
			<td>Epsilon's EMF driver.</td>
			<td><a href="https://www.eclipse.org/downloads/download.php?file=/epsilon/2.0/jars/epsilon-2.0.0-emf.jar">epsilon-2.0.0-emf.jar</a>
			<td><a href="https://www.eclipse.org/downloads/download.php?file=/epsilon/2.0/jars/epsilon-2.0.0-emf-src.jar">epsilon-2.0.0-emf-src.jar</a>
			<td>
				<ul>
					<li>To use this JAR, you will also need to have epsilon-2.0.0-core in your classpath.
					<li> To use this JAR, you will also need to have at least these <a href="https://www.eclipse.org/downloads/download.php?file=/epsilon/2.0/jars/epsilon-2.0.0-emf-dependencies.zip">external dependencies</a>
					in your classpath.
				</ul>
			</td>
		</tr>
		<tr>
			<td>Epsilon's UML driver.</td>
			<td><a href="https://www.eclipse.org/downloads/download.php?file=/epsilon/2.0/jars/epsilon-2.0.0-uml.jar">epsilon-2.0.0-uml.jar</a>
			<td><a href="https://www.eclipse.org/downloads/download.php?file=/epsilon/2.0/jars/epsilon-2.0.0-uml-src.jar">epsilon-2.0.0-uml-src.jar</a>
			<td>
				<ul>
					<li>To use this JAR, you will also need to have epsilon-2.0.0-emf in your classpath.
					<li> To use this JAR, you will also need to have at least these <a href="https://www.eclipse.org/downloads/download.php?file=/epsilon/2.0/jars/epsilon-2.0.0-uml-dependencies.zip">external dependencies</a>
					in your classpath.
				</ul>
			</td>
		</tr>
		<tr>
			<td>Epsilon's Graphml muddles driver.</td>
			<td><a href="https://www.eclipse.org/downloads/download.php?file=/epsilon/2.0/jars/epsilon-2.0.0-graphml.jar">epsilon-2.0.0-graphml.jar</a>
			<td><a href="https://www.eclipse.org/downloads/download.php?file=/epsilon/2.0/jars/epsilon-2.0.0-graphml-src.jar">epsilon-2.0.0-graphml-src.jar</a>
			<td>
				<ul>
					<li>To use this JAR, you will also need to have epsilon-2.0.0-emf in your classpath.
				</ul>
			</td>
		</tr>
		<tr>
			<td>Epsilon's Excel/Google spreadsheet driver.</td>
			<td><a href="https://www.eclipse.org/downloads/download.php?file=/epsilon/2.0/jars/epsilon-2.0.0-spreadsheets.jar">epsilon-2.0.0-spreadsheets.jar</a>
			<td><a href="https://www.eclipse.org/downloads/download.php?file=/epsilon/2.0/jars/epsilon-2.0.0-spreadsheets-src.jar">epsilon-2.0.0-spreadsheets-src.jar</a>
			<td>
				<ul>
					<li>To use this JAR, you will also need to have epsilon-2.0.0-core in your classpath.
					<li> To use this JAR, you will also need to have at least these <a href="https://www.eclipse.org/downloads/download.php?file=/epsilon/2.0/jars/epsilon-2.0.0-spreadsheets-dependencies.zip">external dependencies</a>
					in your classpath.
				</ul>
			</td>
		</tr>
		<tr>
			<td>Epsilon's Simulink driver.</td>
			<td><a href="https://www.eclipse.org/downloads/download.php?file=/epsilon/2.0/jars/epsilon-2.0.0-simulink.jar">epsilon-2.0.0-simulink.jar</a>
			<td><a href="https://www.eclipse.org/downloads/download.php?file=/epsilon/2.0/jars/epsilon-2.0.0-simulink-src.jar">epsilon-2.0.0-simulink-src.jar</a>
			<td>
				<ul>
					<li>To use this JAR, you will also need to have epsilon-2.0.0-core in your classpath.
					<li> To use this JAR, you will also need to have at least these <a href="https://www.eclipse.org/downloads/download.php?file=/epsilon/2.0/jars/epsilon-2.0.0-simulink-dependencies.zip">external dependencies</a>
					in your classpath.
				</ul>
			</td>
		</tr>
		<tr>
			<td>Epsilon's Human Usable Textual Notation implementation.</td>
			<td><a href="https://www.eclipse.org/downloads/download.php?file=/epsilon/2.0/jars/epsilon-2.0.0-hutn.jar">epsilon-2.0.0-hutn.jar</a>
			<td><a href="https://www.eclipse.org/downloads/download.php?file=/epsilon/2.0/jars/epsilon-2.0.0-hutn-src.jar">epsilon-2.0.0-hutn-src.jar</a>
			<td>
				<ul>
					<li>To use this JAR, you will also need to have epsilon-2.0.0-emf in your classpath.
				</ul>
			</td>
		</tr>
		<tr>
			<td>ANT tasks for the Epsilon languages. To use this JAR, you will need to have Apache ANT installed.</td>
			<td><a href="https://www.eclipse.org/downloads/download.php?file=/epsilon/2.0/jars/epsilon-2.0.0-workflow.jar">epsilon-2.0.0-workflow.jar</a>
			<td><a href="https://www.eclipse.org/downloads/download.php?file=/epsilon/2.0/jars/epsilon-2.0.0-workflow-src.jar">epsilon-2.0.0-workflow-src.jar</a>
			<td>
				<ul>
					<li>To use this JAR, you will also need to have epsilon-2.0.0-core in your classpath.
				</ul>
			</td>
		</tr>
		<tr>
			<td>ANT tasks for Epsilon's EMF driver.</td>
			<td><a href="https://www.eclipse.org/downloads/download.php?file=/epsilon/2.0/jars/epsilon-2.0.0-workflow-emf.jar">epsilon-2.0.0-workflow-emf.jar</a>
			<td><a href="https://www.eclipse.org/downloads/download.php?file=/epsilon/2.0/jars/epsilon-2.0.0-workflow-emf-src.jar">epsilon-2.0.0-workflow-emf-src.jar</a>
			<td>
				<ul>
					<li>To use this JAR, you will also need to have epsilon-2.0.0-workflow in your classpath.
					<li>To use this JAR, you will also need to have epsilon-2.0.0-emf in your classpath.
				</ul>
			</td>
		</tr>
		<tr>
			<td>Fat JAR that contains all JARs above and all required external dependencies.</td>
			<td> - </td>
			<td><a href="https://www.eclipse.org/downloads/download.php?file=/epsilon/2.0/jars/epsilon-2.0.0-kitchensink.jar">epsilon-2.0.0-kitchensink.jar</a>
			<td> <ul> <li> None </ul> <td>
	</tbody>
</table>

### Interim
<table>
	<thead>
		<tr>
			<th>Description</th>
			<th>Binary</th>
			<th>Binary + Source</th>
			<th>Dependencies</th>
		</tr>
	</thead>
	<tbody>
		<tr>
			<td>The execution engines of all Epsilon languages,
		as well as the plain XML and CSV drivers.</td>
			<td><a href="https://www.eclipse.org/downloads/download.php?file=/epsilon/latest/jars/epsilon-2.0.0-core.jar">epsilon-2.0.0-core.jar</a>
			<td><a href="https://www.eclipse.org/downloads/download.php?file=/epsilon/latest/jars/epsilon-2.0.0-core-src.jar">epsilon-2.0.0-core-src.jar</a>
			<td>
				<ul>		
					<li> To use this JAR, you will also need to have at least these <a href="https://www.eclipse.org/downloads/download.php?file=/epsilon/latest/jars/epsilon-2.0.0-core-dependencies.zip">external dependencies</a> 
					in your classpath.
				</ul>
			</td>
		</tr>
		<tr>
			<td>Epsilon's EMF driver.</td>
			<td><a href="https://www.eclipse.org/downloads/download.php?file=/epsilon/latest/jars/epsilon-2.0.0-emf.jar">epsilon-2.0.0-emf.jar</a>
			<td><a href="https://www.eclipse.org/downloads/download.php?file=/epsilon/latest/jars/epsilon-2.0.0-emf-src.jar">epsilon-2.0.0-emf-src.jar</a>
			<td>
				<ul>	
					<li>To use this JAR, you will also need to have epsilon-2.0.0-core in your classpath.
					<li> To use this JAR, you will also need to have at least these <a href="https://www.eclipse.org/downloads/download.php?file=/epsilon/latest/jars/epsilon-2.0.0-emf-dependencies.zip">external dependencies</a> 
					in your classpath.
				</ul>
			</td>
		</tr>
		<tr>
			<td>Epsilon's UML driver.</td>
			<td><a href="https://www.eclipse.org/downloads/download.php?file=/epsilon/latest/jars/epsilon-2.0.0-uml.jar">epsilon-2.0.0-uml.jar</a>
			<td><a href="https://www.eclipse.org/downloads/download.php?file=/epsilon/latest/jars/epsilon-2.0.0-uml-src.jar">epsilon-2.0.0-uml-src.jar</a>
			<td>
				<ul>	
					<li>To use this JAR, you will also need to have epsilon-2.0.0-emf in your classpath.
					<li> To use this JAR, you will also need to have at least these <a href="https://www.eclipse.org/downloads/download.php?file=/epsilon/latest/jars/epsilon-2.0.0-uml-dependencies.zip">external dependencies</a> 
					in your classpath.
				</ul>
			</td>
		</tr>
		<tr>
			<td>Epsilon's Graphml muddles driver.</td>
			<td><a href="https://www.eclipse.org/downloads/download.php?file=/epsilon/latest/jars/epsilon-2.0.0-graphml.jar">epsilon-2.0.0-graphml.jar</a>
			<td><a href="https://www.eclipse.org/downloads/download.php?file=/epsilon/latest/jars/epsilon-2.0.0-graphml-src.jar">epsilon-2.0.0-graphml-src.jar</a>
			<td>
				<ul>
					<li>To use this JAR, you will also need to have epsilon-2.0.0-emf in your classpath.
				</ul>
			</td>
		</tr>
		<tr>
			<td>Epsilon's Simulink driver.</td>
			<td><a href="https://www.eclipse.org/downloads/download.php?file=/epsilon/latest/jars/epsilon-2.0.0-simulink.jar">epsilon-2.0.0-simulink.jar</a>
			<td><a href="https://www.eclipse.org/downloads/download.php?file=/epsilon/latest/jars/epsilon-2.0.0-simulink-src.jar">epsilon-2.0.0-simulink-src.jar</a>
			<td>
				<ul>
					<li>To use this JAR, you will also need to have epsilon-2.0.0-core in your classpath.
					<li> To use this JAR, you will also need to have at least these <a href="https://www.eclipse.org/downloads/download.php?file=/epsilon/latest/jars/epsilon-2.0.0-simulink-dependencies.zip">external dependencies</a> 
					in your classpath.
				</ul>
			</td>
		</tr>
		<tr>
			<td>Epsilon's Human Usable Textual Notation implementation.</td>
			<td><a href="https://www.eclipse.org/downloads/download.php?file=/epsilon/latest/jars/epsilon-2.0.0-hutn.jar">epsilon-2.0.0-hutn.jar</a>
			<td><a href="https://www.eclipse.org/downloads/download.php?file=/epsilon/latest/jars/epsilon-2.0.0-hutn-src.jar">epsilon-2.0.0-hutn-src.jar</a>
			<td>
				<ul>
					<li>To use this JAR, you will also need to have epsilon-2.0.0-emf in your classpath.
				</ul>
			</td>
		</tr>
		<tr>
			<td>ANT tasks for the Epsilon languages. To use this JAR, you will need to have Apache ANT installed.</td>
			<td><a href="https://www.eclipse.org/downloads/download.php?file=/epsilon/latest/jars/epsilon-2.0.0-workflow.jar">epsilon-2.0.0-workflow.jar</a>
			<td><a href="https://www.eclipse.org/downloads/download.php?file=/epsilon/latest/jars/epsilon-2.0.0-workflow-src.jar">epsilon-2.0.0-workflow-src.jar</a>
			<td>
				<ul>
					<li>To use this JAR, you will also need to have epsilon-2.0.0-core in your classpath.
				</ul>
			</td>
		</tr>
		<tr>
			<td>ANT tasks for Epsilon's EMF driver.</td>
			<td><a href="https://www.eclipse.org/downloads/download.php?file=/epsilon/latest/jars/epsilon-2.0.0-workflow-emf.jar">epsilon-2.0.0-workflow-emf.jar</a>
			<td><a href="https://www.eclipse.org/downloads/download.php?file=/epsilon/latest/jars/epsilon-2.0.0-workflow-emf-src.jar">epsilon-2.0.0-workflow-emf-src.jar</a>
			<td>
				<ul>
					<li>To use this JAR, you will also need to have epsilon-2.0.0-workflow in your classpath.
					<li>To use this JAR, you will also need to have epsilon-2.0.0-emf in your classpath.
				</ul>
			</td>
		</tr>
		<tr>
			<td>EMC drivers for Google and Excel spreadsheets.</td>
			<td><a href="https://www.eclipse.org/downloads/download.php?file=/epsilon/latest/jars/epsilon-2.0.0-spreadsheets.jar">epsilon-2.0.0-spreadsheets.jar</a>
			<td><a href="https://www.eclipse.org/downloads/download.php?file=/epsilon/latest/jars/epsilon-2.0.0-spreadsheets-src.jar">epsilon-2.0.0-spreadsheets-src.jar</a>
			<td>
				<ul>
					<li>To use this JAR, you will also need to have epsilon-2.0.0-core in your classpath.
					<li> To use this JAR, you will also need to have at least these <a href="https://www.eclipse.org/downloads/download.php?file=/epsilon/latest/jars/epsilon-2.0.0-spreadsheets-dependencies.zip">external dependencies</a> 
					in your classpath.
				</ul>
			</td>
		</tr>
		<tr>
			<td>Command-line interface for Epsilon's main languages.</td>
			<td><a href="https://www.eclipse.org/downloads/download.php?file=/epsilon/latest/jars/epsilon-2.0.0-cli.jar">epsilon-2.0.0-cli.jar</a>
			<td><a href="https://www.eclipse.org/downloads/download.php?file=/epsilon/latest/jars/epsilon-2.0.0-cli-src.jar">epsilon-2.0.0-cli-src.jar</a>
			<td>
				<ul>
					<li>To use this JAR, you will also need to have epsilon-2.0.0-core in your classpath.
					<li> To use this JAR, you will also need to have at least these <a href="https://www.eclipse.org/downloads/download.php?file=/epsilon/latest/jars/epsilon-2.0.0-cli-dependencies.zip">external dependencies</a> 
					in your classpath.
				</ul>
			</td>
		</tr>
		<tr>
			<td>Fat JAR that contains all JARs above and all required external dependencies.</td>
			<td> - </td>
			<td><a href="https://www.eclipse.org/downloads/download.php?file=/epsilon/latest/jars/epsilon-2.0.0-kitchensink.jar">epsilon-2.0.0-kitchensink.jar</a>
			<td> <ul> <li> None </ul> <td>
	</tbody>
</table>

## Maven

Since 1.4, these JARs are also available from [Maven Central](https://mvnrepository.com/artifact/org.eclipse.epsilon). For
instance, to use the `epsilon-core` JAR from your `pom.xml`:

```xml
<dependencies>
  ...
  <dependency>
    <groupId>org.eclipse.epsilon</groupId>
    <artifactId>epsilon-core</artifactId>
    <version>2.0</version>
  </dependency>
  ...
</dependencies>
```

## Older versions

Previous stable versions of Epsilon are available [here](history).