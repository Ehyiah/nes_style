<?php

namespace Deployer;

require 'vendor/deployer/deployer/recipe/symfony4.php';

set('application', 'nes_style');
set('repository', 'git@github.com:Ehyiah/nes_style.git');

set('writable_dirs', ['var/cache']);

set('git_tty', false);

set('ssh_multiplexing', false);

set('default_stage', 'dev');

set('allow_anonymous_stats', false);

// Hosts
host('nesHost')
    ->hostname('home701856139.1and1-data.host')
    ->stage('dev')
    ->set('deploy_path', '/nes_style')
    ->user('u90780264');

before('deploy:prepare', 'deploy:getversion');
after('deploy:failed', 'deploy:unlock');

before('deploy:symlink', 'yarn:install');
before('deploy:symlink', 'database:migrate');
//after('database:migrate', 'symfony:translation');

task('yarn:install', function () {
    run('cd {{release_path}} && yarn install && yarn build');
});

//task('symfony:translation', function () {
//    run('{{bin/console}} app:import-translations');
//});

task('deploy:getversion', function () {
    $tags = explode("\n", runLocally('git tag --sort=v:refname'));
    if (count($tags) > 0) {
        set('branch', $tags[count($tags) - 1]);
    }
    $branch = ask('Version to deploy', get('branch'));
    set('branch', $branch);
});
