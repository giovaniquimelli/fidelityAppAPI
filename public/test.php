<?php

require_once '../src/Util/Crypto.php';

$plaintext = 'x8mh0yBgvhYYh0dd9ueRrA==';
$encrypted = \App\Util\Crypto::encrypt($plaintext);
$decrypted = \App\Util\Crypto::decrypt($plaintext);

echo 'encrypted to: ' . $encrypted . "\n";
echo 'decrypted to: ' . $decrypted . "\n\n";