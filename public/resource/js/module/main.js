/**
 * main.js
 * @author phachon@163.com
 */


/**
 * 调整工作区尺寸
 */
function resizeContentHeight() {
	var mainHeight = document.body.clientHeight - 55;
	$('#mainContent').height(mainHeight);
}

$(window).resize(function() {
	resizeContentHeight();
});

