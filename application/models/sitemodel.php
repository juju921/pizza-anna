<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Sitemodel extends CI_Model {

	function __construct()
	{
		parent::__construct();
	}

function get_all()
	{
		$this->load->database();
		$q = $this->db->select('*')->from('pizza')->order_by('numero', 'ASC')->where('visible =','1')
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
		$q = $this->db->select('*')->from('pizza')
		->where('id',$id)
		->get();
		if($q->num_rows()>0)
		{
			return $q->row();
		}
	}


function get_allnews()
	{
		$q = $this->db->select('*')->from('news',  0, 3)
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


		function get_onenews($id)
	{
		$q = $this->db->select('*')->from('news')
		->where('id_news',$id)
		->get();
		if($q->num_rows()>0)
		{
			return $q->row();
		}
	}


    function add($data){

        $this ->db->insert('commande',$data);
           return;

    }


    function signup($data)
    {
        $this->db->insert('users',$data);
        return true;
    }

	function signupinfo($data)
	{
		$this->db->insert('commande',$data);
		return true;
	}

    function  login($email,$password)
    {
        $q = $this->db->get_where('users',array('email'=>$email, 'password'=>sha1(md5($password))));
        if($q->num_rows()>0)
        {
            $row = $q->row();
            $session = array('email'=>$row->email ,'prenom'=>$row->prenom,'logged'=>true);
            $this->session->set_userdata($session);
            return true;
        }
        return false;
    }


	public function verfiemail($email)
	{
		$q = $this->db->get_where('users',array('email'=>$email));

		if($q->num_rows() > 0)
		{
			$row = $q->row();
			$session = array('email'=>$row->email,'logged'=>true);
			$this->session->set_userdata($session);
			return true;

		}

		return false;
	}




    function is_logged()
    {
        return $this->session->userdata('prenom') && $this->session->userdata('logged');

    }


    function is_connected()
    {
        return $this->session->userdata('telephone') && $this->session->userdata('logged');

    }


    
    	function get_user($param)
	{
		if(is_numeric($param))
		{
			$this->db->where('u.user_id',$param);
		}else{
			$this->db->where('u.prenom',$param);
		}

		$q = $this->db->select('*')->from('users u')
		->get();
		if($q->num_rows()>0)
		{
			return $q->row();
		}
	}

    function add_order($data)
    {
        $this->db->insert('orders',$data);
        return true;
    }

    function add_commande($data)
    {
        $this->db->insert('commande',$data);
        return true;
    }

    function add_sale($data)
    {
        $this->db->insert('sales',$data);
        return true;
    }





}

	
