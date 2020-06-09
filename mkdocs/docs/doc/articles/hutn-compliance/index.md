# Compliance of Epsilon HUTN to the OMG Standard

Epsilon HUTN is an implementation of the [OMG HUTN standard](http://www.omg.org/spec/HUTN/). Epsilon HUTN implements most of the OMG standard, but there are some differences between the two. This article summaries the similarities and differences between Epsilon HUTN and the OMG HUTN standard.

| Feature                     | Section of the OMG HUTN Standard | Supported in Epsilon HUTN? | Details of support in Epsilon HUTN                           |
| --------------------------- | -------------------------------- | -------------------------- | ------------------------------------------------------------ |
| Packages                    | Section 6.2                      | Yes                        |                                                              |
| Classes                     | Section 6.3                      | Partial                    | Epsilon HUTN provides an extra syntactic shortcut. Not yet supported: parametric attributes and enumeration adjectives. |
| Attributes                  | Section 6.4                      | Yes                        | Epsilon HUTN corrects a mistake in the HUTN standard.        |
| References                  | Sections 6.5 and 6.8             | Yes                        | Limitation: Epsilon HUTN only allows absolute references for non-containment features. |
| Classifier-Level Attributes | Section 6.6                      | Yes                        |                                                              |
| Data values                 | Section 6.7                      | Yes                        | Epsilon HUTN supports Ecore (EMF) types, rather than MOF types. |
| Inline configuration        | Section 6.9                      | No                         | A configuration model is used instead.                       |
| Configuration rules         | Section 5                        | Partial                    | Currently supported: IdentifierConfig and DefaultValueConfig rules. |

## Extra Object Shorthand

Epsilon HUTN allows classes with no body to be terminated with a semi-colon rather than with a pair of empty brackets, for example the following are equivalent in Epsilon HUTN:

```
Family "The Smiths" {}
Family "The Smiths";
```

This form appears in Figure 6.5 of the HUTN specification, but oddly is not supported in the grammar provided by the HUTN specification.

## Parametric Attributes

The HUTN specification allows classes to be instantiated with arguments, for example:

```
Coordinate (3.5, 7.3) {}
```

The above code assumes that configuration rules have been specified for the parameters of Coordinate.

Epsilon HUTN does not currently support this form. Instead, the following code can be used:

```
Coordinate { 
  x: 3.5
  y: 7.3 
}
```

## Enumeration Adjectives

The HUTN specification allows objects to be prefixed with enumeration values as adjectives, for example:

```
poodle Dog {}
```

The above code assumes that configuration rules have been specified to configure Dog to accept a feature, "breed," as an enumeration adjective.

Epsilon HUTN does not currently support this form. Instead, the following code can be used:

```
Dog { 
  breed: poodle 
}
```

## Potential error in the OMG HUTN Specification

Section 6.4 of the OMG HUTN specification appears to contain an error. Grammar rule [20] implies that AttributeName is optional in specifying a KeywordAttribute. However, the semantics of an empty KeywordAttribute or a single tilde as a KeywordAttribute are not defined.

Epsilon HUTN ensures that an AttributeName is specified for every
KeywordAttribute.

## Absolute References

The HUTN specification allows relative referencing for non-containment references. For example:

```
ShapePackage "triangles" {
  Polygon "my_triangle" {
    Coordinate (3.6, 7.3) {}
    Coordinate (5.2, 7.6) {}
    Coordinate (9.4, 13) {}
  }
}

ShapePackage "lines" {
  Polygon "my_line" {
     Coordinate (4.6, 78.3) {}
     Coordinate (10.4, 1.5) {}
  }
    
  Diagram "my_diagram" {
    shapes: "//triangles/my_triangle", "/my_line"
  }
}
```

The Diagram object references two Polygons: "my_triangle" and "my line". The first is referenced with respect to the root of the document ("//"), while the second is referenced with respect to the current package ("/").

Epsilon HUTN does not support relative referencing, and all references are resolved with respect to the diagram root. The "//" prefix is omitted:

```
Diagram "my_diagram" {
  shapes: "my_triangle", "my_line"
}
```
