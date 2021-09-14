// Project settings, update if needed.
const projectSettings = {
    projectURL: 'https://lahdensivunkoti.local',
    projectPath: './htdocs/wp-content/themes/lahdensivunkoti/',
    blocksPluginPath: './htdocs/wp-content/plugins/meomblocks/',
    outPutFolder: 'build/',
};

// Theme entries, update if needed.
const themeEntries = {
    main: projectSettings.projectPath + 'js/main.js',
    'blocks-editor': projectSettings.projectPath + 'js/blocks-editor.js',
    theme: projectSettings.projectPath + 'scss/theme.scss',
    editor: projectSettings.projectPath + 'scss/editor.scss',
};

// Update **only** block related entries.
const meomblockEntries = {
    // For some reason index.js creates empty folder.
    main: projectSettings.blocksPluginPath + 'src/main.js',
};

/**
 * Note that all MEOM blocks front-end entries are generated automatically.
 *
 * File names should follow these patterns:
 * front-end styles: {slug}-styles.scss
 * editor styles: {slug}-editor.scss
 * front-end JS: {slug}-js.scss
 *
 * For example if the block slug is `hero`:
 * hero-styles.scss
 * hero-editor.scss
 * hero-js.scss
 */

// Browsersync settings.
const browserSyncSettings = {
    host: 'localhost',
    port: 3000,
    proxy: projectSettings.projectURL,
    open: true,
    files: [
        projectSettings.projectPath + projectSettings.outPutFolder + '**/*.js',
        projectSettings.projectPath + projectSettings.outPutFolder + '**/*.css',
        projectSettings.projectPath + 'partials/**/*.php',
        projectSettings.blocksPluginPath +
            projectSettings.outPutFolder +
            '**/*.js',
        projectSettings.blocksPluginPath +
            projectSettings.outPutFolder +
            '**/*.css',
        projectSettings.blocksPluginPath + 'blocks/**/*.php',
    ],
};

module.exports = {
    projectSettings,
    themeEntries,
    meomblockEntries,
    browserSyncSettings,
};
