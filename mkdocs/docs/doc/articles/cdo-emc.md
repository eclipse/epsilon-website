# Connecting to CDO repositories

Since version 2.5.0, Epsilon includes an EMC driver to connect to an [Eclipse CDO](https://www.eclipse.org/cdo/) model repository.
Although CDO is EMF-based, and its model resources work relatively the same as standard EMF resources, accessing some of its additional features (e.g. branching and prefetching) requires using a specific model driver.

## Prerequisites

When installing Epsilon, ensure that the "Epsilon CDO Model Support" feature in the "Epsilon CDO Integration" group is selected.

If you are using the Epsilon launch configurations from Eclipse, you will also need the "Epsilon CDO Model Support Developer Tools Feature" in order to add CDO models.

## How to use from Eclipse

From an Epsilon launch confgiuration, go to the "Models" tab and click on "Add...".
Tick the "Show all model types" box, to make "CDO Model" appear.
Select "CDO Model" and click on OK.

You will find the following options:

* Identification: this group works the same as any other model.
* Repository access: this group indicates how to locate the model.
    * URL: this is the same URL as that shown in the "CDO Repositories" view, removing the name of the repository (e.g. `jvm://local` for a JVM-only local repository).
    * Repository: this is the name of the repository (same string that you entered from "Repository name" in CDO during creation). For instance, `repo`.
    * Branch: this can be left empty if using the main branch, or you can enter the full path to the branch in question. Note that `branch1` created off from the main branch should be entered as `MAIN/branch1`, rather than as just `branch1`. (If you make a mistake, the driver will list the paths to all available branches.)
    * Path: this is the absolute path (starting with `/`) to the relevant model resource in your CDO repository (e.g. `/model`).
    * Create if missing: if ticked, the driver will automatically create the model resource if it does not exist yet in your repository.
* Prefetching: this section controls CDO's options for automatically prefetching elements from the model, to reduce the number of roundtrips done over the network.
    * Initial collection prefetch size: when first fetching a collection, how many elements to fetch in advance. 0 means "do not fetch any objects until the lists are accessed".
    * Collection resolving chunk size: how many elements to fetch in one chunk when needed.
    * Revision prefetch size: when accessing revisions, how many revisions to fetch per chunk.
    * Use CDO model-based feature analyzer: if enabled, CDO will track which features are being traversed and prefetch those in later accesses of objects of the same EClass.
* Load/Store Options:
    * Due to the fact that CDO works like a database rather than like a file-based model (where you can immediately connect to it and access its entire contents), the "Read on load" option is not used by the driver.
    * The "Store on disposal" option is honored, however. If ticked, the driver will commit a new revision when the model is disposed. If left unticked, the driver will discard the transaction without committing anything to the repository.

For an example with step-by-step instructions, please consult [this project on Github](https://github.com/eclipse-epsilon/epsilon/tree/main/examples/org.eclipse.epsilon.emc.cdo.example).

## How to use from Java

You will need to create a new instance of the `CDOModel` class, and use setter methods to configure it appropriately.
The setter methods match the options listed above.

For concrete examples, please consult the [JUnit tests for the driver](https://github.com/eclipse-epsilon/epsilon/blob/main/tests/org.eclipse.epsilon.emc.cdo.test/src/org/eclipse/epsilon/emc/cdo/tests/CDOPluggedInTestSuite.java).
