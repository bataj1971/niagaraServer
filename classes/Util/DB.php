<?php

namespace Util;

use Exceptions\RestApiException;
use Config\Config;
use Util\Logger;

/**
 * Description of DB
 *
 * @author Bata Jozsef 
 */
class DB
{

    /**
     * database connenction
     */
    protected \PDO $con;

    protected array $dbSettings =[];
    /**
     * last error message
     * @var type string
     */
    protected static string $error = ""; // last errormesage

    /**
     * true if transaction started allready     
     */
    protected bool $transactionStarted = false;

    /*
     * @var type DB
     */
    private static ?DB $dbInstance = null;

    /**
     *  @var bool|null 
     * 
     */
    private static ?DB $dbInstanceNoTransactions = null;



    /**
     * 
     * @param bool $useTransactions
     * @return \DB
     */
    public static function getInstance(bool $useTransactions = true): DB
    {

        if (!$useTransactions) {
            if (self::$dbInstanceNoTransactions == null) {
                self::$dbInstanceNoTransactions = new DB(false);
            }

            return self::$dbInstanceNoTransactions; // return instance with no transaction
        }

        if (self::$dbInstance == null) {
            self::$dbInstance = new DB();
        }

        return self::$dbInstance;
    }

    /**
     * 
     * @param bool $useTransactions
     * @throws Exception
     */
    private function __construct(bool $useTransactions = true)
    {

        $config = Config::getInstance();

        $this->dbSettings = $config->getValue("db");
        $dbRdbms = $config->getValue("db/rdbms");
        $dbHost = $config->getValue("db/host");
        $dbPort = $config->getValue("db/port");
        $dbName = $config->getValue("db/name") ?? '';
        $dbUser = $config->getValue("db/user") ?? '';
        $dbPassword = $config->getValue("db/password") ?? '';

        $pdostring = "{$dbRdbms}:host={$dbHost};dbname={$dbName};port={$dbPort}";

        // setting utf-8 charset - pgsql pdo driver needs some special care..
        if ($dbRdbms == 'pgsql') {
            $pdostring .= ";options='--client_encoding=UTF8'";
        } else {
            $pdostring .= ';charset=utf8';
        }

        $options = [
            \PDO::ATTR_ERRMODE            => \PDO::ERRMODE_EXCEPTION,
        ];

        if (!$this->con = new \PDO($pdostring, $dbUser, $dbPassword, $options)) {
            Logger::getInstance()->error("DB : Connection error: {$dbHost}:{$dbPort} /{$dbUser}/{$dbName} Check /config/config.default.json and /config/config.json");
            throw new \Exception("DB connection error: Check errorlogs");
        }
        $this->con->setAttribute(\PDO::ATTR_ERRMODE, \PDO::ERRMODE_EXCEPTION);

        if (!$this->transactionStarted and $useTransactions) {
            $this->startTransaction();
        }
    }

    /**
     * Starts database transaction, and sets $transactionStarted static property to true.
     * @throws Exception if transactin allready started or starting transaction fails.
     */
    public function startTransaction()
    {

        if ($this->transactionStarted) {
            throw new RestApiException("DB : Transaction more than once");
        }
        if ($this->con->beginTransaction()) {
            $this->transactionStarted = true;
        } else {
            throw new RestApiException("DB : Could not start transaction");
        }
    }

    /**
     * Commits database transaction
     * Should be called automatically on end of service call.
     * @throws Exception if commit fails
     */
    public function commitTransaction(): void
    {
        if (!$this->transactionStarted) {
            return;
        }

        if ($this->con->commit()) {
            $this->transactionStarted = false;
        } else {
            throw new RestApiException("DB : Transaction commit failed");
        }
    }

    /**
     * rollbacks all database modifications since last startTransaction call. 
     * Should be called if, any read/write error occurs in service.
     * @throws Exception if rollback failed.
     */
    public function rollbackTransaction(): void
    {

        if ($this->con->rollback()) {
            $this->transactionStarted = false;
        } else {
            throw new RestApiException("DB : Transaction rollback failed");
        }
    }

