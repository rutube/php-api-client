<?php
const LIMIT = 15;

$test = file_get_contents('output.json');
$test = '{"result": [' . $test . ']}';
$test = str_replace('}{', '},{', $test);
$test = json_decode($test);

usort($test->result, function ($a, $b) {
    if (!isset($a->time)) return 1;
    if (!isset($b->time)) return 1;

    if ($a->time == $b->time) {
        return 0;
    }
    return ($a->time < $b->time) ? 1 : -1;
});

$n = 0;
echo "Results:\n";
foreach ($test->result as $item) {
    if ($n > LIMIT) break;
    if ($item->event == "test") {
        if ($item->status == "pass") {
            echo " - " . sprintf("%01.2f", $item->time) . " (" . $item->suite . ") [" . $item->status . "]\n";
        }
        if ($item->status == "error") {
            echo " ! " . $item->time . " (" . $item->suite . ") [" . $item->status . "]\n";
        }
        $n++;
    }
}
echo "\n";