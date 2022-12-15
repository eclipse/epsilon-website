import {playground, runButton } from './constants.js';

/*
describe('Basic', () => {
  it('Checks that the default EOL example loads fine and there is text in all three editors', () => {
    cy.visit(playground);
    cy.contains('Query Project Plan');
    cy.contains('For every task in the model');
    cy.contains('<?nsuri psl?>');
    cy.contains('package psl;');
  })
});*/

describe('Run EOL', () => {
  it('Checks that the default EOL example runs fine and it produces the expected output', () => {
    cy.visit(playground);
    cy.get(runButton).click();
    cy.contains("Analysis: 3.0");
  })
});

