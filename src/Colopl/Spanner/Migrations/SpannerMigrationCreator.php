<?php

namespace Colopl\Spanner\Migrations;

use Illuminate\Database\Migrations\MigrationCreator;
use Illuminate\Filesystem\Filesystem;

class SpannerMigrationCreator extends MigrationCreator
{
    /**
     * Create a new migration creator instance.
     *
     * @param  \Illuminate\Filesystem\Filesystem  $files
     * @param  string  $customStubPath
     * @return void
     */
    public function __construct(Filesystem $files, $customStubPath)
    {
        $customStubPath = __DIR__ . '/stubs';

        parent::__construct($files, $customStubPath);
    }
}
