<?php

namespace Util;

trait ReportHandler
{
    /**
     * report
     *
     * @var array
     */
    protected $report = [];


    /**
     * addReport
     *
     * @param  string $message
     * @param  mixed $type
     * @return void
     */
    protected function addReport(string $message, $type = 'log')
    {
        $this->report[] = ["type" => $type, 'message' => $message];        
    }

    /**
     * getReport
     *
     * @return array
     */
    public function getReport(): array
    {
        return $this->report;
    }
}
