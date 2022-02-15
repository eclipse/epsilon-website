# Working with versions of Epsilon prior to 2.0

In the old days before we embraced advancements in Eclipse provisioning technology (P2), to use Epsilon one needed to download an Eclipse distribution and manually install the pre-requisite plugins and features required to work with Epsilon.

## Pre-packaged distributions

If you wish to use an older version of Epsilon, the easiest and most compatible way is to download one of the ready-made distributions bundled from the [archives](https://archive.eclipse.org/epsilon/), since they contain the selected version of Epsilon all its mandatory and optional dependencies. You will only need a [Java Runtime Environment](https://adoptopenjdk.net).

Navigate to the directory with the desired version, and download the archive file appropriate for your platform and unzip it. If you are using Windows, please extract the download close to the root of a drive (e.g. C:) as the maximum path length on Windows may not exceed 255 characters by default.

## From a Modeling Distribution

For a more up-to-date IDE, we recommend that users install the [Eclipse Modeling Tools distribution](https://www.eclipse.org/downloads/packages/release/2020-03/r/eclipse-modeling-tools) and install Epsilon along with its (optional) dependencies (these are mainly for working with Eugenia) by adding the following list of update sites through *Help → Install New Software...*:

- **Epsilon** : <https://download.eclipse.org/epsilon/updates/1.5> (substitute *1.5* for the desired version)
- **Emfatic**: <https://download.eclipse.org/emfatic/update>
- **GMF Tooling**: <https://download.eclipse.org/modeling/gmp/gmf-tooling/updates/releases>
- **QVTo**: <https://download.eclipse.org/mmt/qvto/updates/releases/3.9.1>
