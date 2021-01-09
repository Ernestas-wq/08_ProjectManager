# Project manager

Project manager is an application designed to manage employees and projects that their working on,
where you can perform basic CRUD operations and have a scaleable database.

## Instalation

1. You will need AMPPS (_Make sure it's turned on before importing_)
1. You will need some sort of a database managing application(**MySQL Workbench recommended**)
1. Clone or download and extract the project into your AMPPS projects folder(_By default it's Ampps/www/_).
1. Import **schema** directoy into MySQL Workbench. In MySQL Workbench select **Server** -> **Data Import** -> Locate the **schema** directory in projects **root** directory -> **Start Import**.
1. Execute the **users.php** script via localhost to create the necessary users.(**NOTE:** _Creating users this way is unsafe, this is purely for studying purposes. You can copy the query and add them by hand if you prefer._).

## Usage

- Make sure AMPPS is turned on.
- **(Keep in mind)** If you ever want to refresh the data with a new set execute the **seeds.php** script located in **root**/seeds/. You can also alter the _EMPS TO GENERATE_ and _CONNECTIONS TO GENERATE_ parameters to get more or less data.
- You can find some test users in **users.json** (_Note: the app user parameter will determine if you can only view the data or perform CRUD on it, so choose accordingly_).
- Open the root directory via localhost, login and that's it!.
