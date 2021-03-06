#!/usr/bin/env php
<?php

/*
 * This script can be used to generate metadata for simpleSAMLphp
 * based on an XML metadata file.
 */


/* This is the base directory of the simpleSAMLphp installation. */
$baseDir = dirname(dirname(dirname(dirname(__FILE__))));

/* Add library autoloader. */
require_once($baseDir . '/lib/_autoload.php');

/* Initialize the configuration. */
SimpleSAML_Configuration::setConfigDir($baseDir . '/config');

/* $outputDir contains the directory we will store the generated metadata in. */
$outputDir = $baseDir . '/metadata-generated';


/* $toStdOut is a boolean telling us wheter we will print the output to stdout instead
 * of writing it to files in $outputDir.
 */
$toStdOut = FALSE;

/* $validateFingerprint contains the fingerprint of the certificate which should have been used
 * to sign the EntityDescriptor in the metadata, or NULL if fingerprint validation shouldn't be
 * done.
 */
$validateFingerprint = NULL;

/* $CA contains a path to a PEM file with certificates which are trusted,
 * or NULL if we don't want to verify certificates this way.
 */
$ca = NULL;

/* This variable contains the files we will parse. */
$files = array();

/* Parse arguments. */

$progName = array_shift($argv);

foreach($argv as $a) {
	if(strlen($a) === 0) {
		continue;
	}

	if($a[0] !== '-') {
		/* Not an option. Assume that it is a file we should parse. */
		$files[] = $a;
		continue;
	}

	if(strpos($a, '=') !== FALSE) {
		$p = strpos($a, '=');
		$v = substr($a, $p + 1);
		$a = substr($a, 0, $p);
	} else {
		$v = NULL;
	}

	/* Map short options to long options. */
	$shortOptMap = array(
		'-h' => '--help',
		'-o' => '--out-dir',
		'-s' => '--stdout',
		);
	if(array_key_exists($a, $shortOptMap)) {
		$a = $shortOptMap[$a];
	}

	switch($a) {
	case '--validate-fingerprint':
		if($v === NULL || strlen($v) === 0) {
			echo('The --validate-fingerprint option requires an parameter.' . "\n");
			echo('Please run `' . $progName . ' --help` for usage information.' . "\n");
			exit(1);
		}
		$validateFingerprint = $v;
		break;
	case '--ca':
		if($v === NULL || strlen($v) === 0) {
			echo('The --ca option requires an parameter.' . "\n");
			echo('Please run `' . $progName . ' --help` for usage information.' . "\n");
			exit(1);
		}
		$ca = $v;
		break;
	case '--help':
		printHelp();
		exit(0);
	case '--out-dir':
		if($v === NULL || strlen($v) === 0) {
			echo('The --out-dir option requires an parameter.' . "\n");
			echo('Please run `' . $progName . ' --help` for usage information.' . "\n");
			exit(1);
		}
		$outputDir =  $baseDir . $v;
		break;
	case '--stdout':
		$toStdOut = TRUE;
		break;
	default:
		echo('Unknown option: ' . $a . "\n");
		echo('Please run `' . $progName . ' --help` for usage information.' . "\n");
		exit(1);
	}
}

if(count($files) === 0) {
	echo($progName . ': Missing input files. Please run `' . $progName . ' --help` for usage information.' . "\n");
	exit(1);
}




/* The metadata global variable will be filled with the metadata we extract. */
$metaloader = new sspmod_metarefresh_MetaLoader();

foreach($files as $f) {
	$source = array('src' => $f);
	if (isset($validateFingerprint)) $source['validateFingerprint'] = $validateFingerprint;
	$metaloader->loadSource($source);
}

if($toStdOut) {
	$metaloader->dumpMetadataStdOut();
} else {
	$metaloader->writeMetadataFiles($outputDir);
}

exit(0);

/**
 * This function prints the help output.
 */
function printHelp() {
	global $progName;

	/*   '======================================================================' */
	echo('Usage: ' . $progName . ' [options] [files]' . "\n");
	echo("\n");
	echo('This program parses a SAML metadata files and output pieces that can' . "\n");
	echo('be added to the metadata files in metadata/.' . "\n");
	echo("\n");
	echo('Options:' . "\n");
	echo('     --validate-fingerprint=<FINGERPRINT>' . "\n");
	echo('                              Check the signature of the metadata,' . "\n");
	echo('                              and check the fingerprint of the' . "\n");
	echo('                              certificate against <FINGERPRINT>.' . "\n");
	echo('     --ca=<PEM file>          Use the given PEM file as a source of' . "\n");
	echo('                              trusted root certificates.' . "\n");
	echo(' -h, --help                   Print this help.' . "\n");
	echo(' -o=<DIR>, --out-dir=<DIR>    Write the output to this directory. The' . "\n");
	echo('                              default directory is metadata-generated/' . "\n");
	echo(' -s, --stdout                 Write the output to stdout instead of' . "\n");
	echo('                              seperate files in the output directory.' . "\n");
	echo("\n");
}





