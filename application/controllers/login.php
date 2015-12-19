<?php if (!defined('BASEPATH')) exit('No direct script access allowed');

class Login extends CI_Controller
{

    function __construct()
    {
        parent::__construct();
        $this->view_folder = strtolower(__CLASS__) . '/';

    }

    public function index()
    {

        if ($this->sitemodel->is_logged()) {
            redirect('user');
            exit;
        }

        $this->form_validation->set_rules('email', 'Email', 'required|valid_email|is_unique[users.email]');
        $this->form_validation->set_rules('civilite', 'civilite', 'required');
        $this->form_validation->set_rules('lastname', 'Nom', 'trim|required');
        $this->form_validation->set_rules('firstname', 'Prénom', 'trim|required');
        $this->form_validation->set_rules('phone', 'Téléphone', 'trim|required|integer');
        $this->form_validation->set_rules('mdp', 'mdp', 'trim|required|min_length[5]');


        if ($this->form_validation->run()) {
            $user = array(
                'civilite' => $this->input->post('civilite'),
                'nom' => $this->input->post('lastname'),
                'prenom' => $this->input->post('firstname'),
                'telephone' => $this->input->post('phone'),
                'email' => $this->input->post('email'),
                'password' => sha1(md5($this->input->post('mdp')))
            );

            if ($this->sitemodel->signup($user)) {
                $this->session->set_flashdata('success', 'Inscription réussie');
                redirect(current_url());
                exit;
            } else {
                throw new Exception('Une erreur est survenue, réessayez svp');

            }
        }

        $data = array(

            'test' => "bonjour",
            'content' => 'article/login',
        );
        $this->load->view('template/content', $data);

    }


    public function login()
    {
        if ($this->sitemodel->is_logged()) {
            redirect('user');
            exit;
        }

        $this->form_validation->set_rules('email', 'email', 'trim|required|valid_email');
        $this->form_validation->set_rules('mdp', 'mdp', 'trim|required');

        if ($this->form_validation->run()) {
            if ($this->sitemodel->login($this->input->post('email'), $this->input->post('mdp'))) {
                redirect('user');
                exit;
            } else {
                $this->session->set_flashdata('error', 'Mauvais identifiants');
                redirect(current_url());
                exit;
            }
        }

        $data = array(
            'title' => 'Connexion',
            'content' => $this->view_folder . __FUNCTION__
        );
        $this->load->view('template/content', $data);
    }



}










