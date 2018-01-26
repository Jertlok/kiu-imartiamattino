<?php
/**
 * Created by PhpStorm.
 * User: angel
 * Date: 19/01/2018
 * Time: 13:17
 */

class Proprietario extends CI_Controller
{
    public function __construct() //costruttore
    {
        parent::__construct();
        $this->load->helper('url');
        $this->load->model('proprietario_model');
        $this->load->library('session');
        $this->load->library('form_validation'); // form validation lib
        $this->load->helper('form');
    }

    public function index(){

        $this->load->view('template/header'); // navbar loading
        $this->load->view('user/Proprietario/sidebar');// sidebar loading
        $data['summary'] = $this->proprietario_model->get_summary();
        $this->load->view('user/Proprietario/main', $data);
        $this->load->view('template/footer'); // footer loading

    }


    public function visualizza_impianti(){

        $this->load->view('template/header'); // navbar loading
        $this->load->view('user/Proprietario/sidebar');// sidebar loading

        // Ricerca tutti gli impianti appartenenti al proprietario nella sessione corrente e li mette in $data
        $data['impianti'] = $this->proprietario_model->get_impianti();

        $this->load->view('user/Proprietario/seleziona_impianto', $data);
        $this->load->view('template/footer'); // footer loading

    }

// visualizza tutti gli impianti di un determinato proprietario
    public function visualizza_dati_impianto($id = false){
        $this->load->view('template/header'); // navbar loading
        $this->load->view('user/Proprietario/sidebar');

        // normal call
        if($id=== false) {
            $daterange = explode(' - ', $this->input->post('daterange'));
            $id_impianto = $this->input->post('id_impianto');
            $tipo_sensore = $this->input->post('tipo');
            $initial_date = $daterange[0];
            $ending_date = $daterange[1];
            $rilevazioni = $this->proprietario_model->get_rilevazioni_by_date($id_impianto, $tipo_sensore, $initial_date, $ending_date);
            $data['labels'] = $rilevazioni['labels'];
            $data['series'] = $rilevazioni['series'];
            $data['tipo'] = $tipo_sensore;
            $data['id_impianto'] = $id_impianto;
            $data['date_range'] = $this->input->post('daterange');
            $this->load->view('user/Proprietario/visualizzadati', $data);
            $this->load->view('template/footer'); // footer loading
        }

        else {
            $initial_date = new DateTime();
            $initial_date->modify('-6 day');
            $rilevazioni = $this->proprietario_model->get_rilevazioni_by_date($id, 'Temperatura', $initial_date->format('Y-m-d'), date('Y-m-d'));
            $data['initial_date'] = $initial_date->format('Y-m-d');
            $data['labels'] = $rilevazioni['labels'];
            $data['series'] = $rilevazioni['series'];
            $data['id_impianto'] = $id;
            $data['tipo'] = 'Temperatura';
            $this->load->view('user/Proprietario/visualizzadati', $data);
            $this->load->view('template/footer'); // footer loading
        }


    }


    //implementa visualizza dati
    public function visualizza() {


        $data['rilevazioni'] = $this->proprietario_model->get_rilevazioni();
        $this->load->view('template/header'); // navbar loading
        $this->load->view('user/Proprietario/sidebar');// sidebar loading
        $this->load->view('user/Proprietario/visualizzadati', $data);
        $this->load->view('template/footer'); // footer loading
    }

    public function nuova_terzaparte($status=0) {
        $this->load->view('template/header'); // navbar loading
        $this->load->view('user/Proprietario/sidebar');// sidebar loading
        $data['status'] = $status;
        $data['impianti'] = $this->proprietario_model-> get_impianti();
        $this->load->view('user/Proprietario/autorizzaterzaparte', $data);
        $this->load->view('template/footer'); // footer loading
    }

    public function autorizzaterzaparte() {

        $this->form_validation->set_rules('indirizzoIP' , 'indirizzoIP' , 'required');
        $this->form_validation->set_rules('intervalloTempo' , 'IntervalloTempo' , 'required');
        $this->form_validation->set_rules('impianto' , 'Impianto' , 'required');


        if($this->form_validation->run()=== false){
            $this->nuova_terzaparte( -1);
        }
        else{

            $this->proprietario_model->autorizzaterzaparte();
            $this->nuova_terzaparte(1);
        }

    }

    public function rilevazioni() {
        $this->proprietario_model->genera_rilevazioni();
    }


    public function invia_dati()
    {
      $this->proprietario_model->invia_dati();
      $this->load->view('template/header'); // navbar loading
      $this->load->view('user/Proprietario/sidebar');// sidebar loading
      $this->load->view('user/Proprietario/dati_inviati');
      $this->load->view('template/footer'); // footer loading
      //redirect();
    }


}