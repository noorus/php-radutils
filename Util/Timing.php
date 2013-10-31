<?php

  // Util\Timing » from php-radutils
  // licensed under the MIT license.
  // see LICENSE for license details.

  declare( encoding = 'UTF-8' );

  namespace Util;

  class Timing
  {
    protected $_tasks = array();
    public function __construct()
    {
      $this->begin();
    }
    public function begin()
    {
      $time = microtime( true );
      array_push( $this->_tasks, $time );
    }
    public function end()
    {
      $time = microtime( true );
      $stime = array_pop( $this->_tasks );
      if ( $stime === null )
        return 0;
      return $time - $stime;
    }
    public function done()
    {
    if ( count( $this->_tasks ) != 1 )
      throw new \RuntimeException( 'One or more unmatched begin/end calls detected' );
      return $this->end();
    }
  }
