<div class="div-left-column">
    <div id="div-basket"><?php echo $this->element('basket');?></div>
    <div class="div-specials"><?php echo $this->element('specials');?></div>
    <div class="div-news"><?php echo $this->element('news');?></div>
</div>
<div class="div-right-column">
    <div id="div-product">
        <h1><?php echo $current_product['Product']['name'];?></h1>
        <div class="div-product-image">
            <?php echo $html->image($current_product['BigImage']['url'], array(
                'class' => 'image-product'
            ));?>
            <?php if(!empty($current_product['ProductImage'])) { ?>
            <div class="div-product-images div-main-product-images">
                <?php foreach($current_product['ProductImage'] as $product_image) {
                    echo $html->link($html->image($product_image['SmallImage']['url']),
                            $this->webroot.'img/'.$product_image['BigImage']['url'], array(
                                'class' => 'link-product-image',
                                'rel' => 'lightbox_product_images',
                                'escape' => false,
                                'title' => $product_image['name']
                            ));
                } ?>
            </div>
            <?php } ?>
            <?php $product_dets_has_images = array(); ?>
            <?php foreach($current_product['ProductDet'] as $product_det) { ?>
            <?php if(!empty($product_det['ProductDetImage'])) { ?>
            <div class="div-product-images div-sub-product-images"
                 product_det_id="<?php echo $product_det['id'];?>">
                <?php 
                $product_dets_has_images[] = $product_det['id'];
                foreach($product_det['ProductDetImage'] as $product_det_image) {
                    echo $html->link($html->image($product_det_image['SmallImage']['url']),
                            $this->webroot.'img/'.$product_det_image['BigImage']['url'], array(
                                'class' => 'link-product-image',
                                'rel' => 'lightbox_product_det_images_'.$product_det['id'],
                                'escape' => false,
                                'title' => $product_det_image['name']
                            ));
                } ?>
            </div>
            <?php } ?>
            <?php } ?>
        </div>
        <div class="div-product-about">
            <?php echo $current_product['Product']['about'];?>
        </div>
        <div class="div-product-order">
            <?php
            echo $form->create('Basket', array(
                'url' => array(
                    'controller' => 'basket',
                    'action' => 'add'
                ),
                'id' => 'form-basket-add',
                'type' => 'GET'
            ));
            echo $form->hidden('product_id', array(
                'value' => $current_product['Product']['id'],
                'id' => 'input-product-id'
            ));
            ?>
            <?php if(!empty($current_product['Product']['product_det_list'])) { ?>
            <div class="div-product-det">
                <div class="label">Вариант: </div>
                <div class="value">
                    <?php echo $form->select('product_det_id', $current_product['Product']['product_det_list'], null, array(
                        'id' => 'select-product-det-id'
                    ), false); ?>
                </div>
            </div>
            <?php } ?>
            <div class="div-product-price">
                <div class="label">Цена: </div>
                <div class="value<?php if($is_opt_price) echo " div-wrong-price"; else echo " div-current-price"?>">
                    <span class="price"><?php echo $current_product['Product']['price'];?></span> руб.
                </div>
            </div>
            <?php if($is_opt_price) { ?>
            <div class="div-product-opt-price">
                <div class="label">Оптовая цена: </div>
                <div class="value<?php if($is_opt_price) echo " div-current-price";?>">
                    <span class="price"><?php echo $current_product['Product']['opt_price'];?></span> руб.
                </div>
            </div>
            <?php } ?>
            <div class="div-product-count">
                <div class="label">Количество: </div>
                <div class="value">
                    <?php
                    echo $form->text('count', array(
                        'id' => 'input-product-count',
                        'value' => 1
                    ));
                    ?>
                </div>
            </div>
            <div class="div-product-sum">
                <div class="label">Сумма</div>
                <div class="value">
                    <span class="price"><?php echo ($is_opt_price)?$current_product['Product']['opt_price']:$current_product['Product']['price'];?></span> руб.
                </div>
            </div>
            <?php
            echo $form->submit('Заказать', array(
                'id' => 'button-basket-add'
            ));
            echo $form->end();
            ?>
        </div>
    </div>
</div>

<script type="text/javascript">
    $(function() {
        $('#div-product .div-product-count #input-product-count').change(update_product_sum);
        $('#div-product .div-product-count #input-product-count').keyup(update_product_sum);
        $('#div-product .div-product-count #input-product-count').keypress(function(e) {
            return (e.which==8 || e.which==0 || (e.which>=48 && e.which<=57));
        });
        
        update_product_sum();
        
        $('#button-basket-add').click(function() {
            var data = {};
            data.product_id = $('#input-product-id').val();
            data.count = $('#input-product-count').val();
            <?php if(!empty($current_product['Product']['product_det_list'])) { ?>
            data.product_det_id = $('#select-product-det-id').val();
            <?php } ?>
            
            $.get('<?php echo $this->webroot;?>basket/add', data, function(data) {
                $('#div-basket').html(data);
            });
//            $('#div-basket').load('<?php echo $this->webroot;?>basket/add', data);
            return false;
        })
    });
    
    function update_product_sum() {
        var current_price = $('#div-product .div-current-price .price').text();
        var count = $('#div-product #input-product-count').val();
        var sum = current_price*count;
        $('#div-product .div-product-sum .price').text(sum);
    }
</script>

<?php if(!empty($current_product['Product']['product_det_list'])) { ?>
<script type="text/javascript">
    var product_dets_images = <?php echo $javascript->object(Set::combine($current_product['ProductDet'], '{n}.id', '{n}.BigImage.url'));?>;
    var product_dets_has_images = <?php echo $javascript->object($product_dets_has_images);?>;
    var product_dets_prices = <?php echo $javascript->object(Set::combine($current_product['ProductDet'], '{n}.id', '{n}.price'));?>;
    var product_dets_opt_prices = <?php echo $javascript->object(Set::combine($current_product['ProductDet'], '{n}.id', '{n}.opt_price'));?>;
    var product_image_url = "<?php echo $current_product['BigImage']['url'];?>";
    $(function() {
        $('#div-product #select-product-det-id').change(function() {
            var product_det_id = $(this).val();
            
            //меняем изображение
            var new_image_url = product_dets_images[product_det_id];
            if(new_image_url==null) new_image_url = product_image_url;
            $('#div-product .image-product').attr('src', '<?php echo $this->webroot;?>img/'+new_image_url);
            
            //меняем изображения
            $('.div-product-images').hide();
            if($.inArray(product_det_id, product_dets_has_images) >= 0) {
                $('.div-sub-product-images[product_det_id='+product_det_id+']').show();
            } else {
                $('.div-main-product-images').show();
            }
            
            //меняем цены
            $('#div-product .div-product-price .price').text(product_dets_prices[product_det_id]);
            <?php if($is_opt_price) { ?>
            $('#div-product .div-product-opt-price .price').text(product_dets_opt_prices[product_det_id]);
            <?php } ?>

            //меняем сумму
            update_product_sum();
        });
        
        $('#div-product #select-product-det-id').change();
    });
</script>
<?php } ?>
