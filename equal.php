function equal($arr): int {
    // Write your code here
    $min = min($arr);
    $result_ary = []; 
    
    $limit = 6;
    for ($key = 0; $key < $limit; $key++) {
        $result_ary[] = getTotal($min - $key, $arr);
    }
    return min($result_ary);
}


function getTotal($target, $arr): int {
    $count = 0;
    foreach ($arr as $num) {
        $count = $count + getCount($num - $target);
    }
    return $count;
}

function getCount($new_target): int {
    $count = 0;
    
    $num_ary = [5,2,1];
    foreach ($num_ary as $step) {
        $count = $count + floor($new_target / $step);
        $new_target = $new_target % $step;
    }

    return $count;
}

$fptr = fopen(getenv("OUTPUT_PATH"), "w");

$t = intval(trim(fgets(STDIN)));

for ($t_itr = 0; $t_itr < $t; $t_itr++) {
    $n = intval(trim(fgets(STDIN)));

    $arr_temp = rtrim(fgets(STDIN));

    $arr = array_map('intval', preg_split('/ /', $arr_temp, -1, PREG_SPLIT_NO_EMPTY));

    $result = equal($arr);

    fwrite($fptr, $result . "\n");
}

fclose($fptr);
