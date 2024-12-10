module.exports = {
  e2e: {
    // Increased to 60 secs as Google Cloud Functions 
    // can take a while is they are not warmed up
    defaultCommandTimeout: 60000,
    video: false,
    screenshotOnRunFailure: true,
    setupNodeEvents(on, config) {
      
    },
  },
};
