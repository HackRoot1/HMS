<?php 

    $arr = [2, 7, 11, 15];
    $target = 9;

    
    // $arr = [3, 2, 4];
    // $target = 6;

    
    // $arr = [3, 3];
    // $target = 6;




    function twoSum($nums, $target){
        for($i = 0; $i < count($nums); $i++){
            for($j = $i + 1; $j < count($nums); $j++){
                $sum = $nums[$j] + $nums[$i];
                if($sum == $target){
                    return [$i, $j];
                }
            }
        }
    }

    print_r( twoSum($arr, $target));



    
?>
