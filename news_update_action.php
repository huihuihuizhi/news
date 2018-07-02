<?php
	//获取要修改的信息
	//连接数据库
	//sql语句
	//跳转到浏览页面
	
	 extract($_POST);
	  require "include/connect.php";
     $sql="update news set title='$title',contents='$contents' where id='$id'";
     //echo $sql;
     mysql_query($sql);     
?>
<script language="JavaScript">location.href="news_main.php"</script>