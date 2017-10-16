<?php
/** 
 * UEditor 上传类封装
 * @author phachon@163.com
 */
abstract class UEditor_Upload {

	/**
	 * 文件域名
	 * @var string
	 */
	protected $_fileField = '';

	/**
	 * 文件上传对象
	 * @var [type]
	 */
	protected $_file = NULL;

	/**
	 * 文件上传对象
	 * @var string
	 */
	protected $_base64 = NULL;

	/**
	 * 原始文件名
	 * @var string
	 */
	protected $_oriName = '';

	/**
	 * 新文件名
	 * @var string
	 */
	protected $_fileName = '';

	/**
	 * 配置信息
	 * @var array
	 */
	protected $_config = array ();

	/**
	 * 完整文件名,即从当前配置目录开始的URL
	 * @var string
	 */
	protected $_fullName = '';

	/**
	 * 完整文件名,即从当前配置目录开始的URL
	 * @var string
	 */
	protected $_filePath = '';

	/**
	 * 文件大小
	 * @var integer
	 */
	protected $_fileSize = 2048000;

	/**
	 * 文件类型
	 * @var string
	 */
	protected $_fileType = '';

	/**
	 * 上传状态信息,
	 * @var string
	 */
	protected $_stateInfo = '';

	/**
	 * 返回类型
	 * @var string
	 */
	protected $_returnType = '';

	/**
	 * 上传状态映射表，国际化用户需考虑此处数据的国际化
	 * @var array
	 */
	protected $_stateMap = array(
		"SUCCESS",
		"文件大小超出 upload_max_filesize 限制",
		"文件大小超出 MAX_FILE_SIZE 限制",
		"文件未被完整上传",
		"没有文件被上传",
		"上传文件为空",
		"ERROR_TMP_FILE" => "临时文件错误",
		"ERROR_TMP_FILE_NOT_FOUND" => "找不到临时文件",
		"ERROR_SIZE_EXCEED" => "文件大小超出网站限制",
		"ERROR_TYPE_NOT_ALLOWED" => "文件类型不允许",
		"ERROR_CREATE_DIR" => "目录创建失败",
		"ERROR_DIR_NOT_WRITEABLE" => "目录没有写权限",
		"ERROR_FILE_MOVE" => "文件保存时出错",
		"ERROR_FILE_NOT_FOUND" => "找不到上传文件",
		"ERROR_WRITE_CONTENT" => "写入文件内容错误",
		"ERROR_UNKNOWN" => "未知错误",
		"ERROR_DEAD_LINK" => "链接不可用",
		"ERROR_HTTP_LINK" => "链接不是http链接",
		"ERROR_HTTP_CONTENTTYPE" => "链接contentType不正确",
		"INVALID_URL" => "非法 URL",
		"INVALID_IP" => "非法 IP"
	);

	/**
	 * factory
	 * @param string $type
	 * @return UEditor_Upload_Base64|UEditor_Upload_Common|UEditor_Upload_Remote
	 * @throws UEditor_Exception
	 */
	public static function factory($type) {

		$type = strtolower($type);
		if($type == 'common') {
			return new UEditor_Upload_Common();
		}
		if($type == 'base64') {
			return new UEditor_Upload_Base64();
		}
		if($type == 'remote') {
			return new UEditor_Upload_Remote();
		}

		throw new UEditor_Exception("Error UEditor Upload Type");
	}

	/**
	 * 配置信息
	 * @param  array $config
	 * @return object
	 */
	public function config($config) {
		$this->_config = $config;
		return $this;
	}

	/**
	 * 返回类型
	 * @param string $returnType
	 * @return object
	 */
	public function returnType($returnType) {
		$this->_returnType = $returnType;
		return $this;
	}

	/**
	 * 构造函数
	 */
	public function __construct() {
		//$this->_stateMap['ERROR_TYPE_NOT_ALLOWED'] = iconv('unicode', 'utf-8', $this->stateMap['ERROR_TYPE_NOT_ALLOWED']);
	}

	/**
	 * 上传错误检查
	 * @param $errCode
	 * @return string
	 */
	protected function _getStateInfo($errCode) {
		return !$this->_stateMap[$errCode] ? $this->_stateMap["ERROR_UNKNOWN"] : $this->_stateMap[$errCode];
	}

	/**
	 * 获取文件扩展名
	 * @return string
	 */
	protected function _getFileExt() {
		return strtolower(strrchr($this->_oriName, '.'));
	}

	/**
	 * 重命名文件
	 * @return string
	 */
	protected function _getFullName() {
		//替换日期事件
		$t = time();
		$d = explode('-', date("Y-y-m-d-H-i-s"));
		$format = $this->_config["pathFormat"];
		$format = str_replace("{yyyy}", $d[0], $format);
		$format = str_replace("{yy}", $d[1], $format);
		$format = str_replace("{mm}", $d[2], $format);
		$format = str_replace("{dd}", $d[3], $format);
		$format = str_replace("{hh}", $d[4], $format);
		$format = str_replace("{ii}", $d[5], $format);
		$format = str_replace("{ss}", $d[6], $format);
		$format = str_replace("{time}", $t, $format);

		//过滤文件名的非法自负,并替换文件名
		$oriName = substr($this->_oriName, 0, strrpos($this->_oriName, '.'));
		$oriName = preg_replace("/[\|\?\"\<\>\/\*\\\\]+/", '', $oriName);
		$format = str_replace("{filename}", $oriName, $format);

		//替换随机字符串
		$randNum = rand(1, 10000000000) . rand(1, 10000000000);
		if (preg_match("/\{rand\:([\d]*)\}/i", $format, $matches)) {
			$format = preg_replace("/\{rand\:[\d]*\}/i", substr($randNum, 0, $matches[1]), $format);
		}

		$ext = $this->_getFileExt();
		return $format . $ext;
	}

	/**
	 * 获取文件名
	 * @return string
	 */
	protected function _getFileName () {
		return substr($this->_filePath, strrpos($this->_filePath, '/') + 1);
	}

	/**
	 * 获取文件完整路径
	 * @return string
	 */
	protected function _getFilePath() {
		$fullname = $this->_fullName;
		$rootPath = $_SERVER['DOCUMENT_ROOT'];

		if (substr($fullname, 0, 1) != '/') {
			$fullname = '/' . $fullname;
		}

		return $rootPath . $fullname;
	}

	/**
	 * 文件类型检测
	 * @return bool
	 */
	protected function _checkType() {
		return in_array($this->_getFileExt(), $this->_config["allowFiles"]);
	}

	/**
	 * 文件大小检测
	 * @return bool
	 */
	protected function _checkSize() {
		return $this->_fileSize <= ($this->_config["maxSize"]);
	}

	/**
	 * 获取当前上传成功文件的各项信息
	 * @return array
	 */
	protected function _getFileInfo() {
		return array(
			"state" => $this->_stateInfo,
			"url" => $this->_fullName,
			"title" => $this->_fileName,
			"original" => $this->_oriName,
			"type" => $this->_fileType,
			"size" => $this->_fileSize
		);
	}

	/**
	 * 返回信息
	 * @return json | array 
	 */
	public function results() {

		return UEditor_Result::factory($this->_returnType, $this->_getFileInfo())->execute();
	}

	abstract public function execute();
}