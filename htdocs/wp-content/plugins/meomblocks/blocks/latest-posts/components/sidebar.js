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
				<TermSelector taxonomy="category" {...props} />
            </PanelBody>
        </InspectorControls>
    );
};

export default Sidebar;
