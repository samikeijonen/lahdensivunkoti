import classNames from 'classnames';

const { registerBlockType } = wp.blocks;
const { useBlockProps } = wp.blockEditor;

const { serverSideRender: ServerSideRender } = wp;

import metadata from './block.json';

const { name } = metadata;

const BLOCK_SLUG = 'latest-posts';

export default registerBlockType(name, {
    edit: (props) => {
        const { attributes, className } = props;

        const classes = classNames({
            [`${BLOCK_SLUG}`]: true,
            ['alignfull']: true, // eslint-disable-line
            [`${className}`]: className ? true : false,
        });

        const blockProps = useBlockProps({ // eslint-disable-line
            className: classes,
        });

        return (
            <div {...blockProps}>
                <ServerSideRender block={name} attributes={attributes} />
            </div>
        );
    },

    save: () => {
        return null;
    },
});
