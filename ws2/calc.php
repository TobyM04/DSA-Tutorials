<?php

function calculate($x, $y, $op) {
    if (!is_numeric($x) || !is_numeric($y)) {
        return 'Error: Please enter numeric values.';
    }

    switch ($op) {
        case '+': return $x + $y;
        case '-': return $x - $y;
        case '*': return $x * $y;
        case '/': return $y == 0 ? '∞' : $x / $y;
        default: return 'Invalid operation';
    }
}

extract($_GET);

if (isset($calc)) {
    $result = calculate($x, $y, $op);
} else {
    $x = $y = 0;
    $op = '+';
    $result = 0;
}
?>

<!DOCTYPE html>
<html>
<head>
    <title>PHP Calculator Example</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            background-color: #f4f4f4;
            margin: 0;
            padding: 0;
            display: flex;
            justify-content: center;
            align-items: center;
            height: 100vh;
            font-size: 18px; /* Larger font size for better readability */
        }
        form {
            background-color: #fff;
            padding: 40px; /* Increased padding */
            border-radius: 8px;
            box-shadow: 0 0 15px rgba(0, 0, 0, 0.2);
            width: 500px; /* Set a specific width */
        }
        h3 {
            margin-top: 0;
        }
        input[type=text], select {
            padding: 15px; /* Increased padding */
            margin: 10px 0;
            border: 2px solid #ccc;
            border-radius: 4px;
            font-size: 16px; /* Larger font size for inputs */
        }
        input[type=submit] {
            padding: 15px 30px; /* Increased padding */
            background-color: #007bff;
            color: #fff;
            border: none;
            border-radius: 4px;
            cursor: pointer;
            margin-top: 10px;
            font-size: 16px; /* Larger font size for button */
        }
        input[type=submit]:hover {
            background-color: #0056b3;
        }
        p {
            color: #333;
            margin-top: 20px; /* Add space above the result */
        }
    </style>
</head>
<body>

<div>
    <h3>PHP Calculator (Styled & Larger)</h3>
    <p>Perform arithmetic operations on two numbers and output the result.</p>

    <form method="get" action="<?php echo $_SERVER['PHP_SELF']; ?>">
        x = <input type="text" name="x" size="10" value="<?php echo htmlspecialchars($x); ?>"/> <!-- Increased size attribute -->
        <select name="op">
            <option value="+" <?php if ($op === '+') echo 'selected'; ?>>+</option>
            <option value="-" <?php if ($op === '-') echo 'selected'; ?>>-</option>
            <option value="*" <?php if ($op === '*') echo 'selected'; ?>>*</option>
            <option value="/" <?php if ($op === '/') echo 'selected'; ?>>/</option>
        </select>
        y = <input type="text" name="y" size="10" value="<?php echo htmlspecialchars($y); ?>"/> <!-- Increased size attribute -->
        <input type="submit" name="calc" value="Calculate"/>
    </form>

    <?php
    if (isset($calc)) {
        echo "<p>Result: $result</p>";
    }
    ?>
</div>

</body>
</html>

