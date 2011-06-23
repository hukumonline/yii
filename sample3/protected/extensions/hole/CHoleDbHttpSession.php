<?php
/**
 * CDbHttpSession class
 *
 * @author Qiang Xue <qiang.xue@gmail.com>
 * @link http://www.yiiframework.com/
 * @copyright Copyright &copy; 2008-2010 Yii Software LLC
 * @license http://www.yiiframework.com/license/
 */

/**
 * CDbHttpSession extends {@link CHttpSession} by using database as session data storage.
 *
 * CDbHttpSession stores session data in a DB table named 'YiiSession'. The table name
 * can be changed by setting {@link sessionTableName}. If the table does not exist,
 * it will be automatically created if {@link autoCreateSessionTable} is set true.
 *
 * The following is the table structure:
 *
 * <pre>
 * CREATE TABLE YiiSession
 * (
 *     id CHAR(32) PRIMARY KEY,
 *     expire INTEGER,
 *     data TEXT
 * )
 * </pre>
 *
 * CDbHttpSession relies on {@link http://www.php.net/manual/en/ref.pdo.php PDO} to access database.
 *
 * By default, it will use an SQLite3 database named 'session-YiiVersion.db' under the application runtime directory.
 * You can also specify {@link connectionID} so that it makes use of a DB application component to access database.
 *
 * When using CDbHttpSession in a production server, we recommend you pre-create the session DB table
 * and set {@link autoCreateSessionTable} to be false. This will greatly improve the performance.
 * You may also create a DB index for the 'expire' column in the session table to further improve the performance.
 *
 * @author Qiang Xue <qiang.xue@gmail.com>
 * @version $Id: CDbHttpSession.php 1781 2010-02-01 20:37:46Z qiang.xue $
 * @package system.web
 * @since 1.0
 */
class CHoleDbHttpSession extends CHttpSession
{
	/**
	 * @var string the ID of a {@link CDbConnection} application component. If not set, a SQLite database
	 * will be automatically created and used. The SQLite database file is
	 * is <code>protected/runtime/session-YiiVersion.db</code>.
	 */
	public $connectionID;
	/**
	 * @var string the name of the DB table to store session content.
	 * Note, if {@link autoCreateSessionTable} is false and you want to create the DB table manually by yourself,
	 * you need to make sure the DB table is of the following structure:
	 * <pre>
	 * (id CHAR(32) PRIMARY KEY, expire INTEGER, data TEXT)
	 * </pre>
	 * @see autoCreateSessionTable
	 */
	public $sessionTableName='KutuSession';
	/**
	 * @var boolean whether the session DB table should be automatically created if not exists. Defaults to true.
	 * @see sessionTableName
	 */
	public $autoCreateSessionTable=false;
	/**
	 * @var CDbConnection the DB connection instance
	 */
	private $_db;


	/**
	 * Returns a value indicating whether to use custom session storage.
	 * This method overrides the parent implementation and always returns true.
	 * @return boolean whether to use custom storage.
	 */
	public function getUseCustomStorage()
	{
		return true;
	}

	/**
	 * Creates the session DB table.
	 * @param CDbConnection the database connection
	 * @param string the name of the table to be created
	 */
	protected function createSessionTable($db,$tableName)
	{
		return true;
	}

	/**
	 * @return CDbConnection the DB connection instance
	 * @throws CException if {@link connectionID} does not point to a valid application component.
	 */
	protected function getDbConnection()
	{
		if($this->_db!==null)
			return $this->_db;
		else if(($id=$this->connectionID)!==null)
		{
			if(($this->_db=Yii::app()->getComponent($id)) instanceof CDbConnection)
				return $this->_db;
			else
				throw new CException(Yii::t('yii','CHoleDbHttpSession.connectionID "{id}" is invalid. Please make sure it refers to the ID of a CDbConnection application component.',
					array('{id}'=>$id)));
		}
		else
		{
			$dbFile=Yii::app()->getRuntimePath().DIRECTORY_SEPARATOR.'session-'.Yii::getVersion().'.db';
			return $this->_db=new CDbConnection('sqlite:'.$dbFile);
		}
	}
	public function open()
	{
		if($this->getUseCustomStorage())
			@session_set_save_handler(array($this,'openSession'),array($this,'closeSession'),array($this,'readSession'),array($this,'writeSession'),array($this,'destroySession'),array($this,'gcSession'));
		
		
		$aServerName = explode('.', $_SERVER['SERVER_NAME']);

		$count = count($aServerName);
		$domainName = '.'.$aServerName[$count-2].'.'.$aServerName[$count-1];
		
		//$some_name = session_name("some_name");
		session_set_cookie_params(0, '/', $domainName);
		
		@session_start();
	}

	/**
	 * Session open handler.
	 * Do not call this method directly.
	 * @param string session save path
	 * @param string session name
	 * @return boolean whether session is opened successfully
	 */
	public function openSession($savePath,$sessionName)
	{
		
		$db=$this->getDbConnection();
		$db->setActive(true);
		
		global $sess_save_path;
		$sess_save_path = $savePath;

		return true;
	}

	/**
	 * Session read handler.
	 * Do not call this method directly.
	 * @param string session ID
	 * @return string the session data
	 */
	public function readSession($id)
	{
		$time = time();
		
		$sql = "SELECT sessionData FROM {$this->sessionTableName} WHERE sessionId=:id AND sessionExpiration > FROM_UNIXTIME($time)";
		
		$data=$this->getDbConnection()->createCommand($sql)->bindValue(':id',$id)->queryScalar();
	
		return $data===false?'':$data;
	}

	/**
	 * Session write handler.
	 * Do not call this method directly.
	 * @param string session ID
	 * @param string session data
	 * @return boolean whether session write is successful
	 */
	public function writeSession($id,$data)
	{
		
		$lifeTime = ini_get('session.gc_maxlifetime'); //get_cfg_var("session.gc_maxlifetime");
		$time = time() + $lifeTime - 600;
		
		$expire=$time;
		$db=$this->getDbConnection();
		$sql="SELECT sessionId FROM {$this->sessionTableName} WHERE sessionId=:id";
		
		if($db->createCommand($sql)->bindValue(':id',$id)->queryScalar()===false)
			$sql="INSERT INTO {$this->sessionTableName} VALUES (:id, :data, FROM_UNIXTIME($expire))";
		else
			$sql="UPDATE {$this->sessionTableName} SET sessionExpiration=FROM_UNIXTIME($expire), sessionData=:data WHERE sessionId=:id";
			
		$db->createCommand($sql)->bindValue(':id',$id)->bindValue(':data',$data)->execute();
		return true;
	}

	/**
	 * Session destroy handler.
	 * Do not call this method directly.
	 * @param string session ID
	 * @return boolean whether session is destroyed successfully
	 */
	public function destroySession($id)
	{	
		$sql="DELETE FROM {$this->sessionTableName} WHERE sessionId=:id";
		$this->getDbConnection()->createCommand($sql)->bindValue(':id',$id)->execute();
		return true;
	}

	/**
	 * Session GC (garbage collection) handler.
	 * Do not call this method directly.
	 * @param integer the number of seconds after which data will be seen as 'garbage' and cleaned up.
	 * @return boolean whether session is GCed successfully
	 */
	public function gcSession($maxLifetime)
	{
		// Garbage Collection
		$time = time();
		
		$db=$this->getDbConnection();
		$db->setActive(true);
		$sql="DELETE FROM {$this->sessionTableName} WHERE sessionExpiration < FROM_UNIXTIME($time)";
		$db->createCommand($sql)->execute();
		return true;
	}
}
