<?php


class penempatan extends MY_Controller
{

  public function __construct()
  {
    parent::__construct();
  }

  public function index()
  {
    $data['penempatan'] = $this->Main_model->get_penempatan(); //penempatan adalah nama tabel database
    $this->header('Data penempatan');
    $this->load->view('penempatan/data_penempatan', $data);
    $this->footer();
  }

  public function data_penempatan()
  {
    $data['sig'] = $this->Main_model->get_sig($this->session->userdata('id'));
    $data['penempatan'] = $this->Main_model->get_penempatan();   //penempatan join
    $this->header('Data penempatan');
    $this->load->view('penempatan/data_penempatan', $data);
    $this->footer();
  }

  public function tambah_penempatan()
  {
    $data['lokasi'] = $this->Main_model->select_record('lokasi');
    $data['pegawai'] = $this->Main_model->select_record('pegawai');
    $data['barang'] = $this->Main_model->select_record('barang');

    $this->header('Tambah penempatan');
    $this->load->view('penempatan/tambah_penempatan', $data);
    $this->footer();
  }


  public function insert_penempatan()
  {
    $user_id = $this->session->userdata('user_id');

    //generate untuk id_penempatan dengan MSK + tanggal + jlh row data penempatan 
    $back = $this->db->get('penempatan')->num_rows() + 1;
    $id_penempatan = 'KLR-' . date('ymd') . $back;

    //data untuk ke tabel penempatan
    $data = array(
      'id_penempatan' => $id_penempatan,
      'tgl_permintaan_penempatan' => $this->input->post('date'),
      'id_lokasi' => $this->input->post('id_lokasi'),
      'USER_ID' => $user_id,
      'pegawai_penanggung_jawab' =>  $this->input->post('EMP_ID'),
      'status' => 0,
    );



    //data untuk ke tabel permintaan_item berupa array (karena multiple input)
    $id_barang = $_POST['id_barang'];
    $jumlah = $_POST['jumlah'];
    $id_lokasi = $this->input->post('id_lokasi');

    $data_item = array();
    for ($index = 0; $index < count($id_barang) - 1; $index++) { // Kita buat perulangan berdasarkan id_barang sampai data terakhir
      array_push($data_item, array(
        'id_penempatan' => $id_penempatan,
        'id_barang' => $id_barang[$index], //mengubah array menjadi string
        'jumlah' => $jumlah[$index],  // Ambil dan set data nama sesuai index array dari $index
        'id_lokasi' => $id_lokasi
      ));
    }

    //simpan ke tabel penempatan
    $response = $this->Main_model->save_record('penempatan', $data);

    //simpan ke tabel permintaan_item
    $sql = $this->Main_model->save_batch_permintaan_penempatan($data_item);


    if ($response == TRUE) {

      if ($sql == TRUE) { // Jika sukses
        $this->session->set_flashdata('success', 'Data penempatan Berhasil Ditambahkan');
        redirect(base_url() . 'Penempatan/data_penempatan');
      } else { // Jika gagal
        $this->session->set_flashdata('alert', 'Data penempatan Gagal Ditambahkan');
        redirect(base_url() . 'Penempatan/data_penempatan');
      }
    }
  }

  public function hapus_penempatan($id)
  {
    $response = $this->Main_model->delete_penempatan($id);
    $this->session->set_flashdata('warning', 'Data penempatan Berhasil Dihapus');
    redirect(base_url() . 'Penempatan/data_penempatan');
  }

  public function detail_penempatan($id)
  {
    //mengambil detail penempatan
    $data['detail_penempatan'] = $this->Main_model->get_detail_penempatan($id);
    //mengambil semua data barang dengan id_penempatan yang sama
    $data['barang'] = $this->Main_model->get_detail_penempatan_item($id);
    $data['pegawai'] = $this->Main_model->select_record('pegawai');

    $this->header('Detail Pengadaan Barang');
    $this->load->view('penempatan/detail_penempatan', $data);
    $this->footer();
  }

  public function selesaikan_penempatan($id)
  {
    $diselesaikan_oleh = $this->session->userdata('user_id');
    $_diselesaikan = 1;
    $data = array(
      'diselesaikan_oleh' => $diselesaikan_oleh,
      '_diselesaikan' => $_diselesaikan,
      'tgl_ditempatkan' => date("Y-m-d H:i:s"),

    );

    // tabel penempatan di update
    $where = array('id_penempatan' => $id);
    $response = $this->Main_model->update_record('penempatan', $data, $where);

    // row tabel permintan_penempatan_item masuk ke tabel keluar_item
    $this->Main_model->insert_keluar_item($id);
    if ($response == TRUE) {
      $this->session->set_flashdata('success', "Penempatan ini sudah diselesaikan! Data barang telah diupdate");
      redirect(base_url() . 'penempatan/data_penempatan');
    } else {
      $this->session->set_flashdata('error', "Something went wrong");
    }
    redirect(base_url() . 'penempatan/data_penempatan');
  }

  public function print_penempatan($id)
  {
    //mengambil detail penempatan
    $data['detail_penempatan'] = $this->Main_model->get_detail_penempatan($id);
    // $data['detail_aset_inventaris'] = $this->Main_model->get_detail_keluar_item_by_id($id);
    //mengambil semua data barang dengan id_penempatan yang sama
    $data['barang'] = $this->Main_model->get_detail_penempatan_item($id);
    $data['pegawai'] = $this->Main_model->select_record('pegawai');

    $this->header('Detail Pengadaan Barang');
    $this->load->view('penempatan/print_penempatan', $data);
    $this->footer();
  }


