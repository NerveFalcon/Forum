$('#authForm').on('submit', function(e){
	e.preventDefault();
	let login = $('#login').val();
	let password = $('#password').val();
	let check = $('#remember').is(":checked");
	$.ajax({ 
		url: '/auth',
		type: 'POST',
		data: {
			login: login,
			password: password,
			remember: check
		},
		dataType: 'json',
		success: function(result){
			console.log(result);
			if(result == 'OK'){
				document.location.href = "/";
				return true;
			}
			else{
				buildAuthError(result[0]);
			}
		},
		complete:function(res){
			console.log(res);
		}
	})
})

$('#regForm').on('submit', function(e){
	e.preventDefault();
	let login = $('#login').val();
	let email = $('#email').val();
	let password = $('#password').val();
	let repassword = $('#repassword').val();
	$.ajax({ 
		url: '/reg',
		type: 'POST',
		data: {
			login: login,
			email: email,
			password: password,
			repassword: repassword
		},
		dataType: 'json',
		success: function(result){
			console.log(result);
			if(result == 'OK'){
				document.location.href = "/done";
				return true;
			}
			else{
				buildAuthError(result[0]);
			}
		},
		complete:function(res){
			console.log(res);
		}
	})
})

function buildAuthError($string){
	$('#authErrors').html("<li>"+$string+"</li>");
}
