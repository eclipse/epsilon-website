import {playground, runButton, toggleModelDiagramButton, toggleMetamodelDiagramButton } from './constants.js';

describe('Tests the default EGL example', () => {
    beforeEach(() => {
      cy.visit(playground + "?egl");
    }),
    it('Tests that the example loads fine and there is text in all three editors', () => {
      cy.contains('Project.all.first()');
      cy.contains('<?nsuri psl?>');
      cy.contains('package psl;');
    }),
    it('Checks that the generator runs fine and the expected text is produced', () => {
      cy.get(runButton).click();
      cy.contains("Project: ACME");
    })
  });