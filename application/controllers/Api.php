<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Api extends CI_Controller {

    public function __construct() {
        parent::__construct();
        // Load database
        $this->load->database();
    }

    /**
     * Get regulations for company_id 21
     * URL: /api/regulations
     */
    public function regulations() {
        // Allow from any origin
        header('Access-Control-Allow-Origin: *');
        header("Access-Control-Allow-Methods: GET, POST, OPTIONS");
        header("Access-Control-Allow-Headers: Content-Type, Content-Length, Accept-Encoding");

        try {
            // We use query builder directly
            $query = $this->db->get_where('regulations', array('company_id' => 21));
            
            if (!$query) {
                throw new Exception('Database error');
            }

            $data = $query->result();

            return $this->output
                ->set_content_type('application/json')
                ->set_status_header(200)
                ->set_output(json_encode(array(
                    'status' => 'success',
                    'count' => count($data),
                    'data' => $data
                )));
        } catch (Exception $e) {
            return $this->output
                ->set_content_type('application/json')
                ->set_status_header(500)
                ->set_output(json_encode(array(
                    'status' => 'error',
                    'message' => $e->getMessage()
                )));
        }
    }
}
