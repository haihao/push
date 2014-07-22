<?php

class UserController extends Controller {
	//测试方法
	public function Test(){
		//if (Auth::check())
		//{
    		// 用户已经登陆...
		//	echo "用户已经登录";
		//	$name = Auth::user()->name;
		//	$password= Auth::user()->password;

		//	echo $name,$password;
		//}else{
			//echo "用户没有登录";
		//}	
		//$time="21/Jul/2014:07:15:41";
		//$d=DateTime::createFromFormat('d/M/Y:H:i:s',$time);
		//$date=$d->format('Y-m-d H:i:s');
		//echo $date;
		//$a=" ";
		//$time2=preg_replace('/\//',$a,$time);
		//$time3=preg_replace('/\:/',' ',$time2,1);
		//$d=strtotime($time3);
		//$str="0000-00-00 00:00:00";
		//$str="2014-07-21 07:15:41";
		//$time=date('Y-m-d H:i:s',$time);
		//var_dump($time);
		//$config=DB::table('configs')->first();
		//var_dump($config);

		

	}
	

	//修改用户密码
	public function getReset(){
		$user = User::find(2);
//var_dump($user);
		$user->password="123";
		$user->save();
		return "update seccess";
	}

	public function getDel($id=""){
		if(empty($id)){
			echo "kong de";
			exit();
		}
		$user=User::find($id);
		$user->delete();
	}

	public function lgoin(){
		if (Auth::check()){
			return Redirect::to(APP_ROOT."admin/home");
		}else{
			return View::make('login');
		}
		
		
	}
	
	//登录验证
	public function loginCheck(){
		$name=Input::get('username');
		$password=Input::get('password');
		if (Auth::attempt(array('name' => $name, 'password' => $password))){
    			return Redirect::to(APP_ROOT."admin/home");
		}else{
			echo '<script language="javascript">alert("用户名或密码错误！")</script>';
					echo ' <script language="javascript" type="text/javascript">
           					window.location.href="/admin/login";
   						</script>';
		}

	}


	public function logout(){
		Auth::logout();
		return Redirect::to(APP_ROOT."admin/login");
	}

	public function test2(){
		
		$file="/home/haihao/Desktop/f.txt";
		//搜索数据库，得到之前文件的行数
		$oldsize=0;
		//计算现在文件的行数，并写如数据库
		list($newsize, $file) = explode(" ", system("wc -l $file"));
		//写入数据库TODO
		
		//得到相差的行数
		$n=$newsize-$oldsize;
		echo $n;
		if(!$fp=fopen($file,'r')){
        		echo "打开文件失败，请检查文件路径是否正确，路径和文件名不要包含中文";
        		return false;
    		}else{
			echo "可以打开文件";

			$pos=-2;
			$eof="";
    			$str="";
			//每循环几次加入数据库
			$cycles=100;
			$i=$cycles;

			while($n>0){
        			while($eof!="\n"){
            				if(!fseek($fp,$pos,SEEK_END)){
                				$eof=fgetc($fp);
                				$pos--;
            				}else{
						list($size, $file) = explode(" ", system("wc -l $file"));
                				break;
            				}
        			}
        			$str.=fgets($fp);
				if(preg_match($regex, $str, $matches)){
    					var_dump($matches);
				}
				$str="";
        			$eof="";
        			$n--;
    			}

		}
		
		
	}


