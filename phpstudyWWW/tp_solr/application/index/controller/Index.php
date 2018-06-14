<?php
namespace app\index\controller;
use think\Page;
class Index extends \think\Controller{

    public function index(){

    	$con=array('hostname'=>'www.123.com','port'=>8983,'path'=>'solr/bookcore');
    	$client=new \SolrClient($con);
    	//dump($client);
    	$query= new \solrQuery();
    	$query->setQuery('*:*');

    	//获取页码

    	$p = input('p')?input('p'):1;
    	//echo $p;
       //$page = new Page(count($arr),10);
    	//$pp=input('pp')?input('pp'):$p;
//echo $pp;
    	$query->setStart(($p-1)*20);
    	$query->setRows(20);

    	$query_response=$client->query($query);
    	$response=$query_response->getResponse();
    	//dump($query_response);
    	//dump($response['response']);
    	//上一页
    	if($p>1){
    		$p0=$p-1;
    	}else{
    		$p0=1;
    	}
    	//下一页
    	if($p<ceil($response['response']['numFound']/20)){
    		$p1=$p+1;
    	}else{
    		$p1=ceil($response['response']['numFound']/20);
    	}
    	$url=$_SERVER["SCRIPT_NAME"];
    	$this->assign('result',$response['response']['docs']);
    	$this->assign('num',$response['response']['numFound']);
    	$this->assign('p0',$p0);
    	$this->assign('p1',$p1);
    	$this->assign('p',$p);
    	//Dump($_SERVER);
    	
    	//echo $url;
    	return view('index/index');
/*    	foreach($response['response']['docs'] as $k=>$v){
    		echo $v['name'][0];
    		echo "<br>";
    	}*/

       
    }

    function search(){
    	$v=$_POST['v'];
    	//dump($v);die;
    	
    	$con=array('hostname'=>'www.123.com','port'=>8983,'path'=>'solr/bookcore');

    	$client=new \SolrClient($con);
    	//dump($client);
    	$query= new \solrQuery();

    	$query->setQuery("full_name:".$v );

/*    	$p = input('p')?input('p'):1;
    	$query->setStart(($p-1)*20);
    	$query->setRows(20);*/
    	$query_response=$client->query($query);
    	$response1=$query_response->getResponse();
    	//echo 1;
    	$this->assign('result',$response1['response']['docs']);
    	$this->assign('num',$response1['response']['numFound']);
		echo 1;
    	return view('index/search');




    }


}
