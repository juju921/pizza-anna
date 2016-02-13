<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class Article extends CI_Controller
{

    function __construct()
    {
        parent::__construct();
        $this->user = ($this->sitemodel->is_logged()) ? $this->sitemodel->get_user($this->session->userdata('prenom')) : false;

    }

    public function index()
    {

        $data = array(
            'title' => "bienvenue",
            'pizzas' => $this->sitemodel->get_all(),
            'content' => 'article/index',
        );
        $this->load->view('template/content', $data);
    }

    public function payer()
    {


        if (!$this->sitemodel->is_logged()) {
            redirect('user/login');
            exit;
        }

        if (!$this->cart->contents()) {
            redirect();
            exit;
        }

        $this->load->library('paypal');
        $params = array(
            'RETURNURL' => site_url('article/retour'),
            'CANCELURL' => site_url('article/cancel')
        );

        $items = array();

        $i = 0;
        foreach ($this->cart->contents() as $cart) {
            $items['L_PAYMENTREQUEST_0_NAME' . $i] = $cart['name'];
            $items['L_PAYMENTREQUEST_0_NUMBER' . $i] = $cart['id'];
            $items['L_PAYMENTREQUEST_0_DESC' . $i] = $cart['name'];
            $items['L_PAYMENTREQUEST_0_AMT' . $i] = $cart['price'];
            $items['L_PAYMENTREQUEST_0_QTY' . $i] = $cart['qty'];
            $i++;
        }

        $items['PAYMENTREQUEST_0_AMT'] = $this->cart->total();
        $items['PAYMENTREQUEST_0_CURRENCYCODE'] = 'EUR';

        $params += $items;
        $paypal = new Paypal();
        $response = $paypal->request('SetExpressCheckout', $params);

        if (!empty($response['TOKEN']) && $response['ACK'] == 'Success') {
            $token = htmlentities($response['TOKEN']);

            $order = array(
                'order_token' => $token,
                'order_user_id' => $this->user->user_id,
                'order_amt' => $this->cart->total(),
                'order_total_items' => $this->cart->total_items(),
                'order_paypal_infos' => false,
                'order_valid' => false
            );

            if ($this->sitemodel->add_order($order)) {
                foreach ($this->cart->contents() as $cart) {
                    $sale = array(
                        'sale_user_id' => $this->user->user_id,
                        'sale_article_id' => $cart['id'],
                        'sale_qty' => $cart['qty'],
                        'sale_amt' => $cart['price'],
                        'sale_order_token' => $token,
                        'sale_valid' => false
                    );
                    $this->sitemodel->add_sale($sale);
                }

                header('Location: https://www.paypal.com/webscr?cmd=_express-checkout&token=' . urlencode($token) . '&useraction=commit');
            }
        } else {
            echo 'Une erreur s\'est produite : <br> ' . $response['L_LONGMESSAGE0'];
        }
    }

    public function cancel()
    {
        echo 'Paiement annulé';
    }

    function retour()
    {
        if (empty($_GET)) {
            redirect();
            exit;
        }

        $this->load->library('paypal');

        if (!empty($_GET['token'])) {
            $params = array('TOKEN' => htmlentities($_GET['token'], ENT_QUOTES));

            $paypal = new Paypal();
            $response = $paypal->request('GetExpressCheckoutDetails', $params);
            if (is_array($response) && $response['ACK'] == 'Success') {
                $token = htmlentities($response['TOKEN']);
                $user = $this->sitemodel->get_user($this->sitemodel->get_order($token)->order_user_id);

                $payment_params = array(
                    'PAYMENTREQUEST_0_PAYMENTACTIO' => 'Sale',
                    'PayerID' => htmlentities($_GET['PayerID'], ENT_QUOTES),
                    'PAYMENTREQUEST_0_AMT' => $response['AMT'],
                    'PAYMENTREQUEST_0_CURRENCYCODE' => 'EUR'
                );

                $params += $payment_params;
                $paypal = new Paypal();
                $response = $paypal->request('DoExpressCheckoutPayment', $params);

                if (is_array($response) && $response['ACK'] == 'Success') {
                    $token = htmlentities($response['TOKEN']);
                    $order = array(
                        'order_paypal_infos' => serialize($response),
                        'order_valid' => true
                    );
                    if ($this->sitemodel->valid_order($token, $order)) {
                        $sales = $this->sitemodel->get_sales_order($token);
                        foreach ($sales as $s) {
                            $data = array('sale_valid' => true);
                            $this->sitemodel->update_sales_order($token, $data);
                        }

                        $amount = htmlentities($response['PAYMENTINFO_0_AMT']);

                        $this->email->from('julien.garretb@gmail.com', 'Shop');
                        $this->email->to($user->email);
                        $this->email->subject('Vos achats sur Shop');
                        $this->email->message('<h2>Bonjour ' . $user->firstname . ', </h2>
							<div>Commande n° <strong>' . $token . '</strong></div>
							<div>Montant de la commande :<strong>' . $amount . '</strong></div>
							<p>Votre commande sera expédiée rapidement bla bla bla<br>
							Vous pouvez consulter ' . anchor('user', 'la liste de vos achats') . ' dans votre epace personnel et imprimer la facture.</p>');

                        $this->email->send();

                        $this->cart->destroy();
                        redirect('user');
                    }
                }
            }
        }
    }


    public function detailivraison()
    {

        if ($this->sitemodel->is_logged()) {

        }

        if ($this->sitemodel->is_connected()) {

        }

        $this->form_validation->set_rules('jour_livraison', 'jour_livraison', 'required');
        $this->form_validation->set_rules('ville', 'ville', 'trim|required');
        $this->form_validation->set_rules('heure', 'heure', 'trim|required');
        $this->form_validation->set_rules('message', 'message', 'trim|required');

        if ($this->form_validation->run()) {
            $user = array(
                'id_commande_user' => $this->user->user_id,
                'jour_livraison' => $this->input->post('jour_livraison'),
                'ville' => $this->input->post('ville'),
                'heure' => $this->input->post('heure'),
                'message' => $this->input->post('message'),
            );

            if ($this->sitemodel->signupinfo($user)) {
                $this->session->set_flashdata('success', 'votre commande à bien été enregistré');
                redirect(current_url());
                exit;
            } else {
                throw new Exception('Une erreur est survenue, réessayez svp');
            }
        }

        $data = array(
            'test' => "bonjour",
            'content' => 'article/detailivraison',
        );
        $this->load->view('template/content', $data);

    }


    public function moyendepayent()
    {

        if (!$this->sitemodel->is_logged()) {
            redirect('user/login');
            exit;
        }


        $data = array(
            'content' => 'article/moyendepayent',
        );
        $this->load->view('template/content', $data);

    }

    public function payersanscompte()
    {


        $this->load->library('paypal');
        $params = array(
            'RETURNURL' => site_url('article/retour'),
            'CANCELURL' => site_url('article/cancel')
        );

        $items = array();

        $i = 0;
        foreach ($this->cart->contents() as $cart) {
            $items['L_PAYMENTREQUEST_0_NAME' . $i] = $cart['name'];
            $items['L_PAYMENTREQUEST_0_NUMBER' . $i] = $cart['id'];
            $items['L_PAYMENTREQUEST_0_DESC' . $i] = $cart['name'];
            $items['L_PAYMENTREQUEST_0_AMT' . $i] = $cart['price'];
            $items['L_PAYMENTREQUEST_0_QTY' . $i] = $cart['qty'];
            $i++;
        }

        $items['PAYMENTREQUEST_0_AMT'] = $this->cart->total();
        $items['PAYMENTREQUEST_0_CURRENCYCODE'] = 'EUR';

        $params += $items;
        $paypal = new Paypal();
        $response = $paypal->request('SetExpressCheckout', $params);

        if (!empty($response['TOKEN']) && $response['ACK'] == 'Success') {
            $token = htmlentities($response['TOKEN']);





                header('Location: https://www.paypal.com/webscr?cmd=_express-checkout&token=' . urlencode($token) . '&useraction=commit');

        } else {
            echo 'Une erreur s\'est produite : <br> ' . $response['L_LONGMESSAGE0'];
        }
    }


}
