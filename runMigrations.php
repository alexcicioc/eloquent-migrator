<?php

use App\Services\Migrator;
use Carbon\Carbon;

include "bootstrap.php";

function getRandomDateTime() {
    return Carbon::create(2019, rand(1, 12), rand(1, 28), rand(1, 23), rand(1, 59));
}

function outputMessage($message)
{
    fwrite(STDOUT, $message . "\n");
}

function createSchemas()
{
    foreach (SCHEMA_LIST as $schema) {
        Migrator::createTable(new $schema);
    }
}

function updateSchemas()
{
    foreach (UPDATES_LIST as $class) {
        Migrator::updateTable(new $class);
    }
}

function runMigrations($retries = 0)
{
    if ($retries > DB_CONNECT_MAX_RETRIES) {
        outputMessage("Max number of retries reached");
        return;
    }

    try {
        createSchemas();
        updateSchemas();
    } catch (PDOException $exception) {
        if ($exception->getCode() !== 2002) {
            throw $exception;

        }
        outputMessage("Unable to connect to db, retrying in " . DB_CONNECT_RETRY_TIME . " seconds...");
        sleep(DB_CONNECT_RETRY_TIME);
        runMigrations(++$retries);
    }
}

runMigrations();
