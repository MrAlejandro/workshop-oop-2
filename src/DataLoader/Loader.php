<?php

namespace App\DataLoader;

interface Loader
{
    public function get(string $url): string;
}
