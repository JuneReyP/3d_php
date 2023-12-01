<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>

<body>
    <?php
    echo "Hello World";
    // 
    #
    /* 
        
        
        */

    $num1 = 1;
    $num2 = "1";
    $sample = true;

    // conditional statement
    echo "<br>";
    // if
    if (1 < 2) {
        echo "That is true" . "<br>";
    }

    if (1 > 2) {
        // code here if condition is true
    } else {
        // code here if condition is false
    }

    if (1 < 2) {
        // code here if condition is true
    } elseif (1 < 2) {
        // code here if condition is true
    } else {
        // code here if condition of both is false
    }

    /*
        if (condition) {
            code to be executed if this condition is true;
        } elseif (condition) {
            code to be executed if first condition is false and this condition is true;
        } else {
            code to be executed if all conditions are false;
        }



        switch (label2) {
            case label1:
                code to be executed if n=label1;
                break;
            case label2:
                code to be executed if n=label2;
                break;
            case label3:
                code to be executed if n=label3;
                break;
                ...
            default:
                code to be executed if n is different from all labels;
            }
*/

    $favcolor = "green";

    switch ($favcolor) {
        case "red":
            echo "Your favorite color is red!";
            break;
        case "blue":
            echo "Your favorite color is blue!";
            break;
        case "green":
            echo "Your favorite color is green!";
            break;
        default:
            echo "Your favorite color is neither red, blue, nor green!";
    }

    /**
         while (condition is true) {
                code to be executed;
            }
     */
    echo "<br>";
    $x = 1;

    while ($x <= 5) {
        echo "The number is: $x <br>";
        $x++;
    }

    /**
        for (initializer; condition; iterator) {
                code to be executed for each iteration;
            }
     */
    for ($x = 0; $x < 10; $x++) {
        echo "The number is: $x <br>";
    }

    /**
       foreach ($array as $value) {
                code to be executed;
        } 
     */

    $colors = ["red", "green", "blue", "yellow"]; //indexed array
    // echo $colors[3];
    for($x = 0; $x < sizeof($colors); $x++){
        echo $colors[$x] . "<br>";
    }

    foreach ($colors as $value) {
        echo "$value <br>";
    }
    echo "<hr>";
    $sample = [
        ["red", "green", "blue", "yellow"],//0
        ["guava", "apple", "mango", "chico"],//1
        ["toyota", "hyudai", "bmw", "ferrari"]//2
    ];

    for($row = 0; $row < sizeof($sample); $row++){

        for($col = 0; $col < sizeof($sample[$row]); $col++){
            echo $sample[$row][$col] . "<br>";
        }
        echo "<br>";
    }
    // $sample[0][0]
    // $sample[0][1]
    // $sample[0][2]
    // $sample[0][3]

    // $sample[1][0]
    // $sample[][]
    ?>
</body>

</html>