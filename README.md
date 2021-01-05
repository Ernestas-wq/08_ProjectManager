# Project manager

Project manager is an application designed to manage employees and projects that their working on,
where you can perform basic CRUD operations and have a scaleable database.

## Instalation

* You will need AMPPS
* You will need some sort of a database managing application(__MySQL Workbench recommended__)

## Usage
1. Make sure AMPPS is turned on and you are connected to a server.
1. Execute the __users.php__ script via localhost to create the necessary users.(__NOTE:__ _Creating users this way is unsafe, this is purely for studying purposes. You can create them by hand if you prefer._)
1. Execute the __schema.php__ script via localhost to create the database and the necesseray tables.(__NOTE:__ _Creating databases this way is unsafe, this is purely for studying purposes. You can create them by hand if you prefer._)
1. __[Optional, but recommended]__ Execute the __seeds.php__ script, located in __root__/seeds/, this will seed the database with some random data so you don't have to add it by hand(_Note: if you didn't create the schema and users via scripts, make sure you gave them the exact same specifications_).
1. You can find some test users in __users.json__ (_Note: the app user parameter will determine if you can only view the data or perform CRUD on it, so choose accordingly_).
1. Open the main directory via localhost, login and that's it!.