<?php
    session_start();
    include 'functions.php';
    include 'database.php';
?>
<!DOCTYPE html>
<html>
    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        
        <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
        <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js" integrity="sha384-Tc5IQib027qvyjSMfHjOMaLkfuWVxZxUPnCJA7l2mCWNIpG9mGCD8wGNIcPD7Txa" crossorigin="anonymous"></script>
        <link href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-BVYiiSIFeK1dGmJRAkycuHAHRg32OmUcww7on3RYdg4Va+PmSTsz/K68vbdEjh4u" crossorigin="anonymous">
        <title>Products Page</title>
    </head>
    <body>
    <div class='container'>
        <div class='text-center'>
            
            <!-- Bootstrap Navagation Bar -->
            <nav class='navbar navbar-default - navbar-fixed-top'>
                <div class='container-fluid'>
                    <div class='navbar-header'>
                        <a class='navbar-brand' href='#'>Shopping Land</a>
                    </div>
                    <ul class='nav navbar-nav'>
                        <li><a href='index.php'>Home</a></li>
                        <li><a href='scart.php'>Cart</a></li>
                    </ul>
                </div>
            </nav>
            <br /> <br /> <br />
            
            <!-- Search Form -->
            <form enctype="text/plain">
                <div class="form-group">
                    <label for="pName">Product: <t> </label>
                    <input type="text" name="query" id="pName" placeholder="Name">
                    <br/><br/>
                    <strong>Category: </strong>
                    <select name = "category">
                        <?php
                            echo getCategoriesHTML();
                        ?>
                    </select>
                    <br><br/>
                    <label for = "pLow">Price: From: </label><input type = "text" name = "priceLow" id = "pLow">
                    <label for = "pHigh">To</label> <input type = "text" name = "priceHigh" id = "pHigh">
                    <br><br/>
                    <label for = "byName">Order Results By: </label>
                    <input type = "radio" name = "ordering" value = 'byName'> Product Name <br/>
                    <input type = "radio" name = "ordering" value = 'byPrice'> Price
                    <br><br/>
                    <input type = "checkbox" name = "disPics" value = "true"> Display Product Pictures 
                </div>
                <input type="submit" name = "search-submitted" value="Search" class="btn btn-default">
                <br /><br />
            </form>
            
            <!-- Display Search Results -->
            
            </br>
            <?php
                if(isset($_POST['itemName'])){
                    $newItem = array();
                    $newItem['name'] = $_POST['itemName'];
                    $newItem['id'] = $_POST['itemId'];
                    $newItem['price'] = $_POST['itemPrice'];
                    $newItem['image'] = $_POST['itemImage'];
                    
                    array_push($_SESSION['cart'], $newItem);
                }
                if(!isset($_SESSION['cart'])){
                    $_SESSION['cart'] = array();
                }
                
                if (isset($_GET["category"]) && !empty($_GET["category"])) {
                    $category = $_GET["category"]; 
                }
                
                if (isset($_GET["priceHigh"]) && !empty($_GET["priceHigh"])) {
                    $priceTo =  $_GET["priceHigh"]; 
                }
                
                if (isset($_GET["priceLow"]) && !empty($_GET["priceLow"])) {
                    $priceFrom = $_GET["priceLow"];
                }
                
                if (isset($_GET["ordering"]) && !empty($_GET["ordering"])) {
                    //echo $_GET['ordering'];
                    $ordering = $_GET["ordering"];
                }
                
                if (isset($_GET["disPics"]) && !empty($_GET["disPics"])) {
                    $showImages = $_GET["disPics"];
                }
                
                if(isset($_GET['query'])) {
                    $query = $_GET['query'];
                }
                
                if(isset($_GET['search-submitted'])) {
                    $items = getMatchingItems($query, $category, $priceFrom, $priceTo, $ordering, $showImages);
                }

                displayResults($items);
            
            ?>
        </div>
    </div>
    </body>
</html>