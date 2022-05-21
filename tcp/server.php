<?php
$sock = socket_create(AF_INET, SOCK_DGRAM,0);
socket_bind($sock, '192.34.234.30', 8881);
socket_recvfrom($sock,$buf,100,0,$rip,$rport);
echo "recieved ".$buf."from ".$rip.$rport;

socket_sendto($sock,"hi",2,0,$rip,$rport);
?>