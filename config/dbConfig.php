<?php
if ( false )     {
    define('DB_RDBMS','pgsql');  // mysql, pgsql, ...
    define('DB_DATABASE','todo2');
    define('DB_USER','postgres');
    define('DB_PASSWORD','fapapucs');
    define('DB_HOST','localhost');
    define('DB_PORT','5432');  //  mysql:3306, pgsql:5432

} else {
    define('DB_RDBMS','mysql');  // mysql, pgsql, ...
    define('DB_DATABASE','testapi');
    define('DB_USER','root');
    define('DB_PASSWORD','');
    define('DB_HOST','localhost');
    define('DB_PORT','3306');  //  mysql:3306, pgsql:5432
}
