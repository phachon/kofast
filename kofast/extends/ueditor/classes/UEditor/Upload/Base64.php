<?php
/** 
 * UEditor Base64 上传类封装
 * @author phachon@163.com
 */
class UEditor_Upload_Base64 extends UEditor_Upload {

	/**
	 * execute
	 */
	public function execute() {
		$fileField = $this->_config['fieldName'];
		$base64Data = $_POST[$fileField];
		$img = base64_decode($base64Data);

		$this->_oriName = $this->_config['oriName'];
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