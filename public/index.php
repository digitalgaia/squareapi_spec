<?php

require_once __DIR__.'\..\app\app.php';

$exedra->httpRequest->resolveUri();
$exedra->dispatch();