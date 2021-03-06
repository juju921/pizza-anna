<?php


class Site extends Ci_Controller
{


	function _contruct()
	{

		parent::_contruct();
		$this->view_folder = strtolower(__CLASS__) . '/';

	}


	public function index()
	{

		$data = array(
			'qty' => 0,
			'title' => 'bienvenu sur la boutique',
			'news' => $this->sitemodel->get_allnews(),
			'content' => 'article/index',


		);
		$this->load->view('template/content', $data);


	}


	public function lacarte()
	{

		$data = array(

			'test' => "bonjour",
			'pizza' => $this->sitemodel->get_all(),
			'content' => 'article/lacarte',


		);
		$this->load->view('template/content', $data);

	}


	public function inscription()
	{

		$data = array(
			'test' => "bonjour",
			'pizza' => $this->sitemodel->get_all(),
			'content' => 'article/inscription',

		);
		$this->load->view('template/content', $data);
	}


	public function panier()
	{
		$data = array(

			'cart' => $this->cart->contents(),
			'total' => $this->cart->total(),
			'total_articles' => $this->cart->total_items(),
			'content' => 'panier',
		);
		$this->load->view('template/content', $data);
	}


	public function add()
	{
		/*if (!$id || !$this->sitemodel->get_one($id)) {
			redirect();
			exit;
		}*/

		$pizza = $this->sitemodel->get_one($this->input->post('idpiz'));
		//$this->input->post('idpiz')
		$data = array(
			'id' => $this->input->post('idpiz'),
			//'qty' => 1,
			'qty' => $this->input->post('quantity'),
			'price' => $pizza->prix,
			'name' => $pizza->noms
		);
		//var_dump($this->cart);

		$this->cart->insert($data);
		redirect('commander');

	}


	public function update($rowid = null)
	{
		if (!$rowid || !$this->input->post('qty') || !is_numeric($this->input->post('qty'))) {
			redirect('panier');
			exit;
		}

		$data = array(
			'rowid' => $rowid,
			'qty' => $this->input->post('qty'),
		);

		$this->cart->update($data);

		if ($this->input->is_ajax_request()) {
			$response = array(
				'success' => true,
				'nb_article' => $this->cart->total_items(),
				'total' => number_format($this->cart->total(), 2, ',', ' '),
				'total_for_item' => number_format($this->input->post('qty') * $this->input->post('price'), 2, ',', ' ')
			);
			echo json_encode($response);
			exit;
		}
		redirect('panier');

	}

	public function delete($rowid = null)
	{
		if (!$rowid) {
			redirect();
			exit;
		}
		$data = array(
			'rowid' => $rowid,
			'qty' => 0,
		);

		$this->cart->update($data);

		if ($this->input->is_ajax_request()) {
			$response = array(
				'success' => true,
				'nb_article' => $this->cart->total_items(),
				'total' => number_format($this->cart->total(), 2, ',', ' '),
			);
			echo json_encode($response);
			exit;
		}

		redirect('panier');
	}

	public function ajax_load_data()
	{

		$result->$this->db->get('pizza')->result();
		$arr_data = array();
		$i = 0;
		foreach ($result as $r) {
			$arr_data[$i]['noms'] = $r->noms;
			$arr_data[$i]['ingredients'] = $r->ingredients;
			$arr_data[$i]['prix'] = $r->prix;
			$arr_data[$i]['numero'] = $r->numero;
			$arr_data[$i]['visible'] = $r->visible;
			$i++;
		}

	}

	public function get_list()
	{
		$this->load->model(array('lacart'));
		$data = $this->lacart->getAllPizza();
		$this->output->set_content_type('application/json')->set_output(json_encode($data));
	}


	public function get_pizza()
	{
		$this->load->model(array('lacart'));
		$data = $this->lacart->getAllPizza();
		$this->output->set_content_type('application/json')->set_output(json_encode($data));
	}


}


?>