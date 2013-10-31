php-radutils
============

Small library of minimal, namespaced utility classes for rapid PHP development.

Usage
-----

Add the root as a dependency to a PSR-0 compatible autoloader, or include needed files directly.

Components
----------

### Logger

Used for writing timestamped log files.  
Data is expected to be UTF-8; UTF-8 BOM is written automatically.  
If the file already exists, it will be appended to.

    $log = new \Util\Logger( 'my-logfile.log' );
    $log->printf( 'It\'s such a %s day to say %d!', 'lovely', 1234 );
    $log->done();

### Timing

Used for micro-timing operations.

    $timing = new \Util\Timing();
    $timing->begin();
    // Sub-operation 1
    printf( 'Sub-operation 1 took %f seconds', $timing->end() );
    $timing->begin();
    // Sub-operation 2
    printf( 'Sub-operation 2 took %f seconds', $timing->end() );
    printf( 'Everything took %f seconds', $timing->done() );

### QuickXMLOut

Used for generating XML output with minimal code.  
Acts as a simplifying wrapper around XMLWriter.  
Allows chaining of calls. Only UTF-8 data in & out.

    $xml = new \Util\QuickXMLOut();
    $xml->start( 'list' )->attribute( 'type', 'shopping' );
    $xml->element( 'item', 'cucumber' );
    $xml->element( 'item', 'potatoe' );
    $xml->element( 'item', 'ham' );
    $xml->end(); // end list
    print( $xml->done() ); // get output

### CSVOut

Used for writing CSV files.  
Data is expected to be UTF-8; UTF-8 BOM is written automatically.  
If the file already exists, it will be appended to.

    $csv = new \Util\CSVOut( 'my-csvfile.csv' );
    $csv->row( array( 'foo', 'bar', ' "foobar" ' ) );
    $csv->done();

License
-------

Files in php-radutils are licensed under the MIT license.  
For full license text, see the LICENSE file.
