 <?php if (!defined('BASEPATH')) exit('No direct script access allowed');

    class Main extends CI_Controller
    {

        function __construct()
        {
            parent::__construct();

            /* Standard Libraries of codeigniter are required */
            $this->load->database();
            $this->load->helper('url');
            /* ------------------ */

            $this->load->library('grocery_CRUD');
        }

        public function index()
        {
            $crud = new grocery_CRUD();
            $this->grocery_crud->set_theme('tablestrap');
            $this->grocery_crud->set_table('karyawan');
            $output = $this->grocery_crud->render();
            echo "<pre>";
            print_r($output);
            echo "</pre>";
            die();
            // $data['output'] = $output;

            // $this->_base_output($data);
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
