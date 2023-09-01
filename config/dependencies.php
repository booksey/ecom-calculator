<?php

use App\Factory\IssueFactory;
use App\Interfaces\IssueFactoryInterface;
use App\Interfaces\IssueHandlerServiceInterface;
use App\Services\IssueHandlerService;
use Psr\Container\ContainerInterface;

return [
    IssueHandlerServiceInterface::class => function (ContainerInterface $container) {
        $issueFactoryInterface = $container->get(IssueFactoryInterface::class);
        return new IssueHandlerService($issueFactoryInterface);
    },
    IssueFactoryInterface::class => function () {
        return new IssueFactory();
    }
];
