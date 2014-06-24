set :application, "devops"
set :domain,      "#{application}.in.net"
set :deploy_to,   "/var/www/#{domain}"
set :app_path,    "app"
set :user, "www-data"

set :repository,  "git@github.com:sogos/gerHosting.git"
set :scm,         :git
# Or: `accurev`, `bzr`, `cvs`, `darcs`, `subversion`, `mercurial`, `perforce`, or `none`

set :model_manager, "doctrine"
# Or: `propel`

role :web,        domain                         # Your HTTP server, Apache/etc
role :app,        domain, :primary => true       # This may be the same as your `Web` server
set   :use_sudo,      false

set  :keep_releases,  3
set :use_composer, true
set :update_vendors, true
set :interactive_mode, false


# Be more verbose by uncommenting the following line
logger.level = Logger::MAX_LEVEL

default_run_options[:pty] = true

set :app_path,              "app"
set :bin_path,              "bin"
set :var_path,              "var"
set :web_path,              "web"

# Symfony console bin
set :symfony_console,       bin_path + "/console"
set :dump_assetic_assets,   true

# Symfony log path
set :log_path,              var_path + "/logs"

# Symfony cache path
set :cache_path,            var_path + "/cache"

set :shared_files,      ["app/config/parameters.yml"]
