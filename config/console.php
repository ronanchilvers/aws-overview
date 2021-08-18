<?php
// Add console commands here

use App\Console\Command\TestCommand;
use App\Console\Command\WatchCommand;

$console->add(new WatchCommand);
$console->add(new TestCommand);
