##############
#INSTRUCTIONS
##############

#Download the following repositories:
1. XAMMP Installer: https://www.apachefriends.org/
2. Composer Installer: https://getcomposer.org/
3. CodeIgniter4: https://codeigniter.com/
4. VS Stutio Code: https://code.visualstudio.com/


#Minimum Requirements:
PHP 8
Mysql
Apache


#Setup:
Install XAMMP
Install Composer
1. Run XAMMP and start APACHE and mySQL
2. Apache Php.ini uncomment: extension=intl
3. Apache Httpd.conf uncomment: Rewrite _module modules/mod_rewrite.so
4. Import SQL file from github repo to mySQL server
   
	a. Open command prompt(CMD) and navigate to your htdocs folder under XAMMP
	b. type: composer create create-project codeigniter4/starter cidem

6. Paste the downloaded files from github to the cidemo project folder (overwrite all files and folder)
7. Open VS Studio Code
8. Open  cidemo project folder
9. Edit the .env file
 	a. edit the Database connection credential

#How to use the ticketing application
After running and setting up the ticketing application:
1. Open your internet browser
2. Type localhost/cidemo
3. Click Login in the upper right corner of the page
4. Enter Admin credential email: admin@admin.com and password: cc.alvarez2023
5. this account has admin access and can add, delete and update users
6. You can start using the app 
