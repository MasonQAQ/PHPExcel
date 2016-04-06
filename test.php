<?php
include 'PHPExcel.php';
include 'PHPExcel/Writer/Excel2007.php';

//引入PHPExcel库文件（路径根据自己情况）
// include './phpexcel/Classes/PHPExcel.php';
//创建对象
$excel = new PHPExcel();
//Excel表格式,这里简略写了8列
$letter = array('A','B','C','D','E','F','G','H');
//表头数组
$tableheader = array('id','from','to','value');
//填充表头信息
for($i = 0;$i < count($tableheader);$i++) {
$excel->getActiveSheet()->setCellValue("$letter[$i]1","$tableheader[$i]");
}


//从数据库接受数据

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
		while ($resArray = mysql_fetch_row($result)){
			$arr[]=$resArray;
			// var_dump($resArray);
		}
		// var_dump($arr);

//表格数组
// $data = array(
// array('1','小王','男','20','100'),
// array('2','小李','男','20','101'),
// array('3','小张','女','20','102'),
// array('4','小赵','女','20','103')
// );
$data=$arr;
//填充表格信息
for ($i = 2;$i <= count($data) + 1;$i++) {
$j = 0;
	foreach ($data[$i - 2] as $key=>$value) {
		$excel->getActiveSheet()->setCellValue("$letter[$j]$i","$value");
		$j++;
	}
}

//创建Excel输入对象
$write = new PHPExcel_Writer_Excel5($excel);
header("Pragma: public");
header("Expires: 0");
header("Cache-Control:must-revalidate, post-check=0, pre-check=0");
header("Content-Type:application/force-download");
header("Content-Type:application/vnd.ms-execl");
header("Content-Type:application/octet-stream");
header("Content-Type:application/download");;
header('Content-Disposition:attachment;filename="testdata.xls"');
header("Content-Transfer-Encoding:binary");
$write->save('php://output');


?>