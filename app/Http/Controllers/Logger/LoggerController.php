<?php

namespace App\Http\Controllers\Logger;

use App\Http\Controllers\ApiController;
use Illuminate\Http\Request;
use App\src\Logger\LoggerTrait as Logger;

class LoggerController extends ApiController
{
    use Logger;

    public function __invoke(Request $request)
    {
        $emailLogger            = self::createEmailLogger();
        $filesystemLogger       = self::createFilesystemLogger();
        $legacyFilesystemLogger = self::createLegacyFilesystemLogger();

        $emailLogger->info('adsda',[]);
        $filesystemLogger->info('adsda',[]);
        $legacyFilesystemLogger->info('adsda',[]);

        dd(
            [
                'emailLogger'            => $emailLogger,
                'filesystemLogger'       => $filesystemLogger,
                'legacyFilesystemLogger' => $legacyFilesystemLogger
            ]
        );

    }

    protected function exceptions(): array
    {
        return [

        ];
    }
}
