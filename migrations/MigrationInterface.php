<?php

namespace Migration;

interface MigrationInterface
{

    public function up();
    public function down();
}
