const { registerBlockType } = wp.blocks;

const { serverSideRender: ServerSideRender } = wp;

import metadata from './block.json';

const { name } = metadata;

export default registerBlockType(name, {
    edit: () => {
        return <ServerSideRender block={name} />;
    },

    save: () => {
        return null;
    },
});
