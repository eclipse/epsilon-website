<h4>Modular JARs</h4>

<table class="table table-striped">
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
			<td><a href="<?=$jarsUrl?>/epsilon-2.0.0-core.jar">epsilon-2.0.0-core.jar</a>
			<td><a href="<?=$jarsUrl?>/epsilon-2.0.0-core-src.jar">epsilon-2.0.0-core-src.jar</a>
			<td>
				<ul>
				
					<li> To use this JAR, you will also need to have at least these <a href="<?=$jarsUrl?>/epsilon-2.0.0-core-dependencies.zip">external dependencies</a> 
					in your classpath.
				</ul>
			</td>
		</tr>
		<tr>
			<td>Epsilon's EMF driver.</td>
			<td><a href="<?=$jarsUrl?>/epsilon-2.0.0-emf.jar">epsilon-2.0.0-emf.jar</a>
			<td><a href="<?=$jarsUrl?>/epsilon-2.0.0-emf-src.jar">epsilon-2.0.0-emf-src.jar</a>
			<td>
				<ul>
				
					<li>To use this JAR, you will also need to have epsilon-2.0.0-core in your classpath.
					<li> To use this JAR, you will also need to have at least these <a href="<?=$jarsUrl?>/epsilon-2.0.0-emf-dependencies.zip">external dependencies</a> 
					in your classpath.
				</ul>
			</td>
		</tr>
		<tr>
			<td>Epsilon's UML driver.</td>
			<td><a href="<?=$jarsUrl?>/epsilon-2.0.0-uml.jar">epsilon-2.0.0-uml.jar</a>
			<td><a href="<?=$jarsUrl?>/epsilon-2.0.0-uml-src.jar">epsilon-2.0.0-uml-src.jar</a>
			<td>
				<ul>
				
					<li>To use this JAR, you will also need to have epsilon-2.0.0-emf in your classpath.
					<li> To use this JAR, you will also need to have at least these <a href="<?=$jarsUrl?>/epsilon-2.0.0-uml-dependencies.zip">external dependencies</a> 
					in your classpath.
				</ul>
			</td>
		</tr>
		<tr>
			<td>Epsilon's Graphml muddles driver.</td>
			<td><a href="<?=$jarsUrl?>/epsilon-2.0.0-graphml.jar">epsilon-2.0.0-graphml.jar</a>
			<td><a href="<?=$jarsUrl?>/epsilon-2.0.0-graphml-src.jar">epsilon-2.0.0-graphml-src.jar</a>
			<td>
				<ul>
				
					<li>To use this JAR, you will also need to have epsilon-2.0.0-emf in your classpath.
				</ul>
			</td>
		</tr>
		<tr>
			<td>Epsilon's Simulink driver.</td>
			<td><a href="<?=$jarsUrl?>/epsilon-2.0.0-simulink.jar">epsilon-2.0.0-simulink.jar</a>
			<td><a href="<?=$jarsUrl?>/epsilon-2.0.0-simulink-src.jar">epsilon-2.0.0-simulink-src.jar</a>
			<td>
				<ul>
				
					<li>To use this JAR, you will also need to have epsilon-2.0.0-core in your classpath.
					<li> To use this JAR, you will also need to have at least these <a href="<?=$jarsUrl?>/epsilon-2.0.0-simulink-dependencies.zip">external dependencies</a> 
					in your classpath.
				</ul>
			</td>
		</tr>
		<tr>
			<td>Epsilon's Human Usable Textual Notation implementation.</td>
			<td><a href="<?=$jarsUrl?>/epsilon-2.0.0-hutn.jar">epsilon-2.0.0-hutn.jar</a>
			<td><a href="<?=$jarsUrl?>/epsilon-2.0.0-hutn-src.jar">epsilon-2.0.0-hutn-src.jar</a>
			<td>
				<ul>
				
					<li>To use this JAR, you will also need to have epsilon-2.0.0-emf in your classpath.
				</ul>
			</td>
		</tr>
		<tr>
			<td>ANT tasks for the Epsilon languages. To use this JAR, you will need to have Apache ANT installed.</td>
			<td><a href="<?=$jarsUrl?>/epsilon-2.0.0-workflow.jar">epsilon-2.0.0-workflow.jar</a>
			<td><a href="<?=$jarsUrl?>/epsilon-2.0.0-workflow-src.jar">epsilon-2.0.0-workflow-src.jar</a>
			<td>
				<ul>
				
					<li>To use this JAR, you will also need to have epsilon-2.0.0-core in your classpath.
				</ul>
			</td>
		</tr>
		<tr>
			<td>ANT tasks for Epsilon's EMF driver.</td>
			<td><a href="<?=$jarsUrl?>/epsilon-2.0.0-workflow-emf.jar">epsilon-2.0.0-workflow-emf.jar</a>
			<td><a href="<?=$jarsUrl?>/epsilon-2.0.0-workflow-emf-src.jar">epsilon-2.0.0-workflow-emf-src.jar</a>
			<td>
				<ul>
				
					<li>To use this JAR, you will also need to have epsilon-2.0.0-workflow in your classpath.
					<li>To use this JAR, you will also need to have epsilon-2.0.0-emf in your classpath.
				</ul>
			</td>
		</tr>
		<tr>
			<td>EMC drivers for Google and Excel spreadsheets.</td>
			<td><a href="<?=$jarsUrl?>/epsilon-2.0.0-spreadsheets.jar">epsilon-2.0.0-spreadsheets.jar</a>
			<td><a href="<?=$jarsUrl?>/epsilon-2.0.0-spreadsheets-src.jar">epsilon-2.0.0-spreadsheets-src.jar</a>
			<td>
				<ul>
				
					<li>To use this JAR, you will also need to have epsilon-2.0.0-core in your classpath.
					<li> To use this JAR, you will also need to have at least these <a href="<?=$jarsUrl?>/epsilon-2.0.0-spreadsheets-dependencies.zip">external dependencies</a> 
					in your classpath.
				</ul>
			</td>
		</tr>
		<tr>
			<td>Command-line interface for Epsilon's main languages.</td>
			<td><a href="<?=$jarsUrl?>/epsilon-2.0.0-cli.jar">epsilon-2.0.0-cli.jar</a>
			<td><a href="<?=$jarsUrl?>/epsilon-2.0.0-cli-src.jar">epsilon-2.0.0-cli-src.jar</a>
			<td>
				<ul>
				
					<li>To use this JAR, you will also need to have epsilon-2.0.0-core in your classpath.
					<li> To use this JAR, you will also need to have at least these <a href="<?=$jarsUrl?>/epsilon-2.0.0-cli-dependencies.zip">external dependencies</a> 
					in your classpath.
				</ul>
			</td>
		</tr>
		<tr>
			<td>Fat JAR that contains all JARs above and all required external dependencies.</td>
			<td> - </td>
			<td><a href="<?=$jarsUrl?>/epsilon-2.0.0-kitchensink.jar">epsilon-2.0.0-kitchensink.jar</a>
			<td> <ul> <li> None </ul> <td>
	</tbody>
</table>
