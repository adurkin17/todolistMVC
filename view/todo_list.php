<?php include ('C:\xampp\htdocs\mvcToDoList\view\header.php'); ?>

<section id="list" class = "list">
    <header class = "list__row list__header">
        <h1>TO DO </h1>
        <form action = "." method = "get" id = "list__header_select" class = "list__header_select">
            <input type = "hidden" name = "action" value = "list_todo">
            <select name = "category_id" required>
                <option value = "0"> View All </option>
                <?php foreach($categories as $category) : ?>
                <?php if ($category_id == $category['categoryID']) { ?>
                    <option value ="<?= $category['categoryID'] ?>" selected>

                <?php } else { ?>
                    <option value ="<?= $category['categoryID'] ?>">
                <?php } ?>
                        <?= $category['categoryName']?>
                    </option>
                    <?php endforeach; ?>
            </select>
            <button class = "add_button bold" > GO </button>
        </form>
    </header>
    <?php if($todolist) { ?>
        <?php foreach ($todolist as $todo) : ?>
        <div class = "list__row">
            <div class = "list__item">
                <p class = "bold"> <?= $todo['categoryName'] ?> </p>
                <p> <?= $todolist['Title'] ?> </p>
                <p> <?= $todolist['Description'] ?></p>
            </div>
            <div class = "list__removeItem">
                <form action = "." method="post">
                    <input type="hidden" name ="action" value = "delete_todo">
                    <input type = "hidden" name = "category_id" value = "<?= $todolist['ID'] ?> ">
                    <button class ="remove-button"> Delete</button>
                </form>
            </div>
        </div>
        <?php endforeach ?>
        <?php } else { ?>
        <br>
        <?php if ($category_id) { ?>
            <p> No TODo List exist for this category yet.</p>
        <?php } else { ?>
            <p> No ToDo List exist yet.</p>
        <?php } ?>
        <br>
        <?php } ?>
</section>

<section id = "add" class = "add">
       <h2> Add To Do Item </h2>
        <form action = "." method = "post" id = "add_form" class = "add_form">
            <input type = "hidden" name = "action" value="add_todo">
            <div class ="add__inputs">
                <label> Category: </label>
                <select name="category_id" required>
                    <option value=""> Please Select </option>
                    <?php foreach($category as $categories) : ?>
                    <option value=" <?php $categories['categoryID']; ?>">
                        <?= $categories['categoryName'];?>
                    </option>
                    <?php endforeach; ?>
                </select>
                <label>Title: </label>
                <input type = "text" name ="Title" maxLength = "30" placeholder="Title" required>
                <label>Description: </label>
                <input type = "text" name ="Description" maxLength = "120" placeholder="Description" required>
            </div>
            <div class ="add_addItem">
                    <button class = "add_button bold"> Add </button>
            </div>
        </form>
</section>
<br>
<p><a href=".?action=list_categories"> View/Edit Categories </a></p>
<?php include ('C:\xampp\htdocs\mvcToDoList\view\footer.php'); ?>
