<?php
/**
 * Created by PhpStorm.
 * User: JOREXZOFLANK
 * Date: 5/11/15
 * Time: 7:32 AM
 */

namespace models;

use core\Model;

class Blog extends Model {

    protected $_table  = "blog";

    public $primary_key = "id";

    public function __construct()
    {
        parent::__construct();
    }

} 