	public function test3(){
		$file="/home/haihao/Desktop/sample.log";
		//搜索数据库，得到之前文件的行数
		
		$log=DB::table('logs')->first();
		$oldsize=$log->line;
		//计算现在文件的行数，并写如数据库
		list($newsize, $file) = explode(" ", system("wc -l $file"));
		//写入数据库TODO
		DB::table('logs')->where('id', 1)->update(
			array('line'=>$newsize)
		);
		//得到相差的行数
		$n=$newsize-$oldsize;
		if(!$fp=fopen($file,'r')){
        		echo "打开文件失败，请检查文件路径是否正确，路径和文件名不要包含中文";
        		return false;
    		}else{
			echo "可以打开文件";

			$pos=-2;
			$eof="";
    			$str="";
			//每循环几次加入数据库
			$cycles=100;
			$i=$cycles;
			//匹配正则
			$regex='/\d+\.\d+\.\d+\.\d+\s\-\s\-\s\[[0-3]\d\/[A-Z][a-z][a-z]\/[2]\d\d\d\:[0-4]\d\:[0-6]\d\:\d{2}\s\+\d\d\d\d\]\s\"[A-Z]+\s\/[a-z]{6}\/[a-z]{3}\/[a-z]{2}[C][l][i][c][k]\/[a-z]{6}\.[a-z]{4}\?[a-z]{6}\_[a-z]{2}\=[a-z0-9A-Z]+\&[c][l][i][c][k]\=[0-1]/';
			while($n>0){
				if($i==1){
					$i=$cycles;
					$matches = array();
					if(preg_match_all($regex, $str, $matches)){
    						//如果匹配的有数据则解析写入数据库
						$regextime="/[0-3]\d\/[A-Z][a-z][a-z]\/[2]\d\d\d\:[0-4]\d\:[0-6]\d\:\d{2}/";
						$regexclick="/\&[c][l][i][c][k]\=[0-1]/";
						$regexisclick="/[0-1]/";
						//var_dump($matches);
						$matchearray=$matches[0];
						$insertArray=array();
						$j=0;
						foreach($matchearray as $matchstring){
							preg_match($regextime, $matchstring, $matchetime);
							preg_match($regexclick,$matchstring,$matcheclick);
							preg_match($regexisclick,$matcheclick[0],$matcheisclick);
							$d=DateTime::createFromFormat('d/M/Y:H:i:s',$matchetime[0]);
							$time=$d->format('Y-m-d H:i:s');
							$isclick=$matcheisclick[0];
							$adlog=array( 'time'=>$time,'isclick'=>$isclick );
							$insertArray[$j]=$adlog;
							$j++;
						}
						DB::table('ads')->insert($insertArray);
						echo '写入成功';
						
					}
					$str="";

				}else{
        				while($eof!="\n"){
            					if(!fseek($fp,$pos,SEEK_END)){
                					$eof=fgetc($fp);
                					$pos--;
            					}else{
							list($size, $file) = explode(" ", system("wc -l $file"));
							if($i!==1||$i!==$cycles){
								$matches = array();
								if(preg_match_all($regex, $str, $matches)){
    									$i=$cycles;
									$matches = array();
									if(preg_match_all($regex, $str, $matches)){
    										//如果匹配的有数据则解析写入数据库
										$regextime="/[0-3]\d\/[A-Z][a-z][a-z]\/[2]\d\d\d\:[0-4]\d\:[0-6]\d\:\d{2}/";
										$regexclick="/\&[c][l][i][c][k]\=[0-1]/";
										$regexisclick="/[0-1]/";
										//var_dump($matches);
										$matchearray=$matches[0];
										$insertArray=array();
										$j=0;
										foreach($matchearray as $matchstring){
											preg_match($regextime, $matchstring, $matchetime);
											preg_match($regexclick,$matchstring,$matcheclick);
											preg_match($regexisclick,$matcheclick[0],$matcheisclick);
											$d=DateTime::createFromFormat('d/M/Y:H:i:s',$matchetime[0]);
											$time=$d->format('Y-m-d H:i:s');
											$isclick=$matcheisclick[0];
											$adlog=array( 'time'=>$time,'isclick'=>$isclick );
											$insertArray[$j]=$adlog;
											$j++;
										}
										DB::table('ads')->insert($insertArray);
										echo '写入成功';
						
									}
						
						
								}
							}
							
                					break;
            					}
        				}
        				$str.=fgets($fp);

        				$eof="";
        				$n--;
					$i--;
    				}
			}
		}
		
		
	}

	
	

	


	
	

	
	
	
	

}
