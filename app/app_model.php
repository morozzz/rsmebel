<?php

define('VALID_UNIQUE',   'isUnique');
define('VALID_HAS_PAIR', 'hasPair');

class AppModel extends Model {
    var $actsAs = array('Containable');
    
    function isUploadedFile($val) {
        if ((isset($val['error']) && $val['error'] == 0) ||
        (!empty( $val['tmp_name']) && $val['tmp_name'] != 'none')) {
            return is_uploaded_file($val['tmp_name']);
        }
        return false;
    }

    function isUnique($params) {
		//
		$data = $this->find($params);
		if($data && !isset($this->data[$this->name]['id']))
			return false;
		if($data && $data[$this->name]['id'] == $this->data[$this->name]['id'])
			return true;
			
		//
    	return !$this->hasAny($params);
    }
    function hasPair($params) {
    	foreach($params as $key => $value) {
    		if(!isset($this->data[$this->name][$key.'_confirm']))
    			return false;
    		if($this->data[$this->name][$key.'_confirm'] != $value)
    			return false;
    	}
		//
    	return true;
    }
    function onError() {
        $this->error = $this->getDataSource()->error;
    }
    function beforeDelete() {
        $belongsTo = array();
        foreach($this->belongsTo as $t => $c) $belongsTo[] = $t;
        $hasOne = array();
        foreach($this->hasOne as $t => $c) $hasOne[] = $t;
        $hasMany = array();
        foreach($this->hasMany as $t => $c) $hasMany[] = $t;
        $hasAndBelongsToMany = array();
        foreach($this->hasAndBelongsToMany as $t => $c) $hasAndBelongsToMany[] = $t;
        $this->unbindModel(array(
            'belongsTo' => $belongsTo,
            'hasOne' => $hasOne,
            'hasMany' => $hasMany,
            'hasAndBelongsToMany' => $hasAndBelongsToMany
        ), false);

        return true;
    }

}

?>
