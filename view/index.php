<?php
    require('C:\xampp\htdocs\mvcToDoList\model\database.php');
    require('C:\xampp\htdocs\mvcToDoList\model\todolist_db.php');
    require('C:\xampp\htdocs\mvcToDoList\model\category_db.php');

    $todolist_id = filter_input(INPUT_POST, 'todolist_id', FILTER_VALIDATE_INT);
    $title = filter_input(INPUT_POST, 'title', FILTER_SANITIZE_STRING);
    $description = filter_input(INPUT_POST, 'description', FILTER_SANITIZE_STRING);
    $category_name = filter_input(INPUT_POST, 'category_name', FILTER_SANITIZE_STRING);

    $category_id = filter_input(INPUT_POST, 'category_id', FILTER_VALIDATE_INT);
    if (!$category_id) {

        $category_id = filter_input(INPUT_GET, 'category_id', FILTER_VALIDATE_INT);
    }

    $action = filter_input(INPUT_POST, 'action', FILTER_SANITIZE_STRING);
    if (!$action) {
        $action = filter_input(INPUT_GET, 'action', FILTER_SANITIZE_STRING);
            if(!$action)
            {
                $action = 'list_todo';
            }
    }

    switch($action) {
        case "list_categories":
            $category = get_category();
            include('C:\xampp\htdocs\mvcToDoList\view\category_list.php');
            break;
        case "add_category":
            add_category($category_name);
            header("Location: .?action=list_categories");
            break;
        case "add_todo":
            if($category_id && $title && $description)
            {
                add_todolist($category_id,$description,$title);
                header("Location: .?category_id = $category_id");
            } else {
                $error= "invalid todo data. Please Check your to do item";
                include('C:\xampp\htdocs\mvcToDoList\view\error.php');
                exit();
            }
            break;
        case "delete_category":
            if($category_id)
            {
                try {
                    delete_category($category_id);

                }
                catch (PDOException $e)
                {
                    $error = "You can't delete a category if is assigned to an item.";
                    include('C:\xampp\htdocs\mvcToDoList\view\error.php');
                    exit();
                }
                header("Location: .?action=list_categories");
            }
            break;
        case "delete_todo":
            if ($todolist_id) {
                delete_todolist($todolist_id);
                header("Location: .?category_id=$category_id");
            }
            else {
                $error= "Missing or incorrect todo list id";
                include('C:\xampp\htdocs\mvcToDoList\view\error.php');
            }
            break;

        default:
            $category_name = get_category_name($category_id);
            $category = get_category();
            $todolist = get_todolist_by_category($category_id);
            include ('C:\xampp\htdocs\mvcToDoList\view\todo_list.php');
    }