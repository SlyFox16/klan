<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
require_once(BASEPATH.'/model/MSQL.php');

class M_Cast
{
    private static $instance;       // ссылка на экземпляр класса
    private $msql;                  // драйвер БД

    //
    // Получение единственного экземпляра (одиночка)
    //
    public static function Instance() {
        if (self::$instance == null)
            self::$instance = new M_Cast();

        return self::$instance;
    }

    //
    // Конструктор
    //
    public function __construct() {
        $this->msql = MSQL::Instance();
    }
	
	public function newCast($arr)
	{
		$gameDay = '';
		$contact_inf = '';
		foreach ($arr as $key => $value)
		{
			switch($key)
			{
				case "mon": $gameDay .= 'Понедельник '; unset($arr[$key]); break;
				case "tue": $gameDay .= 'Вторник '; unset($arr[$key]); break;
				case "wed": $gameDay .= 'Среду '; unset($arr[$key]);  break;
				case "thu": $gameDay .= 'Четверг '; unset($arr[$key]);  break;
				case "fri": $gameDay .= 'Пятницу '; unset($arr[$key]);  break;
				case "sat": $gameDay .= 'Субботу '; unset($arr[$key]);  break;
				case "sun": $gameDay .= 'Воскресенье '; unset($arr[$key]);  break;
				case "monFrom": $gameDay .= 'C '.$value; unset($arr[$key]);  break;
				case "tueFrom": $gameDay .= 'C '.$value; unset($arr[$key]);  break;
				case "wedFrom": $gameDay .= 'C '.$value; unset($arr[$key]);  break;
				case "thuFrom": $gameDay .= 'C '.$value; unset($arr[$key]);  break;
				case "friFrom": $gameDay .= 'C '.$value; unset($arr[$key]);  break;
				case "satFrom": $gameDay .= 'C '.$value; unset($arr[$key]);  break;
				case "sunFrom": $gameDay .= 'C '.$value; unset($arr[$key]);  break;
				case "monTill": $gameDay .= ' До '.$value.' часов<br>'; unset($arr[$key]);  break;
				case "tueTill": $gameDay .= ' До '.$value.' часов<br>'; unset($arr[$key]);  break;
				case "wedTill": $gameDay .= ' До '.$value.' часов<br>'; unset($arr[$key]);  break;
				case "thuTill": $gameDay .= ' До '.$value.' часов<br>'; unset($arr[$key]);  break;
				case "friTill": $gameDay .= ' До '.$value.' часов<br>'; unset($arr[$key]);  break;
				case "satTill": $gameDay .= ' До '.$value.' часов<br>'; unset($arr[$key]);  break;
				case "sunTill": $gameDay .= ' До '.$value.' часов<br>'; unset($arr[$key]);  break;
				case "ICQ": $contact_inf .= 'ICQ - '.$value.'<br>'; unset($arr[$key]); break;
				case "SKYPE": $contact_inf .= 'SKYPE - '.$value.'<br>'; unset($arr[$key]); break;
				case "tanks": $arr[$key] = nl2br($value); break;
			}
		}
		unset($arr['captcha']);
		$arr['gameTime'] = $gameDay;
		$arr['contact_inf'] = $contact_inf;
		$this->msql->Insert(DB_PREF.'cast', $arr);
	}
}