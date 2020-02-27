<?php

function task1($data)
{
    $order = simplexml_load_file($data);

    echo '<table border="1" cellpadding="4" cellspacing="0" style="width: 500px;">';
    echo '  <tr style="text-align: center; background-color: #efefef;">
                <td><span style="font-size: 14pt; font-weight: bold;">Order:</span> ' . $order->attributes()->PurchaseOrderNumber . '</td>
                <td><span style="font-size: 14pt; font-weight: bold;">Date:</span> ' . $order->attributes()->OrderDate . '</td>
            </tr>';
    foreach ($order->children() as $child) {
        echo '<tr>';
        if ($child->getName() == 'Address') {

            echo '    <td colspan="2"><span style="font-size: 14pt; font-weight: bold;">Address ' . $child->attributes()->Type . '</span>';
            foreach ($child->children() as $grandchild) {
                echo '<br><b>' . $grandchild->getName() . ': </b>' . $grandchild.'';
            }
            echo '    </td>';
        } elseif ($child->getName() == 'DeliveryNotes') {
            echo '    <td colspan="2">
                        <span style="font-size: 14pt; font-weight: bold;">' . $child->getName(). '</span>
                        <br>' . $child;
            echo '    </td>';
        } elseif ($child->getName() == 'Items') {
            echo '    <td colspan="2"><span style="font-size: 14pt; font-weight: bold;">' . $child->getName() . '</span>';
            $i = 1;
            foreach ($child->children() as $grandchild) {
                foreach ($grandchild as $item) {
                    if ($item->getName() == 'ProductName') {
                        echo '<br><b>' . $i++ . '. '. $item.'</b>';
                    } else {
                        echo '<br><span style="margin-left: 17px;">' . $item->getName() . ': '. $item . '</span>';
                    }
                }
            }
            echo '    </td>';
        }
        echo '</tr>';
    }
    echo '</table>';
}

function compare_arr($v1, $v2)
{
    if ($v1 == $v2)
        return 0;
    else if ($v1 > $v2)
        return 1;
    else
        return -1;
}

function task3($min, $max, $cnt)
{
    $arr = [];
    $file = 'data.csv';
    for ($i = 0; $i < $cnt; $i++) {
        $arr[] = rand($min, $max);
    }
    if (($handle = fopen($file, "w")) !== false) {
        fputcsv($handle, $arr, ";");
        fclose($handle);
    }
    return $file;
}

function task4($src, $params)
{
    $data = json_decode(file_get_contents($src));
    $page = key($data->query->pages);
    foreach ($params as $param) {
        echo $param . ': ' .$data->query->pages->$page->$param . '<br>';
    }
}