<?php
class database{
	private $host;
	private $dbusername;
	private $dbpassword;
	private $dbname;

	protected function connect(){
		$this->host='localhost';
		$this->dbusername='root';
		$this->dbpassword='';
		$this->dbname='crud';

		$conn= new mysqli($this->host,$this->dbusername,$this->dbpassword,$this->dbname);
		return $conn;
	}
}

class query extends database{
	public function getData($table,$field='*',$condition='',$order_by_field='',$order_by_type='desc',$limit=''){
		$sql="select $field from $table";
		
		if($condition!=''){
		$sql.=' where';
		$c=count($condition);
		$i=1;
		foreach($condition as $key=>$val){
				if($i==$c){
					$sql.=" $key='$val' ";
				}else{
					$sql.=" $key='$val' and ";	
				}
				$i++;
			}
		}

		if($order_by_field!=''){
		$sql.=" order by $order_by_field $order_by_type";
		}

		if($limit!=''){
		$sql.=" limit $limit";
		}
		
		//die($sql);
		$result=$this->connect()->query($sql);
		if($result->num_rows>0){
			while($row=$result->fetch_assoc()){
				$arr[]=$row;
			}
			return $arr;
		}else{
			return 0;
		}
	}


	public function insertData($table,$condition){
		if($condition!=''){
			foreach($condition as $key=>$val){
				$fieldArr[]=$key;
				$valueArr[]=$val;
			}
		$field=implode(",",$fieldArr);
		$value=implode("','",$valueArr);
		$value="'".$value."'";

		$sql="insert into $table($field) values($value)";
		$result=$this->connect()->query($sql);
		}
	}

public function deleteData($table,$condition){
				
		if($condition!=''){
		$sql="delete form $table where ";
		$c=count($condition);
		$i=1;
		foreach($condition as $key=>$val){
				if($i==$c){
					$sql.=" $key='$val' ";
				}else{
					$sql.=" $key='$val' and ";	
				}
				$i++;
			}
			$result=$this->connect()->query($sql);
		}
	}

public function updateData($table,$condition,$where_field,$where_value){
				
		if($condition!=''){
		$sql="update $table set ";
		$c=count($condition);
		$i=1;
		foreach($condition as $key=>$val){
				if($i==$c){
					$sql.=" $key='$val' ";
				}else{
					$sql.=" $key='$val' and ";	
				}
				$i++;
			}
			$sql.="where $where_field='$where_value' ";
			echo $sql;
			$result=$this->connect()->query($sql);
		}
	}


}




//select $field from $table $condition $like $order_by_field $order_by_type $limit
?>