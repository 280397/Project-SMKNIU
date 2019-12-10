<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Auth extends CI_Controller
{
  public function __construct()
  {
    parent::__construct();
    $this->load->library('form_validation');
  }

  // login
  public function index()
  {

    // jika terdapat session (login), user tidak bisa mengakses controller auth atau login
    if ($this->session->userdata('username')) {
      redirect('user');
    }

    $this->form_validation->set_rules('username', 'Username', 'trim|required');
    $this->form_validation->set_rules('password', 'Password', 'trim|required');
    if ($this->form_validation->run() == false) {
      $data['title'] = 'Login User';
      $data['title2'] = 'SMKN IHYA ULUMUDIN INVENTORY SYSTEM';
      $this->load->view('templates/auth_header', $data);
      $this->load->view('auth/login');
      $this->load->view('templates/auth_footer');
    } else {
      // validasi sukses
      $this->_login();
    }
  }

  private function _login()
  {
    $username = $this->input->post('username');
    $password = $this->input->post('password');

    // query database
    $user = $this->db->get_where('user', ['username' => $username])->row_array();

    // jika usernya ada
    if ($user) {
      // jika user aktif
      if ($user['is_active'] == 1) {
        // cek password
        if (password_verify($password, $user['password'])) {
          $data = [
            'username' => $user['username'],
            'role_id' => $user['role_id']
          ];
          $this->session->set_userdata($data);
          if ($user['role_id'] == 1) {
            redirect('user/dashboard');
          } else {
            redirect('user');
          }
        } else {
          $this->session->set_flashdata('message', '<div class="alert alert-danger" role="alert">Wrong password!</div>');
          redirect('auth');
        }
      } else {
        $this->session->set_flashdata('message', '<div class="alert alert-danger" role="alert">This username has not been activated!
        Please contact the administrator!</div>');
        redirect('auth');
      }
    } else {
      $this->session->set_flashdata('message', '<div class="alert alert-danger" role="alert">Username is not registered!</div>');
      redirect('auth');
    }
  }

  // registration



  public function logout()
  {
    $this->session->unset_userdata('username');
    $this->session->unset_userdata('role_id');
    $this->session->set_flashdata('message', '<div class="alert alert-success" role="aler">You have been logged  out!</div>');
    redirect('auth');
  }
  public function blocked()
  {
    $this->load->view('auth/blocked');
  }
}