    /**
     * Runs an sql-query  expression
     * @param string $sql - sql expression - should be a select. ( for insert/update please use the insert/update methos of this class)
     * @param string $idField - fieldId - if given, result will be an asociative array. The keys will be the values of idField 
     * @return array - array or associative array ( see idField )
     * @throws Exception - if error occures on running sql expression on db
     */
    public function query(string $sql, array $values = [], string $idField = ''): array
    {

        try {
            $pdoStatement = $this->con->prepare($sql);
            $pdoStatement->execute($values);
        } catch (\Exception $exc) {
            Logger::getInstance('sql_error')->log($exc->getMessage()."\nSQL:\n".$sql);
            throw new RestApiException("PDO-querry error: " . $exc->getMessage());
        }

        $array = [];

        if ($idField) { // making associative array with the choses idfield  as key
            foreach ($pdoStatement->fetchAll(\PDO::FETCH_ASSOC) as $row) {
                $array[$row[$idField]] = $row;
            }
        } else {  // without keys
            $array = $pdoStatement->fetchAll(\PDO::FETCH_ASSOC);
        }

        return $array;
    }

    /**
     * queryOne
     *
     * @param  string $sql
     * @param  array $values
     * @return array
     */
    public function queryOne(string $sql, array $values = []): array
    {
        $resultset = $this->query($sql, $values);
        if (count($resultset) != 1) {
            throw new RestApiException("query should return only one record");
        }
        return reset($resultset);
    }

    /**
     * Runs an sql-insert  expression
     * @param string $sql - sql expression - should be an insert. ( for query/update please use the query/update methos of this class)    
     * @return associative array ( contains key/value pairs of record fields )
     * @throws Exception - if error occures on running sql expression on db
     */
    public function runInsertQuery(string $sql, array $values): string
    {
        try {

            $statement = $this->con->prepare($sql);
            $statement->execute($values);
            $lastInsertId = $this->con->lastInsertId();    
        } catch (\PDOException $exc) {

            $errorList = [];
            if ($exc->getCode() == '23000') {
                $message = $exc->getMessage();
                // "SQLSTATE[23000]: Integrity constraint violation: 1062 Duplicate entry 'test2' for key 'loginname'"
                $fieldName = stristr($message, "' for key '") ?? 'unknown';
                $fieldName = substr($fieldName, 11, -1);
                $errorList['fields'][$fieldName] = 'Must be unique';
                $errorList['errorinfo'] = $exc->errorInfo;
            }
            throw new RestApiException("PDO insert-query error: " . $exc->getMessage(), 403, $errorList);
        }


        return (string) $lastInsertId;
    }

    public function runQuery(string $sql, array $values): array
    {
        try {

            $statement = $this->con->prepare($sql);
            $statement->execute($values);
            $lastInsertId = $this->con->lastInsertId() ?? '';
            $affectedRows = $statement->rowCount() ?? 0;
        } catch (\PDOException $exc) {

            $errorList = [];
            if ($exc->getCode() == '23000') {
                $message = $exc->getMessage();
                // "SQLSTATE[23000]: Integrity constraint violation: 1062 Duplicate entry 'test2' for key 'loginname'"
                $fieldName = stristr($message, "' for key '") ?? 'unknown';
                $fieldName = substr($fieldName, 11, -1);
                $errorList['fields'][$fieldName] = 'Must be unique';
                $errorList['errorinfo'] = $exc->errorInfo;
            }
            throw new RestApiException("PDO insert-query error: " . $exc->getMessage(), 403, $errorList);
        }


        return [
            "lastInsertid"=>(string) $lastInsertId,
            "affectedRows"=>$affectedRows
        ];
    }
    /**
     * Runs an sql-update  expression
     * @param string $sql - sql expression - should be an update. ( for query/insert please use the query/insert methos of this class)
     * @param string $idField - fieldId - if given, result of inserted records will be an asociative array. The keys will be the values of idField 
     * @return int - number of updated rows / sets error status of the class 
     * @throws \Exception - if error occures on running sql expression on db
     */

