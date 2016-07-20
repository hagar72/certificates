# certificates

Certificate Project is created using Symfony2 framework

To install:
- Clone the project
- Run "composer install" command
- Create certificates database in mysql databases and import the database/certificates.sql file into it
- Change database credentials in app/config/parameters.yml
- Locate your browser to http://localhost/certificates/web/app_dev.php/certificates/ according to your webserver configuration


- You can check certificates unit tests on this file src/Solvians/CertificateBundle/Tests/Controller/CertificateControllerTest.php
- And you can run it using this command "bin/phpunit -c app/ --filter=CertificateControllerTest" on the root path of the application