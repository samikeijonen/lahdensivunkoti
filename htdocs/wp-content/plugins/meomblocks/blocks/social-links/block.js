import classNames from 'classnames';

const { __ } = wp.i18n;
const { registerBlockType } = wp.blocks;
const { RichText, useBlockProps } = wp.blockEditor;

import metadata from './block.json';

const { name } = metadata;

const BLOCK_SLUG = 'social-links';

export default registerBlockType(name, {
    edit: (props) => {
        const {
			attributes: { text },
			className,
			setAttributes
		} = props;

		const textClass = `${BLOCK_SLUG}__text`;

        const classes = classNames({
            [`${BLOCK_SLUG}`]: true,
            ['alignfull']: true,
            [`${className}`]: className ? true : false,
        });

        const blockProps = useBlockProps({ // eslint-disable-line
            className: classes,
        });

        return (
            <div {...blockProps}>
				<div class="social-links__wrapper alignwide mx-auto">
					<RichText
						tagName="h2"
						allowedFormats={[]}
						className={textClass}
						placeholder={__('Example text', 'meom-blocks')}
						onChange={(newText) => setAttributes({ text: newText })}
						value={text}
					/>
            	</div>
            </div>
        );
    },

    save: () => {
        return null;
    },
});
