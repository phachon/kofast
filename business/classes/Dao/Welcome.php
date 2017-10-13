<?php
/**
 * welcome dao 示例
 * @author phachon@163.com
 */
class Dao_Welcome extends Dao {

	protected $_db = 'default';
	
	protected $_table = 'welcome';
	
	protected $_primaryKey = 'welcome_id';

	protected $_modelName = 'Model_Welcome';
	
	//分库配置 16 位分库
	protected $_routeDB = Slice_DB::MODE_MOD_16;
	
	//分表配置 64 位分表
	protected $_routeTable = Slice_Table::MODE_MOD_64;
	
	const STATUS_DELETE = -1;
	const STATUS_NORMAL = 0;

	/**
	 * 插入一条数据
	 * @param  array $values
	 * @return array
	 */
	public function insert(array $values) {
		if(!$values) {
			return FALSE;
		}
		return DB::insert($this->_table)
			->columns(array_keys($values))
			->values(array_values($values))
			->execute($this->_db);
	}

	/**
	 * 获取数据示例
	 * 返回 model 对象
	 * @return array
	 */
	public function getText() {
		return DB::select('*')
			->from($this->_table)
			->as_object($this->_modelName)
			->execute($this->_db);
	}

	/**
	 * 分库分表示例
	 */
	public function getNameById($id) {
		return DB::select('*')
			->from($this->_tableName($id))
			->as_object($this->_modelName)
			->execute($this->_db($id));
	}
}