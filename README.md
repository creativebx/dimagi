# Dimagi.com Development Guide

This repo stores the current theme data for Dimagi.com. Below is a guide to help devs address common issues with Dimagi.com.

* [How to Login](#how-to-login) (wpengine vs. wordpress)
* [Requests & Issues](#addressing-requests-issues)

## Logging in to Diamgi.com <a name="how-to-login"></a>

There are three moving parts for Dimagi.com:

1) Our host is wp-engine. You can log into the [wp-engine portal](http://my.wpengine.com/) using credentials in the Dimagi Dev Keepass. If you create a new user, please enable two-factor authentication for that user.
2) [The Dimagi.com production login](http://dimagi.com/wp-admin/) and [Dimagi.com Production Site](http://www.dimagi.com/).
3) [The Dimagi.com staging login](http://dimagi.staging.wpengine.com/) and [Dimagi.com Staging Site](http://dimagi.staging.wpengine.com/).

### What is my username and password?

NOTE: Your wpengine username does **not** work with the [wordpress login](http://dimagi.com/wp-admin/). This is a separate user that must be managed from the Dimagi.com Wordpress Dashboard by an existing Wordpress Admin.

Due to recent security issues, we've had to enable two factor authentication on Dimagi.com with the Google Authenticator Plugin for Wordpress. Unfortunately adding a new user is now supremely clunky, so you will need an existing Wordpress Admin to help you.

If you don't have an existing wpengine account, you will need help from someone who has an existing admin account to help you, due to the two-factor auth security on wpengine.

#### Wordpress Admins Follow These Steps to Add a New User

1) [Login](http://dimagi.com/wp-admin/) to Dimagi.com and have your Google Authenticator app ready.
2) Go to Users > Add New. Fill out the form, apply appropriate role.

#### New Admin Users, Follow These Steps

Once an existing Wordpress Admin has added you as a new user, please check your email with instructions for setting your password. 

1) Click on the link, set a new password and log in.
2) On the top of the screen you should see a notice that says "The admin is requesting all users to activate 2-factor authentication. Click on **please do it now** to set up your Google Authenticator app.

**NOTE:** If you have an existing account with Wordpress, but never enabled two-factor auth, first try logging in or resetting your password and logging in. If that doesn't work, please ask an existing Wordpress Admin to temporarily disable 2 factor auth so that you can login and enable it on your account.

If you don't see the two-factor auth authentication notice, you can set 2 factor auth by visiting your account settings (upper right hand of the screen).

#### Temporarily Disabling Two Factor Authentication

Go to Settings > Authentication and uncheck Yes for **Force Use**. Make sure you go back and turn this on!

## Addressing Dimagi.com Requests and Issues <a name="addressing-requests-issues"></a>

Dimagi.com requests and issues will likely fall into one of the following categories 

1) [Formatting issues](#formatting-debug) on the front-end (e.g. any text/elements that a non-dev can add) with Visual Composer
2) [Plugin issues](#plugin-debug)
3) [Hubspot issues](#hubspot-debug)
4) [Wordpress User Authentication Issues](#wordpress-issues)
5) [Styling issues from the core theme](#css-issues)
6) Updates to the structure of the page or adding completely new styles / widgets / sections

### Debugging Formatting Issues <a name="formatting-debug"></a>

Often if you get a ticket that is something along the lines of "this piece of content looks a little funky" or "this layout looks bad", it is likely a formatting issue that can be debugged using Wordpress-only tools.

1) Log in to the [wordpress dashbaord](http://dimagi.com/wp-admin/)
2) Go to the page with the issue in question
3) Click on **Edit Page** and see if something looks strange in the Visual Composer

If this doesn't solve the problem then it's likely that 2 or 5 are potential steps to try next.

### Debugging Plugin Isses <a name="plugin-debug"></a>

When a ticket comes in saying something along the lines of "I'm having trouble saving this page" or "saving this page results in unexpected results." It's likely that one of the plugins used by wordpress is not up to date with the current version of wordpress (which is forcibly updated by WPEngine).

1) Log in to the [wordpress dashbaord](http://dimagi.com/wp-admin/)
2) Go to Plugins and check for any plugin update warnings.

**NOTE:** If a plugin update is significant enough, sometimes it's worth creating a snapshot of the site from the [WPEngine dashboard](http://my.wpengine.com/)

### Hubspot Issues <a name="hubspot-debug"></a>

When you get a ticket that is something along the lines of "we're not seeing hubspot analytics, but we thought we added this widget" or "this hubspot button looks funny" it's likely due to someone copy-pasting hubspot html directly into the page and somewhere along the line wordpress "cleaned it up".

To solve most hubspot issues:

