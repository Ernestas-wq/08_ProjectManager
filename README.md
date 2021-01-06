# Project manager

Project manager is an application designed to manage employees and projects that their working on,
where you can perform basic CRUD operations and have a scaleable database.

## Instalation

1. You will need AMPPS (_Make sure it's turned on before importing_)
1. You will need some sort of a database managing application(__MySQL Workbench recommended__)
1. Import __schema__ directoy into MySQL Workbench. In MySQL Workbench select __Server__ -> __Data Import__ -> Locate the __schema__ directory in projects __root__ directory -> __Start Import__.
1. Execute the __users.php__ script via localhost to create the necessary users.(__NOTE:__ _Creating users this way is unsafe, this is purely for studying purposes. You can copy the query and add them by hand if you prefer._).

## Usage
* Make sure AMPPS is turned on.
* __(Keep in mind)__ If you ever want to refresh the data with a new set execute the __seeds.php__ script located in __root__/seeds/. You can also alter the _EMPS TO GENERATE_ and _CONNECTIONS TO GENERATE_ parameters to get more or less data.
* You can find some test users in __users.json__ (_Note: the app user parameter will determine if you can only view the data or perform CRUD on it, so choose accordingly_).
* Open the root directory via localhost, login and that's it!.