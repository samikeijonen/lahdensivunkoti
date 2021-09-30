/**
 * WordPress dependencies
 */
const { __ } = wp.i18n;
const { withSelect } = wp.data;
const { SelectControl, Spinner } = wp.components;

/**
 * Term picker from wanted taxonomy.
 *
 * @param {Object} props Props for component.
 */
const TermSelector = (props) => {
    const { attributes, setAttributes, termIdWanted } = props;
    const options = [];
	console.log(attributes, props, props.termIdWanted);

    options.push({
        value: 0,
        label: __('From which category', 'meom-blocks'),
    });

    if (!props.isRequesting) {
        props.terms.forEach((term) => {
            options.push({
                value: term.id,
                label: term.name,
            });
        });
    }

    return (
        <>
            {props.isRequesting && <Spinner />}

            {!props.isRequesting && (
                <SelectControl
                    label={__('Select a category', 'meom-blocks')}
                    options={options}
                    onChange={(newTermId) => {
                        setAttributes({ termIdWanted: newTermId });
                    }}
                    value={attributes.termIdWanted}
                />
            )}
        </>
    );
};

export default withSelect((select, props) => {
    const { taxonomy } = props;
    const { isResolving } = select('core/data');
    return {
        terms: select('core').getEntityRecords('taxonomy', taxonomy),
        isRequesting: isResolving('core', 'getEntityRecords', [
            'taxonomy',
            taxonomy,
        ]),
        props,
    };
})(TermSelector);
