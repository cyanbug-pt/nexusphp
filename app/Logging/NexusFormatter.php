<?php
namespace App\Logging;

use Monolog\Formatter\LineFormatter;

class NexusFormatter
{
    public function __invoke($logger)
    {
        foreach ($logger->getHandlers() as $handler) {
            $handler->setFormatter($this->formatter());
        }
    }

    protected function formatter()
    {
        $id = 'NO_REQUEST_ID';
        if (nexus()) {
            $id = nexus()->getRequestId();
        }
        $format = "[%datetime%] [" . $id . "] %channel%.%level_name%: %message% %context% %extra%\n";
        return tap(new LineFormatter($format, "Y-m-d\TH:i:s.vP", true, true), function ($formatter) {
            $formatter->includeStacktraces();
        });
    }
}
