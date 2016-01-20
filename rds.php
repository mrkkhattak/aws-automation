<?php
/**
 * RDS class which contains rds related automation functions
 *
 * @author Meraj Rasool Khattak (www.naqoosh.com)
 * @date 16 October 2015
*/

require_once('base.php');

class RDS extends Base {

	function __construct($srv) {
		parent::__construct($srv);
	}
	
	public function createInstance(){
        $rds = $this->sdk->createRds();
        $result = $rds->createDBInstance($this->properties);

        return $result;
	}
	
	public function updateInstance(){
		//modifyDBInstance
	}
	
	public function deleteInstance(){
		//deleteDBInstance
	}
}