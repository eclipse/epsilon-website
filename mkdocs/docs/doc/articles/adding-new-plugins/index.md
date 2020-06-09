# Adding new plugins

This article outlines the process of adding new plugins to the main
Epsilon repository.

- Move them to the Epsilon repository. Plugins, features, tests and examples should be placed under the respective directories in the repository. 
- Add `pom.xml` files similar to the ones we already have for each plugin, but changing the `<artifactId>` to the Eclipse plugin name. 
- If you want its tests to be run from Hudson as plug-in tests, add them to the `EpsilonHudsonPluggedInTestSuite` in `org.eclipse.epsilon.test`. 
- Define a feature for the new plugins (feature project in features/, as usual, but with its own POM) and add it to the `site.xml` in the `org.eclipse.epsilon.updatesite.interim` project. 
- Change the `plugins/pom.xml`, `tests/pom.xml` and `features/pom.xml` so they mention the new projects in their `<modules>` section. 
- If you want a specific standalone JAR for this, you\'ll need to update the `jarmodel.xml`, rerun the `jarmodel2mvn.launch` launch config, and then mention the new Maven assembly descriptor in the `org.eclipse.epsilon.standalone/pom.xml` file. There's a readme.txt file in that folder that explains the process. 
- Update `org.eclipse.epsilon/standalone/org.eclipse.epsilon.standalone/pom.xml` with the details of the new plugins.