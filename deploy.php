<?php
namespace Deployer;

require 'recipe/laravel.php';

// Config

set('repository', 'https://github.com/tu002/test-ci-cd.git');

add('shared_files', []);
add('shared_dirs', []);
add('writable_dirs', []);

// Hosts


// Hooks

after('deploy:failed', 'deploy:unlock');
