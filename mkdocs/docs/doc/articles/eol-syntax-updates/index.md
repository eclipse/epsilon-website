# EOL Syntax Updates

The following is a brief description of changes to the Epsilon Object
Language's syntax in each release.

### 2.1

-   [Elvis operator](https://en.wikipedia.org/wiki/Elvis_operator) as a convenient
    shorthand to use an alternative value if an expression is null.
    `a ?: b` is a concise way of writing `a <> null ? a else b`.

-   [Null-safe navigation operator](https://en.wikipedia.org/wiki/Safe_navigation_operator)
    to allow for easy chaining of feature calls without resorting to null checks.
    For example, `null?.getClass()?.getName()` will return `null` without crashing.

-   `!=` can be used as an alias for `<>` (i.e. "not equals").

### 2.0

-   Ternary expressions, which can be used almost anywhere, not just in
    assignments or returns. Syntax and semantics are identical to Java,
    but you can also use the `else` keyword in place of the `:` if you
    prefer.
-   Native lambda expressions. You can use first-order operation syntax
    or JavaScript-style `=>` for [invoking functional
    interfaces.](http://eclipse.org/epsilon/doc/articles/eol-syntax-updates/../lambda-expressions)
-   Removed old-style OCL comments (`-*` and `--`).
-   `--` can be used to decrement integers.
-   Thread-safe collection types: `ConcurrentBag`, `ConcurrentMap` and
    `ConcurrentSet`.

### 1.4

-   Added support for postfix increment operator (i.e. `i++`) and for
    composite assignment statements (i.e.
    `a +=1; a -= 2; a *= 3; a /= 4;`)

### 0.9.1

-   Added support for externally defined variables.
-   Support for Map literal expressions (e.g.
    `Map {key1 = value1, k2 = v2}`)

### 0.8.8

In 0.8.8 we extended the syntax of EOL so that it looks and feels a bit
more like Java. As the majority of Eclipse/EMF audience are Java
programmers, this will hopefully make their (and our) lives a bit
easier. Of course, all these changes also affect all languages built on
top of EOL.

More specifically, we have introduced:

-   double quotes (`" "`) for string literals,
-   backticks (\` \`) for reserved words,
-   Java-like comments (`//` and `/**/`),
-   `==` as a comparison operator,
-   `=` as an assignment operator (in 0.8.7)

All these changes (except for the double quotes which have now been
replaced by \` \`) are non-breaking: the old syntax (`''` for strings,
`=` for comparison and `:=` for assignment still work). Below is an
example demonstrating the new syntax:

```eol
/*
 This is a multi line comment
*/
// This is a single line comment
var i = 1;
if (i == 1) {
  "Hello World".println();
}

i = 2; // Assigns the value 2 to i

var `variable with spaces` = 3;
`variable with spaces`.println(); // Prints 3
```

If you have suggestions for further Java-ifications of the EOL syntax,
please post your comments to the [Epsilon
forum](http://eclipse.org/epsilon/doc/articles/eol-syntax-updates/../../../forum)
or add them to [bug
292403](https://bugs.eclipse.org/bugs/show_bug.cgi?id=292403).
