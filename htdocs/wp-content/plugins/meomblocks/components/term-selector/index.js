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
    const { attributes, setAttributes } = props;
    const options = [];
	console.log(attributes, props);

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
				<>
					<SelectControl
						label={__('Select category 1', 'meom-blocks')}
						options={options}
						onChange={(newTermId) => {
							setAttributes({ termId1: newTermId });
						}}
						value={attributes.termId1}
					/>

					<SelectControl
						label={__('Select category 2', 'meom-blocks')}
						options={options}
						onChange={(newTermId) => {
							setAttributes({ termId2: newTermId });
						}}
						value={attributes.termId2}
					/>

					<SelectControl
						label={__('Select category 3', 'meom-blocks')}
						options={options}
						onChange={(newTermId) => {
							setAttributes({ termId3: newTermId });
						}}
						value={attributes.termId3}
					/>
				</>
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
