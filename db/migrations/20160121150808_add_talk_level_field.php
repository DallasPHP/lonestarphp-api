<?php

use Phinx\Migration\AbstractMigration;

class AddTalkLevelField extends AbstractMigration
{

    /**
     * Migrate Up.
     */
    public function up()
    {
        $this->table('talks')
            ->addColumn('level', 'string', ['length' => 20])
            ->save();
    }

    /**
     * Migrate Down.
     */
    public function down()
    {
        $this->table('talks')
            ->removeColumn('level')
            ->save();
    }
}
