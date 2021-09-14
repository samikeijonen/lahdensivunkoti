const { __ } = wp.i18n;

wp.domReady(() => {
    // Unregister button style
    wp.blocks.unregisterBlockStyle('core/button', 'default');
    wp.blocks.unregisterBlockStyle('core/button', 'outline');
    wp.blocks.unregisterBlockStyle('core/button', 'squared');
    wp.blocks.unregisterBlockStyle('core/button', 'fill');

    // Unregister quote styles.
    wp.blocks.unregisterBlockStyle('core/quote', 'large');
    wp.blocks.unregisterBlockStyle('core/quote', 'default');

    // Unregister table styles.
    wp.blocks.unregisterBlockStyle('core/table', 'stripes');

    // Register paragraph styles.
    wp.blocks.registerBlockStyle('core/paragraph', {
        name: 'all-caps',
        label: __('All caps', 'lahdensivunkoti'),
    });
});
