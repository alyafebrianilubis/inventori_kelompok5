<?php


class Pengadaan extends MY_Controller
{

  public function __construct()
  {
    parent::__construct();
  }

  public function index()
  {
    $data['pengadaan'] = $this->Main_model->get_pengadaan(); //pengadaan adalah nama tabel database
    $this->header('Data Pengadaan');
    $this->load->view('pengadaan/data_pengadaan', $data);
    $this->footer();
  }

  public function data_pengadaan()
  {
    $data['sig'] = $this->Main_model->get_sig($this->session->userdata('id'));
    $data['pengadaan'] = $this->Main_model->get_pengadaan();   //pengadaan join
    $data['barang'] = $this->Main_model->select_record('barang');

    $this->header('Data pengadaan');
    $this->load->view('pengadaan/data_pengadaan', $data);
    $this->footer();
  }

  public function tambah_pengadaan()
  {
    $data['barang'] = $this->Main_model->select_record('barang');
    $data['supplier'] = $this->Main_model->select_record('supplier');

    $this->header('Tambah Pengadaan');
    $this->load->view('pengadaan/tambah_pengadaan', $data);
    $this->footer();
  }


  /*
insert ke tabel pengadaan id_pengadaan, tanggal_permintaan, id_supplier, USER_ID
keterangan status di tabel pengadaan (0-belum disetujui manager, 1-disetujui manager,2-ditolak manager)
keterangan_diselesaikan : saat petugas menyetujui_diselesaikan = 1, lalu data barang di tabel pengadaan dengan id_pengadaan yang disetujui akan masuk dari data
*/

  public function insert_pengadaan_old()
  {

    $data['supplier'] = $this->Main_model->select_record('supplier');

    //mengambil usert data untuk diinput sebagai USER_ID
    $user_id = $this->session->userdata('user_id');
    //generate untuk id_pengadaan dengan MSK + tanggal + jlh row data pengadaan 
    $back = $this->db->get('pengadaan')->num_rows() + 1;
    $id_pengadaan = 'MSK-' . date('ymd') . $back;

    $data = array(
      'id_pengadaan' => $id_pengadaan,
      'tgl_permintaan' => $this->input->post('date'),
      'id_supplier' => $this->input->post('id_supplier'),
      'USER_ID' => $user_id,
      'status' => 0,
      '_dibayar' => 0,
    );

    $response = $this->Main_model->save_record('pengadaan', $data);

    /*beberapa data perlu di kirim ke file tambah_pengadaan_item
    */
    //mengambil data id_pengadaan yang baru diinput
    $id_pengadaan = $id_pengadaan;
    //mengambil data supplier yang baru diinput
    $id_supplier = $this->input->post('id_supplier');
    //obj perlu diubah ke array dulu denga fungsi json_decode
    $data['supplier_input'] = json_decode(json_encode($this->Main_model->single_record('supplier', array('id_supplier' => $id_supplier))), true);
    //mengambil data barang untuk drop down pilihan input
    $data['barang'] = $this->Main_model->select_record('barang');

    if ($response == TRUE) {
      $this->header('Tambah Pengadaan');
      $this->load->view('pengadaan/tambah_pengadaan_item', $data);
      $this->footer();
    }
  }

