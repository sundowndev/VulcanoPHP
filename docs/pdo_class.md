PDO Class for db connect and manipulation
===========================================

**Below is a description on how to use the class**

### Include script and set up db variables

````php
// config/db.php
// setup db variables

define("DB_HOST", "127.8.221.129");
define("DB_USER", "danferth");
define("DB_PASS", "");
define("DB_NAME", "c9");
````

### single insert

    $app->getDB()->query('INSERT INTO test (name, age, description) VALUES(:name, :age, :description)');

##### bind query variables

````php
$app->getDB()->bind(':name', 'Melissa');
$app->getDB()->bind(':age', '39');
$app->getDB()->bind(':description', 'the real boss');
````

##### execute query

    $app->getDB()->execute();

_______________________

### multiple INSERTS using transactions

##### begin transaction

    $app->getDB()->beginTransaction();

##### the query

    $app->getDB()->query('INSERT INTO test (name, age, description) VALUES (:name, :age, :description)');

##### Insert 1
````php
$app->getDB()->bind(':name','Sam');
$app->getDB()->bind(':age','34');
$app->getDB()->bind(':description','The Boss');
````

##### execute insert 1

    $app->getDB()->execute();

##### insert 2
````php
$app->getDB()->bind(':name','Karen');
$app->getDB()->bind(':age','48');
$app->getDB()->bind(':description','Administration');
````

##### execute insert 2

    $app->getDB()->execute();

##### end transaction

    $app->getDB()->endTransaction();

_________________________

### Select Single Row

##### set up query

    $app->getDB()->query("SELECT name, age, description FROM test WHERE name = :name");

##### bind data

    $app->getDB()->bind(':name','dan');

##### Run single method

    $row = $app->getDB()->single();

##### Print result
````php
echo '<pre>';
print_r($row);
echo '</pre>';
````

### Select Multiple rows

##### set up query
````php
$app->getDB()->query('SELECT * FROM test');
$row = $app->getDB()->resultset();
````

##### Print result
````php
echo '<pre>';
print_r($row);
echo '</pre>';
````

##### echo number of records returned

    echo $app->getDB()->rowCount();
