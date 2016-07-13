<?php
require_once 'database.php';

class short
{
	private $original_url;
	private $short_url;
	private $arr=['B','C','D','F','G','H','J','K','L','M','N','P','Q','R','S','T','V','W','X','Y','Z','b','c','d','f','g','h','j','k','l','m','n','p','q','r','s','t','v','w','x','y','z','0','1','2','3','4','5','6','7','8','9'];
	function __construct()
	{
		$this->original_url="";
		$this->short_url="";
	}

	function shortURL($original_url)
	{
		$connect = mysqli_connect(DB_HOST, DB_USER, DB_PASSWORD, DB_NAME);
		$this->original_url=$original_url;
		$time=date("D d M Y H:i:s", time()+16200);	
		$query="INSERT INTO urlshortner values(null,'$this->original_url','$this->original_url',0,'$time')";
		if($result=$connect->query($query))
		{
			$query="SELECT id from urlshortner where original_url='$original_url'";
			if($result=$connect->query($query))
			{
				$row=$result->fetch_assoc();
				$id=intval($row['id']);
				while ($id>0) 
				{
					$this->short_url=$this->short_url.$this->arr[($id%52)-1];
					$id=intval($id/52);
				}
				// $this->short_url="localhost/urlshortner/index.php/".$this->short_url;
				$query="UPDATE urlshortner set short_url='$this->short_url' where original_url='$this->original_url'";
				if($result=$connect->query($query))
				{
					return $this->short_url;
				}
			}
		}
	}
}

?>