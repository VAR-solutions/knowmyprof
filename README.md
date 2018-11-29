# Know My Professor
IT-202 Project

We are using LAMP stack for this project.
### Prerequisites

You need to install following IT tools :
```
PHP
Apache2
MySQL
phpMyAdmin
```
### Installing(UBUNTU)

1- Open phpMyAdmin and create a user with username 'itbois' and password 'Password@123'

2- Setup Postfix on your system <a href="https://opensourceinside.blogspot.com/2016/09/how-to-install-and-configure-postfix-to.html">Click Here</a> for help

3- cd to_your_hosting_dir (apache root dir)

4- clone this repository

```
git clone https://github.com/VAR-solutions/knowmyprof.git
```
5- Open your browser and go to following address:
```
localhost/knowmyprof/install.php
```
This will initialize the database and store some data.

#### For User end
```
localhost/knowmyprof
```
#### For Admin site
```
localhost/knowmyprof/admin
```
And enter following the credentials-
```
username:12345
password:qwerty
```
