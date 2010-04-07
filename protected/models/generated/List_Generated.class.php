<?php

/**
 * This is the base class for List.
 * 
 * @see List, CoughObject
 **/
abstract class List_Generated extends CoughObject {
	
	protected static $db = null;
	protected static $dbName = 'mklst';
	protected static $tableName = 'list';
	protected static $pkFieldNames = array('id');
	
	protected $fields = array(
		'id' => null,
		'name' => null,
		'email' => null,
		'list' => null,
		'created' => null,
		'modified' => null,
	);
	
	protected $fieldDefinitions = array(
		'id' => array(
			'db_column_name' => 'id',
			'is_null_allowed' => false,
			'default_value' => null
		),
		'name' => array(
			'db_column_name' => 'name',
			'is_null_allowed' => false,
			'default_value' => null
		),
		'email' => array(
			'db_column_name' => 'email',
			'is_null_allowed' => false,
			'default_value' => null
		),
		'list' => array(
			'db_column_name' => 'list',
			'is_null_allowed' => false,
			'default_value' => null
		),
		'created' => array(
			'db_column_name' => 'created',
			'is_null_allowed' => false,
			'default_value' => null
		),
		'modified' => array(
			'db_column_name' => 'modified',
			'is_null_allowed' => false,
			'default_value' => null
		),
	);
	
	protected $objectDefinitions = array();
	
	// Static Definition Methods
	
	public static function getDb() {
		if (is_null(List::$db)) {
			List::$db = CoughDatabaseFactory::getDatabase(List::$dbName);
		}
		return List::$db;
	}
	
	public static function getDbName() {
		return CoughDatabaseFactory::getDatabaseName(List::$dbName);
	}
	
	public static function getTableName() {
		return List::$tableName;
	}
	
	public static function getPkFieldNames() {
		return List::$pkFieldNames;
	}
	
	// Static Construction (factory) Methods
	
	/**
	 * Constructs a new List object from
	 * a single id (for single key PKs) or a hash of [field_name] => [field_value].
	 * 
	 * The key is used to pull data from the database, and, if no data is found,
	 * null is returned. You can use this function with any unique keys or the
	 * primary key as long as a hash is used. If the primary key is a single
	 * field, you may pass its value in directly without using a hash.
	 * 
	 * @param mixed $idOrHash - id or hash of [field_name] => [field_value]
	 * @return mixed - List or null if no record found.
	 **/
	public static function constructByKey($idOrHash, $forPhp5Strict = '') {
		return CoughObject::constructByKey($idOrHash, 'List');
	}
	
	/**
	 * Constructs a new List object from custom SQL.
	 * 
	 * @param string $sql
	 * @return mixed - List or null if exactly one record could not be found.
	 **/
	public static function constructBySql($sql, $forPhp5Strict = '') {
		return CoughObject::constructBySql($sql, 'List');
	}
	
	/**
	 * Constructs a new List object after
	 * checking the fields array to make sure the appropriate subclass is
	 * used.
	 * 
	 * No queries are run against the database.
	 * 
	 * @param array $hash - hash of [field_name] => [field_value] pairs
	 * @return List
	 **/
	public static function constructByFields($hash) {
		return new List($hash);
	}
	
	public static function getLoadSql() {
		$tableName = List::getTableName();
		return '
			SELECT
				`' . $tableName . '`.*
			FROM
				`' . List::getDbName() . '`.`' . $tableName . '`
		';
	}
	
	// Generated attribute accessors (getters and setters)
	
	public function getId() {
		return $this->getField('id');
	}
	
	public function setId($value) {
		$this->setField('id', $value);
	}
	
	public function getName() {
		return $this->getField('name');
	}
	
	public function setName($value) {
		$this->setField('name', $value);
	}
	
	public function getEmail() {
		return $this->getField('email');
	}
	
	public function setEmail($value) {
		$this->setField('email', $value);
	}
	
	public function getList() {
		return $this->getField('list');
	}
	
	public function setList($value) {
		$this->setField('list', $value);
	}
	
	public function getCreated() {
		return $this->getField('created');
	}
	
	public function setCreated($value) {
		$this->setField('created', $value);
	}
	
	public function getModified() {
		return $this->getField('modified');
	}
	
	public function setModified($value) {
		$this->setField('modified', $value);
	}
	
	// Generated one-to-one accessors (loaders, getters, and setters)
	
	// Generated one-to-many collection loaders, getters, setters, adders, and removers
	
}

?>