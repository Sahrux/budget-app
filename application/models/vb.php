<?php 


class Vb extends CI_Model
{
	
	public function getdata($table){
		$result=$this->db->get($table);
		if ($result->num_rows()>0) {
			return $result->result();
		}
		else{
			return false;
		}
	}
	public function insert($data,$table){
		$result=$this->db->insert($table,$data);
		if ($result) {
			return true;
		}else{
			return false;
		}
	}
	/*SELECT *,categories.name as "catname",currency.name as "curname" FROM payment left JOIN categories ON payment.category_id=categories.id left join currency on payment.currency_id=currency.id;*/
	public function catcurrpayment(){
		$result=$this->db->select("*,categories.name as catname,currency.name as curname ")->join('categories','categories.id=payment.category_id')->join('currency','currency.id=payment.currency_id')->from('payment')->get();
		if ($result->num_rows()>0) {
			return $result->result();
		}
		else{
			return false;
		}
	}

	public function catcurrincome(){
		$result=$this->db->select("*,categories.name as catname,currency.name as curname ")->join('categories','categories.id=income.category_id')->join('currency','currency.id=income.currency_id')->from('income')->get();
		if ($result->num_rows()>0) {
			return $result->result();
		}
		else{
			return false;
		}
	}
	public function distinctcurpay(){
		$result=$this->db->select("*,categories.name as catname,currency.name as curname ")->join('categories','categories.id=payment.category_id')->join('currency','currency.id=payment.currency_id')->from('payment')->distinct()->get();
		if ($result->num_rows()>0) {
			return $result->result();
		}
		else{
			return false;
		}
	}
	public function curfilter($where){
		$result=$this->db->select("*,categories.name as catname,currency.name as curname ")->join('categories','categories.id=payment.category_id')->join('currency','currency.id=payment.currency_id')->where('currency.name',$where)->from('payment')->get();
		return $result;
	}
	public function catfilter($where){
		$result=$this->db->select("*,categories.name as catname,currency.name as curname ")->join('categories','categories.id=payment.category_id')->join('currency','currency.id=payment.currency_id')->where('categories.name',$where)->from('payment')->get();
		return $result;
	}
	public function filterbydate($initial,$end){
		$result=$this->db->select("*,categories.name as catname,currency.name as curname ")->join('categories','categories.id=payment.category_id')->join('currency','currency.id=payment.currency_id')->where(' payment.date >= date("'.$initial.'")')->where( 'payment.date <= date("'.$end.'")')->from('payment')->get();
		return $result;
	}
	public function totalamount($table){
		$result=$this->db->select('sum(amount) as total')->from($table)->get();
		if ($result->num_rows()>0) {
			return $result->row();
		}
		else{
			return false;
		}
	}
	public function getbalance(){
		$result=$this->db->get("balance")->row();
		return $result;
	}
	public function updatebalance(){
		$result=$this->db->where('id',1)->update($data);
	}

}


