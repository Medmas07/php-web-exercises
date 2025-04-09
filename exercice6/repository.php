<?php
  class Repository {
    private $db;
    private $table;
    
    public function __construct($db, $table) {
      $this->db = $db;
      $this->table = $table;
    }

    public function getAll(){
      $query = "SELECT * FROM " . $this->table;
      $req = $this->db->prepare($query);
      $req->execute();
      return $req->fetchAll(PDO::FETCH_ASSOC);
    }

    public function getById($id){
      $query = "SELECT * FROM " . $this->table . " WHERE id = :id";
      $req = $this->db->prepare($query);
      $req->bindParam(':id', $id, PDO::PARAM_INT);
      $req->execute();
      return $req->fetch(PDO::FETCH_ASSOC);
    }

    public function add($data){
      $columns = implode(", ", array_keys($data));
      $placeholders = ":" . implode(", :", array_keys($data));
      $query = "INSERT INTO " . $this->table . " ($columns) VALUES ($placeholders)";
      $req = $this->db->prepare($query);
      return $req->execute($data);
    }

    public function delete($id){
      $query = "DELETE FROM " . $this->table . " WHERE id = :id";
      $req = $this->db->prepare($query);
      return $req->execute([':id' => $id]);
    }
      

  }