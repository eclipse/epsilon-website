const path = require('path');
const nodeExternals = require('webpack-node-externals');

module.exports = {
  entry: './js/Playground.js',
  output: {
    publicPath: 'dist/',
    filename: 'bundle.js',
    path: path.resolve(__dirname, 'dist'),
  },
  /*externals1: [nodeExternals()]*/
};