module.exports = {
    "extends": [ "@wordpress/stylelint-config/scss" ],
    plugins: [
	    "stylelint-order"
	],
    "rules": {
        // Use spaces.
        "indentation": [4],
        "at-rule-empty-line-before": null,
        "at-rule-no-unknown": null,
        "comment-empty-line-before": null,
        "declaration-property-unit-allowed-list": null,
        "max-line-length": 120,
        "no-descending-specificity": null,
        "rule-empty-line-before": null,
        "selector-class-pattern": null,
    }
};
