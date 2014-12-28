<?php

use Phinx\Migration\AbstractMigration;

class ChangeTalkTitleLength extends AbstractMigration
{

    /**
     * Migrate Up.
     */
    public function up()
    {
        $this->table('talks')
            ->changeColumn('title', 'string', ['length' => 255])
            ->save();
    }

    /**
     * Migrate Down.
     */
    public function down()
    {
        $this->table('talks')
            ->changeColumn('title', 'string', ['length' => 40])
            ->save();
    }
}