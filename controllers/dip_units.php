<?php

// $unit = GET_DIP_UNIT_REGULAR_DIESEL($_GET["liters"]);
// $unit2 = GET_DIP_UNIT_SUPER($_GET["liters"]);
// var_dump($unit);
// var_dump($unit2);

function GET_DIP_UNIT_REGULAR_DIESEL($liters)
{
    $dip_units_for_reg_die = [
        21,
        61,
        113,
        175,
        244,
        321,
        405,
        494,
        588,
        608,
        793,
        902,
        1015,
        1132,
        1253,
        1377,
        1505,
        1636,
        1770,
        1907,
        2047,
        2189,
        2334,
        2481,
        2631,
        2789,
        2936,
        3091,
        3246,
        3408,
        3568,
        3780,
        3894,
        4059,
        4225,
        4393,
        4561,
        4731,
        4901,
        5073,
        5245,
        5417,
        5591,
        5765,
        5939,
        6114,
        6289,
        6464,
        6640,
        6815,
        6991,
        7166,
        7341,
        7516,
        7691,
        7865,
        8039,
        8213,
        8385,
        8558,
        8729,
        8899,
        9069,
        9237,
        9405,
        9571,
        9736,
        9900,
        10062,
        10223,
        10382,
        10539,
        10694,
        10848,
        11000,
        11149,
        11296,
        11441,
        11583,
        11723,
        11860,
        11994,
        12125,
        12253,
        12377,
        12498,
        12615,
        12728,
        12837,
        12942,
        13042,
        13136,
        13226,
        13309,
        13386,
        13455,
        13517,
        13569,
        13609,
        13631
    ];

    $units = 0;
    $diff = 14000;
    for ($i = 0; $i < count($dip_units_for_reg_die); $i++) {
        $newdiff = $liters - $dip_units_for_reg_die[$i];
        if ($newdiff < 0) {
            $margin = $diff / (abs($newdiff) + $diff);
            $units = ($i * 2) + ($margin * 2);
            return number_format($units, 1, '.', '');
        } else {
            $diff = abs($newdiff);
        }
    }
}

function GET_DIP_UNIT_SUPER($liters)
{
    $dip_units_for_reg_die = [
        15,
        43,
        79,
        121,
        169,
        220,
        275,
        336,
        399,
        465,
        533,
        604,
        678,
        753,
        831,
        910,
        991,
        1074,
        1158,
        1243,
        1329,
        1416,
        1505,
        1594,
        1684,
        1774,
        1865,
        1957,
        2049,
        2141,
        2233,
        2325,
        2418,
        2510,
        2602,
        2693,
        2785,
        2876,
        2966,
        3055,
        3144,
        3232,
        3319,
        3405,
        3489,
        3572,
        3654,
        3734,
        3813,
        3889,
        3964,
        4036,
        4106,
        4173,
        4237,
        4299,
        4357,
        4411,
        4460,
        4505,
        4544,
        4576,
        4599
    ];

    $units = 0;
    $diff = 14000;
    for ($i = 0; $i < count($dip_units_for_reg_die); $i++) {
        $newdiff = $liters - $dip_units_for_reg_die[$i];
        if ($newdiff < 0) {
            $margin = $diff / (abs($newdiff) + $diff);
            $units = ($i * 2) + ($margin * 2);
            return number_format($units, 1, '.', '');
        } else {
            $diff = abs($newdiff);
        }
    }
}
