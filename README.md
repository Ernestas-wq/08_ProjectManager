# Project manager

Project manager is an application designed to manage employees and projects that their working on,
where you can perform basic CRUD operations and have a scaleable database.

## Instalation

* You will need AMPPS
* You will need some sort of a database managing application(__MySQL Workbench recommended__)

## Usage
1. Make sure AMPPS is turned on.
1. Import __schema__ directoy. In MySQL Workbench select __Server__ -> __Data Import__ -> Locate the schema directory in projects __root__ directory.
1. Execute the __users.php__ script via localhost to create the necessary users.(__NOTE:__ _Creating users this way is unsafe, this is purely for studying purposes. You can copy the query and add them by hand if you prefer._).
1. __(Keep in mind)__ If you ever want to refresh the data with a new set execute the __seeds.php__ script located in __root__/seeds/. You can also alter the _EMPS TO GENERATE_ and _CONNECTIONS TO GENERATE_ parameters to get more or less data.
1. You can find some test users in __users.json__ (_Note: the app user parameter will determine if you can only view the data or perform CRUD on it, so choose accordingly_).
1. Open the root directory via localhost, login and that's it!.