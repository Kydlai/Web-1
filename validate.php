<?php
session_start();
date_default_timezone_set('Europe/Moscow');
$time_start = microtime(true);

    $x = $_GET['x'];
    $y = substr($_GET['y'], 0, 6);
    $r = $_GET['r'];



function hit($x, $y, $r) {
    $x_cor = $x/$r;
    $y_cor = $y/$r;
    if ($x_cor >= 0 && $y_cor >= 0 && $y_cor<=1/2 && $x_cor <= $r){
        return true;
    }elseif ($x_cor >= 0 && $y_cor <= 0 && $y_cor >= 2*$x_cor-1){
        return true;
    }elseif ($x_cor <= 0 && $y_cor >= 0 && $x_cor^2 + $y_cor^2 <= 1){
        return true;
    }
    return false;
}

function x_validate($x){
    $flag = 0;
    $arr = array("-5", "-4", "-3", "-2", "-1", "0", "1", "2", "3");
    foreach ($arr as $value) {
        if ($value == $x){
            $flag++;
        }
    }
    if ($flag==1){
        return true;
    }
    return false;
}

function y_validate($y){
        if (preg_match('/^-?\d+\.?\d*$/', $y)) {
                if ($y >= -5 && $y <= 3) {
                    return true;
                }
        }
        return false;
}

function r_validate($r){
    $flag = 0;
    $arr = array("1", "1.5", "2", "2.5", "3");
    foreach ($arr as $value) {
        if ($value == $r){
            $flag++;
        }
    }
    if ($flag==1){
        return true;
    }
    return false;
}

    $current_time = date('H:i:s, d.m.Y');
    $session_time = number_format(microtime(true)-$time_start,5);

    if (y_validate($y) && x_validate($x) && r_validate($r)) {
        $answer = [$x, $y, $r, hit($x, $y, $r) ? "Есть" : "Нет", $session_time];
        $_SESSION['history'][] = $answer;
    }
    $_SESSION['time']['0'] = $current_time;
    $result = "<table id=\"main_table\" class=\"super_table\" border=\"3\">
                <tr><th>X</th><th>Y</th><th>R</th><th>Успех</th><th>Время исполнения:</th></tr>";
    foreach ($_SESSION['history'] as $line) {
        $result.="<tr><td>$line[0]</td><td>$line[1]</td><td>$line[2]</td><td>$line[3]</td><td>$line[4]</td></tr>";
    }
    $result = "Попытка восстания в $current_time</label>".$result;
    $result.="</table>";
    $_SESSION['table'] = $result;
    $_SESSION['t'] = $_GET['t'];
    header('Location: https://se.ifmo.ru/~s335058/table.php');


