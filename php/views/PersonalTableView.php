<?php
/**
 * Created by PhpStorm.
 * User: Michał Domagała
 * Date: 2018-05-11
 * Time: 12:04
 */

$day_names = array(
    0 => 'Monady',
    1 => 'Tuesday',
    2 => 'Wednesday',
    3 => 'Thursday',
    4 => 'Friday',
    5 => 'Saturday',
    6 => 'Sunday',
)

?>

<table style="width: 100%">
    <tr>
        <th>Hours</th>
        <?php for ($i = 0; $i < 7; $i++ ){ ?>
            <th><?php echo $day_names[$i%7] ?></th>
        <?php }?>
    </tr>

    <?php for ($i = 0; $i < 24; $i++ ){ ?>
        <tr>
        <td><?php echo $i.':00 - '.$i.':00'?></td>
        <?php for ($j = 0; $j < 7; $j++ ){ ?>
            <td>test</td>
        <?php }?>
        </tr>
    <?php }?>

</table>
