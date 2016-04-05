function initContactForm(){
	$('select#sujet').simpleselect();
	$("#contact_ep").validate({
			rules: {
				email:{	email: true	},				
				prenom: { required: true },
				nom: { required: true },
				sujet: { required: true },
				message: { required: true },
				
			},
			messages: {			
				sujet: { required: "Veuillez sélectionner une réponse" },
				
			},
			submitHandler: function() {				
				sendMail();			
			}
		});	
	
	function sendMail(){
		if($('#submit.loading').length == 0 && $('#submit.sendok').length == 0){	
			$.ajax({
					url: themeURL+'/app/inc/inc_projet/send_contact.php',
					type: 'POST',
					data: $('form#contact_ep').serialize(),
					dataType: 'json',
					beforeSend : function() {					
						$('#submit').addClass('loading');
						$('#submit').val('');
					},
					success: function(json) {
						$('#submit').removeClass('loading').addClass('sendok');
						$('#submit').val('Envoyer');
						if(json.resultForm == 'yes') {                        	
							notify('<span class="valid-submit-form">Votre message à bien été envoyé. Merci</span>');						
						} else {							
							notify('<span class="error-submit-form">Il semble y avoir un problème dans l\'envoie de votre message. Vérifiez si tous les champs requis sont renseignés puis renvoyez le. Si le problème persiste, veuillez nous contacter.</span>');	
						}						
					},
                  error: function(){
						$('#submit').removeClass('loading');
                        notify('<span class="error-submit-form">Il semble y avoir un problème dans l\'envoie de votre message. Vérifiez si tous les champs requis sont renseignés puis renvoyez le. Si le problème persiste, veuillez nous contacter.</span>');
                  }          
			});
		}
	}
	
}