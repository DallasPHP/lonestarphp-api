set :application, 'api.lonestarphp.com'
set :repo_url, 'https://github.com/DallasPHP/lonestarphp-api.git'

# Default branch is :master
# ask :branch, proc { `git rev-parse --abbrev-ref HEAD`.chomp }.call

# Default deploy_to directory is /var/www/my_app
set :deploy_to, '/var/www/api.lonestarphp.com'

# Default value for :scm is :git
set :scm, :git

# Default value for :format is :pretty
set :format, :pretty

# Default value for :log_level is :debug
set :log_level, :debug

# Default value for :pty is false
set :pty, true

# Default value for :linked_files is []
set :linked_files, %w{.env}

# Default value for linked_dirs is []
set :linked_dirs, %w{vendor logs}

# Default value for default_env is {}
# set :default_env, { path: "/opt/ruby/bin:$PATH" }

# Default value for keep_releases is 5
set :keep_releases, 5

namespace :deploy do

  desc 'Composer Install'
  task :composer_install do
    on roles(:web) do
      within release_path do
        execute 'composer', 'install', '--no-dev', '--optimize-autoloader'
      end
    end
  end

  desc 'Migrate Database'
  task :phinx_migrate do
    on roles(:web) do
      # Collect enviornment variables to use with migrate
      within release_path do
        env_content = capture(:cat, '.env').split("\r\n")

        env_vars = {}
        env_content.each do |line|
          key,value = line.split('=')
          env_vars[key] = value unless key.empty?
        end

        with env_vars do
          execute './vendor/bin/phinx', 'migrate', '-e production'
        end
      end
    end
  end

  after :publishing, :composer_install
  after :publishing, :phinx_migrate

end
