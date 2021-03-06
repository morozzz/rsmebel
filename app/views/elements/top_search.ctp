<?php
echo $html->link('', '/', array('class' => 'link-top-search link-home'));
echo $html->link('', $link_top_email, array('class' => 'link-top-search link-mailto'));
echo $html->link('', array(
    'controller' => 'searches',
    'action' => 'index'
), array('class' => 'link-top-search link-search'));
echo $form->create('Search', array(
    'url' => array(
        'controller' => 'searches',
        'action' => 'index'
    ),
    'id' => 'form-search-top',
    'type' => 'GET'
));
echo $form->input('search_str', array(
    'id' => 'input-search-top-text',
    'value' => '',
    'label' => false,
    'div' => false
));
echo $html->link('поиск', array(
    'controller' => 'searches',
    'action' => 'index'
), array(
    'class' => 'link-top-search-submit'
));
echo $form->submit('поиск', array(
    'id' => 'btn-search-top'
));
echo $form->end();
?>

<script type="text/javascript">
    $(function() {
        $('#div-top-search .link-top-search-submit').click(function() {
            $('#form-search-top').submit();
            return false;
        });
    })
</script>