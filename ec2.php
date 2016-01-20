<?php
/**
 * EC2 class which contains ec2 related automation functions
 *
 * @author Meraj Rasool Khattak (www.naqoosh.com)
 * @date 16 October 2015
*/

require_once('base.php');

class EC2 extends Base {

	function __construct($srv) {
		parent::__construct($srv);
	}
	
	public function createInstance(){
        $ec2 = $this->sdk->createEc2();
        $result = $ec2->runInstances($this->properties);
        return $result;
	}
	
	public function updateInstance(){
        echo 'update instance';
	}
	
	public function deleteInstance(){
        echo 'delete instance';
	}

    public function describeImages(){
        $ec2 = $this->sdk->createEc2();
        $result = $ec2->describeImages();
        return $result;
    }

}