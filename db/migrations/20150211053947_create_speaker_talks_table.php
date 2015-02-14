<?php

use Phinx\Migration\AbstractMigration;

class CreateSpeakerTalksTable extends AbstractMigration
{

    /**
     * Migrate Up.
     */
    public function up()
    {
        $this->table('speaker_talks')
            ->addColumn('speaker_id', 'integer', ['limit' => 11])
            ->addColumn('talk_id', 'integer', ['limit' => 11])
            ->addColumn('created_at', 'datetime')
            ->addColumn('updated_at', 'datetime')
            ->addIndex(['speaker_id', 'talk_id'], ['unique' => true])
            ->save();

        $talks = $this->fetchAll('SELECT id AS talk_id, speaker_id FROM talks');

        foreach ($talks as $talk) {
            $this->execute(
                sprintf(
                    "INSERT INTO speaker_talks (speaker_id, talk_id, created_at, updated_at) VALUES (%s, %s, NOW(), NOW())",
                    $talk['speaker_id'],
                    $talk['talk_id']
                )
            );
        }

        $this->table('talks')
            ->removeColumn('speaker_id')
            ->update();
    }

    /**
     * Migrate Down.
     */
    public function down()
    {
        $this->table('talks')
            ->addColumn('speaker_id', 'integer', ['limit' => 11])
            ->save();

        $talks = $this->fetchAll('SELECT talk_id, speaker_id FROM speaker_talks');

        foreach ($talks as $talk) {
            $this->execute(
                sprintf(
                    "UPDATE talks SET speaker_id=%s WHERE id = %s",
                    $talk['speaker_id'],
                    $talk['id']
                )
            );
        }

        $this->dropTable('speaker_talks');
    }
}