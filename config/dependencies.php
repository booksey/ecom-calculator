<?php

use App\Interfaces\IssueHandlerServiceInterface;
use App\Services\IssueHandlerService;

return [
    IssueHandlerServiceInterface::class => function () {
        return new IssueHandlerService();
    }
];
