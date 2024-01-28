import { playground, runButton } from './constants.js';

describe('Tests the default EMG example', () => {
    beforeEach(() => {
      cy.visit(playground + "?emg");
    }),
    it('Tests that the example loads fine and there is text in all editors', () => {
      cy.contains('PetriNet create()');
      cy.contains('?nsuri PetriNet');
      cy.contains('package PetriNet;');
    }),
    it('Checks that the transformation runs fine and a deliverable is produced', () => {
      cy.get(runButton).click();
      cy.contains(":PetriNet");
    })
  });