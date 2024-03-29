<?php

    function get_category()
    {
        global $db;
        $query = 'SELECT * FROM categories ORDER BY categoryID';
        $statement = $db -> prepare($query);
        $statement->execute();
        $category = $statement->fetchall();
        $statement-> closeCursor();
        return $category;
    }

    function get_category_name($category_id) {
        if (!$category_id) {
            return "All Courses";
        }
        global $db;
        $query = 'SELECT * FROM categories WHERE categoryID = :category_id';
        $statement = $db -> prepare($query);
        $statement -> bindValue(':category_id', $category_id);
        $statement->execute();
        $category = $statement->fetch();
        $statement-> closeCursor();
        $category_name = $category['categoryName'];
        return $category_name;
    }

    function delete_category($category_ID) {
        global $db;
        $query ='DELETE FROM categories WHERE categoryID = :category_id';
        $statement = $db -> prepare($query);
        $statement -> bindValue(':category_id', $category_ID);
        $statement->execute();
        $statement-> closeCursor();
    }

    function add_category($category_name) {
        global $db;
        $query = 'INSERT INTO categories (categoryName) VALUES (:categoryName)';
        $statement = $db -> prepare($query);
        $statement -> bindValue(':categoryName', $category_name);
        $statement->execute();
        $statement-> closeCursor();
    }
