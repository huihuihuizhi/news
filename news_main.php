<!DOCTYPE html>
<html>
	<head>
		<meta charset="UTF-8">
		<title>浏览新闻</title>
	</head>
	<body>
		<center>
		<?php require "include/menu.php"; ?>
		</center>
		<center>
		<table border="1"width="800">
			<tr>
				<th>新闻id</th>
				<th>标题</th>
				<th>内容</th>
				<th>图片</th>
				<th>操作</th>
			</tr>
			<?php
	          $con=mysql_connect("localhost","root","root");
              mysql_select_db("news");
              $sql="select * from news order by id ";
              mysql_query("set names utf8");
             
              $res=mysql_query($sql);
             while($row=mysql_fetch_array($res)){
           	echo "<tr>";
       		echo "<td>{$row['id']}</td>";
       		echo "<td>{$row['title']}</td>";
       		echo "<td>{$row['contents']}</td>";
       		//echo "<td>{$row['picurl']}</td>";
       	    echo "<td><img src='{$row['picurl']}' width='50' height='50' alt='图片'></td>";
       		echo "<td>
       			<a href='news_del.php?id={$row['id']}'>删除</a>
       			<a href='news_update.php?id={$row['id']}'>修改</a>
       			</td>";
        	echo "</tr>";
       	       }
       	      //mysql_free_result($result);
       	      mysql_close();
	?>
		
		</table>
		</center>
	</body>
</html>