  public function insert_pengadaan()
  {

    $data['supplier'] = $this->Main_model->select_record('supplier');
    $data['barang'] = $this->Main_model->select_record('barang');

    //mengambil usert data untuk diinput sebagai USER_ID
    $user_id = $this->session->userdata('user_id');
    //generate untuk id_pengadaan dengan MSK + tanggal + jlh row data pengadaan 
    $back = $this->db->get('pengadaan')->num_rows() + 1;
    $id_pengadaan = 'MSK-' . date('ymd') . $back;

    $id_barang = $_POST['id_barang'];
    $jumlah = $_POST['jumlah'];
    $harga = $_POST['harga'];

    //hitung total harga
    $total_harga = array_sum($harga);

    $data = array(
      'id_pengadaan' => $id_pengadaan,
      'tgl_permintaan' => $this->input->post('date'),
      'id_supplier' => $this->input->post('id_supplier'),
      'total_harga' => $total_harga,
      'USER_ID' => $user_id,
      'status' => 0,
      '_dibayar' => 0,
    );



    $data_item = array();
    for ($index = 0; $index < count($id_barang) - 1; $index++) { // Kita buat perulangan berdasarkan id_barang sampai data terakhir
      array_push($data_item, array(
        'id_barang' => $id_barang[$index], //mengubah array menjadi string
        'id_pengadaan' => $id_pengadaan,
        'jumlah' => $jumlah[$index],  // Ambil dan set data nama sesuai index array dari $index
        'harga' => $harga[$index],
      ));
    }


    $response = $this->Main_model->save_record('pengadaan', $data);
    //simpan ke tabel permintaan_item
    $response2 = $this->Main_model->save_batch_permintaan($data_item);

    /*beberapa data perlu di kirim ke file tambah_pengadaan_item
    */
    //mengambil data id_pengadaan yang baru diinput
    $id_pengadaan = $id_pengadaan;
    //mengambil data supplier yang baru diinput
    $id_supplier = $this->input->post('id_supplier');
    //obj perlu diubah ke array dulu denga fungsi json_decode
    $data['supplier_input'] = json_decode(json_encode($this->Main_model->single_record('supplier', array('id_supplier' => $id_supplier))), true);
    //mengambil data barang untuk drop down pilihan input


    if ($response == TRUE) {
      if ($response2 == TRUE) {

        $this->session->set_flashdata('success', 'Data pengadaan Berhasil Ditambahkan');
        redirect(base_url() . 'Pengadaan/data_pengadaan');
      } else { // Jika gagal
        $this->session->set_flashdata('alert', 'Data pengadaan Gagal Ditambahkan');
        redirect(base_url() . 'Pengadaan/data_pengadaan');
      }
    }
  }


  /*memasukkan multiple item ke tabel permintaan_item 
    setelah id_pengadaan masuk ke tabel pengadaan 
    masukkan item-item barang yang diinput user
    ke dalam tabel permintaan_item_barang
  */

  public function insert_pengadaan_item()
  {
    //data untuk ke tabel permintaan_item berupa array (karena multiple input)

    $id_barang = $_POST['id_barang'];
    $jumlah = $_POST['jumlah'];
    $harga = $_POST['harga'];
    $id_pengadaan = $_POST['id_pengadaan'];

    //update tabel pengadaan masukkan total_harga untuk id_pengadaan=$id_pengadaan
    $total_harga = array_sum($harga);
    $data_pengadaan = array(
      'total_harga' => $total_harga,
    );
    $this->db->where('id_pengadaan', $id_pengadaan);
    $this->db->update('pengadaan', $data_pengadaan);


    $data_item = array();
    for ($index = 0; $index < count($id_barang) - 1; $index++) { // Kita buat perulangan berdasarkan id_barang sampai data terakhir
      array_push($data_item, array(
        'id_barang' => $id_barang[$index], //mengubah array menjadi string
        'id_pengadaan' => $id_pengadaan,
        'jumlah' => $jumlah[$index],  // Ambil dan set data nama sesuai index array dari $index
        'harga' => $harga[$index],
      ));
    }


    //simpan ke tabel permintaan_item
    $response = $this->Main_model->save_batch_permintaan($data_item);


    if ($response == TRUE) {

      $this->session->set_flashdata('success', 'Data pengadaan Berhasil Ditambahkan');
      redirect(base_url() . 'Pengadaan/data_pengadaan');
    } else { // Jika gagal
      $this->session->set_flashdata('alert', 'Data pengadaan Gagal Ditambahkan');
      redirect(base_url() . 'Pengadaan/data_pengadaan');
    }
  }

  /* yang dibutuhkan dari detail pengadaan :
  
  |--join 3 tabel = $data['detail_pengadaan']
  1. detail petugas peminta, petugas penyetuju
  2. detail supplier
  3. detail pengadaan : tgl_permintaan, tgl disutujui, tgl masuk, status disetujui
  --.

  |--
  4. detail barang-barang yang diminta dari (id_pengadaan) di tabel permintaan_pengadaan_item
  */

