# 📦 Wordpress Webpack Boilerplate

[![License: MIT](https://img.shields.io/badge/License-MIT-blue.svg)](https://opensource.org/licenses/MIT)

 webpack 5 php boilerplate using Babel and Sass with a hot dev server and an optimized production build.

## Installation

Clone this repo and npm install.

```bash
npm i
```

## Usage

### Development server

```bash
npm start
```

You can view the development server at `localhost:3000`.

### Production build

```bash
npm run build
```

> Note: Install [http-server](https://www.npmjs.com/package/http-server) globally to deploy a simple server.

```bash
npm i -g http-server
```

You can view the deploy by creating a server in `dist`.

```bash
cd dist && http-server
```

## Features

- [webpack](https://webpack.js.org/)
- [Babel](https://babeljs.io/)
- [Sass](https://sass-lang.com/)

## Dependencies

### webpack

- [`webpack`](https://github.com/webpack/webpack) - Module and asset bundler.
- [`webpack-cli`](https://github.com/webpack/webpack-cli) - Command line interface for webpack
- [`webpack-dev-server`](https://github.com/webpack/webpack-dev-server) - Development server for webpack

### Babel

- [`@babel/core`](https://www.npmjs.com/package/@babel/core) - Transpile ES6+ to backwards compatible JavaScript
- [`@babel/preset-env`](https://babeljs.io/docs/en/babel-preset-env) - Smart defaults for Babel
- [`@babel/eslint-parser`](https://github.com/babel/babel/tree/main/eslint/babel-eslint-parser) - allows you to lint all valid Babel code with eslint

### Loaders

- [`babel-loader`](https://webpack.js.org/loaders/babel-loader/) - Transpile files with Babel and webpack
- [`sass-loader`](https://webpack.js.org/loaders/sass-loader/) - Load SCSS and compile to CSS
- [`css-loader`](https://webpack.js.org/loaders/css-loader/) - Resolve CSS imports
- [`file-loader`](https://v4.webpack.js.org/loaders/file-loader/) - Resolves import/require() on a file into a url and emits the file into the output directory
- [`style-loader`](https://webpack.js.org/loaders/style-loader/) - Inject CSS into the DOM
- [`postcss-loader`](https://webpack.js.org/loaders/style-loader/) -  Process CSS with PostCSS

### Plugins

- [`clean-webpack-plugin`](https://github.com/johnagan/clean-webpack-plugin) - Remove/clean build folders
- [`copy-webpack-plugin`](https://github.com/webpack-contrib/copy-webpack-plugin) - Copy files to build directory
- [`mini-css-extract-plugin`](https://github.com/webpack-contrib/mini-css-extract-plugin) - Extract CSS into separate files
- [`eslint-webpack-plugin`](https://webpack.js.org/plugins/eslint-webpack-plugin/) - Extract CSS into separate files
- [`css-minimizer-webpack-plugin`](https://github.com/webpack-contrib/css-minimizer-webpack-plugin) - Optimize and minimize CSS assets
- [`prettier-webpack-plugin `](https://github.com/paulmillr/chokidar) - Automatically process your source files with Prettier when bundling via Webpack
- [`terser-webpack-plugin`](https://webpack.js.org/plugins/terser-webpack-plugin/) - Optimize and minimize Javascript
- [`webpack-manifest-plugin`](https://github.com/shellscape/webpack-manifest-plugin) - Generate an asset manifest
- [`Chokidar ](https://github.com/paulmillr/chokidar) - file watching library for PHP
- [`autoprefixer`](https://github.com/paulmillr/chokidar) - autoprefix css
- [`browser-sync`](https://github.com/BrowserSync/browser-sync) - Keep multiple browsers & devices in sync when building websites
- [`dotenv`](https://github.com/motdotla/dotenv) - Sync your .env files between machines, environments, and team members
- [`postcss-import`](https://github.com/postcss/postcss-import) - This plugin can consume local files, node modules or web_modules. To resolve path of an @import rule
- [`postcss-preset-env`](https://github.com/csstools/postcss-preset-env) - PostCSS Preset Env lets you convert modern CSS into something most browsers can understand

### Linters

- [`eslint`](https://github.com/eslint/eslint) - Enforce styleguide across application

## Author

- [BinaryRx](https://github.com/binaryrx)

## License

This project is open source and available under the [MIT License](LICENSE).