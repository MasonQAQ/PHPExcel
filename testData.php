<?php
		$db_host   = 'localhost';    //数据库主机名称，一般都为localhost   
		$db_user   = 'root';         //数据库用户帐号，根据个人情况而定   
		$db_passw  = '';             //数据库用户密码，根据个人情况而定   
		$db_name   = "山东省泰安监狱";         //数据库具体名称，以刚才创建的数据库为准 
		//连接数据库   
		$conn = mysql_connect($db_host,$db_user,$db_passw) or die ('数据库连接失败！</br>错误原因：'.mysql_error());
		//设置字符为"utf-8"
		mysql_query("set names 'utf8'"); 
		//选择数据库
		mysql_select_db($db_name,$conn) or die('数据库选定失败！</br>错误原因：'.mysql_error());   
		$sql="select * from poisonsimple"; //
		//echo $sql;
		$result = mysql_query($sql) or die('数据库查询失败！</br>错误原因：'.mysql_error());  
		// $resArray = mysql_fetch_array($result);
		// var_dump($resArray);
		while ($resArray = mysql_fetch_array($result)){
			$arr[]=$resArray;
			var_dump($resArray);
		}
		// var_dump($arr);
?>