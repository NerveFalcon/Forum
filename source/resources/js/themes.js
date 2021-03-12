$('#search').on('input', function() {
	let val = this.value.trim();
	$.ajax({
		url: '/search',
		type: 'POST',
		data: { search: val },
		dataType: 'json',
		success: function(result) {
			// console.log(result);
			if (result) {
				buildSearchPage(result);
				return true;
			} else {
				alert(result.message);
			}
			return false;
		},
		complete: function(res) {
			// console.log(res);
		}
	})
});

function buildSearchPage(material) {
	let res = '';
	for (let i = 0; i < material.length; i++) {
		res += buildTheme(material[i].title, material[i].desc, material[i].id)
	}
	$('#themes').html(res);
}

function buildTheme(title, desc, id) {
	return "<div class=\"theme\">\
				<h2><a href=\"/theme/" + id + "\"><fromphp>" + title + "</fromphp></a></h2>\
				<p><fromphp>" + desc + "</fromphp></p>\
				<a href=\"/theme/" + id + "\">Подробнее</a>\
			</div>";
}

$('#createForm').on('submit', function(e) {
	e.preventDefault();
	let title = $('#topicTitle').val().trim();
	let desc = $('#topicDescription').val().trim();
	$.ajax({
		url: '/create',
		type: 'POST',
		data: {
			title: title,
			description: desc,
		},
		dataType: 'json',
		success: function(result) {
			console.log(result);
			if (result[0] == 'OK') {
				document.location.href = "/theme/" + result[1];
				return true;
			}
			else {
				buildCreateError(result[0]);
			}
		},
		confirm: function(res) {
			console.log(res);
		}
	})
})

function buildCreateError(errors) {
	$('#createErrors').html("<li>" + errors + "</li>");
}
