<?php
require("../db_con.php");
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Quiz</title>
</head>
<body>
    <h1>Quiz</h1>
    <section class="ques-section">
        <div class="questionBox">
            <form action="">
            <h3>Here Comes the question ?</h3>
            <ol >
                <li>
                    <label for="op"> <input type="radio" name="op" value=""><span>Option 1</span> </label>
                </li>
                
                <li>
                    <label for="op"> <input type="radio" name="op"><span>Option 1</span> </label>
                </li>
                
                <li>
                    <label for="op"> <input type="radio" name="op"><span>Option 1</span> </label>
                </li>
                
                <li>
                    <label for="op"> <input type="radio" name="op"><span>Option 1</span> </label>
                </li>
            </ol>
        </form>
        </div>
    </section>
</body>
</html>