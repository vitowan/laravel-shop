<?php
//phpinfo();
$con=array('hostname'=>'www.123.com','port'=>8983,'path'=>'solr/testcore');
$client=new SolrClient($con);
//var_dump($client);
//$doc=new SolrInputDocument();
/*$doc->addField('id',17);
$doc->addField('title','面包1');
$doc->addField('intro','面包不错的1');
$doc->addField('content','哎呦不错哦1');

$doc2=new SolrInputDocument();
$doc2->addField('id',18);
$doc2->addField('title','面包2');
$doc2->addField('intro','面包不错的2');
$doc2->addField('content','哎呦不错哦2');
$docs=[$doc,$doc2];
//var_dump($docs);die;
//$response=$client->addDocuments($docs,false,1000);
$response=$client->addDocuments($docs);
$client->commit();
//echo "<pre>";
var_dump($response);*/


/*$data=array(
	array('id'=>20,'title'=>'面包片5','intro'=>'爱吃面包片5'),
	array('id'=>19,'title'=>'面包片4','intro'=>'爱吃面包片4')
);
foreach($data as $key=>$value){
	$doc=new SolrInputDocument();
	foreach($value as $key2=>$value2){
		$doc->addField($key2,$value2);
	}
	$docs=[$doc];
	$response=$client->addDocuments($docs);
}
$client->commit();*/
/*$response=$client->deleteByQuery('id:16');
$client->commit();
var_dump($response->getResponse());

*/


$query=new solrQuery();
$query->setQuery("title:面包?");
$query->setStart(0);
$query->setRows(100);
$query_response=$client->query($query);
$response=$query_response->getResponse();
echo "<pre>";
var_dump($response);

?>