<?php
namespace Lonestar\View;

class Json extends \Slim\View
{
    public function render($status = 200, $data = null)
    {
        $app = \Slim\Slim::getInstance();

        $status = intval($status);

        $data = $this->all();

        unset($data['flash']);

        $app->response()->setStatus($status);
        $app->response()->header('Content-Type', 'application/json');

        $jsonpCallback = $app->request()->get('callback', null);

        if ($jsonpCallback !== null){
            $app->response()->body($jsonpCallback . '(' . json_encode($data) . ')');
        } else {
            $app->response()->body(json_encode($data, JSON_PARTIAL_OUTPUT_ON_ERROR));
        }

        $app->stop();

    }
}