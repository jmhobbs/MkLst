<?php

/**
 * This is the base class for Miss.
 * 
 * @see Miss, CoughObject
 **/
abstract class Miss_Generated extends CoughObject {
	
	protected static $db = null;
	protected static $dbName = 'mklst';
	protected static $tableName = 'miss';
	protected static $pkFieldNames = array('ip');
	
	protected $fields = array(
		'ip' => null,
		'list_id' => null,
		'missed' => null,
	);
	
	protected $fieldDefinitions = array(
		'ip' => array(
			'db_column_name' => 'ip',
			'is_null_allowed' => false,
			'default_value' => null
		),
		'list_id' => array(
			'db_column_name' => 'list_id',
			'is_null_allowed' => false,
			'default_value' => null
		),
		'missed' => array(
			'db_column_name' => 'missed',
			'is_null_allowed' => false,
			'default_value' => null
		),
	);
	
	protected $objectDefinitions = array();
	
	// Static Definition Methods
	
	public static function getDb() {
		if (is_null(Miss::$db)) {
			Miss::$db = CoughDatabaseFactory::getDatabase(Miss::$dbName);
		}
		return Miss::$db;
	}
	
	public static function getDbName() {
		return CoughDatabaseFactory::getDatabaseName(Miss::$dbName);
	}
	
	public static function getTableName() {
		return Miss::$tableName;
	}
	
	public static function getPkFieldNames() {
		return Miss::$pkFieldNames;
	}
	
	// Static Construction (factory) Methods
	
	/**
	 * Constructs a new Miss object from
	 * a single id (for single key PKs) or a hash of [field_name] => [field_value].
	 * 
	 * The key is used to pull data from the database, and, if no data is found,
	 * null is returned. You can use this function with any unique keys or the
	 * primary key as long as a hash is used. If the primary key is a single
	 * field, you may pass its value in directly without using a hash.
	 * 
	 * @param mixed $idOrHash - id or hash of [field_name] => [field_value]
	 * @return mixed - Miss or null if no record found.
	 **/
	public static function constructByKey($idOrHash, $forPhp5Strict = '') {
		return CoughObject::constructByKey($idOrHash, 'Miss');
	}
	
	/**
	 * Constructs a new Miss object from custom SQL.
	 * 
	 * @param string $sql
	 * @return mixed - Miss or null if exactly one record could not be found.
	 **/
	public static function constructBySql($sql, $forPhp5Strict = '') {
		return CoughObject::constructBySql($sql, 'Miss');
	}
	
	/**
	 * Constructs a new Miss object after
	 * checking the fields array to make sure the appropriate subclass is
	 * used.
	 * 
	 * No queries are run against the database.
	 * 
	 * @param array $hash - hash of [field_name] => [field_value] pairs
	 * @return Miss
	 **/
	public static function constructByFields($hash) {
		return new Miss($hash);
	}
	
	public static function getLoadSql() {
		$tableName = Miss::getTableName();
		return '
			SELECT
				`' . $tableName . '`.*
			FROM
				`' . Miss::getDbName() . '`.`' . $tableName . '`
		';
	}
	
	// Generated attribute accessors (getters and setters)
	
	public function getIp() {
		return $this->getField('ip');
	}
	
	public function setIp($value) {
		$this->setField('ip', $value);
	}
	
	public function getListId() {
		return $this->getField('list_id');
	}
	
	public function setListId($value) {
		$this->setField('list_id', $value);
	}
	
	public function getMissed() {
		return $this->getField('missed');
	}
	
	public function setMissed($value) {
		$this->setField('missed', $value);
	}
	
	// Generated one-to-one accessors (loaders, getters, and setters)
	
	// Generated one-to-many collection loaders, getters, setters, adders, and removers
	
}

?>