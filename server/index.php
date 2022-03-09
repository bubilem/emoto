<?php
require_once('_conf.php');

require_once(APP_DIR . 'utils/Loader.php');
spl_autoload_register('Loader::loadClass');

header('Access-Control-Allow-Origin: *');

try {
    $request = new RequestModel();
    switch ($request->getUriPart()) {
        case 'echo':
            (new EchoController($request))->run();
            break;
        case 'add-log':
            (new AddLogController($request))->run();
            break;
        case 'get-last-log':
            (new GetLastLogController($request))->run();
            break;
        default:
            echo (string) (new ReplyModel())->status(2);
    }
} catch (Exception $e) {
    echo (string) (new ReplyModel())->status(3, $e->getMessage());
}