  public function detail_pengadaan($id)
  {
    //mengambil detail pengadaan
    $data['detail_pengadaan'] = $this->Main_model->get_detail_pengadaan($id);
    //mengambil semua data barang dengan id_pengadaan yang sama
    $data['barang'] = $this->Main_model->get_detail_pengadaan_item($id);


    $this->header('Detail Pengadaan Barang');
    $this->load->view('pengadaan/detail_pengadaan', $data);
    $this->footer();
  }

  public function hapus_pengadaan($id)
  {
    $response = $this->Main_model->delete_pengadaan($id);
    if ($response == TRUE) {
      $this->session->set_flashdata('warning', "Data Pengadaan Berhasil Dihapus");
      redirect(base_url() . 'Pengadaan');
    } else {
      $this->session->set_flashdata('error', "Data ini penting! Tidak bisa dihapus!");
      redirect(base_url() . 'Pengadaan');
    }
  }


  public function bayar_pengadaan_ver1($id)
  {
    $dibayar_oleh = $this->session->userdata('user_id');
    $_dibayar = 1;
    $data = array(
      'dibayar_oleh' => $dibayar_oleh,
      '_dibayar' => $_dibayar,
      'tgl_masuk' => date("Y-m-d H:i:s"),
    );

    //update tabel pengadaan
    $where = array('id_pengadaan' => $id);
    $response = $this->Main_model->update_record('pengadaan', $data, $where);

    //update tabel permintaan_pengadaan_item
    $response2 = $this->Main_model->update_permintaan_pengadaan_item($id);

    // var_dump($barang[1]);



    if ($response == TRUE) {
      if ($response2 == TRUE) {
        $this->session->set_flashdata('success', "Pengadaan ini telah dibayar!");
        redirect(base_url() . 'Pengadaan/invoice_pengadaan');
      }
    } else {
      $this->session->set_flashdata('error', "Something went wrong");
    }
    redirect(base_url() . 'Pengadaan/invoice_pengadaan');
  }

  public function bayar_pengadaan($id)
  {
    $dibayar_oleh = $this->session->userdata('user_id');
    $_dibayar = 1;
    $data = array(
      'dibayar_oleh' => $dibayar_oleh,
      '_dibayar' => $_dibayar,
      'tgl_masuk' => date("Y-m-d H:i:s"),
    );

    //update tabel pengadaan
    $where = array('id_pengadaan' => $id);
    $response = $this->Main_model->update_record('pengadaan', $data, $where);

    //barang dari tabel permintaan_masuk_item masuk ke tabel masuk_item
    $response2 = $this->Main_model->insert_masuk_item($id);

    if ($response == TRUE) {
      if ($response2 == TRUE) {
        $this->session->set_flashdata('success', "Pengadaan ini telah dibayar! Data barang telah diupdate");
        redirect(base_url() . 'Pengadaan/invoice_pengadaan');
      }
    } else {
      $this->session->set_flashdata('error', "Something went wrong");
    }
    redirect(base_url() . 'Pengadaan/invoice_pengadaan');
  }