  public function aset_inventaris()
  {
    $data['keluar_item'] = $this->Main_model->get_detail_keluar_item();

    $this->header('Data Aset Inventaris');
    $this->load->view('penempatan/aset_inventaris', $data);
    $this->footer();
  }

  public function detail_aset_inventaris($id)
  {
    //mengambil detail aset_inventaris
    $data['detail_aset_inventaris'] = $this->Main_model->get_detail_keluar_item_by_id($id);
    //mengambil semua data barang dengan id_aset_inventaris yang sama
    $data['barang'] = $this->Main_model->get_detail_penempatan_item($id);
    $data['pegawai'] = $this->Main_model->select_record('pegawai');
    $this->header('Detail Pengadaan Barang');
    $this->load->view('penempatan/detail_aset_inventaris', $data);
    $this->footer();
  }

  public function generate_qrcode($id)
  {
    $kodenya = "http://localhost/godblessthis/inventori_kelompok5/Barang/detail_barang/" . $id;

    //render qrcode dengan format PNG
    QRcode::png(
      $kodenya,
      $outfile = false,
      $level = QR_ECLEVEL_H,
      $size = 5,
      $margin = 2
    );
  }

  public function nerima_penempatan($id)
  {
    $postData = $this->input->post();

    $data = array(
      'status' => 1,
      'tgl_disetujui' => date("Y-m-d H:i:s"),
      'disetujui_oleh' =>  $this->session->userdata('user_id'),
    );
    $where = array('id_penempatan' => $id);
    $this->session->set_flashdata('success', 'Penempatan diterima');
    $this->Main_model->update_record('penempatan', $data, $where);
    redirect(base_url() . 'Penempatan/data_penempatan');
  }

  public function tolak_penempatan($id)
  {
    $postData = $this->input->post();

    $data = array(
      'status' => 2,
      'disetujui_oleh' =>  $this->session->userdata('user_id'),
    );
    $where = array('id_penempatan' => $id);
    $this->session->set_flashdata('warning', 'Menolak Penempatan');
    $response = $this->Main_model->update_record('penempatan', $data, $where);
    redirect(base_url() . 'Penempatan/data_penempatan');
  }

  public function edit_penempatan($id)
  {
    //mengambil detail penempatan
    $data['edit_penempatan'] = $this->Main_model->get_detail_untuk_edit_penempatan($id);
    //mengambil semua data barang dengan id_penempatan yang sama
    $data['item_barang'] = $this->Main_model->get_detail_penempatan_item($id);
    $data['lokasi'] = $this->Main_model->select_record('lokasi');
    $data['pegawai'] = $this->Main_model->select_record('pegawai');
    $data['barang'] = $this->Main_model->select_record('barang');
    $this->header('Edit penempatan');
    $this->load->view('penempatan/edit_penempatan', $data);
    $this->footer();
  }
  public function update_penempatan()
  {
    $postData = $this->input->post();
    $id_penempatan =  $this->input->post('id_penempatan');
    //data untuk ke tabel penempatan
    $data = array(
      'id_penempatan' => $id_penempatan,
      'tgl_permintaan_penempatan' => $this->input->post('date'),
      'id_lokasi' => $this->input->post('id_lokasi'),
      'USER_ID' => $this->session->userdata('user_id'),
      'pegawai_penanggung_jawab' =>  $this->input->post('EMP_ID'),
      'status' => 0,
    );
    //data untuk ke tabel permintaan_item berupa array (karena multiple input)
    $id_barang = $_POST['id_barang'];
    $jumlah = $_POST['jumlah'];
    $id_lokasi = $this->input->post('id_lokasi');
    $data_item = array();
    for ($index = 0; $index < count($id_barang) - 1; $index++) { // Kita buat perulangan berdasarkan id_barang sampai data terakhir
      array_push($data_item, array(
        'id_penempatan' => $id_penempatan,
        'id_barang' => $id_barang[$index], //mengubah array menjadi string
        'jumlah' => $jumlah[$index],  // Ambil dan set data nama sesuai index array dari $index
        'id_lokasi' => $id_lokasi
      ));
    }
    // $where = array('id_penempatan' => $postData['id_penempatan']);
    // $response = $this->Main_model->update_record('penempatan', $data, $where);
    $where = array('id_penempatan' => $postData['id_penempatan']);
    $response = $this->Main_model->update_record('penempatan', $data, $where);
    //simpan ke tabel permintaan_item
    $response2 = $this->Main_model->update_batch_permintaan_penempatan($data_item, $id_penempatan);
    /*beberapa data perlu di kirim ke file tambah_penempatan_item
    */
    //mengambil data id_penempatan yang baru diinput
    $id_penempatan = $id_penempatan;
    //mengambil data supplier yang baru diinput
    $id_supplier = $this->input->post('id_supplier');
    //obj perlu diubah ke array dulu denga fungsi json_decode
    $data['supplier_input'] = json_decode(json_encode($this->Main_model->single_record('supplier', array('id_supplier' => $id_supplier))), true);
    //mengambil data barang untuk drop down pilihan input
    if ($response == TRUE) {
      if ($response2 == TRUE) {
        $this->session->set_flashdata('success', 'Data penempatan Berhasil Diubah');
        redirect(base_url() . 'penempatan/data_penempatan');
      } else { // Jika gagal
        $this->session->set_flashdata('alert', 'Data penempatan Gagal Diubah');
        redirect(base_url() . 'penempatan/data_penempatan');
      }
    }
  }
}
