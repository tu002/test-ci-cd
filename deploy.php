<?php

namespace Deployer;

require 'recipe/laravel.php';
require 'contrib/npm.php';
require 'contrib/rsync.php';

///////////////////////////////////
// Config
///////////////////////////////////

set('repository', 'git@github.com:tu002/test-ci-cd.git'); // Git Repository
set('ssh_multiplexing', true);

set('rsync_src', function () {
    return __DIR__; // If your project isn't in the root, you'll need to change this.
});

add('rsync', [
    'exclude' => [
        '.git',
        '/vendor/',
        '.github',
        'deploy.php',
    ],
]);


host('prod')
->setHostname('104.237.130.191')
->set('remote_user', 'root')
->set('branch', 'main')
->set('deploy_path', '/var/www/test-ci-cd/test-ci-cd');

after('deploy:failed', 'deploy:unlock');

desc('Start of Deploy the application');

task('deploy', [
    'deploy:prepare',
    'rsync',
    'deploy:secrets',
    'deploy:vendors',
    'deploy:shared',
    'artisan:view:cache',
    'artisan:config:cache',
    'deploy:publish',
]);

desc('End of Deploy the application');
