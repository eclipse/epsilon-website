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
			<td><a href="<?=$jarsUrl?>/epsilon-1.4-core.jar">epsilon-1.4-core.jar</a>
			<td><a href="<?=$jarsUrl?>/epsilon-1.4-core-src.jar">epsilon-1.4-core-src.jar</a>
			<td>
				<ul>
 <li> None
				</ul>
			</td>
		</tr>
		<tr>
			<td>Epsilon's EMF driver.</td>
			<td><a href="<?=$jarsUrl?>/epsilon-1.4-emf.jar">epsilon-1.4-emf.jar</a>
			<td><a href="<?=$jarsUrl?>/epsilon-1.4-emf-src.jar">epsilon-1.4-emf-src.jar</a>
			<td>
				<ul>

					<li>To use this JAR, you will also need to have epsilon-1.4-core in your classpath.
					<li> To use this JAR, you will also need to have at least these <a href="<?=$jarsUrl?>/epsilon-1.4-emf-dependencies.zip">external dependencies</a>
					in your classpath.
				</ul>
			</td>
		</tr>
		<tr>
			<td>Epsilon's UML driver.</td>
			<td><a href="<?=$jarsUrl?>/epsilon-1.4-uml.jar">epsilon-1.4-uml.jar</a>
			<td><a href="<?=$jarsUrl?>/epsilon-1.4-uml-src.jar">epsilon-1.4-uml-src.jar</a>
			<td>
				<ul>

					<li>To use this JAR, you will also need to have epsilon-1.4-emf in your classpath.
					<li> To use this JAR, you will also need to have at least these <a href="<?=$jarsUrl?>/epsilon-1.4-uml-dependencies.zip">external dependencies</a>
					in your classpath.
				</ul>
			</td>
		</tr>
		<tr>
			<td>Epsilon's Graphml muddles driver.</td>
			<td><a href="<?=$jarsUrl?>/epsilon-1.4-graphml.jar">epsilon-1.4-graphml.jar</a>
			<td><a href="<?=$jarsUrl?>/epsilon-1.4-graphml-src.jar">epsilon-1.4-graphml-src.jar</a>
			<td>
				<ul>

					<li>To use this JAR, you will also need to have epsilon-1.4-emf in your classpath.
				</ul>
			</td>
		</tr>
		<tr>
			<td>Epsilon's Excel/Google spreadsheet driver.</td>
			<td><a href="<?=$jarsUrl?>/epsilon-1.4-spreadsheets.jar">epsilon-1.4-spreadsheets.jar</a>
			<td><a href="<?=$jarsUrl?>/epsilon-1.4-spreadsheets-src.jar">epsilon-1.4-spreadsheets-src.jar</a>
			<td>
				<ul>
					<li>To use this JAR, you will also need to have epsilon-1.4-core in your classpath.
					<li> To use this JAR, you will also need to have at least these <a href="<?=$jarsUrl?>/epsilon-1.4-spreadsheets-dependencies.zip">external dependencies</a>
					in your classpath.
				</ul>
			</td>
		</tr>
		<tr>
			<td>Epsilon's Human Usable Textual Notation implementation.</td>
			<td><a href="<?=$jarsUrl?>/epsilon-1.4-hutn.jar">epsilon-1.4-hutn.jar</a>
			<td><a href="<?=$jarsUrl?>/epsilon-1.4-hutn-src.jar">epsilon-1.4-hutn-src.jar</a>
			<td>
				<ul>

					<li>To use this JAR, you will also need to have epsilon-1.4-emf in your classpath.
				</ul>
			</td>
		</tr>
		<tr>
			<td>ANT tasks for the Epsilon languages. To use this JAR, you will need to have Apache ANT installed.</td>
			<td><a href="<?=$jarsUrl?>/epsilon-1.4-workflow.jar">epsilon-1.4-workflow.jar</a>
			<td><a href="<?=$jarsUrl?>/epsilon-1.4-workflow-src.jar">epsilon-1.4-workflow-src.jar</a>
			<td>
				<ul>

					<li>To use this JAR, you will also need to have epsilon-1.4-core in your classpath.
				</ul>
			</td>
		</tr>
		<tr>
			<td>ANT tasks for Epsilon's EMF driver.</td>
			<td><a href="<?=$jarsUrl?>/epsilon-1.4-workflow-emf.jar">epsilon-1.4-workflow-emf.jar</a>
			<td><a href="<?=$jarsUrl?>/epsilon-1.4-workflow-emf-src.jar">epsilon-1.4-workflow-emf-src.jar</a>
			<td>
				<ul>

					<li>To use this JAR, you will also need to have epsilon-1.4-workflow in your classpath.
					<li>To use this JAR, you will also need to have epsilon-1.4-emf in your classpath.
				</ul>
			</td>
		</tr>
		<tr>
			<td>Fat JAR that contains all JARs above and all required external dependencies.</td>
			<td> - </td>
			<td><a href="<?=$jarsUrl?>/epsilon-1.4-kitchensink.jar">epsilon-1.4-kitchensink.jar</a>
			<td> <ul> <li> None </ul> <td>
	</tbody>
</table>
