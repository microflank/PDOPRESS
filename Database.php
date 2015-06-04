<?php

namespace libraries{

use PDO;
use Container;

use libraries\Common;

Abstract class Database extends Common{
	
	protected $_dbase;

    protected $fetch_mode = "FETCH_OBJ";
	
	protected $db_driver = null;
	
	protected $default_db = null;
	
	private $_connections = array();

   // private $_container;

	/*
		|------------------------------------------
			#DATABASE MANIPULATION PROPERTIES
		|------------------------------------------

	*/

	public $_query;
	public $_results;
	public $_table_fields;
	public $_count;

    /*
		|------------------------------------------
			#DATABASE EXCEPTIONS
		|------------------------------------------

	*/
    private $backtrace;

	public function __construct()
	{
        parent::__construct();

		$this->initialize();
	}
	
	protected function initialize ()
	{
		try{

            $dbconfig = Container::getConfig("databases");

            if (null == $this->db_driver ) {

               $this->db_driver = Container::getConfig('default_database');

            }

            if(null ==  $this->default_db )
            {
                $this->default_db = Container::getConfig('default_conn');
            }

            $this->_dbase = $this->get_connection($this->db_driver, $this->default_db);

            if (!is_resource($this->_dbase)) {

                $dbcredentials = $dbconfig[$this->db_driver][$this->default_db];

                $this->_dbase = new PDO($dbcredentials['dsn'], $dbcredentials['user'], $dbcredentials['password'] );

                $this->set_connection($this->db_driver, $this->default_db, $this->_dbase);

                $this->_dbase->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

            }

		} catch (PDOException $e){
			
		   trigger_error($e->getMessage(), E_USER_ERROR);
		}
	}
	
	public function set_connection($driver, $dbconnection_key, $resource)
	{
		$this->_connections[$driver . $dbconnection_key] = $resource;
	}
	
	public function get_connection($driver, $dbconnection)
	{
		$resource_key = $driver . $dbconnection;
		
		if (array_key_exists($resource_key, $this->_connections)) {

			return $this->_connections[$resource_key];
		}
		
		return false;
	}

    public function db()
    {
       return $this->_dbase;
    }

    public function get_keys($data)
    {
        $keys = '';

        $vals = '';

        $var_symbols = '';

        foreach($data as $key => $val) {

            $keys .=  $key ."," ;

            $vals .=  $val ."," ;

            $var_symbols .= "?,";

        }

        return array( 'fields' => rtrim($keys,','), "values" => rtrim($vals,','), "symbols" => rtrim($var_symbols,','));
    }

    public function getLastId()
    {
        return $this->_dbase->lastInsertId();
    }
	
    /**
     *no body can clone me now
     * because am a private guy
     *
     */

    private function __clone(){

    }
	
}

}