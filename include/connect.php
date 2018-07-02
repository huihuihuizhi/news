<?php
 $con=mysql_connect("localhost","root","root");
              mysql_select_db("news");
              $sql="select * from news order by id ";
              mysql_query("set names utf8");
?>