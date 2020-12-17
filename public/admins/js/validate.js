$(document).ready(function(){
	//Usuarios login
	$("button[action='login']").on("click",function(){
		$("#formLogin").validate({
			rules:
			{
				email: {
					required: true,
					email: true,
					minlength: 5,
					maxlength: 191
				},

				password: {
					required: true,
					minlength: 8,
					maxlength: 40
				}
			},
			submitHandler: function(form) {
				$("button[action='login']").attr('disabled', true);
				form.submit();
			}
		});
	});

	//Usuarios register
	$("button[action='register']").on("click",function(){
		$("#formRegister").validate({
			rules:
			{
				name: {
					required: true,
					minlength: 2,
					maxlength: 191
				},

				lastname: {
					required: true,
					minlength: 2,
					maxlength: 191
				},

				email: {
					required: true,
					email: true,
					minlength: 5,
					maxlength: 191,
					remote: {
						url: "/usuarios/email",
						type: "get"
					}
				},

				password: {
					required: true,
					minlength: 8,
					maxlength: 40
				},

				terms: {
					required: true
				}
			},
			messages:
			{
				email: {
					remote: "This email is already in use."
				}
			},
			submitHandler: function(form) {
				$("button[action='register']").attr('disabled', true);
				form.submit();
			}
		});
	});

	//Recuperar Contraseña
	$("button[action='recovery']").on("click",function(){
		$("#formRecovery").validate({
			rules:
			{
				email: {
					required: true,
					email: true,
					minlength: 5,
					maxlength: 191
				},

				recovery: {
					required: true,
					email: true,
					minlength: 5,
					maxlength: 191
				}
			},
			submitHandler: function(form) {
				$("button[action='recovery']").attr('disabled', true);
				form.submit();
			}
		});
	});

	//Restaurar Contraseña
	$("button[action='reset']").on("click",function(){
		$("#formReset").validate({
			rules:
			{
				email: {
					required: true,
					email: true,
					minlength: 5,
					maxlength: 191
				},

				password: {
					required: true,
					minlength: 8,
					maxlength: 40
				},

				password_confirmation: { 
					equalTo: "#password",
					minlength: 8,
					maxlength: 40
				}
			},
			messages:
			{
				password_confirmation: { 
					equalTo: 'The data entered does not match.'
				}
			},
			submitHandler: function(form) {
				$("button[action='reset']").attr('disabled', true);
				form.submit();
			}
		});
	});

	//Perfil
	$("button[action='profile']").on("click",function(){
		$("#formProfile").validate({
			rules:
			{
				name: {
					required: true,
					minlength: 2,
					maxlength: 191
				},

				lastname: {
					required: true,
					minlength: 2,
					maxlength: 191
				},

				phone: {
					required: false,
					minlength: 5,
					maxlength: 15
				},

				type: {
					required: true
				},

				password: {
					required: false,
					minlength: 8,
					maxlength: 40
				},

				password_confirmation: { 
					equalTo: "#password",
					minlength: 8,
					maxlength: 40
				}
			},
			messages:
			{
				type: {
					required: 'Select an option.'
				},

				password_confirmation: { 
					equalTo: 'The data entered does not match.'
				}
			},
			submitHandler: function(form) {
				$("button[action='profile']").attr('disabled', true);
				form.submit();
			}
		});
	});

	//Administradores
	$("button[action='admin']").on("click",function(){
		$("#formAdministrator").validate({
			rules:
			{
				name: {
					required: true,
					minlength: 2,
					maxlength: 191
				},

				lastname: {
					required: true,
					minlength: 2,
					maxlength: 191
				},

				email: {
					required: true,
					email: true,
					minlength: 5,
					maxlength: 191,
					remote: {
						url: "/administradores/email",
						type: "get"
					}
				},

				phone: {
					required: false,
					minlength: 5,
					maxlength: 15
				},

				type: {
					required: true
				},

				password: {
					required: true,
					minlength: 8,
					maxlength: 40
				},

				password_confirmation: { 
					equalTo: "#password",
					minlength: 8,
					maxlength: 40
				}
			},
			messages:
			{
				email: {
					remote: "This email is already in use."
				},

				type: {
					required: 'Select an option.'
				},

				password_confirmation: { 
					equalTo: 'The data entered does not match.'
				}
			},
			submitHandler: function(form) {
				$("button[action='admin']").attr('disabled', true);
				form.submit();
			}
		});
	});

	// Banners Create
	$("button[action='banner']").on("click",function(){
		$("#formBannerCreate").validate({
			rules:
			{
				title: {
					required: false,
					minlength: 2,
					maxlength: 191
				},

				text: {
					required: false,
					minlength: 2,
					maxlength: 191
				},

				button: {
					required: true
				},

				text_button: {
					required: false,
					minlength: 2,
					maxlength: 191
				},

				pre_url: {
					required: true
				},

				url: {
					required: false,
					minlength: 3,
					maxlength: 191
				},

				state: {
					required: true
				},

				image: {
					required: true
				}
			},
			messages:
			{
				button: {
					required: 'Select an option.'
				},

				pre_url: {
					required: 'Select an option.'
				},

				state: {
					required: 'Select an option.'
				},

				image: {
					required: 'Select an image.'
				}
			},
			submitHandler: function(form) {
				$("button[action='banner']").attr('disabled', true);
				form.submit();
			}
		});
	});

	// Banners Edit
	$("button[action='banner']").on("click",function(){
		$("#formBannerEdit").validate({
			rules:
			{
				title: {
					required: false,
					minlength: 2,
					maxlength: 191
				},

				text: {
					required: false,
					minlength: 2,
					maxlength: 191
				},

				button: {
					required: true
				},

				text_button: {
					required: false,
					minlength: 2,
					maxlength: 191
				},

				pre_url: {
					required: true
				},

				url: {
					required: false,
					minlength: 3,
					maxlength: 191
				},

				state: {
					required: true
				}
			},
			messages:
			{
				button: {
					required: 'Select an option.'
				},

				pre_url: {
					required: 'Select an option.'
				},

				state: {
					required: 'Select an option.'
				}
			},
			submitHandler: function(form) {
				$("button[action='banner']").attr('disabled', true);
				form.submit();
			}
		});
	});
});