<?php
class MongoMSCollection extends MongoCollection {
    public $currentSlave = -1;
 	public $numSlaves = 0;

    // call this once to initialize the slaves
    public function addSlaves($slaves) {
        // extract the namespace for this collection: db name and collection name
        $db = $this->db->__toString();
        $c = $this->getName();
 
        // create an array of MongoCollections from the slave connections
        $this->slaves = array();
		$i = 0;
        foreach ($slaves as $slave) {
            $this->slaves[$i] = $slave->$db->$c;
			$i++;
        }
 		
        $this->numSlaves = count($this->slaves);
    }
 
    public function find($query=array(), $fields=array()) {
        // get the next slave in the array
        $this->currentSlave = ($this->currentSlave+1) % $this->numSlaves;
 
        // use a slave connection to do the query
        return $this->slaves[$this->currentSlave]->find($query, $fields);
    }
}

?>