function mymodcarrier_load() {
	$('.delivery_option_radio').click(function() {
		mymodcarrier_carrier_selection();
	});
	$('.mymodcarrier_relay_point').click(function() {
		mymodcarrier_relaypoint_selection();
	});
	mymodcarrier_relaypoint_selection();
	mymodcarrier_carrier_selection();
}

function mymodcarrier_carrier_selection() {
	$('#delivery-options').hide();
	$('.delivery_option_radio').each(function() {
		if (!$(this).val().indexOf(id_carrier_relay_point) && $(this).prop('checked')) {
			$('#delivery-options').show();
		}
	});
}

function mymodcarrier_relaypoint_selection() {
	$('.mymodcarrier_relay_point').each(function() {
		if ($(this).prop('checked')) {
			$.ajax({
				type: "POST",
				url: mymodcarrier_ajax_link,
				data: { relay_point: $(this).val() },
				context: document.body
			});
		}
	});
}