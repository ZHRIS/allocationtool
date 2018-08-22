<?php

$output = "";
if (is_object($dto)) {
    $output = $dto->toJSONString();
}
echo $dto;
