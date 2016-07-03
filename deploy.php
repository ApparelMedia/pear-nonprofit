<?php
/*
 * This file has been generated automatically.
 * Please change the configuration for correct use deploy.
 */

require 'recipe/laravel.php';

set('ssh_type', 'ext-ssh2');

// Set configurations
set('repository', 'git@github.com:ApparelMedia/pear-nonprofit-api.git');
set('shared_files', ['.env']);
set('shared_dirs', [
    'storage/app',
    'storage/framework/cache',
    'storage/framework/sessions',
    'storage/framework/views',
    'storage/logs',
]);

set('writable_dirs', ['storage']);

// Configure servers
server('production', 'metro')->configFile();

/**
 * Restart php-fpm on success deploy.
 */
task('php-fpm:restart', function () {
    // Attention: The user must have rights for restart service
    // Attention: the command "sudo /bin/systemctl restart php-fpm.service" used only on CentOS system
    // /etc/sudoers: username ALL=NOPASSWD:/bin/systemctl restart php-fpm.service
    run('sudo /bin/systemctl restart php-fpm.service');
})->desc('Restart PHP-FPM service');

after('success', 'php-fpm:restart');