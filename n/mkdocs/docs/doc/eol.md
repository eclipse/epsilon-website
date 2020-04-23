# Epsilon Object Language 

EOL is an imperative programming language for creating, querying and modifying EMF models. You can think of it as an amalgamation of JavaScript and OCL, combining the best of both worlds. As such, it provides all the usual imperative features found in Javascript (e.g. statement sequencing, variables, for and while loops, if branches etc.) and all the nice features of OCL such as those handy collection querying functions (e.g. `Sequence{1..5}.select(x|x>3)`). These first-order operations are executed in parallel and are short-circuiting where possible (e.g. `exists`), so performance is significantly better than OCL.

## Features 

- Simultaneously access/modify many models of (potentially) different metamodels
- All the usual programming constructs (while and for loops, statement sequencing, variables etc.)
- Concise first-order logic OCL operations (select, reject, collect etc.)
- Ability to create and call methods of Java objects
- Support for dynamically attaching operations to existing meta-classes and types at runtime
- Cache the results of expensive operations
- Extended properties
- User interaction
- Create reusable libraries of operations and import them from different Epsilon (not only EOL) modules 

