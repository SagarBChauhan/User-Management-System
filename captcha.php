<!DOCTYPE html>
<!--
To change this license header, choose License Headers in Project Properties.
To change this template file, choose Tools | Templates
and open the template in the editor.
-->
<html>
    <head>
        <meta charset="UTF-8">
        <title></title>
    </head>
    <body>
        <?php
            //session_start();
            $random= rand(1111, 9999);
            $_SESSION["captchaText"]=$random;
            $image= imagecreate(100, 32);
            $background= imagecolorallocate($image, 255, 255, 255);
            $textColor= imagecolorallocate($image, 0, 0, 0);
            imagestring($image, 4, 25, 8, $random, $textColor);
            header("content-type: image/png");
            imagepng($image);
            imagecolordeallocate($background);
            imagecolordeallocate($textColor);
            imagedestroy($image);
        ?>
    </body>
</html>
