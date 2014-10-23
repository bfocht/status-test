<?php
class Database{

  private $db_host = "localhost";  // Change as required
  private $db_user = "username";  // Change as required
  private $db_pass = "password";  // Change as required
  private $db_name = "database";  // Change as required
  
  public function select($url, $default){
    $this->tableExists("STATUS_LIST");
    $mysqli = new mysqli($this->db_host,$this->db_user,$this->db_pass, $this->db_name);
    $sql = "SELECT STATUS FROM STATUS_LIST WHERE URI = ?";
    $stmt = mysqli_prepare($mysqli, $sql);
    if ($stmt == FALSE) { return $default; }
    mysqli_stmt_bind_param($stmt,"s", $url);
    mysqli_stmt_execute($stmt);
    mysqli_stmt_bind_result($stmt, $status);
    mysqli_stmt_fetch($stmt);
    mysqli_stmt_close($stmt);
    $mysqli->close();
    return $status;
  }
  
  public function update($url, $status){
    $mysqli = new mysqli($this->db_host,$this->db_user,$this->db_pass, $this->db_name);
    $sql = "INSERT INTO STATUS_LIST(URI,STATUS) VALUES( ?, ?)
    ON DUPLICATE KEY UPDATE STATUS=?";
    $stmt = mysqli_prepare($mysqli, $sql);
    mysqli_stmt_bind_param($stmt,"sss", $url, $status, $status);
    mysqli_stmt_execute($stmt);
    mysqli_stmt_close($stmt);
    $mysqli->close();
    return $status;
  }
  
  // Private function to check if table exists for use with queries
  private function tableExists($table){
    $mysqli = new mysqli($this->db_host, $this->db_user, $this->db_pass, $this->db_name);
    if (mysqli_connect_errno()) {
      printf("Connect failed: %s\n", mysqli_connect_error());
      exit();
    }
    $tablesInDb = mysqli_query($mysqli, 'SHOW TABLES FROM '.$this->db_name.' LIKE "'.$table.'"');
    if(mysqli_num_rows($tablesInDb)==0){
      $query = 'CREATE TABLE IF NOT EXISTS '.$table.' (
        URI varchar(255) NOT NULL,
        STATUS varchar(255),
        PRIMARY KEY  (URI)
        )';
      mysqli_query($mysqli, $query);
    }
    $mysqli->close();
  }
}

?>