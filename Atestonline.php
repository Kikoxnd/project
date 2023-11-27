<?php

// $conn = mysqli_connect('aws.connect.psdb.cloud','v0pm2xl5ilvkmxkbtnd5','pscale_pw_kITBPX2q6ZeL5OFynB4ctienvQx1G4Chbk5OrE9v5sm','deezekco') or die('connection failed');
// 3306 port
// aws.connect.psdb.cloud
// v0pm2xl5ilvkmxkbtnd5
// pscale_pw_kITBPX2q6ZeL5OFynB4ctienvQx1G4Chbk5OrE9v5sm
// deezekco
// HOST=aws.connect.psdb.cloud
// USERNAME=v0pm2xl5ilvkmxkbtnd5
// PASSWORD=pscale_pw_kITBPX2q6ZeL5OFynB4ctienvQx1G4Chbk5OrE9v5sm
// DATABASE=deezekco
//
$mysqli = mysqli_init();
  $mysqli->ssl_set(NULL, NULL, "/etc/ssl/certs/ca-certificates.crt", NULL, NULL);
  $mysqli->real_connect('aws.connect.psdb.cloud', 'v0pm2xl5ilvkmxkbtnd5','pscale_pw_kITBPX2q6ZeL5OFynB4ctienvQx1G4Chbk5OrE9v5sm', 'deezekco');
  $mysqli->close();
 ?>