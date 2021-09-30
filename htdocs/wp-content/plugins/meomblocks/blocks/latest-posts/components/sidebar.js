const { __ } = wp.i18n;
const { PanelBody, RadioControl } = wp.components;
const { InspectorControls } = wp.blockEditor;

/**
 * Internal dependencies
 */
import TermSelector from './../../../components/term-selector';

const Sidebar = (props) => {
    const {
        attributes: { count },
        setAttributes,
    } = props;

    return (
        <InspectorControls>
            <PanelBody title={__('Settings', 'meom-blocks')} initialOpen={true}>
                <RadioControl
                    label={__('How many posts to show', 'meom-blocks')}
                    selected={count}
                    options={[
                        {
                            label: __('Three', 'meom-blocks'),
                            value: '3',
                        },
                        {
                            label: __('Six', 'meom-blocks'),
                            value: '6',
                        },
                    ]}
                    onChange={(newCount) => setAttributes({ count: newCount })}
                />

				<TermSelector taxonomy="category" termIdWanted="termId1" {...props} />
				<TermSelector taxonomy="category" termIdWanted="termId2" {...props} />
				<TermSelector taxonomy="category" termIdWanted="termId3" {...props} />
            </PanelBody>
        </InspectorControls>
    );
};

export default Sidebar;
