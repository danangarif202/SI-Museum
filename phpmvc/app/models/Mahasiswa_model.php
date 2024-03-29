<?php

class Mahasiswa_model {
    /* cara input data menggunakan array
    private $mhs = [
        [
            "nama" => "Dandy Arif",
            "nrp" => "0001",
            "email" => "dandrarif@gmail.com",
            "jurusan" => "Teknik Informatika"
        ],
        [
            "nama" => "Indri Oca",
            "nrp" => "0002",
            "email" => "indrioca_@gmail.com",
            "jurusan" => "Teknik industri"
        ],
        [
            "nama" => "Sri Rahayu",
            "nrp" => "0001",
            "email" => "sri.rahayu1@gmail.com",
            "jurusan" => "Teknik elektro"
        ],
    ];
    */

    /*private $dbh; // database handler
    private $stmt;*/

    private $table = 'mahasiswa';
    private $db;

    public function __construct()
    {
        $this->db = new Database;
    }

    public function getAllMahasiswa()
    {
        $this->db->query('SELECT * FROM ' . $this->table);
        return $this->db->resultSet();
    }


    public function getMahasiswaById($id)
    {
        $this->db->query('SELECT * FROM ' . $this->table . ' WHERE id=:id');

        $this->db->bind('id', $id);
        return $this->db->single();
    }

    public function tambahDataMahasiswa($data)
    {
        $query = "INSERT INTO mahasiswa 
                    VALUES
                    ('', :nama, :nrp, :email, :jurusan)";

        $this->db->query($query);
        $this->db->bind('nama', $data['nama']);
        $this->db->bind('nrp', $data['nrp']);
        $this->db->bind('email', $data['email']);
        $this->db->bind('jurusan', $data['jurusan']);

        $this->db->execute();

        return $this->db->rowCount();
        
    }

    public function hapusDataMahasiswa($id)
    {
        $query = "DELETE FROM mahasiswa WHERE id = :id";
        $this->db->query($query);
        $this->db->bind('id', $id);

        $this->db->execute();

        return $this->db->rowCount();
    }


}