<?php include ('C:\xampp\htdocs\mvcToDoList\view\header.php'); ?>
<?php if($category) { ?>
    <section id= "list" class ="list">
        <header class ="list__row list__header">
            <h1> Category List</h1>
        </header>

        <?php foreach ($category as $categories) : ?>
        <div class = "list__row">
            <div class = "list__item">
                <p class = "bold"> <?=$categories['categoryName'] ?> </p>
            </div>
            <div class = "list__removeItem">
                <form action = "." method = "post"> 
                    <input type = "hidden" name = "action" type="delete_category">
                    <input type ="hidden" name = "category_ID" values="<?=$categories['categoryID']; ?>">
                    <button class ="remove-button"> Remove </button>
                </form>
            </div>
        <?php endforeach; ?>
        </div>
    </section>
<?php } else { ?> 
    <p> No Categories exist yet.</p>
<?php } ?>

<section id="add" class="add">
    <h2> Add Category </h2>
    <form action ="." method = "post" id="add_form" class = "add_form"> 
        <input type = "hidden" name = "action" value="add_category">
        <div class = "add__input" >
            <label> Name:</label>
            <input type ="text" name = "category_name" maxLength= "50" placeholder="Name" autofocus required>
        </div>
        <div class = "add__addItem">
            <button class = "add-button bold" > Add</button>
        </div>
    </form>
</section>
<br>
<p> <a href = "."> View &amp; Add ToDO Items </a></p>
<?php include ('C:\xampp\htdocs\mvcToDoList\view\footer.php'); ?>