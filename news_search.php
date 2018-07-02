

<!DOCTYPE html>
<html>
	<head>
		<meta charset="UTF-8">
		<title>搜索新闻</title><br /><br />
		
		</head>
	<body>
		<center>
		<?php require "include/menu.php"; ?>
		</center>
		
		<!--搜索表单 -->
		<center>
		<form action="news_search.php" method="get" >
			标题：<input type="text" name="title" size="8" @value="<?php echo $_GET['title']?>"/>&nbsp;&nbsp;&nbsp;
			内容：<input type="text" name="contents" size="8" @value="<?php echo $_GET['contents']?>"/>
			<input type="submit" value="搜索"/>
			<input type="button" value="全部信息" onclick="window.location='news_search.php'" />
		</form>
		</center><br /><br />
	  <!---->
		
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
		       //-------------
				//封装搜索信息
				//定义一个封装搜索条件的数组变量
				$wherelist = array();
				//判断新闻标题是否有值，若有，则封装此搜索条件
				if(!empty($_GET["title"])){
					$wherelist[]="title like '%{$_GET['title']}%'";
				}
				//判断内容是否有值，若有，则封装此条件
				if(!empty($_GET['contents'])){
					$wherelist[]="contents like '%{$_GET['contents']}%'";
				}
				
				
		     //组装搜索条件
		        if(count($wherelist)>0){
					$where = " where ".implode(" and ",$wherelist);
				}
				echo @$where;
				
				
		     //echo "<br>";
			//$array=array("ni","hao","ha","ha");
		    //$a=implode("",$array);
            //echo $a;
		  //-------------
			  $con=mysql_connect("localhost","root","root");
              mysql_select_db("news");
              @$sql="select * from news {$where} order by id ";
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
