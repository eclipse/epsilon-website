import {playground} from './constants.js';

describe('Tests the settings dialog', () => {
    beforeEach(() => {
      cy.visit(playground);
    }),
    it('Tests that the visibility of the console panel can be toggled', () => {
      
      // Hide the Console panel
      cy.get('#showSettings').click();
      cy.get('#consoleVisible').click();
      cy.get(".success").click(); // Apply button
      cy.contains('Console').not();

      // Show it again
      cy.get('#showSettings').click();
      cy.get('#consoleVisible').click();
      cy.get(".success").click(); // Apply button
      cy.contains('Console');
    })
  });