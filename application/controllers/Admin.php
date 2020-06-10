<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Admin extends CI_Controller
{

	public function __construct()
	{
		parent::__construct();
		$this->load->model('Admin_model');
		$this->load->library('form_validation');
		$this->load->helper('form');

		// blok akses url
		if (!$this->session->userdata('username')) {
			redirect('auth');
		} else {
			$role_id = $this->session->userdata('role_id');
			$menu = $this->uri->segment(1);

			$queryMenu = $this->db->get_where('user_menu', ['menu' => $menu])->row_array();
			$menu_id = $queryMenu['id'];

			$userAccess = $this->db->get_where('user_access_menu', [
				'role_id' => $role_id,
				'menu_id' => $menu_id
			]);

			if ($userAccess->num_rows() < 1) {
				redirect('auth/blocked');
			}
		}
		// is_logged_in();
	}
	// function kelola user
	public function KelolaUser()
	{
		$data['title'] = 'Kelola User';
		$dataa['user'] = $this->db->get_where('user', ['username' => $this->session->userdata('username')])->row_array();
		// $this->load->model('Admin_model', 'user');

		// query data menu
		$data['row'] = $this->Admin_model->getUser();

		$this->load->view('templates/header', $data);
		$this->load->view('templates/topbar', $dataa);
		$this->load->view('templates/sidebar', $data);
		$this->load->view('templates/breadcumb', $data);
		$this->load->view('admin/kelolauser', $data);
		$this->load->view('templates/footer');
	}


	public function Adduser()
	{
		$data['title'] = 'Tambah User Inventaris';
		$data['user'] = $this->db->get_where('user', ['username' => $this->session->userdata('username')])->row_array();


		// jika terdapat session (login), user tidak bisa mengakses controller auth atau login
		// if ($this->session->userdata('username')) {
		//     redirect('user');
		// }

		//rules
		$this->form_validation->set_rules('name', 'Name', 'required|trim');
		$this->form_validation->set_rules('username', 'username', 'required|trim');
		$this->form_validation->set_rules('password1', 'Password', 'required|trim|min_length[4]|matches[password2]', [
			'matches' => 'Password dont match!',
			'min_length' => 'Password too short!'
		]);
		$this->form_validation->set_rules('password2', 'Password', 'required|trim|matches[password1]');

		if ($this->form_validation->run() == false) {

			$this->load->view('templates/header', $data);
			$this->load->view('templates/topbar', $data);
			$this->load->view('templates/sidebar', $data);
			$this->load->view('templates/breadcumb', $data);
			$this->load->view('auth/registration', $data);
			$this->load->view('templates/footer');
		} else {
			// menyiapkan data
			$username = $this->input->post('username', true);
			$data = [
				'name' => htmlspecialchars($this->input->post('name', true)),
				'id_admin' => htmlspecialchars($this->input->post('id_admin', true)),
				'username' => htmlspecialchars($username),
				'image' => 'default.png',
				'password' => password_hash($this->input->post('password1'), PASSWORD_DEFAULT),
				'role_id' => 2,
				'is_active' => 1,
				'date_created' => time()
			];


			//insert data ke database
			$this->db->insert('user', $data);

			//pesan sebelum rediect
			$this->session->set_flashdata('messageuser', '<div class="alert alert-success" role="aler">Congratulation! Account has been created!</div>');
			redirect('admin/kelolauser');
		}
	}


	// function edit user
	public function edit($id)
	{
		$dataa['user'] = $this->db->get_where('user', ['username' => $this->session->userdata('username')])->row_array();

		$query = $this->Admin_model->getId($id);

		if ($query->num_rows() > 0) {
			$user = $query->row();
			$role = $this->Admin_model->getIdRole();
			$active = $this->Admin_model->getIdActive();
			$data = array(
				'title' => 'Edit User',
				'page' => 'edit',
				'row' => $user,
				'role' => $role,
				'active' => $active
			);

			$this->load->view('templates/header', $data);
			$this->load->view('templates/topbar', $dataa);
			$this->load->view('templates/sidebar', $dataa);
			$this->load->view('templates/breadcumb', $data);
			$this->load->view('admin/edit', $data);
			$this->load->view('templates/footer');
		} else {
			$this->session->set_flashdata('message', '<div class="alert alert-danger" role="alert">Data tidak ditemukan!</div>');
			redirect('barang');
		}
	}


	// prosess edit user
	// public function process()
	// {
	// 	$post = $this->input->post(null, true);
	// 	if (isset($_POST['add'])) {
	// 		$this->Admin_model->add($post);
	// 	} else if (isset($_POST['edit'])) {
	// 		$this->Admin_model->edit($post);
	// 	}
	// 	if ($this->db->affected_rows() > 0) {
	// 		$this->session->set_flashdata('message', '<div class="alert alert-success" role="alert">Data berhasil disimpan!</div>');
	// 	}

	// 	redirect('admin/kelolauser');
	// }

	public function process()
	{
		$post = $this->input->post(null, true);
		if (isset($_POST['add'])) {
            if ($this->Admin_model->check_id($post['id_admin'])->num_rows() > 0) {
                $this->session->set_flashdata('error', "ID $post[id_admin] sudah dipakai admin lain");
                redirect('Admin/adduser');
            } else {               
                    $this->Admin_model->add($post);
                    if ($this->db->affected_rows() > 0) {
                        $this->session->set_flashdata('message', '<div class="alert alert-success" role="alert">Data berhasil disimpan!</div>');
                    }
                    redirect('Admin/KelolaUser');
                
            }
 
            // edit proses
        } else if (isset($_POST['edit'])) {
// 			if ($this->Admin_model->check_id($post['id_admin'])->num_rows() > 0) {
//                 $this->session->set_flashdata('error', "ID $post[id_admin] sudah dipakai admin lain");
//                 redirect('Admin/edit/' . $post['id']);
//             } else {
                
//                     $this->Admin_model->edit($post);
//                     if ($this->db->affected_rows() > 0) {
//                         $this->session->set_flashdata('message', '<div class="alert alert-success" role="alert">Data berhasil disimpan!</div>');
//                     }
//                     redirect('Admin/KelolaUser');
               
//             }
            $this->Admin_model->edit($post);
             $this->session->set_flashdata('message', '<div class="alert alert-success" role="alert">Data berhasil disimpan!</div>');
            redirect('Admin/KelolaUser');
        }

		
	}



	// hapus user
	public function hapususer($id)
	{
		$this->load->model('Admin_model');
		$this->Admin_model->hapusUser($id);
		$this->session->set_flashdata('flash', 'Dihapus');
		redirect('admin/kelolauser');
	}


	// function role
	public function role()
	{
		// ambil data user pada session
		$data['title'] = 'Role';
		$data['user'] = $this->db->get_where('user', ['username' => $this->session->userdata('username')])->row_array();

		$data['role'] = $this->db->get('user_role')->result_array();

		$this->load->view('templates/header', $data);
		$this->load->view('templates/topbar', $data);
		$this->load->view('templates/sidebar', $data);
		$this->load->view('templates/breadcumb', $data);
		$this->load->view('admin/role', $data);
		$this->load->view('templates/footer');
	}

	public function roleAccess($role_id)
	{
		// ambil data user pada session
		$data['title'] = 'Role Access';
		$data['user'] = $this->db->get_where('user', ['username' => $this->session->userdata('username')])->row_array();

		$data['role'] = $this->db->get_where('user_role', ['id' => $role_id])->row_array();

		$this->db->where('id !=', 1);
		$data['menu'] = $this->db->get('user_menu')->result_array();

		$this->load->view('templates/header', $data);
		$this->load->view('templates/topbar', $data);
		$this->load->view('templates/sidebar', $data);
		$this->load->view('templates/breadcumb', $data);
		$this->load->view('admin/role-access', $data);
		$this->load->view('templates/footer');
	}

	// method change access dari ajax file view/admin/role-access.php
	public function changeaccess()
	{
		$menu_id = $this->input->post('menuId');
		$role_id = $this->input->post('roleId');

		$data = [
			'role_id' => $role_id,
			'menu_id' => $menu_id
		];

		$result = $this->db->get_where('user_access_menu', $data);

		if ($result->num_rows() < 1) {
			$this->db->insert('user_access_menu', $data);
		} else {
			$this->db->delete('user_access_menu', $data);
		}

		$this->session->set_flashdata('message', '<div class="alert alert-success" role"alert">Access Changed!</div>');
	}



	function barcode_qrcode($id)
    {
        $data['titl'] = 'Generator';
        $data['title'] = 'Barcode Generator';
        $data['title1'] = 'QR-Code Generator';
        $data['user'] = $this->db->get_where('user', ['username' => $this->session->userdata('username')])->row_array();

        // query data menu
        $dataa['row'] = $this->Admin_model->getId($id)->row();

        $this->load->view('templates/header', $data);
        $this->load->view('templates/topbar', $data);
        $this->load->view('templates/sidebar', $data);
        $this->load->view('templates/breadcumb', $data);
        $this->load->view('admin/barcode_qrcode', $dataa);
        $this->load->view('templates/footer');
    }

    function barcode_print($id)
    {
        $data['row'] = $this->Admin_model->getId($id)->row();
        $html  = $this->load->view('admin/barcode_print', $data, true);
        $this->fungsi->PdfGenerator($html, 'ID-' . $data['row']->id_admin, 'A4', 'landscape');
    }
    // function qrcode_print($id)
    // {
    //     $data['row'] = $this->Admin_model->getId($id)->row();
    //     $html  = $this->load->view('admin/qrcode_print', $data, true);
    //     $this->fungsi->PdfGenerator($html, 'ID-' . $data['row']->barcode, 'A4', 'potrait');
    // }
   
}
