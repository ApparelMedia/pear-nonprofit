## Pear Nonprofit Org Search
### Features
1. Automated one-command update from IRS website
2. Super fast name search using Postgres Full-text search features
3. Restful API

### Getting Started (with Vagrant Environment)
1. Clone this repo to your local computer
2. Edit your Soil.yaml file: add site, and a database `nonprofit_local` (or whatever name you see fit)
3. Add your local site url to `./etc/hosts`
4. `composer install` in the VM
5. In `pear-nonprofit` directory, duplicate `.env.sample` to `.env`
6. In the `.env` file, set `APP_KEY` to a random 32-character alpha-numeric string (no quotes)
7. Make sure `DB_CONNECTION` is set to `pgsql` as we'll need to use Postgres
8. Run `php artisan migrate`
9. Run `php artisan data:downloadFile`, This will download the zip file from the IRS site
10. Run `php artian data:reloadTable`, This will load the csv file to the postgres table

