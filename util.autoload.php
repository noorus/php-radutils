<?php

  // util.autoload » from php-radutils
  // licensed under the MIT license.
  // see LICENSE for license details.

  declare( encoding = 'UTF-8' );

  namespace Util;

  class ClassLoader
  {
    public static function register()
    {
      spl_autoload_register( array( 'Util\ClassLoader', 'load' ) );
    }
    protected static function load( $class )
    {
      switch ( $class )
      {
        case 'Util\Logger':
          require_once( 'util.logger.inc.php' );
        break;
        case 'Util\Timing':
          require_once( 'util.timing.inc.php' );
        break;
        case 'Util\QuickXMLOut':
          require_once( 'util.quickxml.inc.php' );
        break;
        case 'Util\CSVOut':
          require_once( 'util.csv.inc.php' );
        break;
      }
    }
  }

  ClassLoader::register();
