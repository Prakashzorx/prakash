<?php

$sock = socket_create(AF_INET, SOCK_DGRAM,0);

socket_sendto($sock,"hello",5,0,"127.5.0.12",8811);

socket_recvfrom($sock,$buf,100,0,$rip,$rport);
echo "recieved back from server".$buf."from ".$rip.$rport;
?>