<!DOCTYPE html>
<html>
	<head>
		<meta charset="utf-8" />
		<title></title>
	</head>
	<body>
		
<center>
		<?php require "include/menu.php"; ?>
		
		<center>	
		<form action="news_add_action.php" method="post" enctype="multipart/form-data">
			<table width="300">
				<tr>
					<td align="right">标题：</td>
					<td><input type="text" name="title"></td>
				</tr>
				<tr>
					<td align="right" valign="top">内容：</td>
					<td><textarea name="contents" rows="10" cols="20"></textarea></td><!---->
				</tr>
				<tr>
					<td align="right">图片上传:</td>
					<td><input type="file" name="picurl"></td>
				
					
				</tr>
				<tr>
					<td colspan="2" align="center">
						<input type="submit" name="sub" value="添加" />
						<input type="reset" name="res" value="重置" />
					</td>
			
				</tr>
	
			</table>
		</form>
		</center>
	</body>
</html>

