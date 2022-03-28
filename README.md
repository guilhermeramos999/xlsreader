# Student Record from XLS

SRX is a application developed in PHP for teachers who wants to keep control from their students in a database.

## Installation

This application requires PhpOffice to run.

Install composer if you don't have it and run the command below after clone or download the repository:

``` sh
composer require phpoffice/phpspreadsheet
```

Open the class conn.php on the path "xlsreader\src\Infraestructure" and fill the variables ```$dsn```, ```$user``` and ```$pass``` with your database credencials, following the example below:

``` sh
private $dsn = 'mysql:HostFromMyDB;dbname:MyDBname';
private $user = 'MyUser';
private $pass = 'MyPass';
```

The XLS you must edit is in the path: "xlsreader\src\Model\Xls", fill the collumns "Nome" and "Curso" and run the file index.php.
If the student already has a record in your database for that class, the record will not happen, this validation occurs for each row, and not for entire sheet.
