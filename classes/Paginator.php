<?php

/**
 * Paginator
 * 
 * Data for selecting a page of records
 */
class Paginator {
    public $page;
    public $limit;
    public $offset;
    public $previous;
    public $next;
    public $total_pages;


    /**
     * Constructor
     *
     * @param integer $page Page number
     * @param integer $records_per_page Number of records per page
     */
    public function __construct($page, $records_per_page, $total_records) {
        $this->page = $this->validatePageNumber($page);
        $this->total_pages = ceil($total_records / $records_per_page);
        $this->previous = $page - 1;
        $this->next = $page + 1;
        $this->limit = $records_per_page;
        $this->offset = $records_per_page * ($this->page - 1);
    }

    /**
     * Validate the page number in URL qurey string
     *
     * @param mixed $page
     * @return integer if page number is string return it as intger, if it's not a string or an intger return 1
     */
    private function validatePageNumber($page) {
        $page = filter_var($page, FILTER_VALIDATE_INT, [
            'options' => [
                'default' => 1,
                'min_range' => 1
            ]
        ]);

        return $page;
    }
}
