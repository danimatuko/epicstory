<?php

/**
 * Paginator
 * 
 * Data for selecting a page of records
 */
class Paginator {
    public $limit;
    public $offset;

    /**
     * Constructor
     *
     * @param integer $page Page number
     * @param integer $records_per_page Number of records per page
     */
    public function __construct($page, $records_per_page) {
        $this->limit = $records_per_page;
        $this->offset = $records_per_page * ($page - 1);
    }
}
