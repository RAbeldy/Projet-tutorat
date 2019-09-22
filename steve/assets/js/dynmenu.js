// Ajouter la class active pour les menus
$(document).ready(
	function () {
		const regex = /=([a-zA-Z_]*)/gm;
		var url = window.location  + "";
		var arr = url.match(regex);
		var actualPage;
		if(arr[0] == "=superadmin"){
			if((arr[1] == "=interface_superadmin") ||
			(arr[1] == "=interface_set_event") ||
			(arr[1] == "=superadmin_set_event") ||
			(arr[1] == "=events") ||
			(arr[1] == "=future_events_list") ||
			(arr[1] == "=modify_event") ||
			(arr[1] == "=pasts_events_list")){
				actualPage = "Evenement";
			}
			else if((arr[1] == "=interface_tuteur") ||
			(arr[1] == "=tuteurs_list") ||
			(arr[1] == "=tuteurs_belonging_list")){
				actualPage = "Tuteur";
			}
			else if((arr[1] == "=interface_tutore") ||
			(arr[1] == "=tutores_list") ||
			(arr[1] == "=tutores_belonging_list")){
				actualPage = "Tutoré";
			}
			else if((arr[1] == "=interface_tutorat") ||
			(arr[1] == "=create_type_center") ||
			(arr[1] == "=create_center") ||
			(arr[1] == "=typeTutorat_center_list") ||
			(arr[1] == "=delete_typeTutorat") ||
			(arr[1] == "=tutorat_center_list") ||
			(arr[1] == "=delete_tutorat") ||
			(arr[1] == "=admin_tutorat_list") ||
			(arr[1] == "=working_account") ||
			(arr[1] == "=show_associated_tutorat") ||
			(arr[1] == "=remove_tutorat") ||
			(arr[1] == "=interface_account_creation") ||
			(arr[1] == "=create_account") ||
			(arr[1] == "=account_affectation") ||
			(arr[1] == "=static_account")){
				actualPage = "Tutorats";
			}
			else if((arr[1] == "=interface_hours") ||
			(arr[1] == "=validated_hours") ||
			(arr[1] == "=paid_hours")){
				actualPage = "Déclaration / heure";
			}
			else if((arr[1] == "=contact")){
				actualPage = "Questions / Support";
			}
		}
		// Will only work if string in span matches with actualPage
		$('a.nav-link span').filter(function() { return ($(this).text() === actualPage) }).parent().addClass('active');
	}
);