<?php

namespace App\Helpers\Logging;

use Illuminate\Http\Request;
use Monolog\Formatter\LineFormatter;

class ClientApiLogFormatter
{

    public function __construct(Request $request = null)
    {
        $this->request = $request;
    }

    public function __invoke($logger)
    {
        foreach ($logger->getHandlers() as $handler) {


            $handler->setFormatter(new LineFormatter(
                '[%datetime%] %channel%.%level_name%: %res_info% %message% %context% %extra%' . PHP_EOL
            ));

            $handler->pushProcessor([$this, 'processLogRecord']);
        }
    }

    public function processLogRecord(array $record): array
    {
        $record['res_info'] = "['path' : " . $this->request->path() . "]" . "['ip': " . $this->request->getClientIp() . "]";

        $record['extra'] += ['request' => $this->request->all()];

        return $record;
    }
}