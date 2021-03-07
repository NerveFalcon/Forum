$("#logout").removeAttr('disabled');
$("#logout").on('click', function(){ 
	$.ajax({
		url: '/logout',
		type: 'POST',
		data: {logout:'yes'},
		dataType: 'json',
		success: function(result){
			console.log(result);
			if(result = 'OK')
			{
				$('#headerAuth').html(buildAuthBtn());
			}
		}
	})
});


function buildAuthBtn() {
	return '<a href="/auth" class="auth-btn">Регистрация/Авторизация</a>';
}
