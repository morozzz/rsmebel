<?php

class QuestionProduct extends AppModel {
    var $name = 'QuestionProduct';
    
    var $belongsTo = array(
        'Product',
        'QuestionProductType'
    );
    
    var $order = 'QuestionProduct.question_product_type_id, QuestionProduct.created';
    
    var $field_types = array(
        'question' => 'text',
        'answer' => 'text',
        'question_product_type_id' => 'number'
    );

    function afterFind($results, $primary) {
        foreach($results as &$result) {
            if(!empty($result['QuestionProduct']) && !empty($result['QuestionProduct']['created']))
                $result['QuestionProduct']['created'] =
                    date('d.m.Y H:i:s', strtotime($result['QuestionProduct']['created']));
            if(!empty($result['QuestionProduct']) && !empty($result['QuestionProduct']['updated']))
                $result['QuestionProduct']['updated'] =
                    date('d.m.Y', strtotime($result['QuestionProduct']['updated']));
        }
        return $results;
    }
}

?>
