<?php

namespace App\Services;

interface BaseCommand
{
    public function store(): void;

    public function update(): void;

    public function destroy(): void;
}
