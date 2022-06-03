<?php 
function decreasebalance($amount){
		$ci=& get_instance();
		$ci->load->database();
		$balance=$ci->db->where('id',1)->get('balance')->row()->balance;
		
			$balance-=$amount;
		if ($balance>=0) {
		$data=array(
			'balance'=>$balance
		);

		$update=$ci->db->where('id',1)->update('balance',$data);
		return true;
		}else{
			return false;
		}
		
	}
	function increasebalance($amount){
		$ci=& get_instance();
		$ci->load->database();
		$balance=$ci->db->where('id',1)->get('balance')->row()->balance;
		$balance+=$amount;
		$data=array(
			'balance'=>$balance
		);
		$update=$ci->db->where('id',1)->update('balance',$data);
	}