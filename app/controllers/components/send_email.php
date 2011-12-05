<?php
class SendEmailComponent extends Object {

   function send($to, $subject, $body) {

      $from    = "MIME-Version: 1.0" . "\r\n";
      $from   .= "Content-type: text/html; charset=utf-8" . "\r\n";
      $from   .= "From: MTO Angelika<mto24@mail.ru>". "\r\n";
      $from   .= "Subject: $subject\n";

      $body   = $body."<br><br> С уважением компания \"Склад Магазин Торгового Оборудования\" Анжелика. <br>";
      $body   = $body."Сайт: www.mto24.ru <br>";
      $body   = $body."Email: mto24@mail.ru<br>";
      $body   = $body."Телефон: 8(391)2-265-365, 8(391)2-941-495";

      return mail($to, $subject, $body, $from);
    }

   function old_send_img($to, $subject, $body_in) {
        $file_name="logo.jpg";
        $bound="----------4F160803692326F";
        $headers="From: MTO Angelika<mto24@mail.ru>". "\r\n";
        $headers.="Subject: $subject\n";
        $headers.="Mime-Version: 1.0\n";
        $headers.="Content-Type: multipart/mixed; boundary=\"$bound\"\n";
        $body="--$bound\n";
        $body.="Content-type: text/html; charset=\"utf-8\"\n";
        $body.="Content-Transfer-Encoding: 8bit\n\n";
        $body.="<img src=\"cid:spravkaweb_img_1\"><br>";
        $body.=$body_in;
        $body.="<br><br> С уважением компания \"Склад Магазин Торгового Оборудования\" Анжелика. <br>";
        $body.="Сайт: www.mto24.ru <br>";
        $body.="Email: mto24@mail.ru<br>";
        $body.="Телефон: 8(391)2-265-365, 8(391)2-941-495";
        $body.="\n\n--$bound\n";
        $body.="Content-Type: image/jpeg; name=\"".basename($file_name)."\"\n";
        $body.="Content-Transfer-Encoding:base64\n";
        $body.="Content-ID: <spravkaweb_img_1>\n\n";
        $f=fopen($file_name,"rb");
        $body.=base64_encode(fread($f,filesize($file_name)))."\n";
        $body.="--$bound--\n\n";
        return mail($to, $subject, $body, $headers);
   }

   function send_img($to, $subject, $body_in) {
        $file_name="logo.jpg";
        $bound="----------4F160803692326F";
        $headers="From: MTO Angelika<mto24@mail.ru>". "\r\n";
        $headers.="Subject: $subject\n";
        $headers.="Mime-Version: 1.0\n";
        $headers.="Content-Type: multipart/mixed; boundary=\"$bound\"\n";

        $body = "";
        //first_image
        $body.="--$bound\n";
        $body.="Content-Type: image/jpeg; name=\"".basename($file_name)."\"\n";
        $body.="Content-Transfer-Encoding:base64\n";
        $body.="Content-ID: <spravkaweb_img_1>\n\n";
        $f=fopen($file_name,"rb");
        $body.=base64_encode(fread($f,filesize($file_name)))."\n";
        fclose($f);
        
        //other images
        $image_num = 1;
        preg_match_all("{<img[^(src|>)]*src\=\"[/]([^\"]*)\"[^>]*/>}", $body_in, $images);
        $images = $images[1];
        foreach($images as $image) {
            if(file_exists($image)) {
                $image_cid = 'image-'.$image_num++;
                $content_type = mime_content_type($image);
                $body.="\n\n--$bound\n";
                $body.="Content-Type: $content_type; name=\"".basename($image)."\"\n";
                $body.="Content-Transfer-Encoding:base64\n";
                $body.="Content-ID: <$image_cid>\n\n";
                $f=fopen($image,"rb");
                $body.=base64_encode(fread($f,filesize($image)))."\n";
                fclose($f);

                $body_in = str_replace("/".$image, "cid:$image_cid", $body_in);
                $body_in = str_replace("".$image, "cid:$image_cid", $body_in);
            }
        }

        //body text
        $body.="\n\n--$bound\n";
        $body.="Content-type: text/html; charset=\"utf-8\"\n";
        $body.="Content-Transfer-Encoding: 8bit\n\n";
        $body.="<img src=\"cid:spravkaweb_img_1\"><br>";
        $body.=$body_in;
        $body.="<br><br> С уважением компания \"Склад Магазин Торгового Оборудования\" Анжелика. <br>";
        $body.="Сайт: www.mto24.ru <br>";
        $body.="Email: mto24@mail.ru<br>";
        $body.="Телефон: 8(391)2-265-365, 8(391)2-941-495";
        $body.="\n";
        $body.="--$bound--\n\n";
        return mail($to, $subject, $body, $headers);
   }

   function sendd() {
//        $file_name="logo.jpg";
//        $subj="Отправка изображения";
//        $bound="spravkaweb-1234";
//        $headers="From: \"Evgen\" <admin@spravkaweb.ru>\n";
//        $headers.="To: zzzzic@yandex.ru\n";
//        $headers.="Subject: $subj\n";
//        $headers.="Mime-Version: 1.0\n";
//        $headers.="Content-Type: multipart/mixed; boundary=\"$bound\"\n";
//        $body="--$bound\n";
//        $body.="Content-type: text/html; charset=\"windows-1251\"\n";
//        $body.="Content-Transfer-Encoding: 8bit\n\n";
//        $body.="<h3>Привет</h3>
//        Это проба отправки письма с прикрепленной картинкой.<BR>
//        А вот и сама картинка:<BR>
//        <img src=\"cid:spravkaweb_img_1\">";
//        $body.="\n\n--$bound\n";
//        $body.="Content-Type: image/jpeg; name=\"".basename($file_name)."\"\n";
//        $body.="Content-Transfer-Encoding:base64\n";
//        $body.="Content-ID: <spravkaweb_img_1>\n\n";
//        $f=fopen($file_name,"rb");
//        $body.=base64_encode(fread($f,filesize($file_name)))."\n";
//        $body.="--$bound--\n\n";
//        mail("zzzzic@yandex.ru", $subj, $body, $headers);

//      $from    = "MIME-Version: 1.0" . "\r\n";
//      $from   .= "Content-type: text/html; charset=utf-8" . "\r\n";
//      $from   .= "From: MTO Angelika<evdokimenko-a@mail.ru>". "\r\n";
//      $from   .= "Subject: Test\n";
//      $body = "";
//      $body   = $body."<br><br> С уважением компания \"Склад Магазин Торгового Оборудования\" Анжелика. <br>";
//      $body   = $body."Сайт: www.mto24.ru <br>";
//      $body   = $body."Email: mto24@mail.ru<br>";
//      $body   = $body."Телефон: 8(391)2-265-365, 8(391)2-941-495";
//
//      return mail("zzzzic@yandex.ru", "Test", $body, $from);
        return 1;

   }
}

?>
