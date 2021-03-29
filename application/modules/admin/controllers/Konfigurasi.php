<?php


defined('BASEPATH') or exit('No direct script access allowed');

class Konfigurasi extends CI_Controller
{

    public function index()
    {
        $konfigurasi = $this->Crud_model->listingOne('tbl_konfigurasi', 'id_konfigurasi', '1');
        $valid = $this->form_validation;
        $valid->set_rules('nama_aplikasi', 'Nama Aplikasi', 'required', array('required' => '%s tidak boleh kosong'));

        if ($valid->run() === FALSE) {
            $data = [
                'title'     => 'konfigurasi ',
                'back'      => 'barang/konfigurasi',
                'konfigurasi'    => $konfigurasi,
                'content'   => 'admin/konfigurasi/edit'
            ];
            $this->load->view('admin/layout/wrapper', $data, FALSE);
        } else {
            $i = $this->input;
            $data = [
                'nama_aplikasi'   => $i->post('nama_aplikasi'),
                'nama_pimpinan'   => $i->post('nama_pimpinan'),
                'kontak_person'   => $i->post('kontak_person'),
                'provinsi'   => $i->post('provinsi'),
                'kabupaten'   => $i->post('kabupaten'),
                'kecamatan'   => $i->post('kecamatan'),
                'alamat'   => $i->post('alamat')
            ];
            $this->Crud_model->edit('tbl_konfigurasi', 'id_konfigurasi', '1', $data);
            $this->session->set_flashdata('msg', 'Konfigurasi diubah');
            redirect('admin/konfigurasi');
        }
    }
}
