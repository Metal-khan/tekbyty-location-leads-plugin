(function( $ ) {
	'use strict';

	/**
	 * All of the code for your public-facing JavaScript source
	 * should reside in this file.
	 *
	 * Note: It has been assumed you will write jQuery code here, so the
	 * $ function reference has been prepared for usage within the scope
	 * of this function.
	 *
	 * This enables you to define handlers, for when the DOM is ready:
	 *
	 * $(function() {
	 *
	 * });
	 *
	 * When the window is loaded:
	 *
	 * $( window ).load(function() {
	 *
	 * });
	 *
	 * ...and/or other possibilities.
	 *
	 * Ideally, it is not considered best practise to attach more than a
	 * single DOM-ready or window-load handler for a particular page.
	 * Although scripts in the WordPress core, Plugins and Themes may be
	 * practising this, we should strive to set a better example in our own work.
	 */

	jQuery(document).on('submit', '#lead-capture-form', function (e) {
		e.preventDefault();

		var formData = {
			name: $('#inputName').val(),
			email: $('#inputEmail').val(),
			phone: $('#inputPhone').val(),
			message: $('#inputMessage').val(),
			services: $('#inputServices').val(),
			location: $('#input_location').val(),
			page_url: $('#input_page_url').val(),
			utm_source: $('#input_utm_source').val(),
			utm_campaign: $('#input_utm_campaign').val(),
		};

		$.ajax({
			url: tekbytLocationLeads.ajax_url,
			type: 'POST',
			data: {
				action: 'submit_lead',
				form_data: formData,
				security: tekbytLocationLeads.lead_form_nonce
			},
			success: function (response) {
				if (response.success) {
					alert('Lead submitted successfully!');
					$('#lead-capture-form')[0].reset();
				} else {
					alert('There was an error submitting the lead: ' + response.data);
				}
			},
			error: function() {
				alert('There was an error submitting the lead. Please try again.');
			}
		});
	});

})( jQuery );
