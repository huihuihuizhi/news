<!-- 修改页面（同添加页面）
	显示要修改的信息
	          获取要修改的ID号  
	          连接数据库
	    sql语句
	          修改默认值
-->  
<!DOCTYPE html>
<html>
	<head>
		<meta charset="UTF-8">
		<title>添加新闻</title>
	</head>
	<body>
		<!--//导航栏-->
		<!--//执行动作页面news_add.php-->
		
		<center>
		<?php require "include/menu.php"; ?>
		</center>
		
		<?php
	       
	          @$id=$_GET['id'];
	          //连接数据库
              require "include/connect.php";
              $sql="select * from news where id=$id";
              $res= mysql_query($sql);
              @$row=mysql_fetch_array($res);
?>

		<center>			
		<form action="news_update_action.php" method="post">
			<input type="hidden" name="id" value="<?php echo $row['id']; ?>" />
			<table width="300">
				<tr>
					<td align="right">标题：</td>
					<td><input type="text" name="title" value="<?php echo $row['title']; ?>"></td>
				</tr>
				<tr>
					<td align="right" valign="top">内容：</td>
					<td><textarea name="contents" rows="10" cols="20"><?php echo $row['contents']; ?></textarea></td><!--rows行-->
				</tr>
				<tr>
					<td colspan="2" align="center">
						<input type="submit" name="sub" value="修改" />
						<input type="reset" name="res" value="重置" />
					</td>
			
				</tr>
	
			</table>
		</form>
		</center>
	</body>

</html>

