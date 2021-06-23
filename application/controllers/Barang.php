<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class Barang extends MY_Controller
{

    public function __construct()
    {
        parent::__construct();
        //Check if user is logged in or id exists in session
    }

    public function index()
    {
        $data['barang'] = $this->Main_model->select_record('barang'); //barang adalah nama tabel database
        $this->header('Data barang');
        $this->load->view('barang/data_barang', $data);
        $this->footer();
    }

    public function data_barang()
    {
        $data['item'] = $this->Main_model->item_cat();
        $data['item1'] = $this->Main_model->select_record('barang');
        $data['array_item'] = $this->Main_model->item_cat();

        // print_r($data['array_item']);
        // die;

        $this->header('Data barang');
        $this->load->view('barang/data_barang', $data);
        $this->footer();
    }

    public function tambah_barang()
    {
        $data['tampil'] = $this->Main_model->select('kategori');
        $this->header('Tambah Barang');

        $this->load->view('barang/tambah_barang', $data);

        $this->footer();
    }

    public function insert_barang()
    {
        $dt['tampil'] = $this->Main_model->select('kategori');

        // $data = array (
        //     'nama_barang'=>$this->input->post('nama_barang'),
        //     'merek'=>$this->input->post('merek'),
        //     'jumlah'=>$this->input->post('jumlah'),
        //     'gambar'=>$this->input->post('gambar'),
        //     'keterangan'=>$this->input->post('keterangan'),
        //     'id_kategori'=>$this->input->post('id_kategori')
        // );


        $this->form_validation->set_rules('nama_barang', 'Nama Barang', 'trim|required');
        $this->form_validation->set_rules('merek', 'Merek', 'trim|required');
        // $this->form_validation->set_rules('jumlah','Jumlah','numeric|required');
        $this->form_validation->set_rules('keterangan', 'Keterangan', 'trim|required');
        $this->form_validation->set_rules('id_kategori', 'Kategori', 'trim|required');

        if ($this->form_validation->run() == FALSE) {
            $this->header('Tambah Barang');
            $this->load->view('barang/tambah_barang');
            $this->footer();
        } else {
            // $response = $this->Main_model->save_record('barang',$data,$dt);
            // if ($response == TRUE) {
            // $this->session->set_flashdata('success','Data barang Berhasil Ditambahkan');
            // redirect(base_url().'barang/data_barang');
            // }

            $config['upload_path'] = './assets_user/img/';
            $config['allowed_types'] = 'jpg|png';
            $config['max_size'] = 2000;

            $this->load->library('upload', $config);

            $this->Main_model->insertData('gambar');
            $this->session->set_flashdata('success', 'Data barang Berhasil Ditambahkan');
            redirect('barang/data_barang');
        }
    }
    public function edit_barang($id_barang)
    {
        $data['item'] = $this->Main_model->item_cat();
        $data['result'] = $this->Main_model->getUserById_barang($id_barang);
        // $data['edit_barang'] = $this->Main_model->select('kategori');

        $data['edit_barang'] = $this->Main_model->single_record('barang', array('id_barang' => $id_barang));
        // $data['edit_barang1'] = $this->Main_model->lihat($id_barang)->row();
        $data['tampil'] = $this->Main_model->select('kategori');
        $this->header('Edit Barang');
        $this->load->view('Barang/edit_barang', $data);
        $this->footer();
    }


    public function update_barang($id)
    {

        //     $postData = $this->input->post();

        //     $data = array (
        //     'nama_barang'=>$postData['nama_barang'],
        //     'merek'=>$postData['merek'],
        //     'jumlah'=>$postData['jumlah'],
        //     'gambar'=>$postData['gambar'],
        //     'keterangan'=>$postData['keterangan'],
        //     'id_kategori'=>$postData['id_kategori'],
        //     // 'CREATED_USERID'=>$this->session->user_data('user_id'),
        // );

        //     $where = array('id_barang'=>$postData['id_barang']);
        //     $response = $this->Main_model->update_record('barang',$data, $where);
        //         if($response == TRUE){
        //             $this->session->set_flashdata('success','Data Barang berhasil diedit');
        //             redirect(base_url().'Barang/data_barang');
        //         } else {
        //             $this->session->set_flashdata('info','Nothing updated');
        //             redirect(base_url().'Barang/data_barang');
        //         }

        // $data['result'] = $this->Main_model->getUserById($id);


        //rules form_validation
        $this->form_validation->set_rules('nama_barang', 'Nama Barang', 'trim|required');
        $this->form_validation->set_rules('merek', 'Merek', 'trim|required');
        // $this->form_validation->set_rules('jumlah','Jumlah','numeric|required');
        $this->form_validation->set_rules('keterangan', 'Keterangan', 'trim|required');
        $this->form_validation->set_rules('id_kategori', 'Kategori', 'trim|required');

        //cek apakah data yang diinput sudah benar
        if ($this->form_validation->run()  == false) {
            $this->header('Edit Barang');
            $this->load->view('Barang/edit_barang', $data);
            $this->footer();
        }

        //jika data yang diinput sesuai dengan aturan
        else {
            $this->Main_model->updateData($id);
            $this->session->set_flashdata('success', 'Data barang Berhasil Ditambahkan');
            redirect('barang/data_barang');
        }
    }

    public function hapus_barang($id)
    {
        $response = $this->Main_model->delete_record('barang', 'id_barang', $id);
        if ($response == TRUE) {
            $this->session->set_flashdata('success', "Record delection successfool");
            redirect(base_url() . 'Barang/data_barang');
        } else {
            $this->session->set_flashdata('error', "Something Went Wrong");
            redirect(base_url() . 'Barang/data_barang');
        }
    }

    public function generate_qrcode($id)
    {
        $kodenya = "http://localhost/inventori_kelompok5/Barang/detail_barang/" . $id;

        //render qrcode dengan format PNG
        QRcode::png(
            $kodenya,
            $outfile = false,
            $level = QR_ECLEVEL_H,
            $size = 5,
            $margin = 2
        );
    }
    public function detail_barang($id)
    {
        $data['brgDetail'] = $this->Main_model->get_detail_barang($id);

        $this->header('Detail Barang');
        $this->load->view('barang/detail_barang', $data);
        $this->footer();
    }
}
