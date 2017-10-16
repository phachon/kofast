/**
 * 文本编辑器类实现
 * 依赖 UEditor 插件
 * Copyright (c) 2016 phachon@163.com
 */
var Editor = {
	
	bind : function(element) {
		var ue = UE.getEditor(element, {
			toolbars: [[
				'fullscreen', 'source', '|', 
				'undo', 'redo', '|',
				'bold', 'italic', 'underline', 'fontborder', 'strikethrough', 'superscript', 'subscript', 'removeformat', 'formatmatch', 'autotypeset', '|',
				'forecolor', 'backcolor', 'insertorderedlist', 'insertunorderedlist', 'selectall', 'cleardoc', '|',
				'rowspacingtop', 'rowspacingbottom', 'lineheight', '|',
				'customstyle', 'paragraph', 'fontfamily', 'fontsize', '|',
				'directionalityltr', 'directionalityrtl', 'indent', '|',
				'justifyleft', 'justifycenter', 'justifyright', 'justifyjustify', '|', 
				'touppercase', 'tolowercase', '|',
				'link', 'unlink', '|', 
				'imagenone', 'imageleft', 'imageright', 'imagecenter', '|',
				'simpleupload', 'insertimage', 'insertvideo', 'music', 'attachment', 'map', 'insertframe', '|',
				'horizontal', 'date', 'time', 'spechars', '|',
				'inserttable', 'deletetable', 'insertparagraphbeforetable', 'insertrow', 'deleterow', 'insertcol', 'deletecol', 'mergecells', 'mergeright', 'mergedown', 'splittocells', 'splittorows', 'splittocols', 'charts', '|',
				'preview'
			]],
			serverUrl: 'http://test.com/website/ueditor/upload',
			textarea: 'description',
			autoHeightEnabled: true,
			autoFloatEnabled: true
		});
	}
};