    /**
     * 
     * @param string $sql
     * @param array $values
     * @throws \Exception
     */
    public function runUpdateQuery(string $sql, array $values)
    {
        try {
            $statement = $this->con->prepare($sql);
            $statement->execute($values);
            $updatedRows = $statement->rowCount();
        } catch (\Exception $exc) {
            throw new \Exception("PDO-update querry error: " . $exc->getMessage());
        }
        return $updatedRows;
    }

    /**
     * 
     * @param string $sql
     * @param array $values
     * @throws Exception
     */
    public function runDeleteQuery(string $sql, array $values): int
    {

        try {
            $statement = $this->con->prepare($sql);
            $statement->execute($values);
            $deletedRows = $statement->rowCount();
        } catch (\Exception $exc) {
            throw new \Exception("PDO-update querry error: " . $exc->getMessage());
        }
        return $deletedRows;
    }


    /**
     * Get the errormessage for the last occured error
     * @return string - error message
     */
    // public function getError(): string
    // {
    //     return self::$error;
    // }

    /**
     * alias for getError method  / get the errormessage for the last occured error
     * @return string - error message
     */
    // public function getErrorMessage(): string
    // {
    //     return self::$error;
    // }

    /**
     * Retreives the tablestructure of the table from database
     * @param string $tablename - Database table name
     * @return array - associative array:  tablname, fields
     * @throws Exception
     */
    // public function getTableStructure($tablename): array
    // {
    //     self::init();
    //     $result = pg_meta_data($this->con, $tablename, true);
    //     if (!$result)
    //     {
    //         self::$error = "Error: " . pg_last_error();
    //         throw new \Exception("SQL error: " . self::$error);
    //     }

    //     $stru = array();
    //     $stru['tablename'] = $tablename;
    //     foreach ($result as $id => $fielddata)
    //     {
    //         $field = array();
    //         $field['name'] = $id;
    //         $field['type'] = $fielddata['type'];
    //         $field['len'] = $fielddata['len'];
    //         $field['notnull'] = $fielddata['not null'];
    //         $field['hasdefault'] = $fielddata['has default'];

    //         $stru['fields'][$id] = $field;
    //     }

    //     $jsonstring = json_encode($stru, JSON_PRETTY_PRINT);
    //     $success = file_put_contents("dbstru/" . $tablename . ".row", $jsonstring); // dbstru/

    //     return $stru;
    // }

    /**
     * 
     * @param string $sql
     * @throws \Exception
     */
    public function executeQuery(string $sql): bool
    {
        try {
            $this->con->query($sql);
        } catch (\Exception $exc) {
            Logger::getInstance('db')->log($exc->getMessage());
            Logger::getInstance('db')->log(" - SQL:\n {$sql} ");
            throw new \Exception("PDO-execute querry error: " . $exc->getMessage());
        }
        return true;
    }

    /**
     * Performes the escape_string function of the used database engine
     * @param string $string - string to be sanitized
     * @return string - string escaped
     */
    public function clean($string): string
    {
        return $this->con->quote($string);
    }

    /**
     * Cleans date to ansi format
     * TODO: is this here really necessary?
     * 
     * @param string $date - date as string : yyyy-mm-dd ; yyyy/mm/dd ;  yyyy.mm.dd   
     * @return string - date in ansi format: yyyymmdd
     */
    public static function toDateAnsi($date): string
    {
        $date = str_replace(".", "", $date);
        $date = str_replace("-", "", $date);
        $date = str_replace("/", "", $date);

        $date = str_replace(" ", "", $date);
        return $date;
    }

    /**
     * 
     * @param string $sql
     * @param array $values
     */
    public function getFirstValue(string $sql, array $values = [])
    {
        $returnValue = '';
        $resultSet = $this->query($sql, $values);
        $returnRow = reset($resultSet);
        $returnValue = reset($returnRow);
        return $returnValue;
    }


    /**
     * getDatabaseName
     *
     * @return string
     */
    public function getDatabaseName():string
    {
        return $this->dbSettings['name'] ?? '';
    }
}
