<?php
/**
 * Created by PhpStorm.
 * User: JOREXZOFLANK
 * Date: 5/11/15
 * Time: 7:39 AM
 */

namespace contracts;

interface IDatabase {

    public function initialize();
    /**
     * Retrieves information about the given table name
     * @return array
     */
    public function table_fields();

    /**
     * Inserts a new record to the active table and
     * Retrieves the ID generated for an AUTO_INCREMENT column by the query.
     * @param array $params
     * @return mixed
     */
    public function insert($params = array());

    /**
     * Updates a row of record in a specified table with data
     * @param array $data
     * @param int $id
     * @return mixed
     */
    public function update(array $data, $id = 0);

    /**
     * Adds desired fields to be fetched from a query to a table
     * @param $field_name
     * @return mixed
     */
    public function select($field_name);

    /**
     * Adds desired AND WHERE conditions to query to a table
     * @param array $where
     * @return mixed
     */
    public function where(array $where);

    /**
     * Adds desired OR WHERE conditions to query to a table
     * @param array $where
     * @return mixed
     */
    public function orWhere(array $where);

    /**
     * Adds desired NOT WHERE conditions to query to a table
     * @param array $where
     * @return mixed
     */
    public function notWhere(array $where);

    /**
     * Combine rows from two or more tables, based on a common field between them
     * @param $clause
     * @return mixed
     */
    public function join($clause);

    /**
     * Gets all the records that match in the same way and In Addition gets
     * an extra record for each unmatched records in the left table of the join
     * thus ensuring that every record in the left table gets a mention
     * @param $clause
     * @return mixed
     */
    public function leftJoin($clause);

    /**
     * Gets all the records that match in the same way
     * thus ensuring that only record in both table gets a mention
     * @param $clause
     * @return mixed
     */
    public function InnerJoin($clause);

    /**
     * Appends the limit, order by group by offset clause to the query statement
     * @param $clause
     * @return mixed
     */
    public function extraClause($clause);

    /**
     * Generates the query sql statement
     * @return mixed
     */
    public function build_query();

    /**
     * Retrieve all record from a table
     * @param array $data
     * @param null $function
     * @return mixed
     */
    public function fetch_all($data = array(), $function = null);

    /**
     * Retrieve a single record from a table
     * @param int $id
     * @return mixed
     */
    public function fetch_one($id = 0);

    /**
     * Generate a dropdown assoc array for a given key value pair from active table
     * @param $field_key
     * @param $field_value
     * @return mixed
     */
    public function dropdown($field_key, $field_value);

} 