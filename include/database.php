<?php
// Define constants if they are not defined already
if (!defined('LIB_PATH')) define('LIB_PATH', '/path/to/lib');
if (!defined('DS')) define('DS', '/');
if (!defined('server')) define('server', 'localhost:3307');
if (!defined('user')) define('user', 'username');
if (!defined('pass')) define('pass', 'password');
if (!defined('database_name')) define('database_name', 'dbattendance');

class Database {
    var $sql_string = '';
    var $error_no = 0;
    var $error_msg = '';
    private $conn;
    public $last_query;
    private $real_escape_string_exists;

    function __construct() {
        $this->open_connection();
        // No need to use get_magic_quotes_gpc() in modern PHP versions
        $this->real_escape_string_exists = function_exists("mysqli_real_escape_string");
    }

    public function open_connection() {
        $this->conn = mysqli_connect(server, user, pass);

        if (!$this->conn) {
            throw new Exception("Failed to connect to MySQL: " . mysqli_connect_error());
        }

        $db_select = mysqli_select_db($this->conn, database_name);

        if (!$db_select) {
            throw new Exception("Failed to select database: " . mysqli_error($this->conn));
        }
    }

    function setQuery($sql='') {
        $this->sql_string=$sql;
    }

    function executeQuery() {
        $result = mysqli_query($this->conn,$this->sql_string);
        $this->confirm_query($result);
        return $result;
    }

    private function confirm_query($result) {
        if(!$result){
            $this->error_no = mysqli_errno($this->conn);
            $this->error_msg = mysqli_error($this->conn);
            return false;                
        }
        return $result;
    } 

    function loadResultList( $key='' ) {
        $cur = $this->executeQuery();

        $array = array();
        while ($row = mysqli_fetch_object($cur)) {
            if ($key) {
                $array[$row->$key] = $row;
            } else {
                $array[] = $row;
            }
        }
        mysqli_free_result( $cur );
        return $array;
    }

    function loadSingleResult() {
        $cur = $this->executeQuery();

        while ($row = mysqli_fetch_object($cur)) {
            return $data = $row;
        }
        mysqli_free_result($cur);
    }

    function getFieldsOnOneTable($tbl_name) {

        $this->setQuery("DESC ".$tbl_name);
        $rows = $this->loadResultList();

        $f = array();
        for ( $x=0; $x<count($rows); $x++ ) {
            $f[] = $rows[$x]->Field;
        }

        return $f;
    }   

    public function fetch_array($result) {
        return mysqli_fetch_array($result);
    }

    public function num_rows($result_set) {
        return mysqli_num_rows($result_set);
    }

    public function insert_id() {
        return mysqli_insert_id($this->conn);
    }

    public function affected_rows() {
        return mysqli_affected_rows($this->conn);
    }

    public function escape_value( $value ) {
        if( $this->real_escape_string_exists ) { 
            // No need to check for magic_quotes_active in modern PHP versions
            $value = mysqli_real_escape_string($this->conn,$value);
        } else { 
            // No need to use addslashes() in modern PHP versions
            $value = $value;
        }
        return $value;
    }

    public function close_connection() {
        if(isset($this->conn)) {
            mysqli_close($this->conn);
            unset($this->conn);
        }
    }

} 

try {
    $mydb = new Database();
} catch (Exception $e) {
    echo 'Caught exception: ',  $e->getMessage(), "\n";
}
?>