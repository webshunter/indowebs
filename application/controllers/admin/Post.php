<?php
defined('BASEPATH') OR exit('No direct script access allowed');

use PhpOffice\PhpSpreadsheet\Spreadsheet;
use PhpOffice\PhpSpreadsheet\Writer\Xlsx;

class Post extends CI_Controller {

	private $table1 = 'post';

	public function __construct()
	{
		parent::__construct();
        //Cek_login::ceklogin();
		$this->load->model('Createtable');
		$this->load->model('Datatable_gugus');
	}

	public function index()
	{
        $this->Createtable->location('admin/post/table_show');
        $this->Createtable->table_name('tableku');
        $this->Createtable->create_row(["No","No Post","Judul","Slug","Kategori","Thumbnails","Tanggal","Tag","created at","updated at","delete set", "action"]);
        $this->Createtable->order_set('0, 10');
		$show = $this->Createtable->create();

		$data['datatable'] = $show;
        $this->load->view('templateadmin/head');
        $this->load->view('admin/post/view', $data);
        $this->load->view('templateadmin/footer');
	}

	public function table_show($action = 'show', $keyword = '')
	{
		if ($action == "show") {
        
            if (isset($_POST['order'])): $setorder = $_POST['order']; else: $setorder = ''; endif;

            $this->Datatable_gugus->datatable(
                [
                    "table" => $this->table1,
                    "select" => [
						"*"
					],
                    'where' => [
                        ['delete_set', '=', '0']
                    ],
                    'limit' => [
                        'start' => post('start'),
                        'end' => post('length')
                    ],
                    'search' => [
                        'value' => $this->Datatable_gugus->search(),
                        'row' => ["no_post","judul","slug","kategori","thumbnails","tanggal","tag","created_at","updated_at"]
                    ],
                    'table-draw' => post('draw'),
                    'table-show' => [
                        'key' => 'id',
                        'data' => ["no_post","judul","slug","kategori","thumbnails","tanggal","tag","created_at","updated_at"]
                    ],
                    "action" => "standart",
                    'order' => [
                        'order-default' => ['id', 'ASC'],
                        'order-data' => $setorder,
                        'order-option' => [ "1"=>"no_post", "2"=>"judul", "3"=>"slug", "4"=>"kategori", "5"=>"thumbnails", "6"=>"tanggal", "7"=>"tag", "8"=>"created_at", "9"=>"updated_at", "10"=>"delete_set"],
                    ],
                    
                ]
            );
            $this->Datatable_gugus->table_show();
        }elseif ($action == "update") {
            $data_row = $this->db->query("SELECT * FROM ".$this->table1." WHERE id = '".$keyword."'")->row();
            $data['form_data'] = $data_row;
            $this->load->view('templateadmin/head');
            $this->load->view('admin/post/edit', $data);
            $this->load->view('templateadmin/footer');
        }elseif ($action == "delete") {
            $hapus_data = $this->db->query("UPDATE ".$this->table1." SET delete_set = '1' WHERE id = '".post("id")."'");
        }
    }

    public function tambah_data()
    {
        $this->load->view('templateadmin/head');
        $this->load->view('admin/post/tambah');
        $this->load->view('templateadmin/footer');
    }


    public function simpan(){
        $no_post = post("no_post");
$judul = post("judul");
$slug = post("slug");
$kategori = post("kategori");
$thumbnails = post("thumbnails");
$tanggal = post("tanggal");
$tag = post("tag");

        

        $simpan = $this->db->query("
            INSERT INTO post
            (no_post,judul,slug,kategori,thumbnails,tanggal,tag) VALUES ('$no_post','$judul','$slug','$kategori','$thumbnails','$tanggal','$tag')
        ");
    

        if($simpan){
            redirect('admin/post');
        }
    }

    public function update(){
          $key = post('id'); $no_post = post("no_post");
$judul = post("judul");
$slug = post("slug");
$kategori = post("kategori");
$thumbnails = post("thumbnails");
$tanggal = post("tanggal");
$tag = post("tag");

        $simpan = $this->db->query("
            UPDATE post SET  no_post = '$no_post', judul = '$judul', slug = '$slug', kategori = '$kategori', thumbnails = '$thumbnails', tanggal = '$tanggal', tag = '$tag' WHERE id = '$key'
            ");
    

        if($simpan){
            redirect('admin/post');
        }
    }
    
    public function exls(array $data = [], array $headers = [], $fileName = 'data-post.xlsx')
    {
        $spreadsheet = new Spreadsheet();
        $sheet = $spreadsheet->getActiveSheet();

        $headers = ["No","No Post","Judul","Slug","Kategori","Thumbnails","Tanggal","Tag","created at","updated at","delete set", "action"];

        $calldata = ["no_post","judul","slug","kategori","thumbnails","tanggal","tag","created_at","updated_at"];

        for ($i = 0, $l = sizeof($headers); $i < $l; $i++) {
            $sheet->setCellValueByColumnAndRow($i + 1, 1, $headers[$i]);
        }
        
        $qr = $this->db->query("SELECT * FROM $this->table1")->result();

        foreach($qr as $i => $vv){
            $j = 1;
            $sheet->setCellValueByColumnAndRow(0 + 1, ($i + 1 + 1), $i + 1);
            foreach ($calldata as $k => $v) { // column $j
                $sheet->setCellValueByColumnAndRow($j + 1, ($i + 1 + 1), $vv->$v);
                $j++;
            }
        }

        $writer = new Xlsx($spreadsheet);
        header('Content-Type: application/vnd.openxmlformats-officedocument.spreadsheetml.sheet');
        header('Content-Disposition: attachment; filename="'. urlencode($fileName).'"');
        $writer->save('php://output');

    }


}
