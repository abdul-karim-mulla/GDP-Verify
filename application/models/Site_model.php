<?php

class Site_model  extends CI_Model  {

	function __construct()
    {
        parent::__construct();
    }

    function coc_search($keyword=''){

        $this->db->select("*");
        $this->db->from("coc");
        $this->db->or_like("certificate_no", $keyword);
        $this->db->or_like("full_name", $keyword);

        return $this->db->get()->result();
    }

    function cop_search($keyword=''){

        $this->db->select("*");
        $this->db->from("cop");
        $this->db->or_like("certificate_no", $keyword);
        $this->db->or_like("full_name", $keyword);

        return $this->db->get()->result();
    }

    function endo_search($keyword=''){

        $this->db->select("*");
        $this->db->from("endorsement");
        $this->db->or_like("endorsement_no", $keyword);
        $this->db->or_like("full_name", $keyword);

        return $this->db->get()->result();
    }

    function mc_search($keyword=''){

        $this->db->select("*");
        $this->db->from("medical_certificates");
        $this->db->or_like("certificate_no", $keyword);
        $this->db->or_like("full_name", $keyword);

        return $this->db->get()->result();
    }

    function coc_get($id = 0){

        $this->db->select("cc.*, cc.medical_cert_id as mc_no, cc.mc_date as mc_issue_date");
        $this->db->from("coc as cc");
        $this->db->where("coc_id", $id);
        $result = $this->db->get()->result();

        if(count($result) != 1){
          $cert = '';
        }else{
          $cert = $result[0];
        }
        return $cert;
    }

    function cop_get($id = 0){

        $this->db->select("cp.*, cp.medical_cert_id as mc_no, cp.mc_date as mc_issue_date");
        $this->db->from("cop as cp");
        $this->db->where("cop_id", $id);
        $result = $this->db->get()->result();

        if(count($result) != 1){
          $cert = '';
        }else{
          $cert = $result[0];
        }
        return $cert;
    }

    function endo_get($id = 0){

        $this->db->select("en.*, en.medical_cert_id as mc_no, en.mc_date as mc_issue_date");
        $this->db->from("endorsement as en");
        $this->db->where("endo_id", $id);
        $result = $this->db->get()->result();

        if(count($result) != 1){
          $cert = '';
        }else{
          $cert = $result[0];
        }
        return $cert;
    }

    function mc_get($id = 0){

        $this->db->select("*");
        $this->db->from("medical_certificates");
        $this->db->where("mc_id", $id);
        $result = $this->db->get()->result();

        if(count($result) != 1){
          $cert = '';
        }else{
          $cert = $result[0];
        }
        return $cert;
    }

    function getNoteByAlias($alias = ''){

        $this->db->select("*");
        $this->db->from("note");
        $this->db->where("alias", $alias);
        $result = $this->db->get()->result();

        if(count($result) != 1){
          $note = '';
        }else{
          $note = $result[0];
        }
        return $note;
    }

}
