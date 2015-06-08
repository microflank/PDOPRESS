<?php
/**
 * Created by PhpStorm.
 * User: JOREXZOFLANK
 * Date: 6/7/15
 * Time: 11:08 PM
 */

namespace PDOpress\Libraries\Models;

require_once(__DIR__ . '/../Models/MysqlModel.php');

class TestModel extends MysqlModel{

    protected $primary_key = "id";

    Protected $_table = "blog";

    public function __construct()
    {
        parent::__construct();
    }

} 