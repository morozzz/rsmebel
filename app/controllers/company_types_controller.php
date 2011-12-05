<?php
class CompanyTypesController extends AppController {
    var $name = "CompanyTypes";

    function index() {
        $this->set('company_types', $this->CompanyType->findAll());
    }

    function register() {
        //$company_types[0] = 'Корень';
        $company_types += $this->CompanyType->find('list');
        debug($company_types); die;
        $this->set('company_types', $company_types);
    }
}
?>
