# Development Instructions

The Playground uses `webpack` for compiling dependencies and custom JavaScript into a single `bundle.js` file under `dist`, which is then used in `index.html`. To rebuild `bundle.js` you need to run the following commands:

- `npx webpack --mode=development` for a development build (faster build, larger `bundle.js`)
- `npx webpack --mode=production` before you push to GitHub (slower build, smaller `bundle.js`)

## Testing

We use [Cypress](https://cypress.io) for automated testing. Tests are stored under the `cypress/e2e` folder. To run a test, you need to use the following command:

- `npx cypress run --spec "cypress/e2e/eol.cy.js"`
