<?php

echo '<p>Primeiro trecho de código!</p>';

$date1 = new DateTime('2019/01/20 13:50:00');
$date2 = new DateTime('2019/01/22 14:55:00');
$dateDiff = $date1->diff($date2);

$startDate = strtotime('2019/01/20 13:50:00');
$endDate = strtotime('2019/01/22 14:55:00');
$difference = abs($endDate - $startDate)/3600;



?>

<ul>

    <li>
<!--        --><?php //var_dump($dateDiff); ?>
        <?php echo $dateDiff->format('%H:%I:%S'); ?>
    </li>
    <li>
        <?php echo $date1->format('H:i:s'); ?>
    </li>
    <li>
        <?php echo $date2->format('H:i:s'); ?>
    </li>

    <li>
        <?php echo $difference; ?>
    </li>

</ul>

<p>
    Vou ter que criar as classes para calcular a diferênça entre horas...
</p>
