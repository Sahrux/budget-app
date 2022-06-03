<?php 

class Maincontroller extends CI_Controller
{
	
	function __construct()
	{
		parent::__construct();
	}
	public function index(){
		$data['categories']=$this->vb->getdata('categories');
		$data['currencies']=$this->vb->getdata('currency');
		$data['payments']=$this->vb->catcurrpayment();
		$data['incomes']=$this->vb->catcurrincome();
		$data['totalpayment']=$this->vb->totalamount('payment');
		$data['totalincome']=$this->vb->totalamount('income');
		$data['balance']=$this->vb->getbalance();
		$data['distinctcurs']=$this->vb->distinctcurpay();
		$this->load->view("homepage",$data);
		
	}
	public function addcategory(){

		$data['name']=$this->input->post('category');
		$insert=$this->vb->insert($data,'categories');
		if ($insert) {
			echo "Kateqoriya Əlavə Edildi";
		}else{
			echo "Problem yarandi" ;
		}
	}
	public function addcurrency(){
		$data=array(
			'name'=>$this->input->post('name'),
			'fullname'=>$this->input->post('fullname')
		);
		$insert=$this->vb->insert($data,'currency');
		if ($insert) {
			echo "Valyuta Əlavə Edildi";
		}else{
			echo "Problem yarandi" ;
		}
	}
	public function addpayment(){
		$category=$this->input->post('category');
		$currency=$this->input->post('currency');
		/*$cateogory_id;
		$currency_id;*/
		$catarray=$this->db->where('name',$category)->get('categories')->row();
		$category_id=$catarray->id;
		$curarray=$this->db->where('name',$currency)->get('currency')->row();
		$currency_id=$curarray->id;
		$amount=$this->input->post('amount');
		$decrease=decreasebalance($amount);
		if ($decrease) {
			$data=array(
			'description'=>$this->input->post('desc'),
			'amount'=>$this->input->post('amount'),
			'category_id'=>$category_id,
			'currency_id'=>$currency_id,
			'date'=>$this->input->post('date')
		);
		
		$insert=$this->vb->insert($data,'payment');
		if ($insert) {
			
			echo "Ödəniş Əlavə Edildi";

		}else{
			echo "Problem yarandi" ;
		}
		}else{
			$this->session->set_flashdata('notenough', 'Balansinizda kifayət qədər məbləğ yoxdur,ilk öncə mədaxil etməlisiz');
		}
		
		
	}
	public function addincome(){
		$category=$this->input->post('category');
		$currency=$this->input->post('currency');
		$catarray=$this->db->where('name',$category)->get('categories')->row();
		$category_id=$catarray->id;
		$curarray=$this->db->where('name',$currency)->get('currency')->row();
		$currency_id=$curarray->id;
		$data=array(
			'description'=>$this->input->post('desc'),
			'amount'=>$this->input->post('amount'),
			'category_id'=>$category_id,
			'currency_id'=>$currency_id,
			'date'=>$this->input->post('date')
		);
		
		$insert=$this->vb->insert($data,'income');
		if ($insert) {
			$amount=$this->input->post('amount');
			increasebalance($amount);
			echo "Mədaxil Əlavə Edildi";
		}else{
			echo "Problem yarandi" ;
		}
		
	}
	public function curfilter(){
		$print='';
		$currency=$this->input->post('currency');
		if ($currency) {
			$results=$this->vb->curfilter($currency);
			if($results->num_rows()>0){
				foreach($results->result() as $row){
					$print.='
						    <tr>
						      <td>'.$row->curname.'</td>
						      <td>'.$row->description.'</td>
						      <td>'.$row->catname.'</td>
						      <td>'."-".$row->amount.'</td>
						      <td>'.$row->date.'</td>
						    </tr>';
				}

			}else{
				$print=false;
			}
			echo $print;
		}else{
			echo false;
		}
		
		}
		public function catfilter(){
		$print='';
		$category=$this->input->post('category');
		if ($category) {
			$results=$this->vb->catfilter($category);
			if($results->num_rows()>0){
				foreach($results->result() as $row){
					$print.='
						    <tr>
						      <td>'.$row->curname.'</td>
						      <td>'.$row->description.'</td>
						      <td>'.$row->catname.'</td>
						      <td>'."-".$row->amount.'</td>
						      <td>'.$row->date.'</td>
						    </tr>';
				}
			}else{
				$print=false;
			}

			echo $print;
		
		}else{
			echo false;
		}
		
		
	}
	public function datefilter(){
		$print='';
		$initial=$this->input->post('initial');
		// var_dump($initial);
		$end=$this->input->post('end');
		//səbəbsizcə burda postdan gələn data stringdə gəlir
		if ($initial=="false") {
			$initial="2000-01-01";
			// echo $initial; die();	
		}
		if ($end=="false") {
			$end=date('Y-m-d');
		}
		// echo $initial;die();
			$results=$this->vb->filterbydate($initial,$end);
			if($results->num_rows()>0){
				foreach($results->result() as $row){
					$print.='
						    <tr>
						      <td>'.$row->curname.'</td>
						      <td>'.$row->description.'</td>
						      <td>'.$row->catname.'</td>
						      <td>'."-".$row->amount.'</td>
						      <td>'.$row->date.'</td>
						    </tr>';
				}
			}else{
				$print=false;
			}

			echo $print;
		
		
		
		
	}
	
}


 ?>