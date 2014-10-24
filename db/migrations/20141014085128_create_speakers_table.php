<?php

use Phinx\Migration\AbstractMigration;

class CreateSpeakersTable extends AbstractMigration
{
    /**
     * Create Speakers Table
     */
    public function up()
    {
        $this->table('speakers')
            ->addColumn('first_name', 'string', ['limit' => 40])
            ->addColumn('last_name', 'string', ['limit' => 40])
            ->addColumn('company', 'string', ['limit' => 100])
            ->addColumn('twitter', 'string', ['limit' => 25])
            ->addColumn('bio', 'text')
            ->addColumn('photo_path', 'string', ['limit' => 255])
            ->addColumn('created_at', 'datetime')
            ->addColumn('updated_at', 'datetime')
            ->save();
    }

    /**
     * Delete Speakers Table
     */
    public function down()
    {
        $this->dropTable('speakers');
    }
}