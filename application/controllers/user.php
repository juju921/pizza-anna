<?php

if (!defined('BASEPATH')) {
    exit('No direct script access allowed');
}

class User extends CI_Controller
{

    function __construct()
    {

        parent::__construct();
        $this->user = ($this->sitemodel->is_logged()) ? $this->sitemodel->get_user($this->session->userdata('prenom')) : false;

        $this->view_folder = strtolower(__CLASS__) . '/';
    }

    public function index()
    {
        if (!$this->sitemodel->is_logged()) {
            redirect('user/login');
            exit;
        }

        $data = array(
            'user' => $this->user,
            //'orders' => $this->sitemodel->get_orders($this->user->user_id),
            'test' => "bonjour",
            'content' => 'user/test',
        );
        $this->load->view('template/content', $data);
    }

    public function logout()
    {
        $this->session->sess_destroy();
        redirect();
        exit;
    }

    public function inscription()
    {

        if ($this->sitemodel->is_logged()) {
            redirect('panier');
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
            'content' => 'user/inscription',
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
                redirect('panier');
                exit;
            } else {
                $this->session->set_flashdata('error', 'Mauvais identifiants');
                redirect(current_url());
                exit;
            }
        }

        $data = array(
            'title' => 'Connexion',
            'content' => 'user/login',
        );
        $this->load->view('template/content', $data);
    }

    public function facture($token = null)
    {
        if (!$this->sitemodel->is_logged()) {
            redirect();
            exit;
        }
        if (!$token) {
            redirect();
            exit;
        }

        $order = $this->sitemodel->get_order($token);
        $sales = $this->sitemodel->get_sales_order($token);

        $data = array(
            'sales' => $sales,
            'order' => $order
        );

        $this->load->view($this->view_folder . __FUNCTION__, $data);
        $html = $this->output->get_output();
        $this->load->library('mpdf');
        $mpdf = new Pdf();
        $mpdf->WriteHTML($html);
        $mpdf->Output();
    }

    public function commande($token = null)
    {
        if (!$token) {
            redirect();
            exit;
        }
        $sales = $this->sitemodel->get_sales_order($token);
        if (!$sales) {
            redirect();
            exit;
        }
        $data = array(
            'title' => 'Mes commandes',
            'sales' => $sales,
            'order' => $this->sitemodel->get_order($token),
            'content' => $this->view_folder . __FUNCTION__
        );

        $this->load->view('template/content', $data);
    }

    public function choixinscription()
    {

        $data = array(
            'title' => 'Connexion',
            'content' => 'user/choixinscription',
        );
        $this->load->view('template/content', $data);


    }

    public function inscriptions()
    {

        //On vérifie le champ email
        $this->form_validation->set_rules('email', 'email', 'trim|required|valid_email');

        if ($this->form_validation->run()) {


            if ($this->sitemodel->verfiemail($this->input->post('email'))) {
                $this->session->set_flashdata('error', 'votre email est utilisé ');
                redirect('user/login');
                exit;
            } else {
                $mail = $this->input->post('email');
                $this->session->set_flashdata('vars', $mail);


                redirect('user/inscription', $mail);


                exit;

            }
            /*if ($this->input->verfiemail($this->input->post('email'))) {

                $this->session->set_flashdata('error', 'votre email est invalide');
                redirect(current_url());
                exit;

            } else {

                $this->session->set_flashdata('log', 'Inscription réussie');
                //redirect(base_url('user/inscription'));
                redirect(current_url());
                exit;

            }*/

            $data = array(
                'title' => 'Connexion',
                'content' => 'user/login',
            );
            $this->load->view('template/content', $data);
        }

    }


}
