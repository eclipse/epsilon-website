import { file } from 'jszip';
import { playground } from './constants.js';
const path = require('path');

const examples = ["eol", "etl", "evl", "epl", "egl", "egx", "flock"];

// This test can be a bit flaky and fail for no particular reason for some examples
// Before attempting to fix anything, try to run it a few times
examples.forEach((example) => {
    describe("Tests the download dialog of the " + example + " example", () => {
        it("Tests the downloaded file", () => {
            cy.visit(playground + "?" + example);
            var downloadsFolder = Cypress.config("downloadsFolder");
            var exampleFile = path.join(downloadsFolder, 'playground-example.zip');
            var exampleFolder = path.join(downloadsFolder, 'playground-example');

            // Delete the expanded folder if it exists
            cy.exec("rm -rf " + exampleFolder);
            
            // Open the download dialog
            cy.get('#showDownloadOptions').click();
            cy.get(".success").click(); // Download

            // Download the zip file, extract it and run gradle run
            cy.readFile(exampleFile, { timeout: 15000 }).then((contents) => {
                cy.exec("unzip " + exampleFile + " -d " + exampleFolder);

                // The EVL example is expected to fail because of an unsatisfied constraint
                // All other examples are expected to pass
                var expectedOutput = (example == "evl") ? "Duration must be positive" : "BUILD SUCCESSFUL";
                
                cy.exec("cd " + exampleFolder + "; gradle run", { failOnNonZeroExit: false })
                    .its('stdout')
                    .should('contain', expectedOutput);
                
            });
        });
    });
});