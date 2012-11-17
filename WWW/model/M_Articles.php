<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
require_once(BASEPATH.'/model/MSQL.php');

class M_Articles
{
    private static $instance;       // ссылка на экземпляр класса
    private $msql;                  // драйвер БД
    private $page;                  // индекс выбраной страницы

    //
    // Получение единственного экземпляра (одиночка)
    //
    public static function Instance() {
        if (self::$instance == null)
            self::$instance = new M_Articles();

        return self::$instance;
    }

    //
    // Конструктор
    //
    public function __construct() {
        $this->msql = MSQL::Instance();
    }


    //
    // Список всех статей
    //
    public function All($id_page) 
	{
		$this->page = (int)$id_page;
		if($this->page)
		{
			$start = ($this->page - 1) * ART_PAGE;
		}
		else
		{
			$start = 0;
		}    

        $query = "SELECT t1.id_article, t2.cat_name, t1.name, t1.description, t1.author, t1.date, t1.views, t1.comments    FROM ".DB_PREF."articles t1 JOIN ".DB_PREF."category t2 ON t1.id_cat=t2.id_cat WHERE t1.visible='1' ORDER BY t1.id_article DESC LIMIT $start, ".ART_PAGE;
        $temp = $this->msql->Select($query);
		if($temp == null) die('Такой страницы не существует');
		
		foreach($temp as $key => $value)
		{
			$t = date("d.m.Y",$value['date']);

			$t = explode(".", $t);
			$temp[$key]['day'] = $t[0];
			$temp[$key]['month'] = $this->month($t[1]);
			$temp[$key]['year'] = $t[2];
			unset ($temp[$key]['date']); 
		}
		
		return $temp;
    }
	
	//
	// Построение постраничной навигации
	//
	public function Page_nav($table, $ar = 0)
	{
		if($table == 'comments')
		{
			$id_article = (int)$_GET['ar'];
			if(!$id_article)
				$id_article = $ar;
			$query = "SELECT COUNT(*) as num FROM ".DB_PREF."$table WHERE id_article='$id_article'";
		}
		else
		{
			$query = "SELECT COUNT(*) as num FROM ".DB_PREF."$table";
		}
		$total_articles = $this->msql->Select($query);
		$total_articles = $total_articles[0]['num'];
		
		if ($this->page == 0){$this->page = 1;}
		$prev = $this->page - 1;
		$next = $this->page + 1;
		if($table == 'comments')
		{
			$lastpage = ceil($total_articles/COM_PAGE);
		}
		else
		{
			$lastpage = ceil($total_articles/ART_PAGE);
		}
		
		$LastPagem1 = $lastpage - 1;         
		
		$paginate = '';
		$stages = 3;

		if($lastpage > 1)
    	{    
			if($table == 'comments')
			{
				$self.= '?c=view&ar='.$id_article;
				$self.= '&page=';
				$onclick = "onclick=\"javascript:changePage($id_article, ";
				$onclickend = '); return false;"';
			}
			else
			{
				$self = '?page=';
			}
			
        	$paginate .= "<div class='paginate'>";
        	// назад
        	if ($this->page > 1){
            	$paginate.= "<a href='$self$prev' $onclick$prev$onclickend>назад</a>";
        	}else{
            	$paginate.= "<span class='disabled'>назад</span>";    }

       	    // Pages
        	if ($lastpage < 7 + ($stages * 2))    // Не достаточно страниц для разделения
        	{
            	for ($counter = 1; $counter <= $lastpage; $counter++)
            	{
					if($table == 'comments'){ $co = $counter;}
                	if ($counter == $this->page){
                    	$paginate.= "<span class='current'>$counter</span>";
                	}else{
                    	$paginate.= "<a href='$self$counter' $onclick$co$onclickend>$counter</a>";}
           	    }
        	}
        	elseif($lastpage > 5 + ($stages * 2))    // Прячкм некоторые страницы
       	    {
            	// Начнаем прятать с последних
            	if($this->page < 1 + ($stages * 2))
           	    {
                	for ($counter = 1; $counter < 4 + ($stages * 2); $counter++)
                	{
						if($table == 'comments'){ $co = $counter;}
                    	if ($counter == $this->page){
                        	$paginate.= "<span class='current'>$counter</span>";
                    	}else{
                        	$paginate.= "<a href='$self$counter' $onclick$co$onclickend>$counter</a>";}
                	}
                	$paginate.= "...";
                	$paginate.= "<a href='$self$LastPagem1' $onclick$co$onclickend>$LastPagem1</a>";
                	$paginate.= "<a href='$self$lastpage' $onclick$co$onclickend>$lastpage</a>";
            	}
            	// Прячем страницы посередине
            	elseif($lastpage - ($stages * 2) > $this->page && $this->page > ($stages * 2))
            	{
                	$paginate.= "<a href='$self1' $onclick$co$onclickend>1</a>";
                	$paginate.= "<a href='$self2' $onclick$co$onclickend>2</a>";
                	$paginate.= "...";
                	for ($counter = $this->page - $stages; $counter <= $this->page + $stages; $counter++)
                	{
						if($table == 'comments'){ $co = $counter;}
                    	if ($counter == $this->page){
                        	$paginate.= "<span class='current'>$counter</span>";
                    	}else{
                        	$paginate.= "<a href='$self$counter' $onclick$co$onclickend>$counter</a>";}
                	}
                	$paginate.= "...";
                	$paginate.= "<a href='$self$LastPagem1' $onclick$co$onclickend>$LastPagem1</a>";
                	$paginate.= "<a href='$self$lastpage' $onclick$co$onclickend>$lastpage</a>";
            	}
            // Прячем ранние страницы
            else
            {
                $paginate.= "<a href='$self1' $onclick$co$onclickend>1</a>";
                $paginate.= "<a href='$self2' $onclick$co$onclickend>2</a>";
                $paginate.= "...";
                for ($counter = $lastpage - (2 + ($stages * 2)); $counter <= $lastpage; $counter++)
                {
					if($table == 'comments'){ $co = $counter;}
                    if ($counter == $this->page){
                        $paginate.= "<span class='current'>$counter</span>";
                    }else{
                        $paginate.= "<a href='$self$counter' $onclick$co$onclickend>$counter</a>";}
                }
            }
        }

        // Ссылка "вперёд"
        if ($this->page < $counter - 1){
            $paginate.= "<a href='$self$next' $onclick$next$onclickend>вперёд</a>";
        }else{
            $paginate.= "<span class='disabled'>вперёд</span>";
        }

        $paginate.= "</div>";    
		    
		return $paginate;
		}
	}

