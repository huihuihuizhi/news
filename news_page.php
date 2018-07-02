<!DOCTYPE html>
<html>
	<head>
		<meta charset="UTF-8">
		<title>分页浏览新闻</title>
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
              //======================
              //分页处理
              //在执行sql语句之前进行分页操作
              //1、定义一些分页变量
              $page=isset($_GET['page'])?$_GET['page']:1;      //当前是第几页
              $pageSize=3;  //页大小（每页有几条数据）
              $maxRows;     //最大数据条数（所有信息共有多少条数据）
              $maxPage;     //最大页数（所有信息共有几页）
              //2、获得最大页数条数
               $sql="select count(*) from news";
               $res=mysql_query($sql);
               $maxRows=mysql_result($res,0,0);//定位从结果集中获取总数据条数这个值
              //3、计算出共计最大页数
              $maxPage=ceil($maxRows/$pageSize);//floor()舍去法取整；round（）四舍五入；ceil（）进一取整法
              //4、校验当前页数
              //顺序不能颠倒
              if($page>$maxPage){
              	$page=$maxPage;
              }
              if($page<1){
              	$page=1;
              }
              //5、sql语句     
              //起始位置=当前页减一 * 页大小
           
              $limit=" limit ".(($page-1)*$pageSize).",{$pageSize}";
              //=======================
              $sql="select * from news order by id {$limit}"; //limit 0,20是起始位置，2是取几条数据
              mysql_query("set names utf8");
             
              $res=mysql_query($sql)  or die(mysql_error()) ;
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
		<?php 
			//输出分页信息，显示上一页 下一页的连接
			echo "<br><br>";
			echo "当前{$page}/{$maxPage}页  &nbsp;&nbsp;&nbsp;共计{$maxRows}条";
			echo "<a href='news_page.php?page=1'>&nbsp;&nbsp;&nbsp;首页&nbsp;&nbsp;&nbsp;</a>";
			echo "<a href='news_page.php?page=".($page-1)."'>上一页&nbsp;&nbsp;&nbsp;</a>";
			echo "<a href='news_page.php?page=".($page+1)."'>下一页&nbsp;&nbsp;&nbsp;</a>";
			echo "<a href='news_page.php?page={$maxPage}'>末页</a>";
			
			?>
		</center>
	</body>
</html>
