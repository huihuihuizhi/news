<?php
//接收数据
//连接数据库
//sql语句
//跳转到浏览页面

//$title=$_POST['title'];
//$contents-$_POST["contents"];
extract($_POST);
$uploads_dir='./upload';
//var_dump($_FILES);
$tmp_name=$_FILES['picurl']['tmp_name'];
@$filename=date("YmdHis").rand(1,1000).".jpg";
move_uploaded_file($tmp_name,"$uploads_dir/$filename");



$con=mysql_connect("localhost","root","root");
mysql_select_db("news");
//$sql="insert into news (title ,contents)values ('$title',  '$contents')";
$sql="insert into news (title, contents,picurl) values ('$title', '$contents','$uploads_dir/$filename')";
//echo $sql;
mysql_query("set names utf8");
mysql_query($sql);

//方法一：跳转页面
//header('Location:news_main.html');

?>
<script>location.href="news_main.php"</script>
	


