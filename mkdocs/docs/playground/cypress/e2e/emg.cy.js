import { playground, runButton } from './constants.js';

describe('Tests the default EMG example', () => {
    beforeEach(() => {
      cy.visit(playground + "?emg");
    }),
    it('Tests that the example loads fine and there is text in all editors', () => {
      cy.contains('PetriNet create()');
      cy.contains('package petriNet;');
    }),
    it('Checks that the generation runs fine and a Petri Net is produced', () => {
      cy.get(runButton).click();
      cy.contains(":PetriNet");
    })
  });