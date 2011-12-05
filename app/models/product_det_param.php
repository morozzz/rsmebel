<?php

class ProductDetParam extends AppModel {
    var $name = 'ProductDetParam';
    var $belongsTo = array(
        'ProductParam',
        'ProductDet',
        'ProductDetParamValue'
    );
    var $caches = array(
        'all_catalogs'
    );

    function beforeSave() {
        if(empty($this->data['ProductDetParam']['product_det_id']) ||
           empty($this->data['ProductDetParam']['product_param_id']) ||
           !isset($this->data['ProductDetParam']['value'])) {
            return false;
        }
        extract($this->data['ProductDetParam']);

        //получаем product_param_type_id
        $this->ProductParam->recursive = -1;
        $product_param = $this->ProductParam->findById($product_param_id);
        $product_param_type_id = $product_param['ProductParam']['product_param_type_id'];

        //получаем product_det_param_value_id
        $product_det_param_value_id =
            $this->ProductDetParamValue->getIdByName($value, $product_param_type_id);

        //получаем product_det_param, чтобы узнать
        //добавляем мы данные или обновляем
        $product_det_param = $this->find('first', array(
            'conditions' => array(
                'ProductDetParam.product_det_id' => $product_det_id,
                'ProductDetParam.product_param_id' => $product_param_id
            ),
            'contain' => array()
        ));

        //если поля еще нет
        if(empty($product_det_param)) {
            $this->create();
            $this->data = array(
                'ProductDetParam' => array(
                    'product_det_id' => $product_det_id,
                    'product_param_id' => $product_param_id,
                    'product_det_param_value_id' => $product_det_param_value_id
                )
            );
        //если поле уже есть
        } else {
            $product_det_param_id = $product_det_param['ProductDetParam']['id'];
            $this->query("UPDATE {$this->tablePrefix}{$this->useTable} SET ".
                "product_det_param_value_id = $product_det_param_value_id ".
                "WHERE id = $product_det_param_id;");
            return false;
        }
        return true;
    }
}

?>
