function lilysHomework($arr): int {
    // Write your code here
    $desc_ary = $arr;
    $asc_ary = $arr;
    rsort($desc_ary);
    sort($asc_ary);
    $desc_count = getCount($arr, $desc_ary); 
    $asc_count = getCount($arr, $asc_ary);
    return min([$desc_count, $asc_count]);

}

function getCount($origin_ary, $result_ary): int {
    $count = 0;
    $index_map = array_flip($origin_ary);
    
    for($key = 0; $key < count($origin_ary); $key++) {
        $val = $origin_ary[$key];
        if($val != $result_ary[$key]) {
            $count++;
            $now_index = $index_map[$result_ary[$key]];
            $index_map[$val] = $now_index;
            $origin_ary[$now_index] = $val;
        }
    }
    return $count;
}

$fptr = fopen(getenv("OUTPUT_PATH"), "w");

$n = intval(trim(fgets(STDIN)));

$arr_temp = rtrim(fgets(STDIN));

$arr = array_map('intval', preg_split('/ /', $arr_temp, -1, PREG_SPLIT_NO_EMPTY));

$result = lilysHomework($arr);

fwrite($fptr, $result . "\n");

fclose($fptr);
