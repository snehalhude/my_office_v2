<?php if (!defined('BASEPATH'))
		exit('No direct script access allowed');
		
class Common_model extends CI_Model {

public function getData($table, $fields="", $con="", $orderby="",$param="")
{	
	if(empty($fields))
	{
		$this->db->select("*");
	}else{

		$this->db->select($fields);
	}
	$this->db->from($table);
	if(!empty($con)){
	   $this->db->where($con);
	}
	if(!empty($orderby)){
		$this->db->order_by($orderby);
	 }
	
	if(!empty($param)){

	return $this->db->get()->row();

	}else{
		
		return $this->db->get()->result();
	}
}

public function save($table,$con='',$data)
{	
	$this->db->set($data);
	if(empty($con)){
		$this->db->insert($table,$data);
	}else{
		$this->db->where($con);
		$this->db->update($table,$data);

	}

}

public function delete($table, $con)
{
	$this->db->where($con);
	$this->db->delete($table);
}



}

?>