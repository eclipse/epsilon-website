import { file } from 'jszip';
import { playground } from './constants.js';
const path = require('path');

describe('Tests the download dialog', () => {
    beforeEach(() => {
        cy.visit(playground);
    }),
        it('Tests the downloaded zip file', () => {

            var downloadsFolder = Cypress.config("downloadsFolder");
            var exampleFile = path.join(downloadsFolder, 'playground-example.zip');
            var exampleFolder = path.join(downloadsFolder, 'playground-example');

            // Delete the zip file and its expanded folder if they exist
            cy.exec("rm -f " + exampleFile);
            cy.exec("rm -rf " + exampleFolder);
            
            // Open the download dialog
            cy.get('#showDownloadOptions').click();
            cy.get(".success").click(); // Download

            cy.readFile(exampleFile, { timeout: 15000 }).then((contents) => {
                cy.exec("unzip " + exampleFile + " -d " + exampleFolder);

                cy.exec("cd " + exampleFolder + "; gradle run").its('stdout')
                .should('contain', 'BUILD SUCCESSFUL')
            });
        })
});