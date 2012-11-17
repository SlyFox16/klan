<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
require_once(BASEPATH.'/model/MSQL.php');

class M_Photo
{
    private static $instance;       // ссылка на экземпляр класса
    private $msql;                  // драйвер БД
	private $page;

    //
    // Получение единственного экземпляра (одиночка)
    //
    public static function Instance() {
        if (self::$instance == null)
            self::$instance = new M_Photo();

        return self::$instance;
    }
	
	public function getPhotos($id_page)
	{
		$this->page = (int)$id_page;
		if($this->page)
		{
			$start = ($this->page - 1) * PHOTO_PAGE;
		}
		else
		{
			$start = 0;
		}
		
		for ($i = $start; $i < count($_SESSION['photos']); $i++)
		{
			$j++;
			$photo[] = $_SESSION['photos'][$i];
			if ($j == PHOTO_PAGE)
				break;
		}

		return $photo;
	}

    //
    // Конструктор
    //
    public function __construct() {
        $this->msql = MSQL::Instance();
    }
	
	public function Page_nav()
	{
		$total_articles = count($_SESSION['photos']);
		
		if ($this->page == 0){$this->page = 1;}
		$prev = $this->page - 1;
		$next = $this->page + 1;

		$lastpage = ceil($total_articles/PHOTO_PAGE);
		
		$LastPagem1 = $lastpage - 1;         
		
		$paginate = '';
		$stages = 3;

		if($lastpage > 1)
    	{    
			$self.= '?c=photo&page=';
			$onclick = "onclick=\"javascript:showPhotos(";
			$onclickend = '); return false;"';

        	$paginate .= "<div class='paginate'>";
        	// назад
        	if ($this->page > 1){
            	$paginate.= "<a href='$prev' $onclick$prev$onclickend>назад</a>";
        	}else{
            	$paginate.= "<span class='disabled'>назад</span>";    }

       	    // Pages
        	if ($lastpage < 7 + ($stages * 2))    // Не достаточно страниц для разделения
        	{
            	for ($counter = 1; $counter <= $lastpage; $counter++)
            	{
                	if ($counter == $this->page){
                    	$paginate.= "<span class='current'>$counter</span>";
                	}else{
                    	$paginate.= "<a href='$counter' $onclick$counter$onclickend>$counter</a>";}
           	    }
        	}
        	elseif($lastpage > 5 + ($stages * 2))    // Прячкм некоторые страницы
       	    {
            	// Начнаем прятать с последних
            	if($this->page < 1 + ($stages * 2))
           	    {
                	for ($counter = 1; $counter < 4 + ($stages * 2); $counter++)
                	{
                    	if ($counter == $this->page){
                        	$paginate.= "<span class='current'>$counter</span>";
                    	}else{
                        	$paginate.= "<a href='$self$counter' $onclick$co$onclickend>$counter</a>";}
                	}
                	$paginate.= "...";
                	$paginate.= "<a href='$self$LastPagem1' $onclick$counter$onclickend>$LastPagem1</a>";
                	$paginate.= "<a href='$self$lastpage' $onclick$co$onclickend>$lastpage</a>";
            	}
            	// Прячем страницы посередине
            	elseif($lastpage - ($stages * 2) > $this->page && $this->page > ($stages * 2))
            	{
                	$paginate.= "<a href='$self1' $onclick$counter$onclickend>1</a>";
                	$paginate.= "<a href='$self2' $onclick$counter$onclickend>2</a>";
                	$paginate.= "...";
                	for ($counter = $this->page - $stages; $counter <= $this->page + $stages; $counter++)
                	{
                    	if ($counter == $this->page){
                        	$paginate.= "<span class='current'>$counter</span>";
                    	}else{
                        	$paginate.= "<a href='$self$counter' $onclick$counter$onclickend>$counter</a>";}
                	}
                	$paginate.= "...";
                	$paginate.= "<a href='$self$LastPagem1' $onclick$counter$onclickend>$LastPagem1</a>";
                	$paginate.= "<a href='$self$lastpage' $onclick$counter$onclickend>$lastpage</a>";
            	}
            // Прячем ранние страницы
            else
            {
                $paginate.= "<a href='$self1' $onclick$counter$onclickend>1</a>";
                $paginate.= "<a href='$self2' $onclick$counter$onclickend>2</a>";
                $paginate.= "...";
                for ($counter = $lastpage - (2 + ($stages * 2)); $counter <= $lastpage; $counter++)
                {
                    if ($counter == $this->page){
                        $paginate.= "<span class='current'>$counter</span>";
                    }else{
                        $paginate.= "<a href='$self$counter' $onclick$counter$onclickend>$counter</a>";}
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
}