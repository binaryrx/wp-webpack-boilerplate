const path = require('path');
const { CleanWebpackPlugin } = require('clean-webpack-plugin');
const MiniCssExtractPlugin = require('mini-css-extract-plugin');
const TerserPlugin = require('terser-webpack-plugin');
const PrettierPlugin = require("prettier-webpack-plugin");
const CssMinimizerPlugin = require("css-minimizer-webpack-plugin");
const { WebpackManifestPlugin  } = require('webpack-manifest-plugin');
const CopyPlugin = require('copy-webpack-plugin');
const ESLintPlugin = require('eslint-webpack-plugin');
const chokidar = require('chokidar');
require('dotenv').config()

module.exports = (env, argv) => {
    const { mode } = argv;

    return {
        entry: './src/index.js',
        output: {
            path: path.resolve(__dirname, 'dist'),
            filename: 'bundle.[fullhash].js',
        },
        mode: 'development',
        devtool: mode === 'development' && 'eval-source-map',
        devServer: {
            onBeforeSetupMiddleware(devServer) {
                chokidar.watch(
                    ['./**/*.php'],
                    { ignoreInitial: true }).on('all', function () {
                        devServer.sendMessage(devServer.webSocketServer.clients, 'content-changed');
                    }
                )
            },
            host: process.env.DEV_SERVER_HOST || 'localhost',
            port: process.env.DEV_SERVER_PORT,
            open: process.env.DEV_SERVER_OPEN || false,
            devMiddleware: {
                writeToDisk: true,
            },
            proxy: {
                '*': {
                    target: process.env.DEV_SERVER_PROXY_TARGET,
                    secure: false,
                    changeOrigin: true,
                    autoRewrite: process.env.DEV_SERVER_PROXY_REWRITE,
                    headers: {
                        'X-ProxiedBy-Webpack': true,
                    },
                }
            },
        },
        module: {
            rules: [
              
                {
                    test: /\.js$/,
                    exclude: /node_modules/,
                    loader: 'babel-loader'
                },
                {
                    test: /\.s?css$/i,
                    use: [
                        MiniCssExtractPlugin.loader,
                        { 
                            loader: 'css-loader',
                            options: { 
                                url: false,
                                sourceMap: true, 
                            } 
                        },
                        'sass-loader',
                        {
                            loader: 'postcss-loader',
                            options: {
                                postcssOptions: {
                                    plugins: [
                                        [
                                            "autoprefixer",
                                            {
                                                //options
                                            }
                                        ]
                                    ]
                                }
                            }
                        }
                    ],
                },
                {
                    test: /\.(jpe?g|png|gif|svg)\$/,
                    use: [
                        {
                            loader: 'file-loader',
                            options: {
                                outputPath: 'images/',
                                name: '[name].[contenthash].[ext]'
                            }
                        }
                    ]
                }
            ]
        },
        plugins: [
            new CleanWebpackPlugin(),
            new CopyPlugin({
                patterns: [
                    {
                        from: path.resolve(__dirname, 'src/images'),
                        to: path.resolve(__dirname, 'dist/images'),
                        globOptions: {
                            dot: false // ignore .gitkeep
                        },
                        noErrorOnMissing: true
                    },
                ]
            }),
            new MiniCssExtractPlugin({ filename: '[name].[contenthash].css' }),
            new ESLintPlugin({eslintPath: "eslint"}),
            new PrettierPlugin(),
            new WebpackManifestPlugin ({publicPath: ""})
        ],
        optimization: {
            minimizer: [new TerserPlugin(), new CssMinimizerPlugin ()]
        }
    }
}