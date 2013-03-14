<?php

class AutoLoader {
    private static $classes = array();
    
    public static function registerDirectory( $dir ) {
        $iterator = new DirectoryIterator( $dir );
        
        foreach ( $iterator as $file ) {
            if ( $file->isDir() && !$file->isLink() && !$file->isDot() ) {
                self::registerDirectory( $file->getPathname() );
            }
            else if ( substr( $file->getFilename(), -4 ) == '.php' ) {
                $class = substr( $file->getFilename(), 0, -4 );
                self::registerClass( $class, $file->getPathname() );
            }
        }
    }
    
    public static function registerClass( $class, $fileName ) {
        self::$classes[ $class ] = $fileName;
    }
    
    public static function loadClass( $className ) {
        $classParts = explode( '\\', $className );
        $className = end( $classParts );
        
        if ( isset( self::$classes[ $className ] ) ) {
            require_once self::$classes[ $className ];
        }
    }
}

set_include_path( get_include_path() . PATH_SEPARATOR . '/usr/lib/php/PHPUnit' );
spl_autoload_register( array( 'AutoLoader', 'loadClass' ) );

Autoloader::registerDirectory( '../src/' );
AutoLoader::registerDirectory( 'lib/' );

require_once 'PHPUnit/Autoload.php';