<?php

/**
 * Article
 *
 * A piece of writing for publication
 */
class Article {
    public $id;
    public $title;
    public $content;
    public $published_at;
    public $image_path;
    public $errors = [];


    /**
     * Get all articles
     *
     * @param object $conn connection to the database       
     * @return array associative array of all article records
     */
    public static function getAll($conn) {
        $sql = "SELECT * 
                FROM article
                ORDER BY published_at";

        $results = $conn->query($sql);

        return $results->fetchAll(PDO::FETCH_ASSOC);
    }


    /**
     * Get a page of articles
     *
     * @param object $conn Connection to the database
     * @param integer $limit Number of records to return
     * @param integer $offset Number of records to skip
     * @return array Associative array of the current page article
     */
    public static function getPage($conn, $limit, $offset) {
        $sql = "SELECT * 
                FROM article
                ORDER BY published_at
                LIMIT :limit
                OFFSET :offset";

        $stmt = $conn->prepare($sql);

        $stmt->bindValue(':limit', $limit, PDO::PARAM_INT);
        $stmt->bindValue(':offset', $offset, PDO::PARAM_INT);

        $stmt->execute();

        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    /**
     * Get the aricle record based on id
     *
     * @param object  $conn Connection to database
     * @param integer $id the article ID
     * @param string  $columns Optional list of columns for the select, defaults to all 
     * @return mixed  object containing the article with that ID, or null if not found
     */
    public static function getById($conn, $id, $columns = '*') {

        $sql = "SELECT $columns 
                FROM article 
                WHERE id = :id";

        $stmt = $conn->prepare($sql);

        $stmt->bindValue(':id', $id, PDO::PARAM_INT);

        $stmt->setFetchMode(PDO::FETCH_CLASS, 'Article');

        if ($stmt->execute()) {
            return $stmt->fetch();
        }
    }

    /**
     * Count all the articles
     *
     * @param object $conn Connection to the database   
     * @return intger The total number of articles
     */
    public static function getTotalCount($conn) {
        $sql = "SELECT COUNT(*) FROM article";

        return $conn->query($sql)->fetchColumn();
    }

    /**
     * Update the article 
     *
     * @param object $conn Connection to the database   
     * @return boolean true if the update was successful, false otherwise
     */
    public function update($conn) {
        if ($this->validate()) {

            $sql = "UPDATE article 
                SET 
                title = :title,
                content = :content,
                published_at = :published_at
                WHERE id = :id";


            $stmt = $conn->prepare($sql);

            $stmt->bindValue(':id', $this->id, PDO::PARAM_INT);
            $stmt->bindValue(':title', $this->title, PDO::PARAM_STR);
            $stmt->bindValue(':content', $this->content, PDO::PARAM_STR);

            if ($this->published_at == '') {
                $stmt->bindValue(':published_at', $this->published_at, PDO::PARAM_NULL);
            } else {
                $stmt->bindValue(':published_at', $this->published_at, PDO::PARAM_STR);
            }

            return $stmt->execute();
        } else {
            return false;
        }
    }


    /**
     * Validate the article properties
     *
     * @return boolean true if the current properties are valid, false otherwise
     */
    protected function validate() {
        if (trim($this->title) == '') {
            $this->errors[] = 'Title is required';
        }
        if (trim($this->content) == '') {
            $this->errors[] = 'Content is required';
        }
        return empty($this->errors);
    }


    /**
     * Delete the current article
     *
     * @param object $conn Connection to the database
     * @return boolean true if the delete was succsessful, false otherwise
     */
    public function delete($conn) {
        $sql = "DELETE FROM article 
                WHERE id = :id";

        $stmt = $conn->prepare($sql);

        $stmt->bindValue(':id', $this->id, PDO::PARAM_INT);

        return $stmt->execute();
    }


    /**
     * Create new article
     *
     * @param object $conn Connection to the database   
     * @return boolean true if the update was successful, false otherwise
     */
    public function create($conn) {
        if ($this->validate()) {

            $sql = "INSERT INTO article (title, content, published_at)
                    VALUES(:title, :content, :published_at)";

            $stmt = $conn->prepare($sql);

            $stmt->bindValue(':title', $this->title, PDO::PARAM_STR);
            $stmt->bindValue(':content', $this->content, PDO::PARAM_STR);

            if ($this->published_at == '') {
                $stmt->bindValue(':published_at', $this->published_at, PDO::PARAM_NULL);
            } else {
                $stmt->bindValue(':published_at', $this->published_at, PDO::PARAM_STR);
            }
            // immediately update the article id to be able to redirect to it after the creation
            if ($stmt->execute()) {
                $this->id = $conn->lastInsertId();
                return true;
            }
        } else {
            return false;
        }
    }
    /**
     * Update the image file property
     *
     * @param object $conn Connection to the database   
     * @param string $filname
     * @return boolean true if the update was successful, false otherwise 
     */
    public function setImagePath($conn, $filname) {
        $sql = "UPDATE article
                SET image_path = :image_path
                WHERE id = :id";

        $stmt = $conn->prepare($sql);

        $stmt->bindValue(":id", $this->id, PDO::PARAM_INT);
        $stmt->bindValue(":image_path", $filname, $filname == null ? PDO::PARAM_NULL : PDO::PARAM_STR);

        return $stmt->execute();
    }


    /**
     * Get the article record based on the ID along with associated categories, if any
     *
     * @param object $conn Connection to the database
     * @param integer $id the article ID
     *
     * @return array The article data with categories
     */
    public static function getWithCategories($conn, $id) {
        $sql = "SELECT article.*, category.name as category_name
                FROM article
                LEFT JOIN article_category
                ON article.id = article_category.article_id
                LEFT JOIN category
                ON article_category.category_id = category.id
                WHERE article.id = :id";

        $stmt = $conn->prepare($sql);
        $stmt->bindValue(':id', $id, PDO::PARAM_INT);

        $stmt->execute();

        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }


    /**
     * Get the article's categories
     *
     * @param object $conn Connection to the database
     * @param array The category data
     */
    public function getCategories($conn) {
        $sql = "SELECT category.*
                FROM category
                JOIN article_category
                ON category.id = article_category.category_id
                WHERE article_id = :id";

        $stmt = $conn->prepare($sql);
        $stmt->bindValue(':id', $this->id, PDO::PARAM_INT);

        $stmt->execute();

        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    /**
     * Set article categpries
     *
     * @param object $conn Connection to the database
     * @param array $ids Array of the Category id's
     * @return void
     */
    public function setCategories($conn, $ids) {
        if ($ids) {
            $sql = "INSERT IGNORE INTO article_category (article_id,category_id)
                    VALUES ";

            /**
             * Construct the sql qurey to qurey the DB once 
             */

            // init array values
            $values = [];

            // create array for each [article_id => category_id]
            foreach ($ids as $id) {
                $values[] = "({$this->id}, ?)";
            }

            // join the arrays to a string seperated by comma
            $values = implode(",", $values);

            // append values to the sql qurey
            $sql .= $values;

            $stmt = $conn->prepare($sql);

            // bind the values by the index of the placeholder
            foreach ($ids as $i => $id) {
                $stmt->bindValue($i + 1, $id, PDO::PARAM_INT);
            };

            $stmt->execute();
        }
    }
}
