/**
 * 登录
 * Copyright (c) 2016 phachon@163.com
 */
var Login = {

	errorMessage : "#errorMessage",

	text : "登录出错：",

	ajaxSubmit : function(element) {

		function success(message, data) {
			$(Login.errorMessage).addClass("hidden");
			$(Login.errorMessage).html('');
		}
		function failed(message, data) {
			$(Login.errorMessage).removeClass("hidden");
			$(Login.errorMessage).html(Login.text + message);
		}
		function response(result) {
			if(result.code == 0) {
				failed(result.message, result.data);
			}
			if(result.code == 1) {
				success(result.message, result.data);
				if(result.redirect) {
					location.href = result.redirect;
					setTimeout(function() {
						location.reload();
					}, 2000);
				}
			}
		}

		var options = {
			dataType: 'json',
			success: response
		};
		$(element).ajaxSubmit(options);
	}
};