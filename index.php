<?php
/**
 * Main entry file which will provide access to application
 *
 * @author Meraj Rasool Khattak (www.naqoosh.com)
 * @date 16 October 2015
*/

ini_set('display_errors', true);
include('ec2.php');
include('iam.php');
include('rds.php');

//Read command line arguments
if (PHP_SAPI === 'cli') {
    if (isset($argv[1])){
        $service = $argv[1];
    }
    if (isset($argv[2])){
	    $action = $argv[2];
    }
}

//Perform action according to the given arguments
if ($service == 'help' ){
    echo 'Only the following commands are supported: '. PHP_EOL;
    echo 'php index.php ec2 create '. PHP_EOL;
    echo 'php index.php ec2 update '. PHP_EOL;
    echo 'php index.php ec2 delete '. PHP_EOL;
    echo 'php index.php ec2 describe_images '. PHP_EOL;
    echo 'php index.php rds create '. PHP_EOL;
    echo 'php index.php rds update '. PHP_EOL;
    echo 'php index.php rds delete '. PHP_EOL;
    echo 'php index.php iam create '. PHP_EOL;
    echo 'php index.php iam update '. PHP_EOL;
    echo 'php index.php iam delete '. PHP_EOL;
    echo 'php index.php iam create_group '. PHP_EOL;
    echo 'php index.php iam add_to_group '. PHP_EOL;
}
elseif (!empty($service) && !empty($action)) {
    //instantiate ec2 service and perform required actions
    if ($service == "ec2") {
        $ec2 = new EC2('ec2');

        if ($action == 'create'){
            $ret_val = $ec2->createInstance();
        }
        elseif ($action == 'update'){
            $ret_val = $ec2->updateInstance();
        }
        elseif ($action == 'delete'){
            $ret_val = $ec2->deleteInstance();
        }
        elseif ($action == 'describe_images'){
            $ret_val = $ec2->describeImages();
            print_r($ret_val);
        }
    }
    //instantiate rds service and perform required actions
    else if ($service == "rds") {
        $rds = new RDS('rds');

        if ($action == 'create'){
            $ret_val = $rds->createInstance();
        }
        elseif ($action == 'update'){
            $ret_val = $rds->updateInstance();
        }
        elseif ($action == 'delete'){
            $ret_val = $rds->deleteInstance();
        }
    }
    //instantiate iam service and perform required actions
    else if ($service == "iam") {
        $iam = new IAM('iam');

        if ($action == 'create'){
            $ret_val = $iam->createUser();
        }
        elseif ($action == 'create_group'){
            $ret_val = $iam->createGroup();
        }
        elseif ($action == 'add_to_group'){
            $ret_val = $iam->addUserToGroup();
        }
        elseif ($action == 'update'){
            $ret_val = $iam->updateUser();
        }
        elseif ($action == 'delete'){
            $ret_val = $iam->deleteUser();
        }
    }
    else {
        'The provided arguments are not supported yet.';
    }
}
else {
	echo "Argument(s) is required for application to work. For help in command type 'php index.php help'";
}

