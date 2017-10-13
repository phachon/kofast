<?php
/** 
 * UEditor Remote 上传类封装
 * @author phachon@163.com
 */
class UEditor_Upload_Remote extends UEditor_Upload {

	/**
	 * execute
	 */
	public function execute() {
		$fileField = $this->_config['fieldName'];
		$imgUrl = htmlspecialchars($fileField);
		$imgUrl = str_replace("&amp;", "&", $imgUrl);

		//http开头验证
		if (strpos($imgUrl, "http") !== 0) {
			$this->_stateInfo = $this->_getStateInfo("ERROR_HTTP_LINK");
			return;
		}

		preg_match('/(^https*:\/\/[^:\/]+)/', $imgUrl, $matches);
		$host_with_protocol = count($matches) > 1 ? $matches[1] : '';

		// 判断是否是合法 url
		if (!filter_var($host_with_protocol, FILTER_VALIDATE_URL)) {
			$this->_stateInfo = $this->_getStateInfo("INVALID_URL");
			return;
		}

		preg_match('/^https*:\/\/(.+)/', $host_with_protocol, $matches);
		$host_without_protocol = count($matches) > 1 ? $matches[1] : '';

		// 此时提取出来的可能是 ip 也有可能是域名，先获取 ip
		$ip = gethostbyname($host_without_protocol);
		// 判断是否是私有 ip
		if(!filter_var($ip, FILTER_VALIDATE_IP, FILTER_FLAG_NO_PRIV_RANGE)) {
			$this->_stateInfo = $this->_getStateInfo("INVALID_IP");
			return;
		}

		//获取请求头并检测死链
		$heads = get_headers($imgUrl, 1);
		if (!(stristr($heads[0], "200") && stristr($heads[0], "OK"))) {
			$this->_stateInfo = $this->_getStateInfo("ERROR_DEAD_LINK");
			return;
		}
		//格式验证(扩展名验证和Content-Type验证)
		$fileType = strtolower(strrchr($imgUrl, '.'));
		if (!in_array($fileType, $this->_config['allowFiles']) || !isset($heads['Content-Type']) || !stristr($heads['Content-Type'], "image")) {
			$this->_stateInfo = $this->_getStateInfo("ERROR_HTTP_CONTENTTYPE");
			return;
		}

		//打开输出缓冲区并获取远程图片
		ob_start();
		$context = stream_context_create(
			array('http' => array(
				'follow_location' => false // don't follow redirects
			))
		);
		readfile($imgUrl, false, $context);
		$img = ob_get_contents();
		ob_end_clean();
		preg_match("/[\/]([^\/]*)[\.]?[^\.\/]*$/", $imgUrl, $m);

		$this->_oriName = $m ? $m[1]:"";
		$this->_fileSize = strlen($img);
		$this->_fileType = $this->_getFileExt();
		$this->_fullName = $this->_getFullName();
		$this->_filePath = $this->_getFilePath();
		$this->_fileName = $this->_getFileName();
		$dirname = dirname($this->_filePath);

		//检查文件大小是否超出限制
		if (!$this->_checkSize()) {
			$this->_stateInfo = $this->_getStateInfo("ERROR_SIZE_EXCEED");
			return;
		}

		//创建目录失败
		if (!file_exists($dirname) && !mkdir($dirname, 0777, true)) {
			$this->_stateInfo = $this->_getStateInfo("ERROR_CREATE_DIR");
			return;
		} else if (!is_writeable($dirname)) {
			$this->_stateInfo = $this->_getStateInfo("ERROR_DIR_NOT_WRITEABLE");
			return;
		}

		//移动文件
		if (!(file_put_contents($this->_filePath, $img) && file_exists($this->_filePath))) { //移动失败
			$this->_stateInfo = $this->_getStateInfo("ERROR_WRITE_CONTENT");
		} else { //移动成功
			$this->_stateInfo = $this->_stateMap[0];
		}

		return $this->results();
	}
}