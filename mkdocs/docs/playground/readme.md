# Quick Start

To run the playground locally, check that you have [Maven](https://maven.apache.org) and [Node 18](https://nodejs.org/en) installed and then:

- In this directory (`playground`), run `npx webpack --watch --mode=development`
- In the `java` directory, run `mvn package`
- In the parent directory (`docs`), run `npx http-server`
- Open your browser in `http://localhost:8080/playground`

## Webpack

We use `webpack` for compiling dependencies and custom JavaScript into a single `bundle.js` file under `dist`, which is then used in `index.html`. To rebuild `bundle.js` you need to run the following commands:

- `npx webpack --watch --mode=development` for a development build (faster build, larger `bundle.js`)
- `npx webpack --mode=production` before you push to GitHub (slower build, smaller `bundle.js`)

## Testing

We use [Cypress](https://cypress.io) for automated testing. Tests are stored under the `cypress/e2e` folder. To run a single test, you need to use the following command:

- `npx cypress run --browser firefox --spec "cypress/e2e/eol.cy.js"`

To run all the end-to-end tests under `cypress/e2e`, you can use the following command:

- `npx cypress run --browser firefox --spec "cypress/e2e/*.cy.js"`

Note: When the browser is not set to `firefox`, tests in `download.cy.js` can be flaky.

## Why http-server?

The [CheerpJ library](https://cheerpj.com) that we use for syntax checking doesn't work well with the primitive built-in web server of MkDocs as it requires advanced HTTP features. For syntax checking to work, run `npx http-server` from the `docs` directory instead.