import classNames from 'classnames';

const { __ } = wp.i18n;
const { registerBlockType } = wp.blocks;
const { PanelBody, RadioControl } = wp.components;
const { InspectorControls, InnerBlocks, useBlockProps } = wp.blockEditor;

/**
 * Internal dependencies
 */
import block from './block.json';
import ImageSelect from '../../components/image-select';

const ALLOWED_BLOCKS = [
    'core/paragraph',
    'core/heading',
    'core/button',
];
const TEMPLATE = [
    ['core/heading', {}],
    ['core/paragraph', {}],
];

export default registerBlockType(block.name, {
    edit: (props) => {
        const {
            attributes: { imagePosition, image },
            className,
            setAttributes,
        } = props;

        const classes = classNames({
            'image-and-text': true,
            [`image-and-text--position-${imagePosition}`]: true,
            alignfull: true,
            'content-row': true,
            [`${className}`]: className ? true : false,
        });

        const blockProps = useBlockProps({ // eslint-disable-line
            className: classes,
        });

        return (
            <div {...blockProps}>
                <Sidebar {...props} />
                <div
                    className={`image-and-text__container container grid has-2-columns`}
                >
                    <figure className={`image-and-text__image`}>
                        <ImageSelect
                            image={image}
                            onChange={(newImage) =>
                                setAttributes({ image: newImage })
                            }
                        />
                    </figure>
                    <div className={`image-and-text__content`}>
                        <InnerBlocks
                            allowedBlocks={ALLOWED_BLOCKS}
                            template={TEMPLATE}
                        />
                    </div>
                </div>
            </div>
        );
    },

    save: () => <InnerBlocks.Content />,
});

const Sidebar = (props) => {
    const {
        attributes: { imagePosition },
        setAttributes,
    } = props;
    return (
        <InspectorControls>
            <PanelBody
                title={__('Perusasetukset', 'meom-gutenberg')}
                initalOpen={true}
            >
                <RadioControl
                    label={__('Kuvan sijainti', 'meom-gutenberg')}
                    selected={imagePosition}
                    options={[
                        {
                            label: __('Vasemmalla', 'meom-gutenberg'),
                            value: 'left',
                        },
                        {
                            label: __('Oikealla', 'meom-gutenberg'),
                            value: 'right',
                        },
                    ]}
                    onChange={(newImagePosition) => {
                        setAttributes({ imagePosition: newImagePosition });
                    }}
                />
            </PanelBody>
        </InspectorControls>
    );
};
