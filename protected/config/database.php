<?php
/* Silakan konfigurasi koneksi database
 * 'connectionString' => 'mysql:host=localhost;dbname=nama database'
 * 'username' => 'nama pengguna di database',
 * 'password' => 'kata sandi database',
 */
return array(	    
        'pdoClass' => 'NestedPDO',        
        'connectionString' => 'pgsql:host=localhost;port=5432;dbname=kolekin',
	    'emulatePrepare' => true,
	    'username' => 'bukapeta',
	    'password' => 'bukapeta',
	    'charset' => 'utf8',
	    'tablePrefix' => 'kolekin_',
	    );
?> 
