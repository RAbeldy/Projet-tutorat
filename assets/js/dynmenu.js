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
			(arr[1] == "=set_event") ||
			(arr[1] == "=pasts_events_list")){
				actualPage = "évènements";
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
		}else if(arr[0] == "=admin"){
			if((arr[1] == "=interface_admin") ||
			(arr[1] == "=events") ||
			(arr[1] == "=admin_set_event") ||
			(arr[1] == "=future_events_list") ||
			(arr[1] == "=pasts_events_list") ||
			(arr[1] == "=interface_tutores_mef") ||
			(arr[1] == "=sign_up") ||
			(arr[1] == "=tutores_list") ||
			(arr[1] == "=link") ||
			(arr[1] == "=tuteurs_list") ||
			(arr[1] == "=choose_tuteur") ||
			(arr[1] == "=show_informations")){
				actualPage = "évènements";
			}
			else if((arr[1] == "=interface_tutorat") ||
			(arr[1] == "=create_center") ||
			(arr[1] == "=tutorat_center_list")){
				actualPage = "Les centres de la Mef";
			}
			else if((arr[1] == "=interface_hours") ||
			(arr[1] == "=declare_hours") ||
			(arr[1] == "=declared_hours")){
				actualPage = "Mes Heures";
			}
			else if((arr[1] == "=interface_selection") ||
			(arr[1] == "=Sfuture_events_list") ||
			(arr[1] == "=selected_tuteurs") ||
			(arr[1] == "=show_all_proposal")){
				actualPage = "Mes listes";
			}
			else if((arr[1] == "=contact")){
				actualPage = "Questions / Support";
			}
		}else if(arr[0] == "=evenements"){
			if((arr[1] == "=admin_set_event") ||
			(arr[1] == "=subscription_list") ||
			(arr[1] == "=display_future_events") ||
			(arr[1] == "=subscribe_to_event") ||
			(arr[1] == "=cancel_participation") ||
			(arr[1] == "=display_pasts_events") ||
			(arr[1] == "=display_subscribed_events")){
				actualPage = "évènements";
			}else if((arr[1] == "=subscribe_to_event")){
				actualPage = "Mes Listes";
			}
		}else if(arr[0] == "=tutorat"){
			if((arr[1] == "=create_center") ||
			(arr[1] == "=subscription_list")){
				actualPage = "évènements";
			}else if((arr[1] == "=create_type_center") ||
			(arr[1] == "=account_affectation")){
				actualPage = "Tutorats";
			}
		}else if(arr[0] == "=tuteurs"){
			if((arr[1] == "=interface_tuteur") ||
			(arr[1] == "=events_creation") ||
			(arr[1] == "=tuteur_set_event")){
				actualPage = "évènements";
			}else if((arr[1] == "=notifications") ||
			(arr[1] == "=waiting_list") ||
			(arr[1] == "=wish_list") ||
			(arr[1] == "=cancel_wish") ||
			(arr[1] == "=working_list") ||
			(arr[1] == "=selection_tutores")){
				actualPage = "Notifications";
			}else if((arr[1] == "=show_proposal")){
				actualPage = "Propositions";
			}
		}else if(arr[0] == "=users"){
			if((arr[1] == "=update_account") ||
			(arr[1] == "=events_creation") ||
			(arr[1] == "=tuteur_set_event")){
				actualPage = "Mon Compte";
			}
		}
		if(arr[1] == "=contact"){
			actualPage = "Questions / Support";
		}
		// Will only work if string in span matches with actualPage
		$('a.nav-link span').filter(function() { return ($(this).text() === actualPage) }).parent().addClass('active');
	}
);
