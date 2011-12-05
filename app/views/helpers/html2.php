<?php

class Html2Helper extends HtmlHelper {
    function image($path, $options = array()) {
        $image = parent::image($path, $options);
        return $this->corners($image);
    }

    function corners($inc) {
        $str = "";

        $str .= "<div class='corners'>";

        $str .= $inc;
        $str .= "<div class='c1'></div>";
        $str .= "<div class='c2'></div>";
        $str .= "<div class='c3'></div>";
        $str .= "<div class='c4'></div>";

        $str .= "</div>";

        return $str;
    }
}
?>
