import { nodeResolve } from '@rollup/plugin-node-resolve';
import commonjs from '@rollup/plugin-commonjs';

export default {
    external: ['ace-editor', 'handlebars'],
    output: {
      format: 'iife',
      name: 'playground',
      globals: {
        'ace-builds': 'ace, require, define',
        'handlebars': 'handlebars'
      }
    },
    plugins: [nodeResolve(), commonjs()]
  };