<?php

class EasyCaptcha
{
    private $keystring;
    private $use_symbols = "012345679abcdefghijklmnopqrstuvwxyz"; // Здесь Только те буквы, которые Вы хотите выводить
    private $use_symbols_len = 4;
    private $amplitude_min = 10; // Минимальная амплитуда волны
    private $amplitude_max = 25; // Максимальная амплитуда волны

    private $font_width = 25; // Приблизительная ширина символа в пикселях

    private $rand_bsimb_min = 3; // Минимальное расстояние между символами (можно отрицательное)
    private $rand_bsimb_max = 5; // Максимальное расстояние между символами

    private $margin_left = 10;// отступ слева
    private $margin_top = 50; // отступ сверху

    private $font_size = 30; // Размер шрифта

    private $jpeg_quality = 100; // Качество картинки
    //$back_count = 1; // Количество фоновых рисунков в папке DMT_captcha_fonts идущих по порядку от 1 до $back_count
    private $length = 4;

    public function __construct()
    {
        $this->use_symbols_len = strlen($this->use_symbols);
    }

    public function EasyCaptcha()
    {
        $this->keystring = '';
        for ($i = 0; $i < $this->length; $i++)
            $this->keystring .= $this->use_symbols{mt_rand(0, $this->use_symbols_len - 1)};
        $_SESSION['captcha'] = $this->keystring;
        $im = imagecreatefromgif(Q_PATH . "/application/core/components/captcha/back.gif");
        $width = imagesx($im);
        $height = imagesy($im);
        $rc = mt_rand(120, 140);
        $font_color = imagecolorresolve($im, $rc, $rc, $rc);
        $px = $this->margin_left;
        for ($i = 0; $i < $this->length; $i++) {
            imagettftext($im, $this->font_size, 0, $px, $this->margin_top, $font_color, Q_PATH . "/application/core/components/captcha/oreos.ttf", $this->keystring[$i]);
            $px += $this->font_width + mt_rand($this->rand_bsimb_min, $this->rand_bsimb_max);
        }

        $h_y = mt_rand(0, $height);
        $h_y1 = mt_rand(0, $height);
        imageline($im, mt_rand(0, 20), $h_y, mt_rand($width - 20, $width), $h_y1, $font_color);
        imageline($im, mt_rand(0, 20), $h_y, mt_rand($width - 20, $width), $h_y1, $font_color);
        $h_y = mt_rand(0, $height);
        $h_y1 = mt_rand(0, $height);
        imageline($im, mt_rand(0, 20), $h_y, mt_rand($width - 20, $width), $h_y1, $font_color);
        imageline($im, mt_rand(0, 20), $h_y, mt_rand($width - 20, $width), $h_y1, $font_color);
        $this->image_make_pomexi($im, 50, 80);

        $rand = mt_rand(0, 1);
        if ($rand) $rand = -1; else $rand = 1;
        $this->wave_region($im, 0, 0, $width, $height, $rand * mt_rand($this->amplitude_min, $this->amplitude_max), mt_rand(30, 40));
        header('Expires: Sat, 17 May 2008 05:00:00 GMT');
        header('Cache-Control: no-store, no-cache, must-revalidate');
        header('Cache-Control: post-check=0, pre-check=0', FALSE);
        header('Pragma: no-cache');
        if (function_exists("imagejpeg")) {
            header("Content-Type: image/jpeg");
            return imagejpeg($im, null, $this->jpeg_quality);
        } else if (function_exists("imagegif")) {
            header("Content-Type: image/gif");
            return imagegif($im);
        } else if (function_exists("imagepng")) {
            header("Content-Type: image/x-png");
            return imagepng($im);
        }
    }

    public function getKeyString()
    {
        return $this->keystring;
    }


    function wave_region($img, $x, $y, $width, $height, $amplitude = 4.5, $period = 30)
    {
        $mult = 2;
        $img2 = imagecreatetruecolor($width * $mult, $height * $mult);
        imagecopyresampled($img2, $img, 0, 0, $x, $y, $width * $mult, $height * $mult, $width, $height);
        for ($i = 0; $i < ($width * $mult); $i += 2)
            imagecopy($img2, $img2, $x + $i - 2, $y + sin($i / $period) * $amplitude, $x + $i, $y, 2, ($height * $mult));
        imagecopyresampled($img, $img2, $x, $y, 0, 0, $width, $height, $width * $mult, $height * $mult);
        imagedestroy($img2);
    }

    function image_make_pomexi(&$im, $size, $colch)
    {
        $max_x = imagesx($im);
        $max_y = imagesy($im);
        for ($i = 0; $i <= $colch; $i++) {
            $size = mt_rand(10, $size);
            $px1 = mt_rand(0, $max_x);
            $py1 = mt_rand(0, $max_y);
            $col = imagecolorresolve($im, 255, 255, 255);
            $pk1 = mt_rand(-1, 1);
            $pk2 = mt_rand(-1, 1);
            imageline($im, $px1, $py1, $px1 + $size * $pk1, $py1 + $size * $pk2, $col);
        }
    }
}

?>