# Resolved Bugs

There are two types of resolved bugs in Epsilon.

1. [Bugs that have been fixed in the latest version of the source code and in the latest interim version but have not been yet integrated in the latest stable version](https://bugs.eclipse.org/bugs/buglist.cgi?query_format=advanced;bug_status=RESOLVED;bug_status=VERIFIED;product=epsilon)
2. [Bugs that have been fixed in the latest stable version](https://bugs.eclipse.org/bugs/buglist.cgi?product=epsilon&cmdtype=doit&order=Reuse+same+sort+as+last+time&bug_status=CLOSED)

## Bugzilla Conventions

Below are the conventions used by the Epsilon committers to characterise reported bugs according to their status.

- New bug: Status → New
- Assigned bug: Status → Assigned
- Bug fixed in the latest version of the source code (interim update site is rebuilt automatically): Status → Resolved/Fixed
- Bug fixed in the latest stable version: Status → Closed/Fixed

## Release Process

- When releasing a new stable version, go through all bugs of type [1], set their status to Closed/Fixed.
