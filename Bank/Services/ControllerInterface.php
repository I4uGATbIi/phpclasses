<?php

namespace Bank\Services;

interface ControllerInterface
{
    public function execute($request, $response);
}