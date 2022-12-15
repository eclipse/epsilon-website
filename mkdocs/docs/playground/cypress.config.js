module.exports = {
  e2e: {
    // Increased to 20 secs as Google Cloud Functions 
    // can take a while is they are not warmed up
    defaultCommandTimeout: 20000, 
    setupNodeEvents(on, config) {
      
    },
  },
};
