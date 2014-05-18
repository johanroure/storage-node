<?php
/**
 * Created by PhpStorm.
 * User: blen-lenny
 * Date: 18-05-14
 * Time: 03:25 PM
 */
use \SysAPI\SystemAPI;
use \BasicAPP\BaseController;

class TestController extends BaseController {

    public function indice($context) {
        $status = new SystemAPI('.', 8000);
        $this->res->setContent('{"used_percent":'.$status->DiskHealthy().'}');
        $this->res->send();
    }
}