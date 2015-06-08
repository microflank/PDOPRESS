<?php
/**
 * Created by PhpStorm.
 * User: JOREXZOFLANK
 * Date: 6/7/15
 * Time: 11:04 PM
 */

namespace Controller;

use PDOpress\Libraries\Models\TestModel;

class SampleController {

    function index()
    {
        require_once(BASE_URI . "../Libraries/Models/" . 'TestModel.php');

        $test = new TestModel();

        var_dump($test);

        echo "am the sample controller general";
    }

}
