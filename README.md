# certificates

Certificate Project is created using Symfony2 framework

To install:
- Clone the project
- Run "composer install" command
- Create certificates database in mysql databases and import the database/certificates.sql file into it
- Change database credentials in app/config/parameters.yml
- Give read/write permissions to app/cache , app/logs, and web folders
- On terminal run this command to create style files "app/console assets:install"
- Locate your browser to http://localhost/certificates/web/app_dev.php/certificates/ according to your webserver configuration


- You can check certificates unit tests on this file src/Solvians/CertificateBundle/Tests/Controller/CertificateControllerTest.php
- And you can run it using this command "bin/phpunit -c app/ --filter=CertificateControllerTest" on the root path of the application
- You can find the ERD diagram and sql file of database under /database folder ERD diagram could be opened using mysql workbench program