    //
    // Конкретная статья
    //
    public function Get($id_article) {
    	$id_article = (int)$id_article;
		$this->msql->Update(DB_PREF."articles", array('views' => 'views + 1'), "id_article=$id_article", true);
        $query = "SELECT t1.name, t1.author, t1.date, t2.cat_name, t1.content FROM ".DB_PREF."articles t1 JOIN ".DB_PREF."category t2 ON t1.id_cat=t2.id_cat WHERE id_article = '$id_article' AND t1.visible='1'";
        $result = $this->msql->Select($query);
		$result[0]['date'] = date("d.m.Y",$result[0]['date']);
		if($result == 0)
		{
			die('Такой страницы не существует');
		}
        return $result[0];
    }

    //
    // Добавить статью
    //
    public function Add($id_cat, $name, $description, $content, $author, $time) {
/*        // Подготовка.
        $title = trim($title);
        $content = trim($content);

        // Проверка.
        if ($title == '')
            return false;*/


        // Запрос.
        $obj = array();
        $obj['id_cat'] = $id_cat;
        $obj['name'] = $name;
		$obj['description'] = $description;
		$obj['content'] = $content;
		$obj['author'] = $author;
		$obj['date'] = $time;

        $this->msql->Insert(DB_PREF.'articles', $obj);
        return 'Статья добавлена';
    }

    //
    // Изменить статью
    //
    public function Edit($id_article, $title, $content) {
        // Подготовка.
        $id_article = (int)$id_article;
        $title = trim($title);
        $content = trim($content);

        // Проверка.
        if ($title == '')
            return false;

        // Запрос.
        $obj = array();
        $obj['title'] = $title;
        $obj['content'] = $content;
        $where = "id_article = '$id_article'";

        $this->msql->Update($this->tbl_prefix. '_articles', $obj, $where);
        return true;
    }

    //
    // Удалить статью
    //
    public function Delete($id_article) {
        $id_article = (int)$id_article;
        $where = "id_article = '$id_article'";

        $this->msql->Delete($this->tbl_prefix . '_articles', $where);
        return true;
    }
	
