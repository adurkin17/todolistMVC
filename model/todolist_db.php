<?php

    function get_todolist_by_category($category_id) {
        global $db;
        if ($category_id) {
             $query = 'SELECT T.ItemNum,T.Title, T.Description, C.categoryName FROM todolist T LEFT JOIN  
             categories C ON T.categoryID = C.categoryID WHERE T.categoryID = :category_id 
             ORDER BY T.ID';
        } else {
            $query = 'SELECT T.ItemNum, T.Title, T.Description, C.categoryName FROM todolist T LEFT JOIN  
            categories C ON T.categoryID = C.categoryID ORDER BY C.categoryID = :category_id';
        }

        $statement = $db -> prepare($query);
        $statement -> bindValue(':category_id', $category_id);
        $statement->execute();
        $todolist = $statement->fetchall();
        $statement-> closeCursor();
        return $todolist;
    }

    function delete_todolist($todolist_id) {
        global $db;
        $query = 'DELETE FROM todolist WHERE ItemNum = :todo_id';
        $statement = $db -> prepare($query);
        $statement -> bindValue(':todo_id', $todolist_id);
        $statement->execute();
        $statement-> closeCursor();
        }

    function add_todolist($title, $description, $categoryID) {
        global $db;
        $query = 'INSERT INTO todolist (Title,Description,categoryID) VALUES (:title,:descr,:category_id)';
        $statement = $db -> prepare($query);
        $statement -> bindValue(':title', $title);
        $statement -> bindValue(':category_id', $categoryID);
        $statement -> bindValue(':descr', $description);
        $statement->execute();
        $statement-> closeCursor();
        }