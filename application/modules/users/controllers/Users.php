<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Users extends CI_Controller
{
   public function __construct()
    {
        parent::__construct();
        if (!$this->ion_auth->logged_in()) {//cek login ga?
            redirect('login','refresh');
        }else{
            if (!$this->ion_auth->in_group('admin')) {//cek admin ga?
                redirect('login','refresh');
            }
        }
        $this->load->model('modeluser','user');
        $this->load->library('form_validation');
        $this->load->helper(array('url', 'language'));
    }

    public function index()
    {
        $q = urldecode($this->input->get('q', TRUE));
        $start = intval($this->input->get('start'));

        if ($q <> '') {
            $config['base_url'] = base_url() . 'users/index.html?q=' . urlencode($q);
            $config['first_url'] = base_url() . 'users/index.html?q=' . urlencode($q);
        } else {
            $config['base_url'] = base_url() . 'users/index.html';
            $config['first_url'] = base_url() . 'users/index.html';
        }

        $config['per_page'] = 10;
        $config['page_query_string'] = TRUE;
        $config['total_rows'] = $this->user->total_rows($q);
        $user = $this->user->get_limit_data($config['per_page'], $start, $q);

        $this->load->library('pagination');
        $this->pagination->initialize($config);

        $data = array(
            'user_data' => $user,
            'q' => $q,
            'pagination' => $this->pagination->create_links(),
            'total_rows' => $config['total_rows'],
            'start' => $start,
        );
        $data['aktif']		='User';
    		$data['judul_menu'] ='User';
    		$data['sub_judul']	='User List';
        $this->load->view('user/users',$data);
    }

    public function create()
    {
        $data['aktif']		='User';
        $data['judul_menu'] ='User';
        $data['sub_judul']	='Add User';
        $this->load->view('user/table_user_form', $data);
    }

    public function ajax_list()
    {
        $list = $this->user->get_datatables();
        $data = array();
        $no = $_POST['start'];
        foreach ($list as $rows) {
            $no++;
            $row = array();
            $row[] = $rows->first_name;
            $row[] = $rows->last_name;
            $row[] = $rows->username;
            $row[] = $rows->company;
            $row[] = $rows->phone;
            $row[] = $rows->email;
            $row[] = $rows->status;
            $row[] = $rows->active;

            $row[] = '<ul class="icons-list">
                        <li class="dropdown">
                        <a href="javascript:void(0)" title="aksi" href="#" class="dropdown-toggle" data-toggle="dropdown">
                             <i class="icon-menu9"></i>
                        </a>

                        <ul class="dropdown-menu dropdown-menu-right">
                            <li><a href="users/auth/edit_user/'."".$rows->id."".'"><i class="icon-pencil7 text-info"></i> Change </a></li>
                            <li><a href="users/auth/activate/'."".$rows->id."".'"><i class=" icon-switch2 text-success"></i> Activate </a></li>
                            <li><a href="users/auth/deactivate/'."".$rows->id."".'" ><i class="icon-warning2 text-warning"></i> Deactivate </a></li>

                        </ul>
                    </li>
                </ul>';

            $data[] = $row;
        }

        $output = array(
                        "draw" => $_POST['draw'],
                        "recordsTotal" => $this->user->count_all(),
                        "recordsFiltered" => $this->user->count_filtered(),
                        "data" => $data,
                );
        //output to json format
        echo json_encode($output);
    }

    public function ajax_edit($id)
    {
        $data = $this->user->get_by_id($id);
        echo json_encode($data);
    }

    public function ajax_delete()
    {
        $this->input->post('id');
        $this->user->delete_by_id($id);
        echo json_encode(array("status" => TRUE));
    }
    public function ajax_bulk_delete()
    {
        $list_id = $this->input->post('id');
        foreach ($list_id as $id) {
            $this->user->delete_by_id($id);
        }
        echo json_encode(array("status" => TRUE));
    }



}
