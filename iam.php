<?php
/**
 * IAM class which contains iam related automation functions
 *
 * @author Meraj Rasool Khattak (www.naqoosh.com)
 * @date 16 October 2015
*/

require_once('base.php');

class IAM extends Base {

	function __construct($srv) {
		parent::__construct($srv);
	}
	
	public function createUser(){
        $iam = $this->sdk->createIam();
        $result = $iam->createUser(array('UserName' => $this->properties['UserName'], 'Path' => $this->properties['Path']));
        return $result;
	}
	
	public function updateUser(){
		//updateUser
	}
	
	public function deleteUser(){
		//deleteUser
	}

    public function createGroup(){
        $iam = $this->sdk->createIam();
        $result = $iam->createGroup(array('GroupName' => $this->properties['GroupName'], 'Path' => $this->properties['Path']));
        return $result;
    }

    public function addUserToGroup(){
        $iam = $this->sdk->createIam();
        $result = $iam->addUserToGroup(array('GroupName' => $this->properties['GroupName'], 'UserName' => $this->properties['UserName']));
        return $result;
    }
}