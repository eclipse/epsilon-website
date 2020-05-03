# Preparing the MacOSX distribution

- Build the distribution locally
- Compress it using the following terminal command `zip -r -X epsilon-1.x-unsigned.zip Eclipse.app/`
- Upload the zip file to build.eclipse.org
- Update and run the [https://ci.eclipse.org/epsilon/job/macosx-app-signing](https://ci.eclipse.org/epsilon/job/macosx-app-signing)
- Download the signed zip file locally
- Extract the signed Eclipse.app from the zip file using the following terminal command `unzip epsilon-1.5-signed.zip`
- Use Disk Utility to create a .dmg image that contains the extracted Eclipse.app
