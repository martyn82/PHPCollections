<?php
$testPath = realpath( __DIR__ );
$sourcePath = realpath( __DIR__ . DIRECTORY_SEPARATOR . '../src' );

spl_autoload_register( function ( $className ) use ( $testPath, $sourcePath ) {
	$fileName = str_replace( '\\', DIRECTORY_SEPARATOR, $className ) . '.php';

	$paths = array( $testPath, $sourcePath );

	foreach ( $paths as $path ) {
		@include_once $path . DIRECTORY_SEPARATOR . $fileName;
	}
} );

require_once 'PHPUnit' . DIRECTORY_SEPARATOR . 'Autoload.php';
