<?php

use Phinx\Migration\AbstractMigration;

class CreateTalksTable extends AbstractMigration
{
    /**
     * Create Talks Table
     */
    public function up()
    {
        $this->table('talks')
            ->addColumn('title', 'string', ['limit' => 40])
            ->addColumn('abstract', 'text')
            ->addColumn('category', 'string', ['limit' => 40])
            ->addColumn('speaker_id', 'integer', ['limit' => 5])
            ->addColumn('created_at', 'datetime')
            ->addColumn('updated_at', 'datetime')
            ->save();
    }

    /**
     * Delete Talks Table
     */
    public function down()
    {
        $this->dropTable('talks');
    }
}