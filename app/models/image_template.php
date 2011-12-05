<?php

class ImageTemplate extends AppModel {
    var $name = 'ImageTemplate';

    var $actsAs = array(
        'Image' => array(
            'images' => array(
                'image_id' => 'Image'
            ),
            'image_type_id' => 6
        )
    );

    var $belongsTo = array(
        'Image'
    );

    var $field_types = array(
        'Image' => 'file',
        'percent' => 'number'
    );

    function apply($template_url, $image_in_url, $image_out_url, $percent=10) {
        if(empty($template_url) || empty($image_in_url) || empty($image_out_url)) {
            return;
        }
        $template_url = 'img/'.$template_url;
        $image_in_url = 'img/'.$image_in_url;
        $image_out_url = 'img/'.$image_out_url;
//        echo "$template_url - $image_in_url - $image_out_url <br>";
//        debug(file_exists($image_in_url));

        if(!file_exists($template_url) || !file_exists($image_in_url)) {
            return;
        }

        try {
            $template = new Imagick($template_url);
            $image_in = new Imagick($image_in_url);
        } catch(Exception $e) {
            return;
        }

        $template->thumbnailImage(
                $image_in->getImageWidth(),
                $image_in->getImageHeight());

        $template->setImageOpacity($percent/100.0);
        $image_in->compositeImage($template, imagick::COMPOSITE_OVER, 0, 0, imagick::CHANNEL_OPACITY);
        $image_in->writeImage($image_out_url);

        $template->clear();
        $template->destroy();
        $image_in->clear();
        $image_in->destroy();
    }
}

?>
