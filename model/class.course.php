<?php
class Gradebook {
    // declare private field
    private $mysqli;
    
    // declare constructor
    function __construct() {
        // connect to filmcollector MySQL database
        // assign connection to field
        $this->mysqli = new mysqli('localhost:3306', 'root', '', 'gradebook');
    }
    
    // declare destructor
    function __destruct() {
        // close connection to filmcollector MySQL database
        $this->mysqli->close();
    }
    
    // declare getter 
    public function get_mysqli() {
        return $this->mysqli;
    }
    
    public function select_gradebook_results($name, $prof_id) {
        
        $courseName = '%';
        $courseName .= $name;
        $courseName .= '%';
        
        // format select statement as a String
        $sql = "SELECT name, id, prof_fname, prof_lname  " .
                "FROM professor, courses " .
                "WHERE professor.prof_id = courses.prof_id ".
                "AND courses.prof_id = $prof_id ". 
                "AND name LIKE '$courseName'";
        
        // execute select statement
        // assign return value to variable
        // allow only one query to be executed
        // at a time for security
        $retval = $this->mysqli->query($sql);        
        
        //return result of executing select statement
        return $retval;
    }
}
?>