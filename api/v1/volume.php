<?php
// initialize variables
$method	 	= (isset($_REQUEST['method']))? $_REQUEST['method']: 'set';
$wav 		= FALSE;	// wav file to be played upon completion

// grab current volume
$volume 	= json_decode(file_get_contents($_SERVER['DOCUMENT_ROOT']."/api/v1/data/volume.json"),TRUE);
$muted 		= $volume['mute'];
$volume 	= $volume['volume'];

switch($method):
	// ?method=set&volume=X
	case "set":
		// init vars
		$volume 	= (isset($_REQUEST['volume']))? $_REQUEST['volume']: '50';
		break;
	// ?method=up
	case "up":
		$volume	= ($volume < 100)? $volume + 10: 100;
		break;
	// ?method=down
	case "down":
		$volume	= ($volume > 0)? $volume - 10: 0;
		break;
	case "mute":
		$muted 	= ! $muted;
endswitch;

// run the command
$command 	= ($method == 'mute')? 'sudo -u pi mute': 'sudo -u pi volume '.$volume;
$output 	= system($command);

// input new volume into file
file_put_contents($_SERVER['DOCUMENT_ROOT'].'/api/v1/data/volume.json',json_encode(array('volume' => $volume,'mute' => $muted)));

// see if we need to run a response WAV
if ($wav)
	shell_exec('aplay '.$_SERVER['DOCUMENT_ROOT'].'/api/v1/wav/'.$wav);

echo json_encode(array('success' => $output));