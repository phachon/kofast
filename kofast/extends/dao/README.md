## KoFast dao module

dao 模块，实现数据库分库分表功能

## 使用

- 数据库切分
    - MODE_NONE        无切分
    - MODE_TIME_MONTH  按月切分
    - MODE_TIME_YEAR   按年切分
    - MODE_MOD_2       %2 取模
    - MODE_MOD_4       %4 取模
    - MODE_MOD_8       %8 取模
    - MODE_MOD_16      %16 取模
    - MODE_HASH_MD5    substr(md5($this->_key), -1)
```
$dbName = "test"
$key = 18
$realDbName = Slice_DB::factory(Slice_DB::MODE_MOD_2)
        ->name($dbName)
        ->key($key)
        ->route()
echo $realDbName; //test_0

```

- 表切分
    - MODE_NONE         无切分
    - MODE_TIME_MONTH   按月切分
    - MODE_TIME_YEAR    年切分
    - MODE_MOD_16       %16 取模
    - MODE_MOD_32       %32 取模
    - MODE_MOD_64       %64 取模
    - MODE_MOD_128      %128 取模
    - MODE_MOD_256      %256 取模
    - MODE_MOD_512      %512 取模
    - MODE_HASH_MD5     substr(md5($this->_key), -1)

```
$tableName = "test"
$key = 65
$realTableName = Slice_Table::factory(Slice_Table::MODE_MOD_64)
        ->name($tableName)
        ->key($key)
        ->route()
echo $realTableName; //test_1
```

# Dao 类

方便开发 Dao 数据连接层可以直接继承 Dao 类，已经封装好了获取数据库名和表名的方法

```
class Dao_Test extends Dao {

    protected $_routeDB = Slice_DB::MODE_MOD_2;

    protected $_routeTable = Slice_Table::MODE_MOD_64;

    public function getTableName() {

       $this->_tableName($key)
    }

    public function getDbName() {
       $this->_db($key)
    }
}

```