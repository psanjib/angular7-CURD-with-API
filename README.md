# Angular 7 CRUD with Rest API using PHP (Lumen Framework)

CURD Operations with filter are implemented in Rest API using Mysql DB. Those Rest APIs are called from Angular 7 project. In-order to interact between the project we enabled CORS package inside the Rest API Project.

## Get the Code
```
$ git clone https://github.com/psanjib/angular7-CURD-with-API.git
```
## Setup Angular Application
```
$ cd angular7-CURD-with-API/angular7
$ npm install
//run the app
$ ng serve
```

## Setup Rest API
To run PHP application we have to install XAMPP.

[Download Xampp](https://www.apachefriends.org/download.html).

For windows - Copy the source code from RestAPI-PHP folder and page in \xampp\htdocs folder

Start XAMPP - 
If you extract XAMPP in a top level folder like "C:\" or "D:\", you can start most servers like Apache or MySQL directly without execution of the file "setup_xampp.bat".

Not using the setup script, or selecting relative paths in the setup script, is preferred if you are installing XAMPP on a usb drive. Because on each pc such a drive can have an other drive letter. You can switch from absolute to relative paths at any time with the setup script.

Using the installer from our Downloads page is the easiest way to install XAMPP. After the installation is complete, you will find XAMPP under Start | Programs | XAMPP. You can use the XAMPP Control Panel to start/stop all server and also install/uninstall services.

The XAMPP control panel for start/stop Apache, MySQL, FileZilla & Mercury or install these server as services.

For Linux -  Copy the source code from RestAPI-PHP folder and page in \opt\lampp folder

Start XAMPP - sudo /opt/lampp/lampp start

To Run the Application  

move to the source code

For Windows
```
$ cd  pathto(install drive C:\ or D:\)\xampp\htdocs
$php -S localhost:8000 -t public
```
For Linux
```
$ cd /opt/lampp
$php -S localhost:8000 -t public
```

Browse

```
localhost:8000
```
If it display "Lumen (5.5.2) (Laravel Components 5.5.*)"  successfully Rest API setup Completed

//update Web API DB connection string

Import the task.sql file in Mysql and DB connection setting .env file.