  public function invoice_pengadaan()
  {
    $data['pengadaan'] = $this->Main_model->get_invoice_pengadaan();   //pengadaan join
    $this->header('Data pengadaan');
    $this->load->view('pengadaan/invoice_pengadaan', $data);
    $this->footer();
  }
  public function detail_invoice_pengadaan($id)
  {
    $data['detail_pengadaan'] = $this->Main_model->get_detail_pengadaan($id);   //pengadaan join
    $data['barang'] = $this->Main_model->get_detail_pengadaan_item($id);   //pengadaan join

    $this->header('Data pengadaan');
    $this->load->view('pengadaan/detail_invoice_pengadaan', $data);
    $this->footer();
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


  public function nerima_pengadaan($id)
  {
    $data = array(
      'status' => 1,
      'disetujui_oleh' => $this->session->userdata('user_id'),
      'tgl_disetujui' => date("Y-m-d H:i:s"),
    );
    //update tabel pengadaan
    $where = array('id_pengadaan' => $id);
    $this->Main_model->update_record('pengadaan', $data, $where);
    redirect(base_url() . 'Pengadaan/data_pengadaan');
  }

  public function tolak_pengadaan($id)
  {

    $data = array(
      'status' => 2,
      'disetujui_oleh' => $this->session->userdata('user_id'),
      'tgl_disetujui' => date("Y-m-d H:i:s"),
    );
    //update tabel pengadaan
    $where = array('id_pengadaan' => $id);
    $this->Main_model->update_record('pengadaan', $data, $where);
  }
  public function edit_pengadaan($id)
  {
    //mengambil detail pengadaan
    $data['edit_pengadaan'] = $this->Main_model->get_detail_untuk_edit($id);
    //mengambil semua data barang dengan id_pengadaan yang sama
    $data['item_barang'] = $this->Main_model->get_detail_pengadaan_item($id);
    $data['barang'] = $this->Main_model->select_record('barang');
    $data['supplier'] = $this->Main_model->select_record('supplier');
    // var_dump($data['edit_pengadaan']);
    // die;
    $this->header('Edit pengadaan');
    $this->load->view('pengadaan/edit_pengadaan', $data);
    $this->footer();
  }
  public function update_pengadaan()
  {
    $postData = $this->input->post();
    $id_pengadaan =  $this->input->post('id_pengadaan');
    $id_barang = $_POST['id_barang'];
    $jumlah = $_POST['jumlah'];
    $harga = $_POST['harga'];
    //hitung total harga
    $total_harga = array_sum($harga);
    $data = array(
      'id_pengadaan' => $id_pengadaan,
      'tgl_permintaan' => $this->input->post('date'),
      'id_supplier' => $this->input->post('id_supplier'),
      'total_harga' => $total_harga,
      'USER_ID' =>  $this->session->userdata('user_id'),
      'status' => 0,
      '_dibayar' => 0,
    );
    $data_item = array();
    for ($index = 0; $index < count($id_barang) - 1; $index++) { // Kita buat perulangan berdasarkan id_barang sampai data terakhir
      array_push($data_item, array(
        'id_barang' => $id_barang[$index], //mengubah array menjadi string
        'id_pengadaan' => $id_pengadaan,
        'jumlah' => $jumlah[$index],  // Ambil dan set data nama sesuai index array dari $index
        'harga' => $harga[$index],
      ));
    }
    // $where = array('id_pengadaan' => $postData['id_pengadaan']);
    // $response = $this->Main_model->update_record('pengadaan', $data, $where);
    $where = array('id_pengadaan' => $postData['id_pengadaan']);
    $response = $this->Main_model->update_record('pengadaan', $data, $where);
    //simpan ke tabel permintaan_item
    $response2 = $this->Main_model->update_batch_permintaan($data_item, $id_pengadaan);
    /*beberapa data perlu di kirim ke file tambah_pengadaan_item
    */
    //mengambil data id_pengadaan yang baru diinput
    $id_pengadaan = $id_pengadaan;
    //mengambil data supplier yang baru diinput
    $id_supplier = $this->input->post('id_supplier');
    //obj perlu diubah ke array dulu denga fungsi json_decode
    $data['supplier_input'] = json_decode(json_encode($this->Main_model->single_record('supplier', array('id_supplier' => $id_supplier))), true);
    //mengambil data barang untuk drop down pilihan input
    if ($response == TRUE) {
      if ($response2 == TRUE) {
        $this->session->set_flashdata('success', 'Data pengadaan Berhasil Diubah');
        redirect(base_url() . 'Pengadaan/data_pengadaan');
      } else { // Jika gagal
        $this->session->set_flashdata('alert', 'Data pengadaan Gagal Diubah');
        redirect(base_url() . 'Pengadaan/data_pengadaan');
      }
    }
  }
}
