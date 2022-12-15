const path = require('path');

module.exports = {
  entry: './js/Playground.js',
  output: {
    publicPath: 'dist/',
    filename: 'bundle.js',
    path: path.resolve(__dirname, 'dist'),
  }
};