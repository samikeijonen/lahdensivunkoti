import classNames from 'classnames';

const { registerBlockType } = wp.blocks;
const { InnerBlocks, useBlockProps } = wp.blockEditor;

/**
 * Internal dependencies
 */
import metadata from './block.json';
import ImageSelect from '../../components/image-select';

const { name } = metadata;

const BLOCK_SLUG = 'social-links';

const CHILD_BLOCK = 'social-links-nav';
const ALLOWED_BLOCKS = [`${metadata.category}/${CHILD_BLOCK}`, 'core/heading'];
const TEMPLATE = [
    ['core/heading', { level: 2 }],
    [`${metadata.category}/${CHILD_BLOCK}`, {}],
];

export default registerBlockType(name, {
    edit: (props) => {
        const {
            attributes: { image },
            setAttributes,
            className,
        } = props;

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
                <div className="social-links__wrapper alignwide mx-auto">
                    <InnerBlocks
                        allowedBlocks={ALLOWED_BLOCKS}
                        template={TEMPLATE}
                        templateLock="all"
                    />
                </div>

                <figure className={`social-links__image`}>
                    <ImageSelect
                        image={image}
                        onChange={(newImage) =>
                            setAttributes({ image: newImage })
                        }
                    />
                </figure>
            </div>
        );
    },

    save: () => <InnerBlocks.Content />,
});
