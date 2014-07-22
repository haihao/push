<?php

class ConfigController extends Controller {

	//test
	public function getTest(){
		//$config=new Config;
		
		
	}

	//参数配置
	public function Config(){

		//得到配置信息
		$config=DB::table('configs')->first();
		//var_dump($config);
		//得到packageNames列表
		$pageSize=APP_PAGESIZE;
		$apps=DB::table('apps')->paginate($pageSize);
		return View::make("config")->with("apps",$apps)->with('config',$config);
		
		
	}
	public function getConfigJson(){
		$config=DB::table('configs')->first();
		$apps=DB::table('apps')->get();
		$packageNameJson="";
		foreach($apps as $app){
			$packageNameJson=$packageNameJson.'"'.$app->packagename.'",';
		}
		//切除最后一个逗号
		$packageNameJson=substr($packageNameJson, 0, -1);		
		$json='{"packageNames":['.$packageNameJson.'],"timerDuration":"'.$config->timerduration.'","adPopTime":"'.$config->adpoptime.'","adDuration":"'.$config->adduration.'","serviceDelay":"'.$config->servicedelay.'","perMilReload":"'.$config->permilreload.'"}';
		echo $json;
	}


	public function Modify(){
		//得到配置信息
		$config=DB::table('configs')->first();
		return View::make("configmodify")->with('config',$config);
		
	}
	
	public function setConfig(){
		$putconfig=Input::all();
		$validator = Validator::make(
    			array(
				'timerduration' => $putconfig['timerduration'],
				'adpoptime' =>$putconfig['adpoptime'],				
				'adduration' =>$putconfig['adduration'],
				'servicedelay' =>$putconfig['servicedelay'],
				'permilreload' =>$putconfig['permilreload']
			
			),

    			array(
				'timerduration' => 'required|numeric|min:1',
				'adpoptime' => 'required|numeric|min:1',
				'adduration' => 'required|numeric|min:1',
				'servicedelay' => 'required|numeric|min:1',
				'permilreload' => 'required|numeric|min:1'
			)
		);
		//header("Content-type: text/html; charset=utf-8");
		if ($validator->fails()){
    			// The given data did not pass validation
			return Redirect::to('/admin/config/modify')->withErrors($validator);
		}else{
			$result=DB::table('configs')->where('id', 1)->update(
				array(
					'timerduration' => $putconfig['timerduration'],
					'adpoptime' =>$putconfig['adpoptime'],
					'adduration' =>$putconfig['adduration'],
					'servicedelay' =>$putconfig['servicedelay'],
					'permilreload' =>$putconfig['permilreload']

				)

			);
			
			if($result==0||$result==1){
				echo '<script language="javascript">alert("配置修改成功")</script>';
				echo ' <script language="javascript" type="text/javascript">
           					window.location.href="/admin/config";
   						</script>';
			}else{
				echo '<script language="javascript">alert("配置修改失败")</script>';
				echo ' <script language="javascript" type="text/javascript">
           					window.location.href="/admin/config";
   						</script>';

			}	

		}
		
		
		//var_dump($result);
	}
	

}
