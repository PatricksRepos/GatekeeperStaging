// mocha.setup.mjs
import '@babel/register';


// mocha.setup.js
require('@babel/register')({
  extensions: ['.js', '.jsx', '.mjs', '.ts', '.tsx'],
});
