<?php namespace Deployer;

require 'recipe/laravel.php';

set('ssh_type', 'ext-ssh2');
set('default_stage', 'staging');

// Set configurations
set('repository', 'git@github.com:ApparelMedia/pear-nonprofit-api.git');
set('writable_dirs', ['storage']);
set('shared_files', ['.env']);
set('shared_dirs', [
    'storage/app',
    'storage/framework/cache',
    'storage/framework/sessions',
    'storage/framework/views',
    'storage/logs',
]);

task('copy:dotenv', function () {
    $sourceDotEnv = '/opt/microservices/shared/.env.' . env('stage_name');
    $targetDotEnv = env('deploy_path') .'/shared/.env';
    run("cp $sourceDotEnv $targetDotEnv");
})->desc('Copying .env file from source of truth');

after('deploy:symlink', 'copy:dotenv');

// Configure servers

// Production Server
$stageName = 'production';
server('prod1', 'prod1.nonprofit')
    ->configFile('/home/vagrant/.ssh/config')
    ->env('deploy_path', '/var/www/nonprofits-api')
    ->env('stage_name', $stageName)
    ->stage($stageName);

// Staging Server
$stageName = 'staging';
server('stage1', 'stage1.nonprofit')
    ->configFile('/home/vagrant/.ssh/config')
    ->env('deploy_path', '/var/www/nonprofits-api')
    ->env('stage_name', $stageName)
    ->stage($stageName);

