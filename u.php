<?php
if(!empty(substr($_SERVER['REQUEST_URI'],19)))
{
$short=substr($_SERVER['REQUEST_URI'],19);
header('Location: http://localhost/urlshortner/index.php/'.$short);
}
else
{
echo "Invalid URL";
}

?>