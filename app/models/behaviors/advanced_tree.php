<?php

App::import('Behavior','Tree');
class AdvancedTreeBehavior extends TreeBehavior {
    function generatetreelist(&$Model, $conditions = null, $keyPath = null, $valuePath = null, $spacer = '_', $recursive = null, $commonFields=array()) {
        $overrideRecursive = $recursive;
        extract($this->settings[$Model->alias]);
        if (!is_null($overrideRecursive)) {
                $recursive = $overrideRecursive;
        }

        if ($keyPath == null && $valuePath == null && $Model->hasField($Model->displayField)) {
                $fields = array($Model->primaryKey, $Model->displayField, $left, $right);
                foreach($commonFields as $commonField) {
                    array_push($fields, $commonField);
                }
        } else {
                $fields = null;
        }

        if ($keyPath == null) {
                $keyPath = '{n}.' . $Model->alias . '.' . $Model->primaryKey;
        }

        if ($valuePath == null) {
                $valuePath = array('{0}{1}', '{n}.tree_prefix', '{n}.' . $Model->alias . '.' . $Model->displayField);

        } elseif (is_string($valuePath)) {
                $valuePath = array('{0}{1}', '{n}.tree_prefix', $valuePath);

        } else {
                $valuePath[0] = '{' . (count($valuePath) - 1) . '}' . $valuePath[0];
                $valuePath[] = '{n}.tree_prefix';
        }
        $order = $Model->alias . '.' . $left . ' asc';
        $results = $Model->find('all', compact('conditions', 'fields', 'order', 'recursive'));
        $stack = array();

        foreach ($results as $i => $result) {
                while ($stack && ($stack[count($stack) - 1] < $result[$Model->alias][$right])) {
                        array_pop($stack);
                }
                $results[$i]['tree_prefix'] = str_repeat($spacer,count($stack));

                $results[$i]['tree_node'][$Model->alias] = array(
                    $Model->displayField => $results[$i]['tree_prefix'].$results[$i][$Model->alias][$Model->displayField]
                );
                foreach($commonFields as $commonField) {
                    $results[$i]['tree_node'] =
                        Set::insert(
                            $results[$i]['tree_node'],
                            $commonField,
                            Set::classicExtract($result, $commonField)
                        );
                }

                $results[$i]['tree_node']['level'] = count($stack);
                
                $stack[] = $result[$Model->alias][$right];
        }
        if (empty($results)) {
                return array();
        }

        return Set::combine($results, $keyPath, '{n}.tree_node');
    }
}

?>
