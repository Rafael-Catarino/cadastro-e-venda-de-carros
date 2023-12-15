<?php

function createSecurityKey(): string
{
  $key1 = "abcdefghijklmnopqrstuvwxyz";
  $key2 = "ABCDEFGHIJKLMNOPQRSTUVWXYZ";
  $key3 = "0123456789";
  $key4 = str_shuffle($key1 . $key2 . $key3);
  $stringSize = strlen($key4);
  $key = "";
  $numberOfCharacters = rand(20, 50);
  for ($i = 0; $i < $numberOfCharacters; $i++) {
    $position = rand(0, $stringSize);
    $key .= substr($key4, $position, 1);
  }
  return $key;
}
