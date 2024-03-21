<?php

/* ======================================================
   PHP Calculator example using "sticky" form (Version 1)
   ======================================================
   Author : P Chatterjee (adopted from an original example written by C J Wallace)
   Purpose : To perform basic arithmetic operations on 2 numbers passed from a HTML form and display the result.
   input:
      x, y : numbers
      op : operator selection
   Date: 15 Oct 2007
*/

// define a function for calculation
function calculate($x, $y, $op) {
    switch($op) {
        case "+":
            return $x + $y;
        case "-":
            return $x - $y;
        case "*":
            return $x * $y;
        case "/":
            return ($y != 0) ? $x / $y : "∞";
        default:
            return "Invalid operation";
    }
}

// grab the form values from $_HTTP_GET_VARS hash
extract($_GET);

// validate form parameters
if (!is_numeric($x) || !is_numeric($y)) {
    echo "<p>Please enter numeric values for x and y.</p>";
    exit; // stop execution if parameters are invalid
}

// set default values
$x = isset($x) ? $x : 0;
$y = isset($y) ? $y : 0;
$op = isset($op) ? $op : "+"; // default operator is addition

// perform calculation
$result = calculate($x, $y, $op);

?>

<!DOCTYPE html>
<html>
    <head>
        <title>PHP Calculator Example</title>
    </head>

    <body>

       <h3>PHP Calculator (Version 2)</h3>
       <p>Perform basic arithmetic operations on two numbers and display the result.</p>

       <form method="get" action="<?php echo $_SERVER['PHP_SELF']; ?>">

          <input type="text" name="x" size="5" value="<?php echo $x; ?>"/>
          <select name="op">
             <option value="+" <?php echo ($op == "+") ? "selected" : ""; ?>>+</option>
             <option value="-" <?php echo ($op == "-") ? "selected" : ""; ?>>-</option>
             <option value="*" <?php echo ($op == "*") ? "selected" : ""; ?>>*</option>
             <option value="/" <?php echo ($op == "/") ? "selected" : ""; ?>>/</option>
          </select>
          <input type="text" name="y" size="5" value="<?php echo $y; ?>"/>

          <input type="submit" name="calc" value="Calculate"/>
       </form>

      <!-- print the result -->
      <?php 
      if(isset($calc)) {
          echo "<p>$x $op $y = $result</p>";
      } 
      ?>

   </body>
</html>
