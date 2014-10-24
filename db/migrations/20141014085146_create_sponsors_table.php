<?php

use Phinx\Migration\AbstractMigration;

class CreateSponsorsTable extends AbstractMigration
{
    /**
     * Create Sponsors Table
     */
    public function up()
    {
        $this->table('sponsors')
            ->addColumn('name', 'string', ['limit' => 100])
            ->addColumn('url', 'string', ['limit' => 255])
            ->addColumn('sponsor_level', 'integer', ['limit' => 1])
            ->addColumn('description', 'text')
            ->addColumn('logo_path', 'string', ['limit' => 255])
            ->addColumn('created_at', 'datetime')
            ->addColumn('updated_at', 'datetime')
            ->save();
    }

    /**
     * Delete Sponsors Table
     */
    public function down()
    {
        $this->dropTable('sponsors');
    }
}