	//
	// Добавить комментарий 
	//
	public function Add_Com($comment, $id_user, $date, $idArt)
	{
		$this->msql->Update(DB_PREF."articles", array('comments' => 'comments + 1'), "id_article=$idArt", true);
		$comment = $this->ComCheck($comment);
		
		$data = array('id_user' => $id_user, 'date' => $date, 'comment' => $comment, 'id_article ' => $idArt);
		$this->msql->Insert(DB_PREF.'comments', $data);
	}
	
	private function ComCheck($comment)
	{
		$comment = htmlspecialchars($comment);
		$comment = preg_replace('/&amp;/', '&', $comment);
	
		for ($i=0; $i<count($_SESSION['emoticons']); $i++)
		{
      		$comment = preg_replace("/\[$i\]/",$_SESSION['emoticons'][$i],$comment);
		}
		$comment = preg_replace('/\[URL\=(http:\/\/[a-zA-Z0-9@:%_+.~#?&\/=-]+)\](.*)\[\/URL\]/i', '<a href="\\1" target="_blank">\\2</a>', $comment);
		$comment = preg_replace('/\[b\](.*)\[\/b\]/i', '<strong>\\1</strong>', $comment);
		$comment = preg_replace('/\[quote\](.*)\[\/quote\]/i', '<blockquote>\\1</blockquote>', $comment);
		$comment = preg_replace('/\[italic\](.*)\[\/italic\]/i', '<em>\\1</em>', $comment);
		$comment = preg_replace('/\[color\=([#a-zA-Z0-9]+)\](.*)\[\/color\]/i', '<font color="\\1">\\2</font>', $comment);
		$comment = preg_replace('/\[size\=([0-9]{1,2})\](.*)\[\/size\]/i', '<font style="font-size:\\1px;">\\2</font>', $comment);
		$comment = preg_replace('/\[img\](http:\/\/[a-zA-Z0-9@:%_+.~#?&\/=-]+)\[\/img\]/i', '<img src="\\1" />', $comment);
		$comment = nl2br($comment);
		
		return $comment;
	}
	
	//
	// Возвращает массив с комментариями
	//
	public function GetCom($id_article)
	{
		 $this->page = (int)($_GET['page']);
		 if($this->page)
		 {
			 $start = ($this->page - 1) * COM_PAGE;
		 }
		 else
		 {
			 $start = 0;
		 } 
		 
		 $id_article = (int)$id_article;
		 $query = "SELECT t1.id_comment, t1.id_article, t1.date, t1.comment, t2.login FROM ".DB_PREF."comments t1 JOIN ".DB_PREF."users t2 ON t1.id_user = t2.id_user WHERE t1.id_article='$id_article' ORDER BY t1.id_comment DESC LIMIT $start, ".COM_PAGE;
		 $result = $this->msql->Select($query);
		 
		 foreach($result as $key => $value)
		 {
			$t = date("d-m-Y H:i",$value['date']);

			$t = explode("-", $t);
			$result[$key]['date'] = '';
			$t[1] = $this->month($t[1]);
			$result[$key]['date'] = "$t[0]-$t[1]-$t[2] $t[3]";
		 }

		 return $result;
	}
	
	public function GetText($input)
	{
		$input = (int)$input;
		$query = "SELECT about_text, title FROM ".DB_PREF."text WHERE id_text = $input";
		$article = $this->msql->Select($query);
		$article = $article[0];
		
		return $article;
	}
	
	public function Add_Review($data)
	{
		$data['comtext'] = $this->ComCheck($data['comtext']);
		$data = array('reviewName' => $data['reviewName'], 'reviewMail' => $data['reviewMail'], 'comtext' => $data['comtext']);
		$this->msql->Insert(DB_PREF.'review', $data);
	}
	
	//---------------------------------------------------------------
	
	private function month($input)
	{
		switch($input)
		{
			case "01": return 'янв'; break;
			case "02": return 'фев'; break;
			case "03": return 'мар'; break;
			case "04": return 'апр'; break;
			case "05": return 'май'; break;
			case "06": return 'июн'; break;
			case "07": return 'июл'; break;
			case "08": return 'авг'; break;
			case "09": return 'сен'; break;
			case "10": return 'окт'; break;
			case "11": return 'ноя'; break;
			case "12": return 'дек'; break;
		}
	}
}