<?php
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $ip = $_POST['IP'];
    $serveis = [];

    if (isset($_POST['SSH'])) $serveis[] = $_POST['SSH'];
    if (isset($_POST['HTTP'])) $serveis[] = $_POST['HTTP'];
    if (isset($_POST['MYSQL'])) $serveis[] = $_POST['MYSQL'];
    if (isset($_POST['SMTP'])) $serveis[] = $_POST['SMTP'];
    if (isset($_POST['POP3'])) $serveis[] = $_POST['POP3'];
    if (isset($_POST['HTTPS'])) $serveis[] = $_POST['HTTPS'];
    if (isset($_POST['IMAP'])) $serveis[] = $_POST['IMAP'];

    echo "<h2>Comandes IPTABLES Collados2</h2>";
    echo "<pre>";

    echo "<strong>Bloqueig de totes les connexions INPUT, OUTPUT i FORWARD:</strong>\n";
    echo "iptables -P INPUT DROP\n";
    echo "iptables -P OUTPUT DROP\n";
    echo "iptables -P FORWARD DROP\n";
    echo "<pre>";
    echo "<strong>Connexions a la interficie loopback acceptada:</strong>\n";
    echo "iptables -A INPUT -i lo -j ACCEPT\n";
    echo "iptables -A OUTPUT -o lo -j ACCEPT\n";
    echo "<pre>";
    echo "<strong>Nomes connexions als serveix seleccionats:</strong>\n";
    foreach ($serveis as $port) {
        echo "iptables -A INPUT -s $ip -p tcp --dport $port -m state --state NEW,ESTABLISHED -j ACCEPT\n";
        echo "iptables -A OUTPUT -d $ip -p tcp --sport $port -m state --state ESTABLISHED -j ACCEPT\n";
    }
    echo "<pre>";
    echo "<strong>Autors: Iago Valadez & Alex Serrano\n";
    echo "<pre>";
    echo "<strong>Grup: 14\n";
    echo "</pre>";
}
?>
