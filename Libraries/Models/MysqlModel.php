<?php

namespace PDOpress\Libraries\Models;

use PDOpress\Libraries\Database;
use PDOpress\Libraries\Models\Contracts\IDatabase;

/** USE prefared method of loading the classes as seen below*/
require_once(__DIR__ . '/../Database.php');

require_once(__DIR__ . '/Contracts/IDatabase.php');

class MysqlModel extends Database implements IDatabase {

    protected $_table  = "";

    protected $primary_key = "id";

    protected $select = array();

    protected $where = null;

    protected $join = null;

    protected $extra_clause = null;

    public function __construct()
    {
        parent::__construct();
    }

    public function reset()
    {
        $this->select = array();

        $this->where = null;

        $this->join = null;

        $this->extra_clause = null;
    }

    public function insert($params = array())
    {
        try
        {
            $data = $this->get_keys($params);

            $sql = 'INSERT INTO '. $this->_table . ' ('. $data['fields'] . ') VALUES('. $data['symbols'] .')';

            $this->db()->prepare($sql)->execute(array_values($params));

            return $this->getLastId();
        }
        catch(PDOException $e)
        {
            trigger_error($e->getMessage(), E_USER_ERROR);

            return false;
        }

        return true;
    }

    public function update(array $data, $id = 0)
    {
        $set = "";

        foreach ($data as $key => $value) {

           $value = trim($value);

           $set .= $key . "='$value',";

        }

        $this->where(array($this->primary_key => "$id"));

        $where = ($this->where) ? " WHERE " . $this->where : "";

        $sql = "UPDATE " . $this->_table . " SET " . trim($set,",") . $where ;

        $this->reset();

        $statementH = $this->db()->prepare($sql);

        return $statementH->execute();

    }

    public function table_fields()
    {
        $result = $this->db()->query("SHOW COLUMNS FROM " . $this->_table);

        $table_property = $result->fetchAll(PDO::FETCH_ASSOC);

        return $table_property;
    }

    public function select($field_name)
    {
        if (is_array($field_name)) {
            foreach ($field_name as $value) {
               $value = trim($value);

               if(in_array($value, $this->select))  continue;

               $this->select[] = $value;
            }
        }

        if (is_string($field_name))  {

           $pos = strpos($field_name, ",");

           $field_array = ($pos != -1)?  explode(",", $field_name) : (array) $field_name ;

           $this->select($field_array);
        }

        return $this;
    }

    public function where(array $where)
    {
        foreach ($where as $key => $value) {

           if (null != $this->where) {

            $this->where .= " AND " . $key . " = '$value'";

           } else {

            $this->where =  $key . " = '$value'";

           }

        }

        return $this;
    }

    public function orWhere(array $where)
    {
        foreach ($where as $key => $value) {

            if (null != $this->where) {

                $this->where .= " OR " . $key . " = '$value'";

            } else {

                $this->where =  $key . " = '$value'";

            }

        }

        return $this;
    }

    public function notWhere(array $where)
    {
        foreach ($where as $key => $value) {

            if(null != $this->where) {

                $this->where .= " AND " . $key . " != '$value'";

            } else {

                $this->where =  $key . " != '$value'";
            }
        }

        return $this;
    }

    public function join($clause)
    {
        $this->join .= " JOIN " . $clause;

        return $this;
    }

    public function leftJoin($clause)
    {
        $this->join .= " LEFT JOIN " . $clause;

        return $this;
    }

    public function InnerJoin($clause)
    {
        $this->join .= " INNER JOIN " . $clause;

        return $this;
    }

    public function extraClause($clause)
    {
        $this->extra_clause .= " " . $clause ;
    }

    public function build_query()
    {
        $sql = "SELECT ";

        $sql .= ($this->select)? implode(",", $this->select) : " * ";

        $sql .= " FROM " . $this->_table;

        if($this->where) $sql .= " WHERE " . $this->where ;

        if($this->join) $sql .= " " . $this->join ;

        if($this->extra_clause) $sql .= " " . $this->extra_clause;

        $this->reset();

        return $sql;
    }

    public function fetch_all($data = array(), $function = null)
    {
        $sql = $this->build_query();

        $statementH = $this->db()->prepare($sql);

        $statementH->execute($data);

        $result = null;

        if (null != $function) {

            $result = $statementH->fetchAll(PDO::FETCH_FUNC, $function);

        } else {

            $result = $statementH->fetchAll(PDO::FETCH_OBJ);

        }

        return ($result)? $result : array();
    }

    public function fetch_one($id = 0)
    {
        $this->where(array("$this->primary_key" => "$id"));

        $sql = $this->build_query();

        $statementH = $this->db()->prepare($sql);

        $statementH->execute(array($id));

        $result = $statementH->fetch(PDO::FETCH_OBJ);

        return ($result)? $result : array();
    }

    public function dropdown($field_key, $field_value)
    {
        $dropdown = array();

        $data = $this->select(array($field_key, $field_value))->fetch_all();

        foreach ($data as $key => $value) {

            $dropdown[$value->$field_key] = $value->$field_value;

        }

        return $dropdown;
    }

} 