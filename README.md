# candology

Title: Candology
Description: Ecommerce website to buy candles and diffusers. Has built in functionality to manage inventory and orders by an admin.
Authors: Zahra, Caleb, Patrick

Admin username: admin
Admin password: @dm1n

1. Database and validation is in the model folder, all html files are in the views folder, index.php contains routes for all html files, index.php uses a controller to return views a long with call datalayer functions, Classes are in the classes folder, all Javascript/Ajax are in the scripts folder
2. Fat Free is used, all routes render a template view page.
3. DataLayer is in the model folder, using PDO and prepared statements to query our database.
4. Accounts and Orders can be created. Orders and Products can be viewed by admin.
5. Everyone has commits in the repo.
6. Uses multiple classes, with a Candle and Diffuser class inheriting from a parent Product class. These classe are located in the classes folder
7. To DO: Check for doc blocks and comments
8. Create account form has full validation in Javascript and PHP.
9. To Do: Check code is clean and well-commented
10. We learned some new bootstrap features, learned and implemented some more complicated SQL queries than our other projects. We got the minimum amount of features we wanted complete.
11. Using Ajax for an admin feature, display-button-on-focus in the scripts folder .loads a route that calls a PHP script to update database with POST data passed from the javascript script.
