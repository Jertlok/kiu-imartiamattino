<?php
/**
 * Created by PhpStorm.
 * User: angel
 * Date: 19/01/2018
 * Time: 15:30
 */

class Venditore extends CI_Controller
{
    //costruttore
    public function __construct()
    {
        parent::__construct();

        $this->load->helper('url');
        $this->load->library('session');
        $this->load->helper('form');
        $this->load->library('form_validation');
        $this->load->model('venditore_model');
    }

    public function index()
    {
        // Before loading the different pages, gather the data needed

        $this->load->view('template/header'); // navbar loading
        $this->load->view('user/venditore/sidebar'); //sidebar loading
        $data['summary'] = $this->venditore_model->get_summary();
        $this->load->view('user/venditore/main', $data);
        $this->load->view('template/footer'); // footer loading
    }

    public function aggiungi_proprietario($status = 0)
    {
        $this->load->view('template/header'); // navbar loading
        $this->load->view('user/venditore/sidebar'); //sidebar loading
        $data['status'] = $status;
        $this->load->view('user/venditore/aggiungiproprietario', $data);
        $this->load->view('template/footer'); // footer loading
    }

    /*
    public function update_aggiungi_proprietario()
    {
        if(!$this->venditore_model->aggiungi_proprietario())
            $this->aggiungi_proprietario(-1);
        else
            $this->aggiungi_proprietario(1);
    }
    */


    public function perform_aggiungi_proprietario()
    {
        $this->venditore_model->aggiungi_proprietario();
        $this->aggiungi_proprietario(1);
    }

    public function visualizza_proprietari($status = 0)
    {
        $this->load->view('template/header'); // navbar loading
        $this->load->view('user/venditore/sidebar'); //sidebar loading
        $data['status'] = $status;
        //$this->load->view('user/venditore/visualizzaproprietari', $data);
        $data['proprietari'] = $this->venditore_model->get_proprietari();
        $this->load->view('user/venditore/visualizzaproprietari', $data);
        $this->load->view('template/footer'); // footer loading
    }

    public function perform_visualizza_proprietari()
    {
        $this->venditore_model->visualizza_proprietari(0);
    }

    public function rimuovi_proprietario($id)
    {
        $result = $this->venditore_model->rimuovi_proprietario($id);
        $this->visualizza_proprietari($result);
    }


}