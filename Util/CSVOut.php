<?php

  // util.csv » from php-radutils
  // licensed under the MIT license.
  // see LICENSE for license details.

  declare( encoding = 'UTF-8' );

  namespace Util;

  class CSVOut
  {
    const Delimiter = ',';
    protected $_file = null;
    public function __construct( $filename )
    {
      $this->_file = fopen( $filename, 'a' );
      if ( !is_resource( $this->_file ) )
        throw new \RuntimeException( 'Could not open CSV file for writing' );
      if ( ftell( $this->_file ) < 1 )
        fwrite( $this->_file, sprintf( '%c%c%c', 0xEF, 0xBB, 0xBF ) );
    }
    public function __destruct()
    {
      $this->done();
    }
    protected static function walk( &$value, $key )
    {
      $value = '"' . implode( '""', mb_split( '"', $value ) ) . '"';
    }
    public function row( array $values )
    {
      array_walk( $values, array( $this, 'walk' ) );
      $line = sprintf( "%s\r\n", implode( self::Delimiter, $values ) );
      fwrite( $this->_file, $line );
    }
    public function flush()
    {
      if ( !is_resource( $this->_file ) )
        throw new \RuntimeException( 'CSV file is not open' );
      fflush( $this->_file );
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
