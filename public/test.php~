<?php

class LogProcess{
	
	public $link;
	private $dbname='dbpush';
	private $host='localhost';
	private $user='root';
	private $password='root';
	
	public function __construct(){
			//创建数据库链接
		$this->link=@mysql_connect("{$this->host}",$this->user,$this->password);
		if(!$this->link){
			die("Connect Server Falied:".mysql_error());
		}
		//设置链接的字符集编码
		mysql_query ( "set names utf8", $this->link ) or die ( mysql_error() );
		//选择数据库
		if(!mysql_select_db($this->dbname,$this->link)){
			die("Select Database Failed:".mysql_error($this->link));
		}
			
				
	}

	public function execute_dql_free($sql){
		$arr=array();
		$res=mysql_query($sql,$this->link) or die(mysql_error());
		$i=0;
		//把得到$res转化成数组
		while($row=mysql_fetch_assoc($res)){
			$arr[$i++]=$row;//$arr[]=$row;
		}
		//释放资源
		mysql_free_result($res);
		//返回数组
		return $arr;
				
	}
	

	public function execute_dml($sql){
		$res=mysql_query($sql,$this->link) or die(mysql_error());
		if(!$res){
			return 0;
		}else{
			if(mysql_affected_rows($this->link)>0){
				return 1;//表示执行OK
			}else{
				return 2;//表示没有收到影响
			}
		}
				
	}	


	
	
	public function FileLastLines($file){
    		if(!$fp=fopen($file,'r')){
        		echo "打开文件失败，请检查文件路径是否正确，路径和文件名不要包含中文";
        		return false;
    		}
		

		//搜索数据库，得到之前文件的行数
		$sql="select `line` from logs where id=1 limit 1";
		$arr=$this->execute_dql_free($sql);
		$oldsize=$arr[0]['line'];
		
		list($newsize, $file) = explode(" ", system("wc -l $file"));
		echo "文件行数：$size";
		$n=$newsize-$oldsize;
		if($n<=0){
			echo "没有可以更新的记录";
			return false;

		}
		
		$sql="update logs set `line`=$newsize where id=1";
		$result=$this->execute_dml($sql);
		if($result==1){

			echo "</br>更新成功</br>";
		}else{
			echo "</br>更新失败</br>";
			return false;
		}


    		$pos=-2;
    		$eof="";
    		$str="";
		//$date="0000-00-00 00:00:00";
		$shows=0;
		$clicks=0;
		//匹配正则
		$regexShows='/\d+\.\d+\.\d+\.\d+\s\-\s\-\s\[[0-3]\d\/[A-Z][a-z][a-z]\/[2]\d\d\d\:[0-4]\d\:[0-6]\d\:\d{2}\s\+\d\d\d\d\]\s\"[A-Z]+\s\/[a-z]{6}\/[a-z]{3}\/[a-z]{2}[C][l][i][c][k]\/[a-z]{6}\.[a-z]{4}\?[a-z]{6}\_[a-z]{2}\=[a-z0-9A-Z]+\&[c][l][i][c][k]\=[0-1]/';
		$regexClicks='/\d+\.\d+\.\d+\.\d+\s\-\s\-\s\[[0-3]\d\/[A-Z][a-z][a-z]\/[2]\d\d\d\:[0-4]\d\:[0-6]\d\:\d{2}\s\+\d\d\d\d\]\s\"[A-Z]+\s\/[a-z]{6}\/[a-z]{3}\/[a-z]{2}[C][l][i][c][k]\/[a-z]{6}\.[a-z]{4}\?[a-z]{6}\_[a-z]{2}\=[a-z0-9A-Z]+\&[c][l][i][c][k]\=[1]/';
		$regextime="/[0-3]\d\/[A-Z][a-z][a-z]\/[2]\d\d\d\:[0-4]\d\:[0-6]\d\:\d{2}/";
    		while($n>0){
        		while($eof!="\n"){
            			if(!fseek($fp,$pos,SEEK_END)){
                			$eof=fgetc($fp);
                			$pos--;
            			}else{
                			break;
            			}
        		}//while end
        		$str.=fgets($fp);
        		$eof="";
        		$n--;
			


    		}//while end
    			//var_dump($str);
		$matcheShows=array();
		$matcheClicks=array();
		$matcheTime=array();
		if(preg_match_all($regexShows, $str, $matcheShows)){
			preg_match_all($regexClicks, $str, $matcheClicks);
			//var_dump($matcheShows[0]);
			preg_match($regextime, $str, $matcheTime);
			$shows=count($matcheShows[0]);
			$clicks=count($matcheClicks[0]);
			$time=DateTime::createFromFormat('d/M/Y:H:i:s',$matcheTime[0]);
			$date=$time->format('Y-m-d H:i:s');
			echo $shows."  ".$date."  ".$clicks;
			$sql="insert into ads(time,clicks,shows) values('$date',$clicks,$shows)";
			$result=$this->execute_dml($sql);
				if($result==1){

					echo "</br>插入成功</br>";
				}else{
					echo "</br>插入失败</br>";
					return false;
				}
			
		}else{

		}

	}




	public function close_connect(){
		if(!empty($this->link)){
			mysql_close($this->link);
		}

	}




}


	
	header("Content-type: text/html; charset=utf-8");
	$logProcess=new LogProcess();
	$file="/home/haihao/Desktop/sample.log";
	$n=100000;
	$logProcess->FileLastLines($file);
	
	

	$logProcess->close_connect();
	
?>
