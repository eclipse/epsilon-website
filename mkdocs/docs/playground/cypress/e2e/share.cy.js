import {playground} from './constants.js';

describe('Tests the share dialog', () => {
    beforeEach(() => {
      cy.visit(playground);
    }),
    it('Tests that the share dialog appears', () => {

      cy.get('#copyShortened').click();
      cy.contains('The link below');
    })
  });