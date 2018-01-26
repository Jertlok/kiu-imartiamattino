<?php
/**
 * Created by PhpStorm.
 * User: Jertlok
 * Date: 20/01/2018
 * Time: 10:58
 */

class Amministratore extends CI_Controller {

    public function __construct() {
        parent::__construct();
        $this->load->helper('url');
        $this->load->library('session');
        $this->load->helper('form');
        $this->load->library('form_validation');
        $this->load->model('amministratore_model');
    }

    // --- VIEWS SECTION
    public function index() {
        // Before loading the different pages, gather the data needed
        $this->load->view('template/header'); // navbar loading
        $this->load->view('user/amministratore/sidebar');
        $data['summary'] = $this->amministratore_model->get_summary();
        $this->load->view('user/amministratore/main', $data);
        $this->load->view('template/footer'); // footer loading
    }


    /**
     * Page for creating a new Impianto
     * status can be 0, 1 or -1
     * 0 : default
     * -1 : error
     * 1 : success
     */
    public function nuovo_impianto($status = 0) {
        $this->load->view('template/header'); // navbar loading
        $this->load->view('user/amministratore/sidebar');
        $data['status'] = $status;
        $data['proprietari'] = $this->amministratore_model->get_proprietari();
        $this->load->view('user/amministratore/nuovo_impianto', $data);
        $this->load->view('template/footer'); // footer loading
    }

    public function modifica_impianto($status = 0) {
        $this->load->view('template/header'); // navbar loading
        $this->load->view('user/amministratore/sidebar');
        // Retrieving all the 'Impianto'(s)
        $data['status'] = $status;
        $data['impianti'] = $this->amministratore_model->get_impianti();
        $this->load->view('user/amministratore/modifica_impianto', $data);
        $this->load->view('template/footer'); // footer loading
    }

    public function visualizza_eccezioni()
    {
        $this->load->view('template/header'); // navbar loading
        $this->load->view('user/amministratore/sidebar');
        $data['eccezioni'] = $this->amministratore_model->get_eccezioni();
        $this->load->view('user/amministratore/visualizza_eccezioni', $data);
        $this->load->view('template/footer'); // footer loading
    }

    public function perform_visualizza_eccezioni()
    {
        $this->amministratore_model->visualizza_eccezioni();
    }

    public function update_impianto($id, $status = 0) { // view
        $this->load->view('template/header'); // navbar loading
        $this->load->view('user/amministratore/sidebar');
        // ToDo: retrieve the impianto with given id
        $data['impianto'] = $this->amministratore_model->get_impianto($id);
        $data['status'] = $status;
        $this->load->view('user/amministratore/update_impianto', $data);
        $this->load->view('template/footer'); // footer loading
    }
    // --- END VIEWS SECTION

    public function aggiungi_impianto() {
        // validate form
        $sensor_fields = $this->input->post('field_number');

        $this->form_validation->set_rules('impianto', 'Nome impianto', 'required');
        $this->form_validation->set_rules('proprietario', 'Nome proprietario', 'required');

        for($i = 0; $i < $sensor_fields; $i++) {
            $this->form_validation->set_rules('sensore[sens'.$i.'][tipo_sensore]', 'Tipo sensore', 'required');
            $this->form_validation->set_rules('sensore[sens'.$i.'][marca_sensore]', 'Marca sensore', 'required');
        }
        if ($this->form_validation->run() === false) {
            $this->nuovo_impianto(-1);
        }
        else {
            $this->amministratore_model->set_impianto();
            $this->nuovo_impianto(1);
        }
    }

    // --- LOGIC

    public function update_nome_impianto() {
        if($this->amministratore_model->update_nome_impianto()=== false)
            $this->modifica_impianto(-1);
        else
            $this->modifica_impianto(1);
    }

    public function update_sensore($id, $id_impianto) {
        $this->load->view('template/header'); // navbar loading
        $this->load->view('user/amministratore/sidebar');
        // ToDo: retrieve the impianto with given id
        $data['sensore'] = $this->amministratore_model->get_sensore($id);
        $data['id_impianto'] = $id_impianto;
        $this->load->view('user/amministratore/update_sensore', $data);
        $this->load->view('template/footer'); // footer loading
    }

    public function perform_update_sensore() {
        if($this->amministratore_model->update_sensore()=== false)
            $this->update_impianto($this->input->post('id_impianto'),-1);
        else
            $this->update_impianto($this->input->post('id_impianto'), 1);
    }

    public function remove_impianto($id) {

        if($this->amministratore_model->remove_impianto($id)=== false)
            $this->modifica_impianto(-1);
        // redirect user to remove view
        else
            $this->modifica_impianto(1);


    }

    public function remove_sensore($id, $id_impianto) {

        if($this->amministratore_model->remove_sensore($id)=== false)
            $this->update_impianto($id_impianto, -1);
        else
            $this->update_impianto($id_impianto, 1);

    }

    public function perform_update_impianto() {
        $this->amministratore_model->update_nome_impianto(); // updating name

        // checking whether wee need to add sensors
        $sens0['tipo_sensore'] = $this->input->post('sensore[sens0][Tipo]');
        $sens0['marca_sensore'] = $this->input->post('sensore[sens0][Marca]');

        if(isset($sens0['tipo_sensore']) && isset($sens0['marca_sensore'])) {
            $this->amministratore_model->add_sensors();
        }

        $this->update_impianto($this->input->post('id_impianto'), 1);
    }


    public function carica_rilevazioni(){
        define("IDSENS_START", 0);
        define("IDSENS_LENGHT", 2);
        define("DATA1_START", 2);
        define("DATA1_LENGHT", 10);
        define("VALORE1_START", 12);
        define("VALORE1_LENGHT", 2);
        define("DATA2_START", 4);
        define("DATA2_LENGHT", 10);
        define("VALORE2_START", 2);
        define("VALORE2_LENGHT", 2);
        define("MESSAGGIO_START", 14);
        define("MESSAGGIO_LENGHT", 20);
        error_reporting(0);
        $file_name = 'http://martiamattino.altervista.org/rilevazioni.txt';
        if(file_exists($file_name)=== false) {
            //die("File not found");
        } else {
            $file = fopen($file_name, 'r');   // Also function executions errors are handle somehow
            while (feof($file) === false) {
                $riga = fgets($file);
                $stringa['idsens'] = substr($riga, IDSENS_START, IDSENS_LENGHT);
                if ((strcmp($stringa['idsens'], 89) === 0) || (strcmp($stringa['idsens'], 90) === 0)) {
                    $stringa['data'] = substr($riga, DATA1_START, DATA1_LENGHT);
                    $stringa['valore'] = substr($riga, VALORE1_START, VALORE1_LENGHT);
                }
                else {
                    $stringa['valore'] = substr($riga, VALORE2_START, VALORE2_LENGHT);
                    $stringa['data'] = substr($riga, DATA2_START, DATA2_LENGHT);
                }
                $stringa['messaggio'] = substr($riga, MESSAGGIO_START, MESSAGGIO_LENGHT);
                $this->amministratore_model->salva_rilevazioni($stringa);
            }
        }
        $this->index();
    }
}