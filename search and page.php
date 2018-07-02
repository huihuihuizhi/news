<!DOCTYPE html>
<html>
	<head>
		<meta charset="UTF-8">
		<title>搜索加分页浏览新闻</title>
	</head>
	<body>
		<center>
        <a href="news_add.php">添加新闻</a> |
 		<a href="news_main.php">浏览新闻</a> |
		<a href="news_update.php">编辑新闻</a> |
		<a href="news_search.php">搜索新闻</a> |
		<a href="news_page.php">分页浏览</a> |
		<a href="search and page.php">搜索加分页</a>
		</center><br /><br /><br />
		</center>
		
		<!--搜索表单 -->
		<center>
		<form action="search and page.php" method="get" >
			标题：<input type="text" name="title" size="8" @value="<?php echo $_GET['title']?>"/>&nbsp;&nbsp;&nbsp;
			内容：<input type="text" name="contents" size="8" @value="<?php echo $_GET['contents']?>"/>
			<input type="submit" value="搜索"/>
			<input type="button" value="全部信息" onclick="window.location='search and page.php'" />
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
				
				$wherelist = array();//定义一个封装搜索条件的数组变量
				$urllist = array();   //定义了一个封装搜索条件的URL数组，语句放置在URL后面做URL参数
				//判断新闻标题是否有值，若有，则封装此搜索条件
				if(!empty($_GET["title"])){
					$wherelist[]="title like '%{$_GET['title']}%'";
					$urllist[]="title={$_GET['title']}";
				}
				//判断内容是否有值，若有，则封装此条件
				if(!empty($_GET['contents'])){
					$wherelist[]="title like '%{$_GET['contents']}%'";
				    $urllist[]="contents={$_GET['contents']}";
				}
				
				
				
				//组装搜索条件?????  封装的接口？？直接可以调用
				if(count($wherelist)>0){
					$where = " where ".implode(" and ",$wherelist);
				    $url = " & ".implode(" & ",$urllist);
				}
				//echo @$where;
				//echo @$url;
				
				//-------------
				
				
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
               @$sql="select count(*) from news {$where}";
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
              @$sql="select * from news {$where} order by id {$limit}"; //limit 0,20是起始位置，2是取几条数据
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
			echo @"<a href='search and page.php?page=1{$url}'>&nbsp;&nbsp;&nbsp;首页&nbsp;&nbsp;&nbsp;</a>";
			echo "<a href='search and page.php?page=".($page-1).@"{$url}'>上一页&nbsp;&nbsp;&nbsp;</a>";
			echo "<a href='search and page.php?page=".($page+1).@"{$url}'>下一页&nbsp;&nbsp;&nbsp;</a>";
			echo @"<a href='search and page.php?page={$maxPage}{$url}'>末页</a>";
			
			?>
		</center>
	</body>
</html>
