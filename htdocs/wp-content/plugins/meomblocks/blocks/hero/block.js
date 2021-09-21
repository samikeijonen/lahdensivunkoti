import classNames from 'classnames';

const { registerBlockType } = wp.blocks;
const { InnerBlocks, useBlockProps } = wp.blockEditor;

/**
 * Internal dependencies
 */
import block from './block.json';
import FeaturedImage from '../../components/featured-image';

const ALLOWED_BLOCKS = ['core/paragraph', 'core/heading', 'core/buttons'];
const TEMPLATE = [
    ['core/heading', { level: 1 }],
    ['core/paragraph', {}],
];

export default registerBlockType(block.name, {
    edit: (props) => {
        const {
            attributes: { style },
            className,
        } = props;

        const classes = classNames({
            hero: true,
            [`hero--style-${style}`]: true,
            alignfull: true,
            'content-row': true,
            'editor-outlines': true,
            [`${className}`]: className ? true : false,
        });

        const blockProps = useBlockProps({ // eslint-disable-line
            className: classes,
        });

        return (
            <div {...blockProps}>
                <div className={`hero__container grid has-2-columns`}>
                    <div className={`hero__content`}>
                        <InnerBlocks
                            allowedBlocks={ALLOWED_BLOCKS}
                            template={TEMPLATE}
                        />
                    </div>
                    <FeaturedImage>
                        {(featuredImage) => {
                            if (!featuredImage) return null;
                            return (
                                <figure className={`hero__image`}>
                                    <img
                                        alt={featuredImage.alt_text}
                                        src={featuredImage.source_url}
                                        width={
                                            featuredImage.media_details.width
                                        }
                                        height={
                                            featuredImage.media_details.height
                                        }
                                    />
                                </figure>
                            );
                        }}
                    </FeaturedImage>
                </div>
            </div>
        );
    },

    save: () => <InnerBlocks.Content />,
});
