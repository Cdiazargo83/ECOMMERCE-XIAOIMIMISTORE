<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use Illuminate\Support\Facades\File;

class MakeViewCommand extends Command
{
    protected $signature = 'make:view {name : The name of the view}';
    protected $description = 'Create a new view file';

    public function handle()
    {
        $name = $this->argument('name');
        $path = resource_path("views/{$name}.blade.php");

        if (File::exists($path)) {
            $this->error('View already exists!');
            return;
        }

        // Customize the content of your view file as needed
        $content = <<<BLADE
@extends('layouts.admin')

@section('content')
    <h1>Hello, this is {$name} view!</h1>
@endsection
BLADE;

        File::put($path, $content);

        $this->info('View created successfully!');
    }
}
