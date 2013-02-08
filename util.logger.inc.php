<?php

  // util.logger » from php-radutils
  // licensed under the MIT license.
  // see LICENSE for license details.

  declare( encoding = 'UTF-8' );

  namespace Util;

  class Logger
  {
    protected $_file = null;
    protected $_buffer = null;
    public function __construct( $filename, $buffer = false )
    {
      $this->_file = fopen( $filename, 'a' );
      if ( !is_resource( $this->_file ) )
        throw new Exception( 'Could not open log file for writing' );
      if ( ftell( $this->_file ) < 1 )
        fwrite( $this->_file, sprintf( '%c%c%c', 0xEF, 0xBB, 0xBF ) );
      if ( $buffer )
      $this->_buffer = '';
    }
    public function __destruct()
    {
      $this->done();
    }
    public function printf()
    {
      if ( !is_resource( $this->_file ) )
        throw new Exception( 'Log file is not open' );
      if ( func_num_args() < 1 )
        throw new Exception( 'Not enough arguments' );
      $vargs = func_get_args();
      $line = array_splice( $vargs, 0, 1 );
      $line = vsprintf( $line[0], $vargs );
      $rline = sprintf( "[%s] %s\n", date( 'Y-m-d H:i:s' ), $line );
      fwrite( $this->_file, $rline );
      if ( $this->_buffer !== null )
        $this->_buffer .= $rline;
    }
    public function flush()
    {
      if ( !is_resource( $this->_file ) )
        throw new Exception( 'Log file is not open' );
      fflush( $this->_file );
    }
    public function getBuffer()
    {
      return $this->_buffer;
    }
    public function done()
    {
      if ( is_resource( $this->_file ) )
      {
        fflush( $this->_file );
        fclose( $this->_file );
        $this->_file = null;
      }
    }
  }
