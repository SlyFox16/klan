<?php
	require_once('../base/startup.php');
	require_once(BASEPATH.'/base/C_Base.php');
	require_once(BASEPATH.'/model/M_Cast.php');
	require_once(BASEPATH.'/model/M_Captcha.php');
	
	class Cast extends C_Base
	{
		private static $instance;       // ссылка на экземпляр класса
		private $errorList;             // Список ошибок
		private $Playday;     
		private $Contact;
		
		public function __construct() 
		{
			$this->Playday = 0;
			$this->Contact = 0;
        	$this->Request();
    	}
		
		public static function Instance() 
		{
			if (self::$instance == null)
				self::$instance = new Cast();
	
			return self::$instance;
    	}
		
		protected function OnInput()
		{
			if($_POST)
			{	
				if (!isset($_POST['captcha']))
					$_POST['captcha'] = 0;
					
				foreach ($_POST as $key => $value)
				{
					$data[$key] = $this->checkValue($key, $value);
				}
				
				if ($this->Playday == 0)
					$this->errorList['gameTime'] = 'Поле "Время в игре" не заполненно';
				
				if ($this->Contact == 0)
					$this->errorList['contact'] = 'Поле "Контактная информация" не заполненно';
					
				if ($this->errorList)
				{
					$mCaptcha = M_Captcha::Instance();
					$this->errorList['newCapt'] = $mCaptcha->captcha();
					return;
				}
				
				$mCast = M_Cast::Instance();
				$mCast->newCast($data);
			}
		}
		
		protected function OnOutput() 
		{
			if ($this->errorList)
			{
				echo $this->createXML($this->errorList);
			}
			else
			{       
				echo $this->createXML(array('ans' => 'Ваша заявка отправлена!'));    
			}
    	}
		
		//-----------Вспомолательные функции----------
		
		private function checkValue($key, $value)
		{
			$value = htmlspecialchars($value);
			$value = preg_replace('/&amp;/', '&', $value);
			
			if ($value == '')
			{
				$this->errorList[$key] = 'Поле '.$this->fieldName($key).' не заполнено';
				return;
			}
				
			elseif ($key == 'emaill')
			{	
				if (!preg_match('/^[_a-z0-9\.-]+@[_a-z0-9\.-]+\.[a-z]{2,3}$/i',$value))
				{
					$this->errorList[$key] = 'Введите правильный E-mail';
					return;
				}
			}
			
			elseif ($key == 'age' || $key == 'games' || $key == 'ICQ')
			{
				if (!preg_match('/^[0-9]+$/',$value))
				{
					$this->errorList[$key] = 'Некоторый поля формы должны содержать только числа';
					return;
				}
			}
			
			elseif ($key == 'captcha')
			{
				if ($value != $_SESSION['captcha'])
					$this->errorList[$key] = 'Вы ввели неверную "captcha"';
			}
				
			switch($key)
			{
				case "mon": $this->Playday = 1; break;
				case "tue": $this->Playday = 1; break;
				case "wed": $this->Playday = 1; break;
				case "thu": $this->Playday = 1; break;
				case "fri": $this->Playday = 1; break;
				case "sat": $this->Playday = 1; break;
				case "sun": $this->Playday = 1; break;
				case "ICQ": $this->Contact = 1; break;
				case "SKYPE": $this->Contact = 1; break;
			}
			return $value;
		}
		
		private function fieldName($key)
		{
			switch($key)
			{
				case "gameNick": return '"Ник в игре"'; break;
				case "emaill": return '"E-mail"'; break;
				case "name": return '"Имя"'; break;
				case "age": return '"Возраст"'; break;
				case "tanks": return '"Танки в наличии"'; break;
				case "games": return '"Колличество боёв"'; break;
				case "captcha": return '"Captcha"'; break;
				case "ICQ": return '"ICQ"'; break;
				case "SKYPE": return '"SKYPE"'; break;
			}
		}
		
		private function createXML($arr)
		{
			$xml = new DomDocument('1.0','utf-8');
			$errors = $xml->appendChild($xml->createElement('errors'));
			foreach ($arr as $key1 => $value1)
			{
				if ($key1 == 'newCapt')
				{
					$newCapt = $errors->appendChild($xml->createElement('newCapt'));
					$newCapt->appendChild($xml->createTextNode($value1));
					continue;
				}
                elseif ($key1 == 'ans')
                {
                	$ans = $errors->appendChild($xml->createElement('ans'));
					$ans->appendChild($xml->createTextNode($value1));
					continue;
                }
				elseif ($key1 == 'captcha')
                {
                	$captcha = $errors->appendChild($xml->createElement('captcha'));
					$captcha->appendChild($xml->createTextNode($value1));
					continue;
                }
				$error = $errors->appendChild($xml->createElement('error'));
				$error->appendChild($xml->createTextNode($value1));

			}
			return $xml->saveXML();
		}
	}
	$obCast = Cast::Instance();
	