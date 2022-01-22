'use strict';
const path = require('path');
const webpack = require('webpack');
const MiniCssExtractPlugin = require("mini-css-extract-plugin");
const MomentLocalesPlugin = require('moment-locales-webpack-plugin');
const TerserPlugin = require('terser-webpack-plugin');
const env = process.env.NODE_ENV;
// const OptimizeCssAssetsPlugin = require('optimize-css-assets-webpack-plugin');

const location = {
    build: './assets/javascript/build',
    home: './assets/javascript/src/pages/home',
    posts: './assets/javascript/src/pages/posts',
    post: './assets/javascript/src/pages/post',
    faq: './assets/javascript/src/pages/faq',
    search: './assets/javascript/src/pages/search',
    static: './assets/javascript/src/pages/static',
    medv: './assets/javascript/src/pages/medv',
    serviceitem: './assets/javascript/src/pages/serviceitem',
    serviceSubCategory: './assets/javascript/src/pages/serviceSubCategory',
    testFop: './assets/javascript/src/pages/testFop',
    poll: './assets/javascript/src/pages/poll',


    style: './assets/javascript/src/pages/style',
    printIframe: './assets/javascript/src/pages/printIframe'
};

const output = {
    home: location.home,
    posts: location.posts,
    post: location.post,
    faq: location.faq,
    search: location.search,
    static: location.static,
    medv: location.medv,
    serviceitem: location.serviceitem,
    serviceSubCategory: location.serviceSubCategory,
    testFop: location.testFop,
    poll: location.poll,


    style: location.style,
    printIframe: location.printIframe
};

// define plugins
/*const plugins = (function(env) {
    let plugins = [
        new UglifyJsPlugin({
            sourceMap: false
        }),
    ];

    if(env === 'production') {
        plugins.push(new CleanWebpackPlugin([location.build]));
    }

    return plugins;
})(env);*/

module.exports = {
    /*mode: 'development',
    stats: 'minimal',*/
    entry: output,
    output: {
        filename: '[name].bundle.js',
        path: path.resolve(__dirname, location.build)
    },
    plugins: [
        new MomentLocalesPlugin({
            localesToKeep: ['es-us', 'uk'],
        }),
        new MiniCssExtractPlugin({
            filename: "[name].css",
        }),
        /*new webpack.ProvidePlugin({
            $: 'jquery',
            jQuery: 'jquery'
        })*/
    ],
    module: {
        // configuration regarding modules
        rules: [{ /*rules for modules (configure loaders, parser options, etc.)*/
                enforce: "pre",
                test: /\.js$/,
                exclude: /node_modules/,
                loader: "eslint-loader",
                options: {
                    fix: true,
                    "smarttabs": true
                }
            },
            {
                test: /\.(js|jsx)$/,
                exclude: /node_modules/,
                loader: "babel-loader"
            },
            {
                test: /\.woff($|\?)|\.otf($|\?)|\.woff2($|\?)|\.ttf($|\?)|\.eot($|\?)|\.svg($|\?)|\.png($|\?)|\.jpg($|\?)|\.gif($|\?)/,
                use: "url-loader"
            },
            {
                test: /\.handlebars$/,
                loader: "handlebars-loader"
            },
            {
                test: /\.(sass|scss|css)$/,
                use: [{
                        // creates style nodes from JS strings
                        loader: "style-loader",
                        options: {}
                    },
                    MiniCssExtractPlugin.loader,
                    {
                        /*translates CSS into CommonJS*/
                        loader: "css-loader",
                        options: {
                            url: false
                        }
                    },
                    {
                        loader: 'postcss-loader',
                        options: {
                            plugins: (loader) => [
                                require('autoprefixer')
                            ]
                        }
                    },
                    {
                        /*compiles Sass to CSS, using Node Sass by default*/
                        loader: "sass-loader",
                        options: {
                            sassOptions: {
                                outputStyle: 'compressed',
                            },
                        }
                    }
                ]
            }
        ]
    },
    resolve: {
        extensions: [".js", ".json", ".jsx", ".css"],
        modules: ['node_modules']
    },
    watchOptions: {
        aggregateTimeout: 300,
        poll: false,
        ignored: ['assets/fonts/*', 'assets/images/*', 'node_modules']
    },
    devServer: {
        host: '10.10.2.135',
        port: 3000,
        open: true,
        hot: true,
        inline: true,
        watchContentBase: true,
        historyApiFallback: true,
        /*contentBase: resolve(__dirname, ''),*/
        stats: {
            children: false,
        }
    },
    node: {
        fs: "empty",
    },
    performance: {
        maxEntrypointSize: 40000000,
        maxAssetSize: 40000000,
    },
    optimization: {
        // minimize: false,
        minimizer: [
            new TerserPlugin({
                parallel: 4,
                cache: true,
                terserOptions: {
                    output: {
                        comments: false,
                    },
                },
                extractComments: false,
            }),
            /*new OptimizeCssAssetsPlugin({
                assetNameRegExp: /\.css$/g,
                cssProcessor: require('cssnano'),
                cssProcessorPluginOptions: {
                    preset: ['default', { discardComments: { removeAll: true } }],
                },
                canPrint: true
            }),*/
        ]
    }
}
