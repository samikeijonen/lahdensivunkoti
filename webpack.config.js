const glob = require('glob');
const path = require('path');
const defaultConfig = require('@wordpress/scripts/config/webpack.config');
const { mode } = defaultConfig;

const BrowserSyncPlugin = require('browser-sync-webpack-plugin');
const { CleanWebpackPlugin } = require('clean-webpack-plugin'); // eslint-disable-line
const MiniCSSExtractPlugin = require('mini-css-extract-plugin'); // eslint-disable-line
const RemoveEmptyScriptsPlugin = require('webpack-remove-empty-scripts');

// Config settings.
const settings = require('./webpack.settings.js');

// Project theme path.
const projectPath = settings.projectSettings.projectPath;

// Blocks plugin path.
const blocksPluginPath = settings.projectSettings.blocksPluginPath;

// Theme related entries.
const themeEntries = settings.themeEntries;

// Block related entries.
const meomblockEntries = settings.meomblockEntries;

// Get all meom blocks assets automatically.
const meomBlocksAssets = glob.sync(
    `${blocksPluginPath}{/blocks/**/*.js,/blocks/**/*.scss,/acf-blocks/**/*.js,/acf-blocks/**/*.scss}`,
    {
        ignore: [
            `${blocksPluginPath}/blocks/**/block.js`,
            `${blocksPluginPath}/blocks/**/sidebar.js`,
        ],
    }
);

// Create entry object from meomBlocksAssets array.
const meomblockFrontendEntries = meomBlocksAssets.reduce((acc, entryPath) => {
    // Get only filename. There is probably easier way.
    const entryNew = entryPath
        .substring(entryPath.lastIndexOf('/') + 1)
        .replace('.js', '')
        .replace('.scss', '');
    // Start adding as entry.
    acc[entryNew] = entryPath;
    return acc;
}, {});

// Output folder.
const outPutFolder = settings.projectSettings.outPutFolder;

// Is production.
const isProduction = mode === 'production';

// Extra plugins.
const extraPlugins = [
    // During rebuilds, all webpack assets that are not used anymore will be
    // removed automatically. There is an exception added in watch mode for
    // fonts and images. It is a known limitations:
    // https://github.com/johnagan/clean-webpack-plugin/issues/159
    new CleanWebpackPlugin({
        cleanAfterEveryBuildPatterns: ['!fonts/**', '!images/**'],
        cleanStaleWebpackAssets: false,
    }),
    new RemoveEmptyScriptsPlugin(),
    // MiniCSSExtractPlugin to extract the CSS thats gets imported into JavaScript.
    new MiniCSSExtractPlugin({ filename: '[name].css' }),
    new BrowserSyncPlugin(settings.browserSyncSettings, {
        injectCss: true,
        reload: false,
    }),
];

// Plugins.
const pluginsConfig = [...extraPlugins];

// Front-end related externals.
// --webpack-no-externals flag is used in package.json to disable Dependency Extraction Webpack Plugin.
const externalConfig = {
    jquery: 'jQuery',
};

// Externals for blocks.
const blocksExternalConfig = {
    // Utilize notable WordPress bundled scripts via globals.
    jquery: 'jQuery',
    tinymce: 'tinymce',
    moment: 'moment',
    react: 'React',
    'react-dom': 'ReactDOM',
    backbone: 'Backbone',
    lodash: 'lodash',
};

// CSS loaders.
const cssLoaders = [
    {
        loader: MiniCSSExtractPlugin.loader,
    },
    {
        loader: require.resolve('css-loader'),
        options: {
            sourceMap: !isProduction,
            modules: {
                auto: true,
            },
            // We want url() CSS rules as they are, and not do anything about fonts etc.
            url: false,
        },
    },
    {
        loader: require.resolve('postcss-loader'),
    },
];

// Module config.
const moduleConfig = {
    rules: [
        {
            test: /\.jsx?$/,
            exclude: /node_modules/,
            use: [
                {
                    loader: require.resolve('babel-loader'),
                    options: {
                        // Babel uses a directory within local node_modules
                        // by default. Use the environment variable option
                        // to enable more persistent caching.
                        cacheDirectory:
                            process.env.BABEL_CACHE_DIRECTORY || true,

                        babelrc: false,
                        configFile: false,
                        presets: [
                            require.resolve('@wordpress/babel-preset-default'),
                        ],
                    },
                },
            ],
        },
        {
            test: /\.css$/,
            use: cssLoaders,
        },
        {
            test: /\.(sc|sa)ss$/,
            use: [
                ...cssLoaders,
                {
                    loader: require.resolve('sass-loader'),
                    options: {
                        sourceMap: !isProduction,
                    },
                },
            ],
        },
    ],
};

// Multiple array configuration from theme and plugin (or even more).
// @link: https://webpack.js.org/configuration/configuration-types/#exporting-multiple-configurations
const config = [];

const themeConfig = {
    // Use default config from WP scripts.
    // Overwrite needed config after that.
    ...defaultConfig,
    // Name of the config.
    name: 'theme',
    entry: themeEntries,
    output: {
        path: path.resolve(process.cwd(), projectPath + outPutFolder),
    },
    externals: externalConfig,
    module: moduleConfig,
    plugins: pluginsConfig,
};

const meomblockFrontendConfig = {
    // Use default config from WP scripts.
    // Overwrite needed config after that.
    ...defaultConfig,
    // Name of the config.
    name: 'meomblock-frontend',
    entry: meomblockFrontendEntries,
    output: {
        path: path.resolve(process.cwd(), blocksPluginPath + outPutFolder),
    },
    externals: externalConfig,
    module: moduleConfig,
    plugins: pluginsConfig,
};

const meomblockConfig = {
    // Use default config from WP scripts.
    // Overwrite needed config after that.
    ...defaultConfig,
    // Name of the config.
    name: 'meomblocks',
    entry: meomblockEntries,
    output: {
        path: path.resolve(
            process.cwd(),
            // Webpack doesn't allow same output path, let's add blocks folder.
            blocksPluginPath + outPutFolder + 'blocks/'
        ),
    },
    externals: blocksExternalConfig,
    module: moduleConfig,
    plugins: pluginsConfig,
};

// Add theme related config if they exists.
if (Object.entries(themeEntries).length > 0) {
    config.push(themeConfig);
}

// Add meomblock front-end related config if they exists.
if (Object.entries(meomblockFrontendEntries).length > 0) {
    config.push(meomblockFrontendConfig);
}

// Add meomblock related config if they exists.
if (Object.entries(meomblockEntries).length > 0) {
    config.push(meomblockConfig);
}

module.exports = config;
