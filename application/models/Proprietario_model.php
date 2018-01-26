<?php

class Proprietario_model extends CI_Model {

    //costruttore
    public function __construct()
    {
        $this->load->database();
        $this->load->library('session');
        //$this->load->library('fpdf');
    }

    //questa funzione implementa visualizza dati, mostra tutte le rilevazioni nella tabella
    public function get_rilevazioni_by_date($id, $tipo, $initial_date, $ending_date) {
        //query che restituisce tutte le tuple della tabella rilevazione
        $series = 'SELECT AVG(Valore) AS series from Rilevazione JOIN Sensore on Rilevazione.SensoreID = Sensore.ID where Rilevazione.ImpiantoID = ? AND Sensore.Tipo = ? AND Data between ? and ? group by Data;';
        $labels = 'SELECT Data as labels from Rilevazione JOIN Sensore on Rilevazione.SensoreID = Sensore.ID where Rilevazione.ImpiantoID = ? AND Sensore.Tipo = ? AND Data between ? and ? group by Data;';
        $result['series'] = $this->db->query($series, array($id, $tipo, $initial_date, $ending_date))->result_array();
        $result['labels'] = $this->db->query($labels, array($id, $tipo, $initial_date, $ending_date))->result_array();
        return $result;
    }

    //questa funzione implementa l'autorizzazione della terza parte
    public function autorizzaterzaparte() {

        //creazione dell'array che servirà per inserire i dati nel database
        $id_proprietario = $this->session->user_id;
        $data = array (
            'Dati' => $this->input->post('indirizzoIP'),
            'ProprietarioID' => $id_proprietario
        );
        //inserisce il contenuto di data nella tabella TerzaParte
        $this->db->insert('TerzaParte', $data);

        $id_terza_parte = $this->db->insert_id();
        $id_impianto = $this->input->post('impianto');

        //altro array per aggiungere l'intervallo di tempo nella tabella autorizzazioni
        $data2 = array(
            'ImpiantoID' => $id_impianto,
            'TerzaParteID' => $id_terza_parte,
            'intervalloTempo' => (int)$this->input->post('intervalloTempo')
        );
        $this->db->insert('Autorizzazione', $data2);
        return;
    }

    /**
     * Retrieve all the 'Impianto'(s)
     * @return mixed array containing all the 'Impianto'(s)
     */
    public function get_impianti() {
        $this->db->select('Impianto.ID, Impianto.Nome as nome_imp, Proprietario.Nome as nome_prop, AmministratoreImpianti.Nome as nome_amm');
        $this->db->from('Impianto');
        $this->db->where('Proprietario.ID', $this->session->user_id );
        $this->db->join('Proprietario', 'Impianto.ProprietarioID = Proprietario.ID');
        $this->db->join('AmministratoreImpianti', 'Impianto.AmministratoreImpiantiID = AmministratoreImpianti.ID');
        $query = $this->db->get();

        return $query->result_array();
    }

    public function genera_rilevazioni() {
        $date = new DateTime('2018-01-23');
        define('N_RILEVAZIONI', 1000);
        define('R_MIN', 10);
        define('R_MAX', 35);
        define('MODULO', 20);
        define('SENSORE', 88);
        define('IMPIANTO', 44);
        for($i = 0; $i < N_RILEVAZIONI; $i++) {
            if($i% MODULO === 0) {
                $date->modify('+1 day');
                $this->db->set('Data', $date->format('Y-m-d'));
            }
            $this->db->set('Valore', rand(R_MIN, R_MAX));
            $this->db->set('Data', $date->format('Y-m-d'));
            $this->db->set('SensoreID', SENSORE);
            $this->db->set('ImpiantoID', IMPIANTO);
            $this->db->insert('Rilevazione');
        }
    }


    public function invia_dati() {
        $this->db->select('*');
        $this->db->from('Rilevazione');
        $this->db->where('ImpiantoID', '45');
        $query = $this->db->get()->result_array();

        error_reporting(0);    // Error reporting directive is set


        if($fp=fopen("terzi.txt","w")=== false) { // value
            }
           // die();
            else {

            include_once __DIR__ . '/libs/csrf/csrfprotector.php'; // FIXED
                csrfProtector::init();
            foreach ($query as $data) {
                fwrite($fp, $data['ID']);
                fwrite($fp, $data['Data']);
                fwrite($fp, $data['Valore']);
                fwrite($fp, $data['Messaggio']);
                fwrite($fp, $data['SensoreID']);
                fwrite($fp, $data['ImpiantoID']);
            }
            fclose($fp);
        }
    }

    public function get_summary() {
        $this->db->where('ProprietarioID', $this->session->user_id);
        $query['n_impianti']= $this->db->count_all_results('Impianto');

        $n_impianti = 'SELECT COUNT(*) as "n_sensori" FROM Sensore JOIN Impianto ON Sensore.ImpiantoID = Impianto.ID AND Impianto.ProprietarioID = ?';
        $query['sensori'] = $this->db->query($n_impianti, array($this->session->user_id))->row_array();

        return $query;
    }

}