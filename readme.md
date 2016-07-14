![test-status](https://codeship.com/projects/83b4b1d0-0e3c-0134-37ff-663a1105f325/status?branch=master)

## Pear Nonprofit Org Search API Proof-of-concept

### Features
1. Automated one-command database update from IRS website
2. Super fast name search (with city and state) using Postgres Full-text search features
3. Restful API

### Getting Started (with the Soil Vagrant Environment)
1. Clone this repo to your local computer
2. Edit your Soil.yaml file: add site (e.g `nonprofit.app`), and a database `nonprofit_local` (or whatever name you choose)
3. Add the local site url to `./etc/hosts`
4. `composer install` in the VM
5. In `pear-nonprofit` directory, duplicate `.env.sample` to `.env`
6. In the `.env` file, set `APP_KEY` to a random 32-character alpha-numeric string (no quotes)
7. Make sure `DB_CONNECTION` is set to `pgsql` as we'll need to use Postgres
8. Run `php artisan migrate`
9. Run `php artisan data:downloadFile`, This will download the zip file from the IRS site (around a few minutes)
10. Run `php artian data:reloadTable`, This will load the csv file to the postgres table (watch the progress bar) if the process is "Killed" before it reached 100%, please see "Note on Memory Usage" below.

### Web Interface
I have moved the web interface to a [separate repo](https://github.com/ApparelMedia/pear-nonprofit-web), to keep this project as a pure API service.

### To Use the API
Currently there is only one working path: `/api/nonprofits/search?q=[searchstring]`
Once you have completed the steps in "Getting Started", you can test the route in postman.

### Note on Memory Usage
Because processing a million rows of data is pretty memory-intensive, it's possible that in the middle of the `data:reloadTable` command, the VM will "kill" the process due to out-of-memory.
To fix the problem, you would need to disable xdebug (which is by default enabled)
1. `sudo vim /etc/php5/mods-available/xdebug.ini`
2. Add a semicolon to the beginning of first line so it becomes `;zend_extension=xdebug.so`
3. save and quit vim
When you run the command again, it should work.

### Deployment
This app uses [Deployer](http://deployer.org/), a zero-downtime deployment tool written in PHP and **heavily** inspired by Ruby's Capistrano.  
You can check out `deploy.php` to see what is involved.

Install Deployer by running `composer global require deployer/deployer:~4.0@dev herzult/php-ssh`  
Now when you run `dep`, you should see a wealth of commands you can run to manage your deployments.  
You'll also need to set up your `~/.ssh/config` for the servers like so:
```
Host prod1.nonprofit
    HostName prod.host.example.com
    User someuser
    IdentityFile /home/vagrant/.ssh/id_rsa
```

To deploy, you can run `dep deploy` to deploy to staging, and `dep deploy production` to deploy to production