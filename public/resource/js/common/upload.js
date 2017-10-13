/**
 * 上传类
 * Copyright (c) 2016 phachon@163.com
 */
var Upload = {

	image : function(element, uploadUrl) {

		$(element).fileinput({
			uploadAsync: false, //异步上传
			language: 'zh', //设置语言
			overwriteInitial: false,
			maxFileSize: 1000,
			maxFilesNum: 1,
			uploadUrl: '/website/company_hornor/upload', //上传的地址
			allowedFileExtensions : ['jpg', 'png','gif', 'jpeg'],//接收的文件后缀
			showUpload: true, //是否显示上传按钮
			showCaption: true,//是否显示标题
			enctype: 'multipart/form-data',
			browseClass: "btn btn-primary", //按钮样式
			previewFileIcon: "<i class='glyphicon glyphicon-king'></i>",
			//initialPreview:['<img src="/upload/hornor/574079d0e8cfb.jpg" class="file-preview-image" alt="Desert" title="Desert">'],
			//append: true,
		}).on('filebatchuploadsuccess', function(event, data) {
			if(data.response.code == 1) {
				$("#image_url").val(data.response.data.url);
			} else {
				Common.errorAlert(data.response.messages);
			}
		});
	}
};