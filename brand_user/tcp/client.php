<?php

$sock = socket_create(AF_INET, SOCK_DGRAM,0);

socket_sendto($sock,"hello",5,0,"65.1.223.9",8888);

socket_recvfrom($sock,$buf,100,0,$rip,$rport);
echo "recieved back from server".$buf."from ".$rip.$rport;
?>