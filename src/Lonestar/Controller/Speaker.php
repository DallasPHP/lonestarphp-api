<?php

namespace Lonestar\Controller;

class Speaker extends \SlimController\SlimController
{
    public function indexAction()
    {
        $db = $this->app->db;

        $results = $db->fetchAll("SELECT * FROM speakers");
        $this->render(200, $results);
    }

    public function showAction($id)
    {
        $this->render(200, ['message' => 'show']);
    }

    public function talksAction($id)
    {
        $this->render(200, ['message' => 'talks']);
    }

    public function createAction()
    {
        $data = $this->request()->post();
        $db = $this->app->db;

        $query = "INSERT INTO speakers (first_name, last_name) VALUES (:first_name, :last_name)";
        $db->perform($query, $data);

        $id = $db->lastInsertId();

        $this->app->response()->header(
            'Location',
            $this->app->urlFor(
                'Speaker:show',
                ['id' => $id]
            )
        );
        $this->render(202, ['message' => 'Created Speaker']);
    }
}