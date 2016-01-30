<?php


$response = json_decode($_POST['json']);
// var_dump($response);
// $response = $_POST['json_string'];

error_log("Response is: " . print_r($response, true));

// $responseArray = (array)$response;

$secret = '"QQJXpMmdgHNW2v3k5$yqAbLvy}IGM1OLlFeZhO0P"';
// $opts = getopt("k:d:");
// $rawPayload = decryptPayload($secret, $opts["k"], $opts["d"]);

error_log("encKey is: " . print_r($response->encKey), true);

// $rawPayload = decryptPayload($secret, $responseArray["encKey"], $responseArray["encPaymentData"]);

$rawPayload = decryptPayload($secret, $response->encKey, $response->encPaymentData);

$encodeRawPayload = json_encode($rawPayload);

// print "Decrypted payload: " . $rawPayload . "\n";

error_log("Decrypted payload: " . $encodeRawPayload);

function decryptPayload($key, $wrappedKey, $payload) {
  print "Secret: " . $key . "\n";
  print "encKey: " . $wrappedKey . "\n";
  print "encPaymentData&colon; " . $payload . "\n";   
  $unwrappedKey = decrypt($key, $wrappedKey);   
  print "Unwrapped Key: " . $unwrappedKey . "\n";
  return decrypt($unwrappedKey, $payload);  
}   

function decrypt($key, $data) {    
  $decodedData = base64_decode($data);  
   // TODO: Check that data is at least bigger than HMAC + IV length    
   $hmac = substr($decodedData, 0, 32);  
   $iv = substr($decodedData, 32, 16);  
   $data = substr($decodedData, 48);   
   if ($hmac != hmac($key, $iv . $data)) {    
     // TODO: Handle HMAC validation failure      
     return 0;   
   }    
   //echo "no error";
   return openssl_decrypt($data, 'aes-256-cbc', hashKey($key), true, $iv); 
}
  
function hashKey($data) {   
  $hasher = hash_init('sha256');    
  hash_update($hasher, $data);    
  return hash_final($hasher, true); 
}   
 
function hmac($key, $data) {    
  return hash_hmac('sha256', $data, $key, true);  
}   

?> 