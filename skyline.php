class Solution {

/**
 * @param Integer[][] $buildings
 * @return Integer[][]
 */
public function getSkyline($buildings) {
    $sort_list = [];
    foreach ($buildings as $point) {
        $sort_list[] = ['x' => $point[0], 'y' => $point[2], 'z' => 0];
        $sort_list[] = ['x' => $point[1], 'y' => $point[2], 'z' => 1];  
    }


    usort($sort_list, function($left, $right) {
        if ($left['x'] === $right['x']) {
            return $left['z'] - $right['z'];
        }
        return $left['x'] - $right['x'];
    });

    $hight_list = [0]; 
    $new_list = [];
    $pre_hight = 0;

    foreach ($sort_list as $point) {
       
        $key_point = array_search($point['y'],array_keys($hight_list));
        if ($point['z'] == 0) {
            if ($key_point !== false) {
                $hight_list[$point['y']]++;
            } else {
                $hight_list[$point['y']] = 1;
            }
        } else {
            if ($key_point !== false && $hight_list[$point['y']] > 1) {
                $hight_list[$point['y']]--;
            } else {
                unset($hight_list[$point['y']]);
            }
        }

        $current_h = max(array_keys($hight_list));
    
        if ($pre_hight !== $current_h) {
            $new_list[] = [$point['x'], $current_h];
            $pre_hight = $current_h;
        }
    }

    return $new_list;
}
}