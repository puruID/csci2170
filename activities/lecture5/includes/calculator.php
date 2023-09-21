<?php
$number1 = $_POST['number1'];
$number2 = $_POST['number2'];
$operator = $_POST['operator'];

if(is_numeric($number1)&& is_numeric($number2)){
    switch ($operator) {
        case 'Add':
            $result = $number1 + $number2;
            break;

        case 'Subtract':
            $result = $number1 - $number2;
            break;
        
        case 'Multiply':
            $result = $number1 * $number2;
            break;

        case 'Divide':
            $result = $number1 / $number2;

        case 'Modulus':
            $result = $number1 % $number2;
            break;
        
        default:
            # code...
            break;
    }
}else {
    $result = '<strong>You have not entered a number';
}