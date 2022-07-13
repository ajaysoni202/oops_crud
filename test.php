<?php 
include ('database.php');

$obj=new query();
$condition=array('name'=>'ajay','email'=>'baba@fd.sdf');
//$result=$obj->insertData('oops',$condition);
//$result=$obj->getData('oops','*','','id','asc',5);
//$result=$obj->deleteData('oops',$condition);
$result=$obj->updateData('oops',$condition,'id',2);
echo '<pre>';
print_r($result);
?>