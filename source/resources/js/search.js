$('#search').on('input', function(){
	let val = this.value.trim();
	$.ajax({
		url: '/search',
		type: 'POST',
		data: {search:val},
		dataType: 'json',
		success: function(result){
			// console.log(result);
			if(result)
			{
				$('.themes').append(function()
				{
					let res = '';
					for(let i = 0; i < result.length; i++)
					{
						res += build(result[i].title, result[i].desc, result[i].id)
					}
					$('.themes').html(res);
				});
			} else {
				alert(result.message);
			}
			return false;
		},
		complete: function(result){
			// console.log(result);
		}
	})
})
function build(title, desc, id){
	return "<div>\
				<h2><a href=\"/theme/" + id + "\"><fromphp>" + title + "</fromphp></a></h2>\
				<p><fromphp>" + desc + "</fromphp></p>\
				<a href=\"/theme/" + id + "\">Подробнее</a>\
			</div>"
}