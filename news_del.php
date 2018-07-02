<?php
//获取要删除信息的ID号
//连接数据库
//sql语句
//跳转到浏览页面

$id=$_GET['id'];
$con=mysql_connect('localhost',"root","root");
mysql_select_db("news");
$sql="delete from news where id=$id";
mysql_query($sql);

?>
<script language="JavaScript">location.href='news_main.php'</script>
