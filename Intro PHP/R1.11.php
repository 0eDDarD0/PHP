<?php

    echo '<table border= solid>';
    echo '<tr><td>tabla del 1</td><td>tabla del 2</td><td>tabla del 3</td><td>tabla del 4</td><td>tabla del 5</td><td>tabla del 6</td><td>tabla del 7</td><td>tabla del 8</td><td>tabla del 9</td><td>tabla del 10</td></tr>';

    for($i = 1 ; $i <= 10 ; $i++){

        echo "<tr><td>1 x $i = ". $i*1 ."</td><td>2 x $i = ". $i*2 ."</td><td>3 x $i = ". $i*3 ."</td><td>4 x $i = ". $i*4 ."</td><td>5 x $i = ". $i*5 ."</td><td>6 x $i = ". $i*6 ."</td><td>7 x $i = ". $i*7 ."</td><td>8 x $i = ". $i*8 ."</td><td>9 x $i = ". $i*9 ."</td><td>10 x $i = ". $i*10 ."</td></tr>";
    }

    echo '</table>';

?>