<html>
<head>
<link rel="shortcut icon" href="favi.png" />
<script type="text/javascript" src="https://ajax.googleapis.com/ajax/libs/jquery/1.6.1/jquery.min.js"></script>
<title>Parsy</title>
<style>
@import url(https://fonts.googleapis.com/css?family=Roboto:300,400,700);
@import url(https://fonts.googleapis.com/css?family=Source+Sans+Pro:700);
.boxradio
{
	font-family: "Roboto", sans-serif;
	font-weight: 400;
}
h2
{
	font-family: "Roboto", sans-serif;
	font-weight: 700;
}
input
{

	background-color: #4082F0;
    color: white;
	border: 2px solid #4082F0;
    padding: 10px 32px;
    text-align: center;
    text-decoration: none;
    display: inline-block;
    font-size: 16px;
    margin: 4px 2px;
    -webkit-transition-duration: 0.4s; /* Safari */
    transition-duration: 0.4s;
    cursor: pointer;
	font-family: "Roboto", sans-serif;
	font-weight: 700;

	
}

input:hover {
    background-color: white; 
    color: #4082F0;
    border: 2px solid #4082F0;	
}

textarea
{
	font-family: "Roboto", sans-serif;
	font-weight: 400;
	font-size: 16px;
}
hr
{
    background-color:#4082F0; 
    border:0px none;
    height:2px;
    clear:both;
}
.container {
    display: block;
    position: relative;
    padding-left: 35px;
    cursor: pointer;
    -webkit-user-select: none;
    -moz-user-select: none;
    -ms-user-select: none;
    user-select: none;
}

.container input {
    position: absolute;
    opacity: 0;
    cursor: pointer;
}

.checkmark {
    position: absolute;
    top: 0;
    left: 0;
    height: 20px;
    width: 20px;
    background-color: #eee;
    border-radius: 50%;
}

.container:hover input ~ .checkmark {
    background-color: #ccc;
}

.container input:checked ~ .checkmark {
    background-color: #4082F0;
}

.checkmark:after {
    content: "";
    position: absolute;
    display: none;
}

.container input:checked ~ .checkmark:after {
    display: block;
}

.container .checkmark:after {
 	top: 6px;
	left: 6px;
	width: 8px;
	height: 8px;
	border-radius: 50%;
	background: white;
}

</style>
<link rel="stylesheet" href="styleSecretButton.css">
</head>
<body>
<h1 class="bubbly-button">Parsy</h1>

<h2>ШАГ 1. Скачать изменения с сайта</h2>

<?

$content = file_get_contents('http://portal.volgetc.ru');
$main_url = 'http://portal.volgetc.ru';
$pos = strpos($content, '<div id="top_module_2" style="float:right;">');

$content = substr($content, $pos);

$pos = strpos($content, '</ul>');

$content = substr($content,0, $pos);

//если в тексте встречается текст, который нам не нужен, вырезаем его
 $content = str_replace('<div id="top_module_2" style="float:right;">','', $content);
 $content = str_replace('<div class="user">		<div class="module">','', $content);
 $content = str_replace('<div>','', $content);
 $content = str_replace('<div>','', $content);
 $content = str_replace('<div>','', $content);
 $content = str_replace('<h3>Доска объявлений</h3>','', $content);

    
$pattern = '/<a[^<>]+?>(.*?)<\/a>/uis';
$str_find = "/Гл.корпуса/iU";
$name_url = array();
$link=array();
$url;

    if (!preg_match_all($pattern, $content, $matches)) { 
        echo 'error!';
    } else 
	{
		foreach($matches as $brand => $massiv)
		{
			foreach($massiv  as  $inner_key => $value)
			{
				if($brand==0)
				{
					$url=$matches[0][$inner_key];
					$pos = strpos($url, '/index.php/');
					$url = substr($url, $pos);
					$pos = strpos($url, '">');
					$url = substr($url,0, $pos);
					$link[] = $main_url.$url;
				}
				if($brand==1)
					$name_url[] = $matches[1][$inner_key];
					
				
			}
			
		}
	}
?>
<div class="boxradio">	
<form action="" method="POST">
<?
$i = 0;

while($i<count($link)){
?>

<label class="container"><? echo $name_url[$i];?><input type="radio" name="radio_link" value="<? echo $link[$i];?>"> <span class="checkmark"></span></label>
<br/>
<?
$i++;
}
?>
<br/>
<input type="submit" name="save" value="скачать изменения"/>
</form>
</div>
<hr>
<?
if(isset($_POST['save']))
{
	if(isset($_POST['radio_link']))
	{
		$radio_value_url = $_POST['radio_link'];
		//Начало работы парсинга страницы и ее скачивание
		//Открытие итоговой ссылки на скачивание
		
		$content = file_get_contents($radio_value_url);
		$pos = strpos($content, 'src="http://docs.google.com/gview');

		$content = substr($content, $pos);

		$pos = strpos($content, '&embedded=true"');

		$content = substr($content,0, $pos);
		$content= str_replace('src="http://docs.google.com/gview?url=','',$content);
		$content = str_replace('&embedded=true"','',$content);
		echo'<script> window.open("'.$content.'","_blank"); </script>';
	}
}
?>
<h2>ШАГ 2. Спарсить файл</h2>
<div class="boxradio">	
<div id="display">
<?php
$filelist = array();
$filelist = scandir("files");
unset($filelist[0]);
unset($filelist[1]);
?>
<form action="" method="POST">
<?php 
foreach($filelist  as  $key => $value)
{
	?>
	<label class="container"><? echo $filelist[$key];?><input type="radio" name="radio_files" value="files/<? echo $filelist[$key];?>"><span class="checkmark"></span></label>
<br/>
<?php		
}
?>
<br/><input type="submit" name="show" value="показать изменения"/>
</form>
</div>
</div>
<hr>
<?php
if(isset($_POST['show']))
{
	if(isset($_POST['radio_files']))
	{
		$filename = $_POST['radio_files'];
		$word = new COM("word.application") or die ("Could not initialise MS Word object.");
		$word->Documents->Open(realpath($filename));

		$content = (string) $word->ActiveDocument->Content;
		$content = iconv("windows-1251", "UTF-8", $content);

		$pos = strpos($content, 'ЗАМЕНА УЧЕБНЫХ ЗАНЯТИЙ');
		$date = substr($content, $pos);
		$pos = strpos($date, 'по');
		$date = nl2br(substr($date,0, $pos));
		$string_2  =  str_replace("ЗАМЕНА  УЧЕБНЫХ ЗАНЯТИЙ<br />",'',  $date );

		$pos = strpos($content, '401Пк');
		$content = substr($content, $pos);
		$content = nl2br($content);
		
		$words = preg_split('/<br[^>]*>/i',$content);

		foreach($words as $inner_key => $value)
		{
			if(preg_match("/401Пк/iU", $words[$inner_key]))
			{
				$strZam =$strZam.$words[$inner_key].$words[$inner_key+1].$words[$inner_key+2].$words[$inner_key+3];
				$strZam = str_replace(array("\r\n", "\r", "\n", "\t", '  ', '    ', '    '), ' ', $strZam); 
				$strZam .='%0A'; 
			}
		}
		 $strZam = str_replace('',' ', $strZam);
		 $strZam = str_replace('401Пк','', $strZam);

		$string_2 = str_replace(array("\r\n", "\r", "\n", "\t", '  ', '    ', '    '), ' ', $string_2); 
		$textarea = "Изменения".$string_2."%0A".$strZam;

		$word->ActiveDocument->Close(false);
		$word->Quit();
		$word = null;
		unset($word);
	}
}

?>
<h2>ШАГ 3. Отправить изменения в группу</h2>
<form action="sending.php" method="post">
<textarea cols="50" rows="10" name="textarea"><?echo $textarea; ?></textarea>
<br/>
    <input type="submit" name="nazvanie_knopki" value="отправить в группу"/>
</form>

<script  src="index.js"></script>
<script type="text/javascript">
setInterval(function(){
$("#display").load("index.php #display");
}, 5000);
</script>	
</body>
</html>