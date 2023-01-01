import {playground, runButton} from './constants.js';

describe('Tests the default Flock example', () => {
    beforeEach(() => {
      cy.visit(playground + "?flock");
    }),
    it('Tests that the example loads fine and there is text in all editors', () => {
      cy.contains('retype Task to Activity');
      cy.contains('nsuri psl');
      cy.contains('class Task');
      cy.contains('class Activity');
    }),
    it('Checks that the transformation runs fine and an activity is produced', () => {
      cy.get(runButton).click();
      cy.contains(":Activity");
    })
  });