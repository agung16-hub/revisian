<?php

class Nota extends CI_Controller
{
    public function __construct()
    {
        parent::__construct();
        if ($this->session->userdata('logged_in') != true) {
            redirect(base_url('Login'));
        }
        $this->load->model('M_user');
        $this->load->library('cart');
    }
    public function index()
    {
        $total = ($this->M_user->total_record('dummy') / 3);
        $data['nota'] = [];
        for ($i = 0; $i < $total; $i++) {
            $data['nota'][] = $data['dummy'] = $this->M_user->user_limit('3', $i * 3);
        }
        return $data['nota'];
    }
    public function halo()
    {
        $nota = $this->index();
        echo '<pre>';
        print_r($nota);
    }
    public function pembagian_nota($id)
    {
        $total = ($this->M_user->total_row('detail_penjualan', ['kode_penjualan' => $id]) / 3);
        $halaman = [];
        for ($i = 0; $i < $total; $i++) {
            $halaman[] = $data['halaman'] = $this->M_user->bagi('3', $i * 3, ['kode_penjualan' => $id]);
        }
        return $halaman;
    }
    function print($id)
    {
        $data['penjualan'] = $this->M_user->getwhere('penjualan', ['kode_penjualan' => $id]);
        $data['detail'] = $this->M_user->getjoinfilter('detail_penjualan', 'barang', 'detail_penjualan.kode_barang=barang.kode_barang', ['kode_penjualan' => $id]);
        $this->load->view('nota', $data);
    }
    public function cetak($id)
    {
        $data['penjualan'] = $this->M_user->getwhere('penjualan', ['kode_penjualan' => $id]);
        $data['detail'] = $this->pembagian_nota($id);
        $data['halaman'] = ($this->M_user->total_row('detail_penjualan', ['kode_penjualan' => $id]) / 3);
        $this->load->view('nota1', $data);
    }
}
