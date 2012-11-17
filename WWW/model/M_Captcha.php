<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
require_once(BASEPATH.'/model/MSQL.php');

class M_Captcha
{
    private static $instance;       // ссылка на экземпляр класса
    private $msql;                  // драйвер БД

    //
    // Получение единственного экземпляра (одиночка)
    //
    public static function Instance() {
        if (self::$instance == null)
            self::$instance = new M_Captcha();

        return self::$instance;
    }

    //
    // Конструктор
    //
    public function __construct() {
        $this->msql = MSQL::Instance();
    }
	
	private function get_random_string($length) // количество символов
	{
		$ret = "";
		for ( $i=0; $i<$length; $i++)
		{
			if ( mt_rand(1,2) == 1 )
			$char_code = mt_rand(48, 57); // цифра…
			else
			$char_code = mt_rand(65, 90); // .. или буква
			
			$ret .= chr($char_code);
		}
		return $ret;
	}
	
	private function deleteCaptcha()
	{
		$dir = BASEPATH."/images/captcha";
      	$data = opendir($dir);
		while (false !== ($file = readdir($data)))
		{
			 if ($file != "." && $file != ".." && file_exists($dir.'/'.$file))
			 {
				 if(preg_match('/^\.jpg|\.png|\.gif$/i', $file))
					$arr[] = $file;
        	 }
		}
		
		if ($arr != '')
		{
			foreach ($arr as $value)
				unlink($dir.'/'.$value);
		}
	}
	
	public function captcha()
	{
		$this->deleteCaptcha();
		$str = $this->get_random_string(5);
		$_SESSION['captcha'] = $str;

		$img = imagecreatefrompng(BASEPATH."/captcha1.png");
  
		for ($i=0; $i<=1024; $i++) {
            $color = imagecolorallocate ($img, rand(0,255), rand(0,255), rand(0,255)); //задаём цвет
            imagesetpixel($img, rand(0,233), rand(0,49), $color); //рисуем пиксель
        }
		
		$str_arr = preg_split('//', $str, -1, PREG_SPLIT_NO_EMPTY); 
		$font_name = BASEPATH.'/epson1.ttf';
		$font_size = 40;
		$x_pos = -20;
		$y_pos = 50;
		$chars = count($str_arr);
		for ( $i = 0; $i < $chars; $i++ )
		{
			$color = imagecolorallocate ($img, rand(0,255), rand(0,128), rand(0,255));
			$x_pos = $x_pos + 40; // каждую следующую букву двигаем
			$angle = mt_rand(-30, 30); // поворачивая её на случайное количество градусов
			imagettftext($img, $font_size, $angle, $x_pos, $y_pos, $color, $font_name, $str_arr[$i]);
		}
		$temp_file = BASEPATH."/images/captcha/".md5(time()).".png";
		$temp_file1 = "/images/captcha/".md5(time()).".png"; // куда-нибудь сохраняем промежуточный результат …

		imagepng($img, $temp_file);
		imagedestroy($img);
			
		return $temp_file1; // … и выводим его куда захотим. Не забыть потом его удалить, чтоб не мусорить на сервере
	}
}