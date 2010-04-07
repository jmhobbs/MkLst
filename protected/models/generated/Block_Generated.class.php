<?php

/**
 * This is the base class for Block.
 * 
 * @see Block, CoughObject
 **/
abstract class Block_Generated extends CoughObject {
	
	protected static $db = null;
	protected static $dbName = 'mklst';
	protected static $tableName = 'block';
	protected static $pkFieldNames = array('ip');
	
	protected $fields = array(
		'ip' => null,
		'blocked' => null,
	);
	
	protected $fieldDefinitions = array(
		'ip' => array(
			'db_column_name' => 'ip',
			'is_null_allowed' => false,
			'default_value' => null
		),
		'blocked' => array(
			'db_column_name' => 'blocked',
			'is_null_allowed' => false,
			'default_value' => null
		),
	);
	
	protected $objectDefinitions = array();
	
	// Static Definition Methods
	
	public static function getDb() {
		if (is_null(Block::$db)) {
			Block::$db = CoughDatabaseFactory::getDatabase(Block::$dbName);
		}
		return Block::$db;
	}
	
	public static function getDbName() {
		return CoughDatabaseFactory::getDatabaseName(Block::$dbName);
	}
	
	public static function getTableName() {
		return Block::$tableName;
	}
	
	public static function getPkFieldNames() {
		return Block::$pkFieldNames;
	}
	
	// Static Construction (factory) Methods
	
	/**
	 * Constructs a new Block object from
	 * a single id (for single key PKs) or a hash of [field_name] => [field_value].
	 * 
	 * The key is used to pull data from the database, and, if no data is found,
	 * null is returned. You can use this function with any unique keys or the
	 * primary key as long as a hash is used. If the primary key is a single
	 * field, you may pass its value in directly without using a hash.
	 * 
	 * @param mixed $idOrHash - id or hash of [field_name] => [field_value]
	 * @return mixed - Block or null if no record found.
	 **/
	public static function constructByKey($idOrHash, $forPhp5Strict = '') {
		return CoughObject::constructByKey($idOrHash, 'Block');
	}
	
	/**
	 * Constructs a new Block object from custom SQL.
	 * 
	 * @param string $sql
	 * @return mixed - Block or null if exactly one record could not be found.
	 **/
	public static function constructBySql($sql, $forPhp5Strict = '') {
		return CoughObject::constructBySql($sql, 'Block');
	}
	
	/**
	 * Constructs a new Block object after
	 * checking the fields array to make sure the appropriate subclass is
	 * used.
	 * 
	 * No queries are run against the database.
	 * 
	 * @param array $hash - hash of [field_name] => [field_value] pairs
	 * @return Block
	 **/
	public static function constructByFields($hash) {
		return new Block($hash);
	}
	
	public static function getLoadSql() {
		$tableName = Block::getTableName();
		return '
			SELECT
				`' . $tableName . '`.*
			FROM
				`' . Block::getDbName() . '`.`' . $tableName . '`
		';
	}
	
	// Generated attribute accessors (getters and setters)
	
	public function getIp() {
		return $this->getField('ip');
	}
	
	public function setIp($value) {
		$this->setField('ip', $value);
	}
	
	public function getBlocked() {
		return $this->getField('blocked');
	}
	
	public function setBlocked($value) {
		$this->setField('blocked', $value);
	}
	
	// Generated one-to-one accessors (loaders, getters, and setters)
	
	// Generated one-to-many collection loaders, getters, setters, adders, and removers
	
}

?>