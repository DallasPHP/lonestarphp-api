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
        $db = $this->app->db;

        $results = $db->fetchAll("SELECT * FROM speakers WHERE id = :id", ['id' => (int) $id]);
        $this->render(200, $results);
    }

    public function talksAction($id)
    {
        $this->render(200, ['message' => 'talks']);
    }

    public function createAction()
    {
        throw new \Exception('Not currently impelmented');
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