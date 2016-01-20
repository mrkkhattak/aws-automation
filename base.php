<?php
/**
 * Base class which contains utils functions
 *
 * @author Meraj Rasool Khattak (www.naqoosh.com)
 * @date 16 October 2015
*/

require 'aws/aws-autoloader.php';

class Base {

	public $properties;
    public $sdk;

	protected function __construct($srv) {

        //initiate SDK
        $this->sdk = $this->initiateSDK();

		//Read selected properties file
		$file = file_get_contents($srv .'.properties', true);
		$this->properties = $this->parseProperties($file);
	}

    private function initiateSDK(){
        $sdk = new Aws\Sdk([
            'region'   => 'us-east-1',
            'version'  => 'latest',
            'credentials' => [
                'key'    => 'AMAZON_ACCESS_KEY',
                'secret' => 'AMAZON_SECRET_KEY'
            ],
            //to provide an up to date certificates bundle to curl
            'ssl.certificate_authority' => 'cacert.pem',
            'http'    => [
                'verify' => 'cacert.pem'
            ]
            //to disable https
            //'scheme' => 'http'
        ]);

        return $sdk;
    }

    /**
     * Modified version of:
     * https://gist.github.com/alecgorge/977771
     *
     * @param $txtProperties
     * @return array
     */
    private function parseProperties($txtProperties) {
		$result = array();
		$lines = split("\n", $txtProperties);
		$key = "";
		$isWaitingOtherLine = false;
		foreach ($lines as $i => $line) {
			if (empty($line) || (!$isWaitingOtherLine && strpos($line, "#") === 0))
				continue;
				
			if (!$isWaitingOtherLine) {
				$key = substr($line, 0, strpos($line, '='));
				$value = substr($line, strpos($line, '=')+1, strlen($line));        
			}
			else {
				$value .= $line;    
			}    
			/* Check if ends with single '\' */
			if (strrpos($value, "\\") === strlen($value)-strlen("\\")) {
				$value = substr($value,0,strlen($value)-1)."\n";
				$isWaitingOtherLine = true;
			}
			else {
				$isWaitingOtherLine = false;
			}

            //make sure to cast value in correct format
            if (is_numeric($value)) {
                if ($value == 0 || $value == 1){
                    $result[$key] = (bool)$value;
                }
                else {
                    $result[$key] = (int)$value;
                }
            }
            else {
                $result[$key] = $value;
            }

			unset($lines[$i]);        
		}

        return $result;
	}
}