<table class="table table-striped">
	<thead>
		<tr>
			<th>Binary</th>
			<th>Execution engines</th>
			<th>Workflow *</th>
			<th>EMF driver **</th>
		</tr>
	</thead>
	<tbody>
		<tr>
			<td><a href='<?=$jarsUrl?>/epsilon-1.1_SR1-core.jar'>epsilon-1.1_SR1-core.jar</a></td>
			<td>&#10004;</td>
			<td>&#10008;</td>
			<td>&#10008;</td>
		</tr>	
		<tr>
			<td><a href='<?=$jarsUrl?>/epsilon-1.1_SR1-ant.jar'>epsilon-1.1_SR1-ant.jar</a></td>
			<td>&#10004;</td>
			<td>&#10004;</td>
			<td>&#10008;</td>
		</tr>
		<tr>
			<td><a href='<?=$jarsUrl?>/epsilon-1.1_SR1-emf.jar'>epsilon-1.1_SR1-emf.jar</a></td>
			<td>&#10004;</td>
			<td>&#10008;</td>
			<td>&#10004;</td>
		</tr>
		<tr>
			<td><a href='<?=$jarsUrl?>/epsilon-1.1_SR1-ant-emf.jar'>epsilon-1.1_SR1-ant-emf.jar</a></td>
			<td>&#10004;</td>
			<td>&#10004;</td>
			<td>&#10004;</td>
		</tr>	  								  							
	</tbody>						
</table>

<p>
* To use the workflow tasks, you will need to install <a href="http://apache.org/ant">ANT</a>.<br/>
** To use the EMF driver, you will also need EMF in your classpath (not contained in the JARs distributed here).
</p>