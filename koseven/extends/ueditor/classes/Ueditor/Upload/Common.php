<?php
/** 
 * UEditor Common 上传类封装
 * @author phachon@163.com
 */
class UEditor_Upload_Common extends UEditor_Upload {

	/**
	 * execute
	 */
	public function execute() {
		$fileField = $this->_config['fieldName'];
//		var_dump($_FILES);
		$file = $this->_file = $_FILES[$fileField];
		if (!$file) {
			$this->_stateInfo = $this->_getStateInfo("ERROR_FILE_NOT_FOUND");
			return;
		}
		if ($this->_file['error']) {
			$this->_stateInfo = $this->_getStateInfo($file['error']);
			return;
		} else if (!file_exists($file['tmp_name'])) {
			$this->_stateInfo = $this->_getStateInfo("ERROR_TMP_FILE_NOT_FOUND");
			return;
		} else if (!is_uploaded_file($file['tmp_name'])) {
			$this->_stateInfo = $this->_getStateInfo("ERROR_TMPFILE");
			return;
		}

		$this->_oriName = $file['name'];
		$this->_fileSize = $file['size'];
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

		//检查是否不允许的文件格式
		if (!$this->_checkType()) {
			$this->_stateInfo = $this->_getStateInfo("ERROR_TYPE_NOT_ALLOWED");
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
		if (!(move_uploaded_file($file["tmp_name"], $this->_filePath) && file_exists($this->_filePath))) { //移动失败
			$this->_stateInfo = $this->_getStateInfo("ERROR_FILE_MOVE");
		} else { //移动成功
			$this->_stateInfo = $this->_stateMap[0];
		}

		return $this->results();
	}
}