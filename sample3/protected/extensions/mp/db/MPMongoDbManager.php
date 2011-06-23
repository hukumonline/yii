<?php
class MPMongoDbManager extends CApplicationComponent
{
	private $_collection;
	public $readServersConnectionString = array();
	public $writeServerConnectionString; // string "master.example.com:27017"
	public $dbName;
	
	private $_readServers;
	private $_writeServer;
	
	public function init()
	{
		$this->_writeServer = new Mongo($this->writeServerConnectionString);
		if(count($this->readServersConnectionString)>0)
		{
			$this->_readServers = array();
			for($i=0;$i<count($this->readServersConnectionString);$i++)
			{
				$this->_readServers[$i] = new Mongo($this->readServersConnectionString[$i]);
			}
		}
		else
			$this->_readServers = array($this->_writeServer);
		
		//echo "MongoDb init()<br>";
	}
	public function getCollection($collectionName)
	{
		MongoCursor::$slaveOkay = true;
		
		//if empty($this->dbName) throw error;
		$dbName = $this->dbName;
		Yii::import('application.extensions.mp.db.mongodb.*');
		$this->_collection = new MongoMSCollection($this->_writeServer->$dbName, $collectionName);
		$this->_collection->addSlaves($this->_readServers);
		
		return $this->_collection;
	}
}
?>