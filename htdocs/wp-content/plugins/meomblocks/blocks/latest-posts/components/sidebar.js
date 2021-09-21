const { __ } = wp.i18n;
const { PanelBody, RadioControl } = wp.components;
const { InspectorControls } = wp.blockEditor;

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
            </PanelBody>
        </InspectorControls>
    );
};

export default Sidebar;
