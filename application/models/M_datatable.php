<?php 
	if (!defined('BASEPATH')) exit('No direct script access allowed');
	class M_datatable extends CI_Model{
		// function __construct(){
		// 	//session_start();
		// 	parent::__construct();
		// }

        // untuk tabel bidang
        var $table_bidang = 'ak_data_bidang'; 
        var $column_order_bidang = array(null, 'bidang_kd','bidang_nama');
        var $column_search_bidang = array('bidang_kd','bidang_nama');
        var $order_bidang = array('ak_data_bidang.bidang_id' => 'ASC');

        // untuk tabel vendor
        var $table_vendor = 'ak_data_vendor'; 
        var $column_order_vendor = array(null, 'vendor_kd','vendor_nama');
        var $column_search_vendor = array('vendor_kd','vendor_nama');
        var $order_vendor = array('ak_data_vendor.vendor_id' => 'ASC');

        // untuk tabel sewa kategori
        var $table_sewa_kategori = 'ak_data_sewa_kategori'; 
        var $column_order_sewa_kategori = array(null, 'sewa_kategori_kd','sewa_kategori_nama');
        var $column_search_sewa_kategori = array('sewa_kategori_kd','sewa_kategori_nama');
        var $order_sewa_kategori = array('ak_data_sewa_kategori.sewa_kategori_id' => 'ASC');

        // untuk tabel investasi
        var $table_investasi = 'ak_data_investasi'; 
        var $column_order_investasi = array(null, 'investasi_kd','bidang_nama','investasi_uraian_pekerjaan','vendor_nama','investasi_nilai_pekerjaan','investasi_mulai_pelaksanaan');
        var $column_search_investasi = array('investasi_kd','bidang_nama','investasi_uraian_pekerjaan','vendor_nama','investasi_nilai_pekerjaan','investasi_mulai_pelaksanaan');
        var $order_investasi = array('ak_data_investasi.investasi_id' => 'ASC');

        // untuk tabel eksploitasi
        var $table_eksploitasi = 'ak_data_eksploitasi'; 
        var $column_order_eksploitasi = array(null, 'eksploitasi_kd','bidang_nama','eksploitasi_uraian_pekerjaan','vendor_nama','eksploitasi_nilai_pekerjaan','eksploitasi_mulai_pelaksanaan');
        var $column_search_eksploitasi = array('eksploitasi_kd','bidang_nama','eksploitasi_uraian_pekerjaan','vendor_nama','eksploitasi_nilai_pekerjaan','eksploitasi_mulai_pelaksanaan');
        var $order_eksploitasi = array('ak_data_eksploitasi.eksploitasi_id' => 'ASC');

        // untuk tabel adendum
        var $table_adendum = 'ak_data_adendum'; 
        var $column_order_adendum = array(null, 'adendum_kd', null, null, null, 'adendum_nilai_pekerjaan');
        var $column_search_adendum = array('adendum_kd', 'adendum_nilai_pekerjaan');
        var $order_adendum = array('ak_data_adendum.adendum_id' => 'ASC');

         // untuk tabel sewa_properti (hutang)
        var $table_sp_hutang = 'sewa_properti'; 
        var $column_order_sp_hutang = array(null, 'nama_penyewa', 'sewa_kategori_nama', 'jumlah', 'tgl_mulai', 'tgl_selesai', 'status_sewa', 'nominal', 'tgl_batas_pembayaran', 'status_pembayaran');
        var $column_search_sp_hutang = array('nama_penyewa', 'sewa_kategori_nama', 'jumlah', 'tgl_mulai', 'tgl_selesai', 'status_sewa', 'nominal', 'tgl_batas_pembayaran', 'status_pembayaran');
        var $order_sp_hutang = array('sewa_properti.sewa_properti_id' => 'ASC');

        // untuk tabel sewa_properti (lunas)
        var $table_sp_lunas = 'sewa_properti'; 
        var $column_order_sp_lunas = array(null, 'nama_penyewa', 'sewa_kategori_nama', 'jumlah', 'tgl_mulai', 'tgl_selesai', 'status_sewa', 'nominal', 'status_pembayaran');
        var $column_search_sp_lunas = array('nama_penyewa', 'sewa_kategori_nama', 'jumlah', 'tgl_mulai', 'tgl_selesai', 'status_sewa', 'nominal', 'status_pembayaran');
        var $order_sp_lunas = array('sewa_properti.sewa_properti_id' => 'ASC');

         // untuk tabel sewa_properti (all)
        var $table_sp_all = 'sewa_properti'; 
        var $column_order_sp_all = array(null, 'nama_penyewa', 'sewa_kategori_nama', 'jumlah', 'tgl_mulai', 'tgl_selesai', 'status_sewa', 'nominal', 'tgl_batas_pembayaran', 'status_pembayaran');
        var $column_search_sp_all = array('nama_penyewa', 'sewa_kategori_nama', 'jumlah', 'tgl_mulai', 'tgl_selesai', 'status_sewa', 'nominal', 'tgl_batas_pembayaran', 'status_pembayaran');
        var $order_sp_all = array('sewa_properti.sewa_properti_id' => 'ASC');


        public function __construct()
        {
            parent::__construct();
            // $this->load->database();
        }


        // untuk table bidang ===============================================================================
        private function _get_datatables_query_bidang()
        {
            
            $this->db->from($this->table_bidang);
            $this->db->where("ak_data_bidang.deleted", 0);
           
            $i = 0;
        
            foreach ($this->column_search_bidang as $item) // loop column 
            {
                if($_POST['search']['value']) // if datatable send POST for search
                {
                    
                    if($i===0) // first loop
                    {
                        $this->db->group_start(); // open bracket. query Where with OR clause better with bracket. because maybe can combine with other WHERE with AND.
                        $this->db->like($item, $_POST['search']['value']);
                    }
                    else
                    {
                        $this->db->or_like($item, $_POST['search']['value']);
                    }

                    if(count($this->column_search_bidang) - 1 == $i) //last loop
                        $this->db->group_end(); //close bracket
                }
                $i++;
            }
            
            if(isset($_POST['order'])) // here order processing
            {
                $this->db->order_by($this->column_order_bidang[$_POST['order']['0']['column']], $_POST['order']['0']['dir']);
            } 
            else if(isset($this->order_bidang))
            {
                $order = $this->order_bidang;
                $this->db->order_by(key($order), $order[key($order)]);
            }
        }

        function get_datatables_bidang()
        {
            $this->_get_datatables_query_bidang();
            if($_POST['length'] != -1)
            $this->db->limit($_POST['length'], $_POST['start']);
            $query = $this->db->get();
            return $query->result();
        }

        function count_filtered_bidang()
        {
            $this->_get_datatables_query_bidang();
            $query = $this->db->get();
            return $query->num_rows();
        }

        public function count_all_bidang()
        {
            $this->db->from($this->table_bidang);
            return $this->db->count_all_results();
        }



        // untuk table vendor ===============================================================================
        private function _get_datatables_query_vendor()
        {
            
            $this->db->from($this->table_vendor);
            $this->db->where("ak_data_vendor.deleted", 0);
           
            $i = 0;
        
            foreach ($this->column_search_vendor as $item) // loop column 
            {
                if($_POST['search']['value']) // if datatable send POST for search
                {
                    
                    if($i===0) // first loop
                    {
                        $this->db->group_start(); // open bracket. query Where with OR clause better with bracket. because maybe can combine with other WHERE with AND.
                        $this->db->like($item, $_POST['search']['value']);
                    }
                    else
                    {
                        $this->db->or_like($item, $_POST['search']['value']);
                    }

                    if(count($this->column_search_vendor) - 1 == $i) //last loop
                        $this->db->group_end(); //close bracket
                }
                $i++;
            }
            
            if(isset($_POST['order'])) // here order processing
            {
                $this->db->order_by($this->column_order_vendor[$_POST['order']['0']['column']], $_POST['order']['0']['dir']);
            } 
            else if(isset($this->order_vendor))
            {
                $order = $this->order_vendor;
                $this->db->order_by(key($order), $order[key($order)]);
            }
        }

        function get_datatables_vendor()
        {
            $this->_get_datatables_query_vendor();
            if($_POST['length'] != -1)
            $this->db->limit($_POST['length'], $_POST['start']);
            $query = $this->db->get();
            return $query->result();
        }

        function count_filtered_vendor()
        {
            $this->_get_datatables_query_vendor();
            $query = $this->db->get();
            return $query->num_rows();
        }

        public function count_all_vendor()
        {
            $this->db->from($this->table_vendor);
            return $this->db->count_all_results();
        }


        // untuk table sewa kategori ===============================================================================
        private function _get_datatables_query_sewa_kategori()
        {
            
            $this->db->from($this->table_sewa_kategori);
            $this->db->where("ak_data_sewa_kategori.deleted", 0);
           
            $i = 0;
        
            foreach ($this->column_search_sewa_kategori as $item) // loop column 
            {
                if($_POST['search']['value']) // if datatable send POST for search
                {
                    
                    if($i===0) // first loop
                    {
                        $this->db->group_start(); // open bracket. query Where with OR clause better with bracket. because maybe can combine with other WHERE with AND.
                        $this->db->like($item, $_POST['search']['value']);
                    }
                    else
                    {
                        $this->db->or_like($item, $_POST['search']['value']);
                    }

                    if(count($this->column_search_sewa_kategori) - 1 == $i) //last loop
                        $this->db->group_end(); //close bracket
                }
                $i++;
            }
            
            if(isset($_POST['order'])) // here order processing
            {
                $this->db->order_by($this->column_order_sewa_kategori[$_POST['order']['0']['column']], $_POST['order']['0']['dir']);
            } 
            else if(isset($this->order_sewa_kategori))
            {
                $order = $this->order_sewa_kategori;
                $this->db->order_by(key($order), $order[key($order)]);
            }
        }

        function get_datatables_sewa_kategori()
        {
            $this->_get_datatables_query_sewa_kategori();
            if($_POST['length'] != -1)
            $this->db->limit($_POST['length'], $_POST['start']);
            $query = $this->db->get();
            return $query->result();
        }

        function count_filtered_sewa_kategori()
        {
            $this->_get_datatables_query_sewa_kategori();
            $query = $this->db->get();
            return $query->num_rows();
        }

        public function count_all_sewa_kategori()
        {
            $this->db->from($this->table_sewa_kategori);
            return $this->db->count_all_results();
        }



        // untuk table investasi ===============================================================================
        private function _get_datatables_query_investasi()
        {
            
            $this->db->from($this->table_investasi);
            $this->db->join("ak_data_bidang","ak_data_bidang.bidang_id=ak_data_investasi.bidang_id");
            $this->db->join("ak_data_vendor","ak_data_vendor.vendor_id=ak_data_investasi.vendor_id");
            $this->db->where("ak_data_investasi.deleted", 0);
           
            $i = 0;
        
            foreach ($this->column_search_investasi as $item) // loop column 
            {
                if($_POST['search']['value']) // if datatable send POST for search
                {
                    
                    if($i===0) // first loop
                    {
                        $this->db->group_start(); // open bracket. query Where with OR clause better with bracket. because maybe can combine with other WHERE with AND.
                        $this->db->like($item, $_POST['search']['value']);
                    }
                    else
                    {
                        $this->db->or_like($item, $_POST['search']['value']);
                    }

                    if(count($this->column_search_investasi) - 1 == $i) //last loop
                        $this->db->group_end(); //close bracket
                }
                $i++;
            }
            
            if(isset($_POST['order'])) // here order processing
            {
                $this->db->order_by($this->column_order_investasi[$_POST['order']['0']['column']], $_POST['order']['0']['dir']);
            } 
            else if(isset($this->order_investasi))
            {
                $order = $this->order_investasi;
                $this->db->order_by(key($order), $order[key($order)]);
            }
        }

        function get_datatables_investasi()
        {
            $this->_get_datatables_query_investasi();
            if($_POST['length'] != -1)
            $this->db->limit($_POST['length'], $_POST['start']);
            $query = $this->db->get();
            return $query->result();
        }

        function count_filtered_investasi()
        {
            $this->_get_datatables_query_investasi();
            $query = $this->db->get();
            return $query->num_rows();
        }

        public function count_all_investasi()
        {
            $this->db->from($this->table_investasi);
            return $this->db->count_all_results();
        }



         // untuk table eksploitasi ===============================================================================
        private function _get_datatables_query_eksploitasi()
        {
            
            $this->db->from($this->table_eksploitasi);
            $this->db->join("ak_data_bidang","ak_data_bidang.bidang_id=ak_data_eksploitasi.bidang_id");
            $this->db->join("ak_data_vendor","ak_data_vendor.vendor_id=ak_data_eksploitasi.vendor_id");
            $this->db->where("ak_data_eksploitasi.deleted", 0);
           
            $i = 0;
        
            foreach ($this->column_search_eksploitasi as $item) // loop column 
            {
                if($_POST['search']['value']) // if datatable send POST for search
                {
                    
                    if($i===0) // first loop
                    {
                        $this->db->group_start(); // open bracket. query Where with OR clause better with bracket. because maybe can combine with other WHERE with AND.
                        $this->db->like($item, $_POST['search']['value']);
                    }
                    else
                    {
                        $this->db->or_like($item, $_POST['search']['value']);
                    }

                    if(count($this->column_search_eksploitasi) - 1 == $i) //last loop
                        $this->db->group_end(); //close bracket
                }
                $i++;
            }
            
            if(isset($_POST['order'])) // here order processing
            {
                $this->db->order_by($this->column_order_eksploitasi[$_POST['order']['0']['column']], $_POST['order']['0']['dir']);
            } 
            else if(isset($this->order_eksploitasi))
            {
                $order = $this->order_eksploitasi;
                $this->db->order_by(key($order), $order[key($order)]);
            }
        }

        function get_datatables_eksploitasi()
        {
            $this->_get_datatables_query_eksploitasi();
            if($_POST['length'] != -1)
            $this->db->limit($_POST['length'], $_POST['start']);
            $query = $this->db->get();
            return $query->result();
        }

        function count_filtered_eksploitasi()
        {
            $this->_get_datatables_query_eksploitasi();
            $query = $this->db->get();
            return $query->num_rows();
        }

        public function count_all_eksploitasi()
        {
            $this->db->from($this->table_eksploitasi);
            return $this->db->count_all_results();
        }



        // untuk table adendum ===============================================================================
        private function _get_datatables_query_adendum($filter)
        {
            $this->db->select("*, ak_data_adendum.adendum_selesai_pekerjaan AS acd");
            $this->db->from($this->table_adendum);
            // $this->db->join("ak_data_investasi","ak_data_investasi.investasi_id=ak_data_adendum.investasi_id","left");
            // $this->db->join("ak_data_eksploitasi","ak_data_eksploitasi.eksploitasi_id=ak_data_adendum.eksploitasi_id","left");
            // $this->db->join("ak_data_bidang a","a.bidang_id=ak_data_investasi.bidang_id","left");
            // $this->db->join("ak_data_vendor b","b.vendor_id=ak_data_investasi.vendor_id","left");
            // $this->db->join("ak_data_bidang c","c.bidang_id=ak_data_eksploitasi.bidang_id","left");
            // $this->db->join("ak_data_vendor d","d.vendor_id=ak_data_eksploitasi.vendor_id","left");

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

            if($filter == "investasi")$this->db->where("ak_data_adendum.investasi_id !=",null);
            if($filter == "eksploitasi")$this->db->where("ak_data_adendum.eksploitasi_id !=",null);
           
            $i = 0;
        
            foreach ($this->column_search_adendum as $item) // loop column 
            {
                if($_POST['search']['value']) // if datatable send POST for search
                {
                    
                    if($i===0) // first loop
                    {
                        $this->db->group_start(); // open bracket. query Where with OR clause better with bracket. because maybe can combine with other WHERE with AND.
                        $this->db->like($item, $_POST['search']['value']);
                    }
                    else
                    {
                        $this->db->or_like($item, $_POST['search']['value']);
                    }

                    if(count($this->column_search_adendum) - 1 == $i) //last loop
                        $this->db->group_end(); //close bracket
                }
                $i++;
            }
            
            if(isset($_POST['order'])) // here order processing
            {
                $this->db->order_by($this->column_order_adendum[$_POST['order']['0']['column']], $_POST['order']['0']['dir']);
            } 
            else if(isset($this->order_adendum))
            {
                $order = $this->order_adendum;
                $this->db->order_by(key($order), $order[key($order)]);
            }
        }

        function get_datatables_adendum($filter)
        {
            $this->_get_datatables_query_adendum($filter);
            if($_POST['length'] != -1)
            $this->db->limit($_POST['length'], $_POST['start']);
            $query = $this->db->get();
            return $query->result();
        }

        function count_filtered_adendum($filter)
        {
            $this->_get_datatables_query_adendum($filter);
            $query = $this->db->get();
            return $query->num_rows();
        }

        public function count_all_adendum()
        {
            $this->db->from($this->table_adendum);
            return $this->db->count_all_results();
        }




        // untuk table sewa_properti (hutang) ===============================================================================
        private function _get_datatables_query_sp_hutang()
        {
            
            $this->db->from($this->table_sp_hutang);
            $this->db->join("ak_data_sewa_kategori","ak_data_sewa_kategori.sewa_kategori_id=sewa_properti.sewa_kategori_id");
            $this->db->where("status_pembayaran","Hutang");
            $this->db->where("sewa_properti.deleted", 0);
           
            $i = 0;
        
            foreach ($this->column_search_sp_hutang as $item) // loop column 
            {
                if($_POST['search']['value']) // if datatable send POST for search
                {
                    
                    if($i===0) // first loop
                    {
                        $this->db->group_start(); // open bracket. query Where with OR clause better with bracket. because maybe can combine with other WHERE with AND.
                        $this->db->like($item, $_POST['search']['value']);
                    }
                    else
                    {
                        $this->db->or_like($item, $_POST['search']['value']);
                    }

                    if(count($this->column_search_sp_hutang) - 1 == $i) //last loop
                        $this->db->group_end(); //close bracket
                }
                $i++;
            }
            
            if(isset($_POST['order'])) // here order processing
            {
                $this->db->order_by($this->column_order_sp_hutang[$_POST['order']['0']['column']], $_POST['order']['0']['dir']);
            } 
            else if(isset($this->order_sp_hutang))
            {
                $order = $this->order_sp_hutang;
                $this->db->order_by(key($order), $order[key($order)]);
            }
        }

        function get_datatables_sp_hutang()
        {
            $this->_get_datatables_query_sp_hutang();
            if($_POST['length'] != -1)
            $this->db->limit($_POST['length'], $_POST['start']);
            $query = $this->db->get();
            return $query->result();
        }

        function count_filtered_sp_hutang()
        {
            $this->_get_datatables_query_sp_hutang();
            $query = $this->db->get();
            return $query->num_rows();
        }

        public function count_all_sp_hutang()
        {
            $this->db->from($this->table_sp_hutang);
            return $this->db->count_all_results();
        }


        // untuk table sewa_properti (lunas) ===============================================================================
        private function _get_datatables_query_sp_lunas()
        {
            
            $this->db->from($this->table_sp_lunas);
            $this->db->join("ak_data_sewa_kategori","ak_data_sewa_kategori.sewa_kategori_id=sewa_properti.sewa_kategori_id");
            $this->db->where("status_pembayaran","Lunas");
            $this->db->where("sewa_properti.deleted", 0);
           
            $i = 0;
        
            foreach ($this->column_search_sp_lunas as $item) // loop column 
            {
                if($_POST['search']['value']) // if datatable send POST for search
                {
                    
                    if($i===0) // first loop
                    {
                        $this->db->group_start(); // open bracket. query Where with OR clause better with bracket. because maybe can combine with other WHERE with AND.
                        $this->db->like($item, $_POST['search']['value']);
                    }
                    else
                    {
                        $this->db->or_like($item, $_POST['search']['value']);
                    }

                    if(count($this->column_search_sp_lunas) - 1 == $i) //last loop
                        $this->db->group_end(); //close bracket
                }
                $i++;
            }
            
            if(isset($_POST['order'])) // here order processing
            {
                $this->db->order_by($this->column_order_sp_lunas[$_POST['order']['0']['column']], $_POST['order']['0']['dir']);
            } 
            else if(isset($this->order_sp_lunas))
            {
                $order = $this->order_sp_lunas;
                $this->db->order_by(key($order), $order[key($order)]);
            }
        }

        function get_datatables_sp_lunas()
        {
            $this->_get_datatables_query_sp_lunas();
            if($_POST['length'] != -1)
            $this->db->limit($_POST['length'], $_POST['start']);
            $query = $this->db->get();
            return $query->result();
        }

        function count_filtered_sp_lunas()
        {
            $this->_get_datatables_query_sp_lunas();
            $query = $this->db->get();
            return $query->num_rows();
        }

        public function count_all_sp_lunas()
        {
            $this->db->from($this->table_sp_lunas);
            return $this->db->count_all_results();
        }



        // untuk table sewa_properti (all) ===============================================================================
        private function _get_datatables_query_sp_all()
        {
            
            $this->db->from($this->table_sp_all);
            $this->db->join("ak_data_sewa_kategori","ak_data_sewa_kategori.sewa_kategori_id=sewa_properti.sewa_kategori_id");
            $this->db->where("sewa_properti.deleted", 0);
           
            $i = 0;
        
            foreach ($this->column_search_sp_all as $item) // loop column 
            {
                if($_POST['search']['value']) // if datatable send POST for search
                {
                    
                    if($i===0) // first loop
                    {
                        $this->db->group_start(); // open bracket. query Where with OR clause better with bracket. because maybe can combine with other WHERE with AND.
                        $this->db->like($item, $_POST['search']['value']);
                    }
                    else
                    {
                        $this->db->or_like($item, $_POST['search']['value']);
                    }

                    if(count($this->column_search_sp_all) - 1 == $i) //last loop
                        $this->db->group_end(); //close bracket
                }
                $i++;
            }
            
            if(isset($_POST['order'])) // here order processing
            {
                $this->db->order_by($this->column_order_sp_all[$_POST['order']['0']['column']], $_POST['order']['0']['dir']);
            } 
            else if(isset($this->order_sp_all))
            {
                $order = $this->order_sp_all;
                $this->db->order_by(key($order), $order[key($order)]);
            }
        }

        function get_datatables_sp_all()
        {
            $this->_get_datatables_query_sp_all();
            if($_POST['length'] != -1)
            $this->db->limit($_POST['length'], $_POST['start']);
            $query = $this->db->get();
            return $query->result();
        }

        function count_filtered_sp_all()
        {
            $this->_get_datatables_query_sp_all();
            $query = $this->db->get();
            return $query->num_rows();
        }

        public function count_all_sp_all()
        {
            $this->db->from($this->table_sp_all);
            return $this->db->count_all_results();
        }













       

	}
?>
