<?php

namespace DataModel\FieldTypes;

use Util\DB;

/**
 * Description of AutoCounterFieldType
 *
 * @author Bata Jozsef 
 */
class AutoCounterFieldType extends StringFieldType
{
    
    /** @var mixed $prefixPattern */
    protected string $prefixPattern;    
    /** @var mixed $suffixPattern */
    protected string $suffixPattern;    
    /** @var mixed $scopeFields */
    protected array $scopeFields = [];    
    /** @var mixed $counterLength */
    protected int $counterLength;

    /**
     * default number of digits after prefix.
     */
    const CUSTOM_ID_DIGIT_COUNT = 6;

    /**
     * @var array
     */
    protected $settings;

    /**
     * @var DBManager
     */
    protected DB $db;

    public function __construct(array $fieldProps = [])
    {
        parent::__construct($fieldProps);

        $this->assignEvent = 'auto-insert';        
        $this->db = DB::getInstance();
        $this->prefixPattern = $fieldProps['prefix'] ?? '';
        $this->suffixPattern = $fieldProps['suffix'] ?? '';
        $this->counterLength = $fieldProps['counterlength'] ?? self::CUSTOM_ID_DIGIT_COUNT;
        $this->scopeFields = $fieldProps['scopefields'] ?? [];

    }

    /**
     * @param string $moduleName
     *
     * @return string
     */
    public function getNextValue(array $customParts = [])
    {
        $prefixPattern = $this->prefixPattern;
        $prefix = $this->renderPattern($prefixPattern, $customParts);

        $suffixPattern = $this->suffixPattern;
        $suffix = $this->renderPattern($suffixPattern, $customParts);

        $counterLength = $this->counterLength;

        $prefixLen = strlen($prefix);

        $lastCustomId = $this->dataModel->getLastCounterValue($this->name, $prefixLen, $counterLength, $customParts,$this->scopeFields);

        if ($lastCustomId)
        {
            $idCounter = (int) $lastCustomId;
        } else
        {
            $idCounter = 0;
        }

        $counterString = str_pad($idCounter + 1, $counterLength, '0', STR_PAD_LEFT);
        $newCustomId = $prefix . $counterString . $suffix;

        return $newCustomId;
    }

    /**
     * @return array
     */
    public function getModuleList()
    {
        return array_keys($this->settings);
    }

    /**
     * @param $moduleName
     *
     * @return mixed|string
     */
    public function getFieldName($moduleName)
    {
        return $this->settings[$moduleName]['fieldname'] ?? "";
    }

    /**
     * @param $moduleName
     *
     * @return mixed|string
     */
    public function getTableName($moduleName)
    {
        return $this->settings[$moduleName]['tablename'] ?? "";
    }

    /**
     * Howitworks:
     *    find and replace patterns
     *        replace {date:YYMMDD}  with date(YYMMDD)
     *    replace {custom:part}  with $customParts['part']
     *
     * @param string $pattern
     * @param array  $customParts
     *
     * @return string
     */
    protected function renderPattern(string $pattern = '', array $customParts = []): string
    {
        $search = '/{([^}]*)}/';
        $searc2 = "/\{([^\)]*)\}/";
        preg_match_all($search, $pattern, $matches, PREG_OFFSET_CAPTURE);

        foreach ($matches[0] as $match)
        {
            $contentFound = $match[0] ?? '';
            $pos = $match[1] ?? 0;
            $contentToInsert = '*';
            $contentToProcess = substr($contentFound, 1, -1);
            $parts = explode(':', $contentToProcess);
            $cmd = $parts[0];
            $param = $parts[1];
            switch ($cmd)
            {
                case 'date':
                    $contentToInsert = date($param);
                    break;
                case 'custom':
                    $contentToInsert = $customParts[$param] ?? '?';
                    break;
            }

            $pattern = str_replace($contentFound, $contentToInsert, $pattern);
        }

        return $pattern;
    }

    /**
     * getValue
     *
     * @param  array $record
     * @param  string $mode
     * @return string
     */
    public function getValue(array $record, string $mode) : string
    {
        if ($mode = 'insert') {
            return $this->getNextValue($record);
        }
        return null;        
    }

}