1. Grab the latest hubspot HTML for whatever widget needs to be inserted. Hubspot forms can be found at `Hubspot dashboard > Contacts > `[`Forms`](https://app.hubspot.com/forms/503070/)
2. Login to the [wordpress dashboard](http://dimagi.com/wp-admin/)
3. Go to `XYZ HTML > HTML Snippets`. Some Hubspot snippets are in other locations, such as `Appearence > Widgets > Footer Right Column`. 
4. Add a new snippet and insert the HTML from Hubspot there
5. Reference that widget where it is needed.

### Wordpress User Authentication Issues <a name="wordpress-issues"></a>

If someone who hasn't logged in for a while and never set up Google Authenticator for two-factor auth.

- Get the user to reset their password. 
- If the password reset doesn't allow them to login, disable Google Authenticator temporarily in the [Wordpress Dashboard](http://dimagi.com/wp-admin/) by visiting Settings > Authenticator and unchecking the **Force Use** option. **Make sure to re-enable once the user has logged in and set up Authenticator**

### Styling Issues (Updating CSS) <a name="css-issues"></a>

To update the stylesheets for Dimagi.com, please make the necessary edits to the files in `/src/_less/` and run

```
sh make_less.sh
```

to compile the less files to css. You will need to have `lessc 1.7.2 installed`. Follow the instructions on the LESS website.

### Updates to the Struture / HTML of the pages

Typically if a change needs to be made to a style across several pages of the same category (e.g. Blog pages), you are likely going to edit the html for the theme.

The theme's HTML lives in `wp-content > themes > anya-child`.
It's recommended that any hard edits (css / html) to the theme you make there.
First check the theme overrides in `wp-admin` before making any hard edits, as
the change you want to make might be simple and already supported by the theme's structure.

Note: `anya-child` inherits from `anya-installable`, so you'll be editing files
in both directories. Check anya-child first if the file you want to edit exists, because
that overwrites the file in anya-installable.


## Setting up Your Local Dev Environment

1) First and foremost. `git clone` this repo and navigate to it.

- Make sure you `git submodule update --init --recursive`, too.
- `dimagidotcom/` will refer to the root of the cloned repo on your local machine.

2) Make sure you have a my.wpengine.com account (if you don't have one, create it with the
devops@dimagi.com user). Also make sure that you've put your public key in
my.wpengine.com > installs > [Git Push](https://my.wpengine.com/installs/dimagi/git_push).

3) Navigate to my.wpengine.com > installs > dimagi > [Backup points](https://my.wpengine.com/installs/dimagi/backup_points). Select an existing backup, and select Download Zip, or create a new backup if you need the latest data.

- copy the zip contents to root of the cloned git repo.
- Do a git diff to see if anything major changed (hopefully there are no changes).
If there are untracked changes in the diff, it may be that those files / folders
should not be versioned. Check with someone who has worked on Dimagi.com in the
past to see what's up. Hopefully none of these scenarios apply, but this is
a really strange setup.
- remove the `wp-content/mu-plugins` folder. Leaving that around can cause issues
when running wordpress via vagrant locally

## Building LESS files

1) run `sh make_less.sh`

## Setting up for Git Deploy to WP Engine

1) Add the `production` and `staging` remotes

```
git remote add production git@git.wpengine.com:production/dimagi.git
git remote add staging git@git.wpengine.com:staging/dimagi.git
```

2) To deploy

Production
```
git push production master
```

Staging
```
git push staging master
```

Note: Don't worry. WP Engine has an error-checking tool. This is more so that you
can see your changes on staging first.

3) Try deploying to staging first. If it looks good, deploy to master.


## Running the Wordpress install locally...

0) Follow the steps in the "Setting up Your Local Dev Environment" section above to obtain a snapshot of the site.

1) Download and install [VirtualBox](https://www.virtualbox.org/wiki/Downloads).

2) Download and install [Vagrant](https://www.vagrantup.com/downloads.html).

3) In `dimagidotcom/` run `cp config-example.txt wp-config.php`.
In the copied config file, edit `define( 'DB_PASSWORD', 'CHANGEME' );`
to the password you will use in STEP 6.

4) Navigate to `dimagidotcom/_vagrantdev` and spin up the vagrant machine: `vagrant up`

Tips:
- `vagrant suspend` suspends the machine, `vagrant resume` resumes the suspended machine
- `vagrant halt` stops the machine

5) Grab a dump of the current wordpress DB from `my.wpengine.com` and import it on your dev machine.

- go to my.wpengine.com
- navigate to the dimagi site
- navigate to [phpMyAdmin](https://my.wpengine.com/installs/dimagi/phpmyadmin)
- click on `snapshot_dimagi`
- navigate to the export tab, export as SQL
- put `snapshot_dimagi.sql` in `dimagidotcom`

6) Reset the root password for mysql on the vagrant box and create the wordpress db. In `dimagidotcom/_vagrantdev` use the command `vagrant ssh` to open a shell with the vagrant box.

In the shell:
```
cd /var/www/html/
sudo /etc/init.d/mysql stop
sudo mysqld --skip-grant-tables &
mysql -u root mysql
```

In the mysql prompt:
```
UPDATE user SET Password=PASSWORD('CHANGEME') WHERE User='root'; FLUSH PRIVILEGES;
CREATE DATABASE snapshot_dimagi;
exit;
```

In the shell:
```
cd /var/www/html/
mysql -u root -p snapshot_dimagi < snapshot_dimagi.sql
```

7) Verify that the database is setup and copied by visiting `http://192.168.33.10/phpmyadmin/` in your browser. Login in with username "root" and the password selected in step 3. You should see the `snapshot_dimagi` db there with data.


8) Visit `http://192.168.33.10/`. The wordpress site should now be up and running!

9) You can access the wordpress admin by visiting `http://192.168.33.10/wp-admin/`. If you don't remember your login information from the staging site, you can reset the password from phpmyadmin by first [creating an md5 hash](http://www.miraclesalad.com/webtools/md5.php) of your desired password, and pasting that in the `user_pass` field of the desired user in the `snapshot_dimagi > wp_users` table.

---

Cheers and happy Dimagi.com-ing... 
I recommend having a stressball nearby. You're working with PHP now.
