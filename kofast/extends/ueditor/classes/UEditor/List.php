<?php
/**
 * UEditor list
 * @author phachon@163.com
 */
class UEditor_List {

	/**
	 * 允许的文件
	 * @var array
	 */
	protected $_allowFiles = [];

	/**
	 * list 大小
	 * @var int
	 */
	protected $_listSize = 0;

	/**
	 * 路径
	 * @var string
	 */
	protected $_path = '';

	/**
	 * 配置信息
	 * @var array
	 */
	protected $_config = array();

	/**
	 * 返回类型
	 * @var string
	 */
	protected $_returnType = '';

	/**
	 * factory
	 * @param string $type
	 * @return UEditor_Upload_Base64 | UEditor_Upload_Common | UEditor_Upload_Remote
	 * @throws UEditor_Exception
	 */
	public static function factory($type) {

		$type = strtolower($type);
		if ($type == 'file') {
			return new UEditor_List_File();
		}
		if ($type == 'image') {
			return new UEditor_List_Image();
		}

		throw new UEditor_Exception("Error UEditor List Type");
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
	 * 遍历获取目录下的指定类型的文件
	 * @param $path
	 * @param array $allowFiles
	 * @param array $files
	 * @return array
	 */
	protected static function _getFiles($path, $allowFiles, &$files = array()) {
		if (!is_dir($path)) return null;
		if (substr($path, strlen($path) - 1) != '/') $path .= '/';
		$handle = opendir($path);
		while (false !== ($file = readdir($handle))) {
			if ($file != '.' && $file != '..') {
				$path2 = $path . $file;
				if (is_dir($path2)) {
					self::_getFiles($path2, $allowFiles, $files);
				} else {
					if (preg_match("/\.(" . $allowFiles . ")$/i", $file)) {
						$files[] = array(
							'url' => substr($path2, strlen($_SERVER['DOCUMENT_ROOT'])),
							'mtime' => filemtime($path2)
						);
					}
				}
			}
		}
		return $files;
	}
	
	public function execute() {
		$this->_allowFiles = $this->_config['allowFiles'];
		$this->_listSize = $this->_config['listSize'];
		$this->_path = $this->_config['listPath'];

		$allowFiles = substr(str_replace(".", "|", join("", $this->_allowFiles)), 1);

		/* 获取参数 */
		$size = isset($_GET['size']) ? htmlspecialchars($_GET['size']) : $this->_listSize;
		$start = isset($_GET['start']) ? htmlspecialchars($_GET['start']) : 0;
		$end = $start + $size;

		/* 获取文件列表 */
		$path = $_SERVER['DOCUMENT_ROOT'] . (substr($this->_path, 0, 1) == "/" ? "" : "/") . $this->_path;
		$files = self::_getFiles($path, $allowFiles);
		if (!count($files)) {
			$values = array(
				"state" => "no match file",
				"list" => array(),
				"start" => $start,
				"total" => count($files)
			);
			return UEditor_Result::factory($this->_returnType, $values)->execute();
		}

		/* 获取指定范围的列表 */
		$len = count($files);
		for ($i = min($end, $len) - 1, $list = array(); $i < $len && $i >= 0 && $i >= $start; $i--) {
			$list[] = $files[$i];
		}

		//倒序
		//for ($i = $end, $list = array(); $i < $len && $i < $end; $i++){
		//      $list[] = $files[$i];
		//}

		/* 返回数据 */
		$result = array(
			"state" => "SUCCESS",
			"list" => $list,
			"start" => $start,
			"total" => count($files)
		);

		return UEditor_Result::factory($this->_returnType, $result)->execute();
	}
}