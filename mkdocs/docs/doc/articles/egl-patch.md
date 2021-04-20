# EGL Patch Templates

A patch file (also called a patch for short) is a text file that consists of a list of differences and is produced, usually, by running the related the `diff` program with the original and updated file as arguments. The differences follow the [diff format](https://en.wikipedia.org/wiki/Diff). A patch processor can read a patch file and use the contents as a set of instructions. By following those instructions, a target file can be modified to match the changes in the patch file.

Although patches are usually created using a diff tool, it is also possible to write them manually and then use the patch processor to modify a file. This is the approach we provide via EGL *patch* rules.

## EGL Diff Format

In EGL we support a custom diff format. 

- A line starting with "`+`" represents the addition of a line, i.e. this line will be added to the file.
- A line starting with "`-`" represents the deletion of a line, i.e, this line will be removed from the file.
- A line containing only "`...`" indicates a block of lines to keep, i.e. all lines until the next diff/match will be kept.
- A line containing only "`---`" indicates a block of lines to remove, i.e. all lines until the next diff/match will be removed.
- A line with no diff information is used as a match and will be kept.
 
## EGL Diff Processor

The EGl diff processor uses un-diffed lines to match sections of the file and then uses any diff entries till the next un-diffed lines to modify (add/remove/keep) the file. Deletions will also be used to match locations. All additions before a deletion/un-diff will be inserted before the deleted/un-diffed line. All additions after a deletion/un-diff will be inserted after the deleted/un-diffed line.


## Example Templates

In this example we want to insert getters in a Java class file. 

=== "getters.egl"
	```egl
	[%for (a in c.eAllAttributes.excludingAll(c.eAttributes)) {%]
	+
	+	/**
	+	 * @generated
	+	 */
	+	@Override
	+	public [%=a.eType.instanceTypeName%] get[%=a.name.ftuc()%]() {
	+		if ([%=a.name%] == null) {
	+			return prototype.get[%=a.name.ftuc()%]();
	+		}
	+		else return [%=a.name%];
	+	}
	[%}%]
	-} //[%=c.name%]Impl
	+} //[%=c.name%]Impl (Patched)
	```

 - There are no un-diffed lines in the template.
 - There is one deletion: `-} //[%=c.name%]Impl`, thus the processor would match the closing bracket of the Java class commented with the Java class name.
 - The for loop would generate a getter for each attribute and insert it before the closing bracket location.
 - The closing bracket and comment are removed
 - A new closing bracket with the modified comment is added.

In this other example, we want to modify the toString method of a Java class.

=== "toString.egl"
	```egl
		public String toString() {
			---
	+		return "[%=c.name%]";
		}
	```

- The `public String toString() {` line would be used to match the toString method.
- The `---` indicates that all the lines in the method, until the closing bracket (which is the next matched line) should be removed.
- The new method implementation is added, which will return the class name.

## Using patch EGL templates

To use EGL templates with diff lines they must be invoked from an EGX rule annotated with `@patch`. The example EGL templates above would be invoked like this:

```egx
@patch
rule EClass2Getters 
	transform c : EClass {
	
	guard : c.eAnnotations.exists(a|a.source = "instance")
	
	template : "getters.egl"

	target : "src/" + c.eContainer().name + "/impl/" + c.name + "Impl.java"
}

@patch
rule EClass2ToString 
	transform c : EClass {
	
	template : "toString.egl"

	target : "src/" + c.eContainer().name + "/impl/" + c.name + "Impl.java"
}
```

