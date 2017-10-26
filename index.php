<?php
require_once 'database.php';
require 'short.php';
$connect = mysqli_connect(DB_HOST, DB_USER, DB_PASSWORD, DB_NAME);
$original_url="";
$short_url="";
$check_url = "";
$print="";
$err="";
if(isset($_POST['submit']))
{
    if(!empty(trim($_POST['url'])))
	{
		$original_url=$_POST['url'];
		if(substr($original_url,0,4)=="www.")
			$original_url="http://".$original_url;
		$len=strlen($original_url);
		$check=filter_var($original_url, FILTER_VALIDATE_URL);
		if(!$check=== false && $len>25)
		{
			$query="SELECT * from urlshortner where original_url='$original_url'";
			if($result=$connect->query($query))
			{
				if($result->num_rows>0)
				{
					$row=$result->fetch_assoc();
					$print="This URL is already being generated before";
					$short_url=convert_uudecode($row['short_url']);
					// var_dump($short_url);
				}
				else
				{
					$ob=new short();
					$short_url=$ob->shortURL($original_url);
				}
			}
		}
		else
		{
			if(!$check)
				$err="Invalid URL, URL must be in this format 'http://www.example.com'";
			elseif($len<=25)
				$err="It is already a short URL, Doesn't need to shorten";
			unset($_POST['submit']);
		}
	}
}

else if(!empty(substr($_SERVER['REQUEST_URI'],13)))
{

	$short_url=substr($_SERVER['PATH_INFO'],1);
	// echo $short_url;
	$check_url = convert_uuencode($short_url);
	$query="SELECT * from urlshortner where short_url ='$check_url'";
	if($result=$connect->query($query))
	{
		if($result->num_rows>0)
		{
			$row=$result->fetch_assoc();
			$query="UPDATE urlshortner set click_info=click_info+1 where short_url ='$check_url'";
			if($result=$connect->query($query))
				header('Location:'.$row['original_url']);
		}
		else
		{
			die("Invalid URL");
		}
	}
	else
	{
		die("Invalid URL");
	}
}

?>


<!Doctype html>		  <!Doctype html>
  <html>		  <html>
  	<head>		  	<head>
 +        <meta name="viewport" content="width=device-width,initial-scale=1" />
  		<title>URL Shortner</title>		  		<title>URL Shortner</title>
          <link rel="stylesheet" href="css/main.css">		          <link rel="stylesheet" href="css/main.css">
          <link rel="stylesheet" href="css/font-awesome-4.6.3/css/font-awesome.min.css">		          <link rel="stylesheet" href="css/font-awesome-4.6.3/css/font-awesome.min.css">
 @@ -124,8 +125,10 @@
  	    </div>		  	    </div>
  		  
  		  
 -	    <div class="footer">		 +        <footer>
 -	    	<div class="footer_text">Made by <a href="http://ankitjain.surge.sh">Ankit Jain</a></div>		 +            <div class="footer">
 +                <div class="footer_text">Made by <a href="http://ankitjain.surge.sh">Ankit Jain</a></div>
 +            </div>
  	    </footer>		  	    </footer>
      </body>		      </body>
      <script type="text/javascript" src="index.js"></script>		      <script type="text/javascript" src="index.js"></script>

</html>

