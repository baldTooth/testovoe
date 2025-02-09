<?php

namespace Randomserver;
use Randomserver\Repositories\Interfaces\RandomNumberRepositoryInterface;
use Randomserver\Repositories\RandomNumberRepository;
use Randomserver\Services\Interfaces\RandomNumberServiceInterface;
use Randomserver\Services\RandomNumberService;
use Randomserver\Controllers\RandomNumber\RandomNumberControllerInterface;
use Randomserver\Controllers\RandomNumber\RandomNumberController;

return[
    RandomNumberRepositoryInterface::class=>RandomNumberRepository::class,
    RandomNumberServiceInterface::class=>RandomNumberService::class,
    RandomNumberControllerInterface::class=>RandomNumberController::class,
];