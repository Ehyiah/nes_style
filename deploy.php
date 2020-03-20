<?php

namespace Deployer;

require 'vendor/deployer/deployer/recipe/symfony4.php';

set('application', 'nes_style');
set('repository', 'git@github.com:Ehyiah/nes_style.git');

set('writable_dirs', ['var/cache']);
set('shared_files', ['.env']);
set('shared_dirs', ['public/uploads']);

set('git_tty', false);
set('ssh_multiplexing', false);

set('default_stage', 'prod');
set('default_timeout', 1200);

host('nesHost')
    ->hostname('cv.gostiaux.net')
    ->stage('prod')
    ->set('deploy_path', '/var/www/nes_style')
    ->user('deployer');

before('deploy:prepare', 'deploy:getversion');
after('deploy:failed', 'deploy:unlock');

before('deploy:symlink', 'yarn:install');
before('deploy:symlink', 'database:migrate');

task('yarn:install', function () {
    run('cd {{release_path}} && yarn install && yarn build');
});

task('deploy:getversion', function () {
    $tags = explode("\n", runLocally('git tag --sort=v:refname'));
    if (count($tags) > 0) {
        set('branch', $tags[count($tags) - 1]);
    }
    $branch = ask('Version to deploy', get('branch'));
    set('branch', $branch);
});
