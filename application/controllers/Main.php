 <?php if (!defined('BASEPATH')) exit('No direct script access allowed');

    class Main extends CI_Controller
    {

        function __construct()
        {
            parent::__construct();
            if (!$this->session->userdata('id')) {
                redirect('login');
            }
            $this->load->library('encrypt');
            $this->load->library('form_validation');
            /* Standard Libraries of codeigniter are required */
            $this->load->database();
            $this->load->helper('url');
            /* ------------------ */

            $this->load->library('grocery_CRUD');
        }

        public function index()
        {
            // $this->grocery_crud->set_theme('tablestrap');
            $this->grocery_crud->set_table('karyawan');
            $this->grocery_crud->set_relation('kd_sertifikasi', 'sertifikasi', 'keterangan');
            $this->grocery_crud->set_relation('kd_posisi', 'posisi', '{nama} - {keterangan}');
            $this->grocery_crud->set_field_upload('foto', 'assets/uploads/files');
            $output = $this->grocery_crud->render();
            // echo "<pre>";
            // print_r($output);
            // echo "</pre>";
            // die();
            $data['output'] = $output;
            $data['title'] = "Karyawan";

            $this->_base_output($data);
        }

        public function karyawan()
        {
            // $this->grocery_crud->set_theme('tablestrap');
            $this->grocery_crud->set_table('karyawan');
            $this->grocery_crud->set_relation('kd_sertifikasi', 'sertifikasi', 'keterangan');
            $this->grocery_crud->set_relation('kd_posisi', 'posisi', '{nama} - {keterangan}');
            $output = $this->grocery_crud->render();
            // echo "<pre>";
            // print_r($output);
            // echo "</pre>";
            // die();
            $data['output'] = $output;
            $data['title'] = "Karyawan";

            $this->_base_output($data);
        }

        public function absensi()
        {
            // $this->grocery_crud->set_theme('tablestrap');
            $this->grocery_crud->set_table('absensi');
            $this->grocery_crud->set_relation('nik', 'karyawan', 'nama');
            $output = $this->grocery_crud->render();
            $data['output'] = $output;
            $data['title'] = "Absensi";

            $this->_base_output($data);
        }
        public function gaji()
        {
            // $this->grocery_crud->set_theme('tablestrap');
            $this->grocery_crud->set_table('gaji');
            $this->grocery_crud->set_relation('nik', 'karyawan', 'nama');
            $output = $this->grocery_crud->render();
            $data['output'] = $output;
            $data['title'] = "Gaji";

            $this->_base_output($data);
        }

        public function kriteria_nilai()
        {
            // $this->grocery_crud->set_theme('tablestrap');
            $this->grocery_crud->set_table('kriteria_nilai');
            $output = $this->grocery_crud->render();
            $data['output'] = $output;
            $data['title'] = "Kriteria Nilai";

            $this->_base_output($data);
        }

        public function kriteria_pelamar()
        {
            // $this->grocery_crud->set_theme('tablestrap');
            $this->grocery_crud->set_table('kriteria_pelamar');
            $this->grocery_crud->set_relation('kd_posisi', 'posisi', '{nama} - {keterangan}');
            $output = $this->grocery_crud->render();
            $data['output'] = $output;
            $data['title'] = "Kriteria Pelamar";

            $this->_base_output($data);
        }

        public function nilai()
        {
            // $this->grocery_crud->set_theme('tablestrap');
            $this->grocery_crud->set_table('nilai');
            $this->grocery_crud->set_relation('nik', 'karyawan', 'nama');
            $this->grocery_crud->set_relation('kd_kriteria_nilai', 'kriteria_nilai', 'keterangan');
            $output = $this->grocery_crud->render();
            $data['output'] = $output;
            $data['title'] = "Nilai";

            $this->_base_output($data);
        }

        public function pelamar()
        {
            // $this->grocery_crud->set_theme('tablestrap');
            $this->grocery_crud->set_table('pelamar');
            $output = $this->grocery_crud->render();
            $data['output'] = $output;
            $data['title'] = "Pelamar";

            $this->_base_output($data);
        }

        public function posisi()
        {
            // $this->grocery_crud->set_theme('tablestrap');
            $this->grocery_crud->set_table('posisi');
            $output = $this->grocery_crud->render();
            $data['output'] = $output;
            $data['title'] = "Posisi";

            $this->_base_output($data);
        }

        public function sertifikasi()
        {
            // $this->grocery_crud->set_theme('tablestrap');
            $this->grocery_crud->set_table('sertifikasi');
            $output = $this->grocery_crud->render();
            $data['output'] = $output;
            $data['title'] = "Sertifikasi";

            $this->_base_output($data);
        }

        public function tes()
        {
            // $this->grocery_crud->set_theme('tablestrap');
            $this->grocery_crud->set_table('tes');
            $output = $this->grocery_crud->render();
            $data['output'] = $output;
            $data['title'] = "Tes";

            $this->_base_output($data);
        }

        function logout()
        {
            $data = $this->session->all_userdata();
            foreach ($data as $row => $rows_value) {
                $this->session->unset_userdata($row);
            }
            redirect('login');
        }

        public function employees()
        {
            $crud = new grocery_CRUD();
            $crud->set_table('employees');
            $output = $this->grocery_crud->render();

            $this->_base_output($output);
        }

        function _base_output($output = null)

        {
            $this->load->view('main.php', $output);
        }
    }
  
 /* End of file Main.php */
 /* Location: ./application/controllers/Main.php */
