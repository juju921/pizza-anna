<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class lacart extends CI_Model {

	function __construct()
	{
		parent::__construct();
		$this->load->database();
		$this->table_name = 'pizza';

	}

function get_all()
	{
		$this->load->database();
		$q = $this->db->select('*')->from('pizza')->order_by('numero', 'ASC')
		->get();
		if($q->num_rows()>0)
		{
			foreach($q->result() as $row)
			{
				$data[] = $row;
			}
			return $data;
		}
	}


		function get_one($id)
	{
		$q = $this->db->select('*')->from('pizza p')
		->where('p.id',$id)
		->get();
		if($q->num_rows()>0)
		{
			return $q->row();
		}
	}


	public function getAllPizza() {
		return $this->db->from($this->table_name)->order_by('numero', 'ASC')->get()->result_array();
	}

	
	}

	
