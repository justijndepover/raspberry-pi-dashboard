<?php
namespace Deployer;

require 'recipe/laravel.php';

/*************************************************
 MAIN CONFIGURATION
 *************************************************/
set('repository', 'https://github.com/in2red/raspberry-pi-dashboard');
set('git_tty', true); // [Optional] Allocate tty for git on first deployment
// Laravel shared file
set('shared_files', [
    '.env'
]);
add('shared_dirs', [
    'storage'
]);
add('writable_dirs', [
    'storage',
    'vendor'
]);
set('allow_anonymous_stats', false);
set('default_stage', 'staging');
set('http_user', 'pi');
set('keep_releases', 5);


/*************************************************
 HOSTS
 *************************************************/
// Staging
host('192.168.0.172')
    ->user('pi')
    ->stage('staging')
    ->set('branch', 'master')
    ->set('deploy_path', '/var/www/domain.com');


/*************************************************
 CUSTOM TASKS
 *************************************************/
task('upload:env', function () {
    upload('.env.staging', '{{deploy_path}}/shared/.env');
})->desc('Environment setup')->onStage('staging');

task('upload:env', function () {
    upload('.env.production', '{{deploy_path}}/shared/.env');
})->desc('Environment setup')->onStage('production');

task('config:symlink', function(){
    run('ln -s {{deploy_path}}public_html {{deploy_path}}/release/public');
})->desc('Create symbolic link');


/*************************************************
 RUN TASKS
 *************************************************/
desc('Deploy your project');
task('deploy', [
    'deploy:prepare',
    'deploy:lock',
    'deploy:release',
    'deploy:update_code',
    'deploy:shared',
    // 'upload:env',
    'deploy:vendors',
    'deploy:writable',
    'artisan:migrate',
    // 'artisan:db:seed',
    'artisan:view:clear',
    'artisan:cache:clear',
    'artisan:config:cache',
    // 'artisan:route:cache',
    'artisan:optimize',
    'deploy:symlink',
    'deploy:unlock',
    'cleanup',
]);
after('deploy', 'success');
