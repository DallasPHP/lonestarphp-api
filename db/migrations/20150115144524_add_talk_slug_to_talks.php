<?php

use Phinx\Migration\AbstractMigration;

class AddTalkSlugToTalks extends AbstractMigration
{
    /**
     * Migrate Up.
     */
    public function up()
    {
        // Add new slug column
        $talkTable = $this->table('talks');

        if (!$talkTable->hasColumn('slug')) {
            $talkTable->addColumn('slug', 'string')
            ->save();
        }

        $talks = $this->fetchAll('SELECT * FROM talks');

        // Create slug from initial talk title
        foreach ($talks as $talk) {
            $id = $talk['id'];
            $titleTrimmed = preg_replace(
                "([^a-zA-Z0-9\s])",
                "",
                $talk['title']
            );

            $slug = strtolower(str_replace(
                " ",
                "-",
                $titleTrimmed
            ));
            $query = "UPDATE talks SET slug = \"{$slug}\", updated_at = NOW() WHERE id = {$id}";
            $this->execute($query);
        }
    }

    /**
     * Migrate Down.
     */
    public function down()
    {
        $this->table('talks')
            ->removeColumn('slug');
    }
}
