<?php

print("<table border = solid>");
print("<tr><td>decimal</td><td>binario</td><td>octal</td><td>hexadecimal</td></tr>");

for($i = 0 ; $i <= 20 ; $i++){
    print("<tr>");
    print('<td>' . $i . '</td>');
    print('<td>' . decbin($i) . '</td>');
    print('<td>' . decoct($i) . '</td>');
    print('<td>' . dechex($i) . '</td>');
    print("</tr>");
}
print("</table>");

?>