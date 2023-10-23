( function( api ) {

	// Extends our custom "product-comparison-woocommerce" section.
	api.sectionConstructor['product-comparison-woocommerce'] = api.Section.extend( {

		// No events for this type of section.
		attachEvents: function () {},

		// Always make the section active.
		isContextuallyActive: function () {
			return true;
		}
	} );

} )( wp.customize );