<?php
class database {
	var $host;
	var $user;
	var $pass;
	var $database;
	var $persistent=0;
	var $last_query;
 	var $result;
	var $connection_id;
	var $num_queries=0;
	var $start_time;
function configure($host, $user, $pass, $database, $persistent=0){
    $this->host=$host;
    $this->user=$user;
    $this->pass=$pass;
    $this->database=$database;
    $this->persistent=$persistent;
    return 1; //Success.
}
function connect(){
    if(!$this->host) { $this->host="localhost"; }
    if(!$this->user) { $this->user="root"; }
    if($this->persistent){
      $this->connection_id=mysql_pconnect($this->host, $this->user, $this->pass) or $this->connection_error();
}else{
      $this->connection_id=mysql_connect($this->host, $this->user, $this->pass, 1) or $this->connection_error();
}
    mysql_select_db($this->database, $this->connection_id);
    return $this->connection_id;
}
function disconnect(){
    if($this->connection_id) { mysql_close($this->connection_id); $this->connection_id=0; return 1; }
    else { return 0; }
}
function change_db($database){
    mysql_select_db($database, $this->connection_id);
    $this->database=$database;
}
function query($query){
    $this->last_query=$query;
    $this->num_queries++;
    $this->result=mysql_query($this->last_query, $this->connection_id) or $this->query_error();
    return $this->result;
}
function fetch_row($result=0){
    if(!$result) { $result=$this->result; }
    return mysql_fetch_assoc($result);
}
function num_rows($result=0){
    if(!$result) { $result=$this->result; }
    return mysql_num_rows($result);
}
function insert_id(){
    return mysql_insert_id($this->connection_id);
}
  function connection_error(){
    die("<b>FATAL ERROR:</b> Could not connect to database on {$this->host} (".mysql_error().")");
}
function query_error(){
    die("<b>QUERY ERROR:</b> ".mysql_error()."<br />
    Query was {$this->last_query}");
}
function fetch_single($result=0){
    if(!$result) { $result=$this->result; }
    return mysql_result($result, 0, 0);
}
function affected_rows($conn = NULL){
    return mysql_affected_rows($this->connection_id);
}
}

?>