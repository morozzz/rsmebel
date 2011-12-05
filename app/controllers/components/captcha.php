<?php
//
// See http://bakery.cakephp.org/articles/view/integrate-cakephp-with-kcaptcha
//
class CaptchaComponent extends Object {
	//
    function startup(&$controller) {
        $this->controller = $controller;
    }

	//
    function render() {
        App::import('Vendor', '/kcaptcha/kcaptcha');
        $kcaptcha = new KCAPTCHA();
        $this->controller->Session->write('captcha', $kcaptcha->getKeyString());
    }
}
?>