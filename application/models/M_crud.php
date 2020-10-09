<?php 
	if (!defined('BASEPATH')) exit('No direct script access allowed');
	class M_crud extends CI_Model{
		function __construct(){
			//session_start();
			parent::__construct();
		}

        function allInsertSave($data,$getDbName){
                $this->db->insert($getDbName, $data);
                $last_id = $this->db->insert_id();
                if($this->db->affected_rows() > 0){
                    $return = array(
                        'code' => 0,
                        'message' => "Berhasil disimpan",
                        'last_id' => $last_id
                    );
                }
                else{
                    $return = array(
                        'code' => 1,
                        'message' => "Gagal disimpan"
                    );
                }
                return $return;
        }

		function allEditSave($data,$id,$getDbName,$getPrimColumnName){
			$this->db->where($getPrimColumnName, $id);
			$this->db->update($getDbName, $data);

                        if($this->db->affected_rows() > 0){
                            $return = array(
                                'code' => 0,
                                'message' => "update successful"
                            );
                        }
                        else{
                            $return = array(
                                'code' => 1,
                                'message' => "update failed"
                            );
                        }
                        return $return;
		}

        function allEditSave2($data,$getDbName,$con1,$val1,$con2,$val2){
			$this->db->where($con2,$val2);
            $this->db->where($con1,$val1);
			$this->db->update($getDbName,$data);

                        if($this->db->affected_rows() > 0){
                            $return = array(
                                'code' => 0,
                                'message' => "update successful"
                            );
                        }
                        else{
                            $return = array(
                                'code' => 1,
                                'message' => "update failed"
                            );
                        }
                        return $return;
		}

		function allValidate($data,$tableName,$columnName,$count){
			$this->db->select($count.' as jumlah');
			$this->db->from($tableName);
			$this->db->where($columnName,$data);
            $this->db->where('STATHAPUS','0');
			return $this->db->get()->result();
		}

        function allValidate2($data,$tableName,$columnName,$count,$data2,$columnParent){
            $this->db->select($count.'as jumlah');
            $this->db->from($tableName);
            $this->db->where('status', 0);
            $this->db->where($columnName,$data);
            $this->db->where($columnParent,$data2);
            //echo $this->db; exit;
            return $this->db->get()->result()[0]->jumlah;
        }

        function allValidate3($data,$tableName,$columnName,$count,$data2,$column2,$data3,$column3){
			$this->db->select($count.'as jumlah');
			$this->db->from($tableName);
            $this->db->where('STATHAPUS','0');
			$this->db->where($columnName,$data);
			$this->db->where($column2,$data2);
            $this->db->where($column3,$data3);
            //echo $this->db; exit;
			return $this->db->get()->result();
		}

		function get_allDetail($getId,$getTableName,$getprimColumnName){
			$this->db->select('*');
			$this->db->from($getTableName);
			$this->db->where($getprimColumnName,$getId);
			return $this->db->get()->result();
		}

        function allEditSaveArray($data,$id,$getDbName,$getPrimColumnName, $position){
			$this->db->where($getPrimColumnName,$id);
			$this->db->update($getDbName,$data);

                        if($this->db->affected_rows() > 0){
                            $return = array(
                                'code' => 0,
                                'message' => "update successful"
                            );
                        }
                        else{
                            $return = array(
                                'code' => 1,
                                'message' => "update failed on position " . $position
                            );
                        }
                        return $return;
		}

		function insertTrashAll($data,$table){
            $this->db->insert($table, $data); return;
        }

		function deleteAll($id,$table,$primColumn){
                    $this->db->where($primColumn,$id);
                    $this->db->delete($table);

                    if($this->db->affected_rows() > 0){
                        $return = array(
                            'code' => 0,
                            'message' => "hapus data berhasil"
                        );
                    }
                    else{
                        $return = array(
                            'code' => 1,
                            'message' => "hapus data gagal"
                        );
                    }
                    return $return;
		}

        function login($username, $password){
            $this -> db -> select('id_user, username, password');
            $this -> db -> from('users');
            $this -> db -> where('username', $username);
            $this -> db -> where('password', $password);
            $this -> db -> limit(1);

            $query = $this -> db -> get();

            if($query -> num_rows() == 1){
                return 1;
            }
            else{
                return 0;
            }
        }

        function getiduser($username){
            $this -> db -> select('id_user');
            $this -> db -> from('users');
            $this -> db -> where('username', $username);
            $this -> db -> limit(1);
            return $this -> db -> get() -> row()->id_user;
        }

        function getroleuser($username){
            $this -> db -> select('role.id_role,nama_role');
            $this -> db -> from('users');
            $this -> db -> join("role","role.id_role=users.id_role");
            $this -> db -> where('users.username', $username);
            $this -> db -> limit(1);
            return $this -> db -> get() -> row();
        }

         function gethakapproveuser($username){
            $this -> db -> select('hak_approve');
            $this -> db -> from('users');
            $this -> db -> where('username', $username);
            $this -> db -> limit(1);
            return $this -> db -> get() -> row()->hak_approve;
        }

        function getalldatatable($table){
            $this -> db -> select('*');
            $this -> db -> from($table);
            return $this -> db -> get() -> result();
        }

        function getalldatatablewhere($table,$colname,$val){
            $this -> db -> select('*');
            $this -> db -> from($table);
            $this -> db -> where($colname, $val);
            return $this -> db -> get() -> result();
        }

        // function getsingledatatable($table){
        //     $this -> db -> select('*');
        //     $this -> db -> from($table);
        //     return $this -> db -> get() -> row_array();
        // }

        function getsingledatatablewhere($table,$colname,$val){
            $this -> db -> select('*');
            $this -> db -> from($table);
            $this -> db -> where($colname, $val);
            return $this -> db -> get() -> row_array();
        }

        function lastid($kolom,$tabel){
            $sql = "
                SELECT IFNULL(MAX($kolom),0)
                AS max
                FROM $tabel
            ";
            $query = $this->db->query($sql);
            return $query->result();
        }


        public function getLastCode($from,$col,$id){
            $this->db->select("*");
            $this->db->from($from);
            $this->db->like($col, $id);
            $this->db->order_by($col,"DESC");
            return $this->db->get()->row_array();
        }



        public function getAdendumInvestasiBy($investasi_id)
        {
            $this->db->select("ak_data_adendum.*");
            $this->db->from("ak_data_adendum");
            $this->db->join("ak_data_investasi","ak_data_investasi.investasi_id=ak_data_adendum.investasi_id");
            $this->db->where("ak_data_adendum.investasi_id",$investasi_id);
            $this->db->where("ak_data_adendum.deleted",0);
            $this->db->order_by("ak_data_adendum.adendum_id","DESC");
            $this->db->limit(1);
            return $this->db->get()->row_array();
        }

        public function getAdendumEksploitasiBy($eksploitasi_id)
        {
            $this->db->select("ak_data_adendum.*");
            $this->db->from("ak_data_adendum");
            $this->db->join("ak_data_eksploitasi","ak_data_eksploitasi.eksploitasi_id=ak_data_adendum.eksploitasi_id");
            $this->db->where("ak_data_adendum.eksploitasi_id",$eksploitasi_id);
            $this->db->where("ak_data_adendum.deleted",0);
            $this->db->order_by("ak_data_adendum.adendum_id","DESC");
            $this->db->limit(1);
            return $this->db->get()->row_array();
        }

        public function getAdendumJoinInvestasiBy($id_adendum)
        {
            $this->db->select("*");
            $this->db->from("ak_data_adendum");

            $this->db->join('(SELECT ak_data_investasi.investasi_id AS invid, ak_data_investasi.created_date AS cd, ak_data_investasi.bidang_id AS invid_bid, ak_data_investasi.vendor_id AS invid_ven, ak_data_investasi.deleted, ak_data_investasi.investasi_uraian_pekerjaan AS invup, ak_data_investasi.investasi_mulai_pelaksanaan AS invmp
                FROM ak_data_investasi) A','A.invid=ak_data_adendum.investasi_id',"left");

            // $this->db->join('(SELECT *, ak_data_bidang.bidang_id AS bid1, ak_data_bidang.bidang_nama AS binam1
            //     FROM ak_data_bidang) AA','AA.bid1=A.invid_bid',"left");

            // $this->db->join('(SELECT *, ak_data_vendor.vendor_id AS ven1, ak_data_vendor.vendor_nama AS venam1
            //     FROM ak_data_vendor) CC','CC.ven1=A.invid_ven',"left");

            $this->db->where("ak_data_adendum.adendum_id",$id_adendum);
            return $this->db->get()->row_array();
        }

        public function getAdendumJoinEksploitasiBy($id_adendum)
        {
            $this->db->select("*");
            $this->db->from("ak_data_adendum");

            $this->db->join('(SELECT ak_data_eksploitasi.eksploitasi_id AS eksid, ak_data_eksploitasi.created_date AS cd2, ak_data_eksploitasi.bidang_id AS eksid_bid, ak_data_eksploitasi.vendor_id AS eksid_ven, ak_data_eksploitasi.deleted, ak_data_eksploitasi.eksploitasi_uraian_pekerjaan AS eksup, ak_data_eksploitasi.eksploitasi_mulai_pelaksanaan AS eksmp
                FROM ak_data_eksploitasi) B','B.eksid=ak_data_adendum.eksploitasi_id',"left");

            // $this->db->join('(SELECT *, ak_data_bidang.bidang_id AS bid2, ak_data_bidang.bidang_nama AS binam2
            //     FROM ak_data_bidang) BB','BB.bid2=B.eksid_bid',"left");

            // $this->db->join('(SELECT *, ak_data_vendor.vendor_id AS ven2, ak_data_vendor.vendor_nama AS venam2
            //     FROM ak_data_vendor) DD','DD.ven2=B.eksid_ven',"left");

            $this->db->where("ak_data_adendum.adendum_id",$id_adendum);
            return $this->db->get()->row_array();
        }

        public function getSewaPropertiBy($id)
        {
            $this->db->select("*");
            $this->db->from("sewa_properti");
            $this->db->join("ak_data_sewa_kategori","ak_data_sewa_kategori.sewa_kategori_id=sewa_properti.sewa_kategori_id");
            $this->db->where("sewa_properti.sewa_properti_id",$id);
            return $this->db->get()->row_array();
        }

        public function getFilterSewaProperti($tahun1,$tahun2,$type)
        {
            $this->db->select("*");
            $this->db->from("sewa_properti");
            $this->db->join("ak_data_sewa_kategori","ak_data_sewa_kategori.sewa_kategori_id=sewa_properti.sewa_kategori_id");
            if($type == "Hutang" || $type == "Lunas")$this->db->where("sewa_properti.status_pembayaran",$type);
            if($tahun1 !=null && $tahun2 !=null)$this->db->where("sewa_properti.tgl_mulai >=",$tahun1);
            if($tahun1 !=null && $tahun2 !=null)$this->db->where("sewa_properti.tgl_mulai <=",$tahun2);
            $this->db->where("sewa_properti.deleted",0);
            return $this->db->get()->result();
        }

        public function getFilterInvestasi($tahun1,$tahun2)
        {
            $this->db->select("*");
            $this->db->from("ak_data_investasi");
            $this->db->join("ak_data_bidang","ak_data_bidang.bidang_id=ak_data_investasi.bidang_id");
            $this->db->join("ak_data_vendor","ak_data_vendor.vendor_id=ak_data_investasi.vendor_id");
            
            if($tahun1 !=null && $tahun2 !=null)$this->db->where("ak_data_investasi.investasi_mulai_pelaksanaan >=",$tahun1);
            if($tahun1 !=null && $tahun2 !=null)$this->db->where("ak_data_investasi.investasi_mulai_pelaksanaan <=",$tahun2);
            $this->db->where("ak_data_investasi.deleted",0);
            return $this->db->get()->result();
        }

        public function getFilterEksploitasi($tahun1,$tahun2)
        {
            $this->db->select("*");
            $this->db->from("ak_data_eksploitasi");
            $this->db->join("ak_data_bidang","ak_data_bidang.bidang_id=ak_data_eksploitasi.bidang_id");
            $this->db->join("ak_data_vendor","ak_data_vendor.vendor_id=ak_data_eksploitasi.vendor_id");
            
            if($tahun1 !=null && $tahun2 !=null)$this->db->where("ak_data_eksploitasi.eksploitasi_mulai_pelaksanaan >=",$tahun1);
            if($tahun1 !=null && $tahun2 !=null)$this->db->where("ak_data_eksploitasi.eksploitasi_mulai_pelaksanaan <=",$tahun2);
            $this->db->where("ak_data_eksploitasi.deleted",0);
            return $this->db->get()->result();
        }


        public function countAllInvestasi()
        {
            $this->db->select("*");
            $this->db->from("ak_data_investasi");
            $this->db->where("ak_data_investasi.deleted",0);
            return $this->db->count_all_results();
        }

        public function countAllEksploitasi()
        {
            $this->db->select("*");
            $this->db->from("ak_data_eksploitasi");
            $this->db->where("ak_data_eksploitasi.deleted",0);
            return $this->db->count_all_results();
        }

        // jika data eksploitasi / investasi dihapus maka adendum tidak akan dihitung
        public function countAllAdendum()
        {
            $this->db->select("*, ak_data_adendum.created_date AS acd");
            $this->db->from("ak_data_adendum");

            $this->db->join('(SELECT ak_data_investasi.investasi_id AS invid, ak_data_investasi.created_date AS cd, ak_data_investasi.bidang_id AS invid_bid, ak_data_investasi.vendor_id AS invid_ven, ak_data_investasi.deleted, ak_data_investasi.investasi_uraian_pekerjaan AS invup, ak_data_investasi.investasi_mulai_pelaksanaan AS invmp
                FROM ak_data_investasi) A','A.invid=ak_data_adendum.investasi_id',"left");
            $this->db->join('(SELECT ak_data_eksploitasi.eksploitasi_id AS eksid, ak_data_eksploitasi.created_date AS cd2, ak_data_eksploitasi.bidang_id AS eksid_bid, ak_data_eksploitasi.vendor_id AS eksid_ven, ak_data_eksploitasi.deleted, ak_data_eksploitasi.eksploitasi_uraian_pekerjaan AS eksup, ak_data_eksploitasi.eksploitasi_mulai_pelaksanaan AS eksmp
                FROM ak_data_eksploitasi) B','B.eksid=ak_data_adendum.eksploitasi_id',"left");

            $this->db->join('(SELECT *, ak_data_bidang.bidang_id AS bid1, ak_data_bidang.bidang_nama AS binam1
                FROM ak_data_bidang) AA','AA.bid1=A.invid_bid',"left");
            $this->db->join('(SELECT *, ak_data_bidang.bidang_id AS bid2, ak_data_bidang.bidang_nama AS binam2
                FROM ak_data_bidang) BB','BB.bid2=B.eksid_bid',"left");

            $this->db->join('(SELECT *, ak_data_vendor.vendor_id AS ven1, ak_data_vendor.vendor_nama AS venam1
                FROM ak_data_vendor) CC','CC.ven1=A.invid_ven',"left");
            $this->db->join('(SELECT *, ak_data_vendor.vendor_id AS ven2, ak_data_vendor.vendor_nama AS venam2
                FROM ak_data_vendor) DD','DD.ven2=B.eksid_ven',"left");

            $this->db->where("ak_data_adendum.deleted", 0);
            $where = '(A.deleted = 0 or B.deleted = 0)';
            $this->db->where($where);
            return $this->db->count_all_results();
        }




        public function getAllInvestasi()
        {
            $this->db->select("*");
            $this->db->from("ak_data_investasi");
            $this->db->join("ak_data_bidang","ak_data_bidang.bidang_id=ak_data_investasi.bidang_id");
            $this->db->join("ak_data_vendor","ak_data_vendor.vendor_id=ak_data_investasi.vendor_id");
            
            $this->db->where("ak_data_investasi.deleted",0);
            return $this->db->get()->result();
        }

        public function getAllEksploitasi()
        {
            $this->db->select("*");
            $this->db->from("ak_data_eksploitasi");
            $this->db->join("ak_data_bidang","ak_data_bidang.bidang_id=ak_data_eksploitasi.bidang_id");
            $this->db->join("ak_data_vendor","ak_data_vendor.vendor_id=ak_data_eksploitasi.vendor_id");
            
            $this->db->where("ak_data_eksploitasi.deleted",0);
            return $this->db->get()->result();
        }

        // jika data investasi / eksploitasi dihapus, maka adendum tidak dihitung
        public function getAllAdendum()
        {
            $this->db->select("*, ak_data_adendum.created_date");
            $this->db->from("ak_data_adendum");
            
            $this->db->join('(SELECT ak_data_investasi.investasi_id AS invid, ak_data_investasi.created_date AS cd, ak_data_investasi.bidang_id AS invid_bid, ak_data_investasi.vendor_id AS invid_ven, ak_data_investasi.deleted, ak_data_investasi.investasi_uraian_pekerjaan AS invup, ak_data_investasi.investasi_mulai_pelaksanaan AS invmp
                FROM ak_data_investasi) A','A.invid=ak_data_adendum.investasi_id',"left");
            $this->db->join('(SELECT ak_data_eksploitasi.eksploitasi_id AS eksid, ak_data_eksploitasi.created_date AS cd2, ak_data_eksploitasi.bidang_id AS eksid_bid, ak_data_eksploitasi.vendor_id AS eksid_ven, ak_data_eksploitasi.deleted, ak_data_eksploitasi.eksploitasi_uraian_pekerjaan AS eksup, ak_data_eksploitasi.eksploitasi_mulai_pelaksanaan AS eksmp
                FROM ak_data_eksploitasi) B','B.eksid=ak_data_adendum.eksploitasi_id',"left");

            $this->db->where("ak_data_adendum.deleted", 0);
            $where = '(A.deleted = 0 or B.deleted = 0)';
            $this->db->where($where);

            return $this->db->get()->result();
        }




      

       

	}
?>
