<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Facturation extends CI_Controller {

    function __construct()
    {
        parent::__construct();
        $this->view_folder = strtolower(__CLASS__).'/';
        $this->user = ($this->sitemodel->is_logged()) ? $this->sitemodel->get_user($this->session->userdata('prenom')) : false;


    }

    public function index()
    {

        if(!$this->sitemodel->is_logged()){
            redirect('user/login');exit;
        }

        $data = array(

            'test'=>"bonjour",
            'pizza'=>$this->sitemodel->get_all(),
            'content'=>'article/facturation',

        );
        $this->load->view('template/content',$data);
    }


    public function facturation()
    {

        if(!$this->sitemodel->is_logged()){
            redirect('user/login');exit;
        }

        $this->form_validation->set_rules('email', 'Email', 'required|valid_email|is_unique[users.email]');
        $this->form_validation->set_rules('jours', 'jours', 'required');
        $this->form_validation->set_rules('ville', 'ville', 'required');
        $this->form_validation->set_rules('message', 'message', 'trim|required');
        $this->form_validation->set_rules('heure', 'heure', 'trim|required|integer');

        if ($this->form_validation->run()) {

            $commande = array(
                'email'  => $this->user->email,
                'id_commande_user'  => $this->user->id_user,
                'jour_livraison'   =>   $this->input->post('jours'),
                'ville' => $this->input->post('ville'),
                'heure'     => $this->input->post('heure'),
                'message'  => $this->input->post('message')
            );

            if ($this->sitemodel->add_commande($commande)) {
                $this->session->set_flashdata('success', 'Inscription réussie');
                redirect(current_url());
                exit;
            } else {
                throw new Exception('Une erreur est survenue, réessayez svp');
            }
        }

        $data = array(
            'test'=>"bonjour",
            'pizza'=>$this->sitemodel->get_all(),
            'content'=>'facturation',

        );
        $this->load->view('template/content',$data);

    }





}
