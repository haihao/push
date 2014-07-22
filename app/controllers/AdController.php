<?php

class AdController extends Controller {
	//测试方法
	public function getTest1(){
		//echo "haha";	
		$ads = Ad::select(DB::raw("sum(case when isclick=1 then 1 else 0 end) as 'clicks',count(*) as shows,DATE(time+0) as 'date'"))->groupBy('date')->paginate(10);
		return View::make("adlist")->with("ads",$ads);
		//var_dump($ads);
	}
	public function getTest(){
		//select sum(case when isclick=1 then 1 else 0 end) as '点击次数',count(`isclick`) as '展现次数',DATE(time+0) as '日期' from ads group by time+0;
		
		for($i=1;$i<=10;$i++){
			$ad=new Ad;
			$ad->time='2014-05-16 12:15:42';
			$ad->isclick=1;
			//var_dump($ad);exit();
			$ad->save();
		}
		
	
	}
	
	//广告统计
	public function Adlist(){
		$pageSize=APP_PAGESIZE;
		$ads = DB::table('ads')->paginate($pageSize);
		//var_dump($ads);
		//输出到模板
		return View::make("adlist")->with("ads",$ads);
		
	}
	
	public function getAd($id=""){
		if(is_numeric($id)){
			$ad=new Ad;
			$a=$ad->find($id);
			//var_dump($a);
			if(!empty($a)){
				return View::make("ad")->with('ad',$a);
			}else{
				return "没有这条广告";
			}
		
			
		}else{
			return '请输入数字';
		}
		
	}


	

}
