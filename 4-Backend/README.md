Usage Instructions:

Change server, username and password on the first three lines of both files based on your requirements. I have let them be the default for a WAMP Server.

Run create.php: 
This will create a database called 'ign' and make two tables based on that will hold all the data: content, thumbnails

Run index.php:
This file gets all the data from the RSS feed (goes through all 20 pages).
Then the code proceeds to extract all the information per item and store it in PHP variables.
I have used prepared statements to then insert all this into a mysql table.

For content, the 'guid' of every post is the primary key
For thumbnails, I have used a composite primary key consisting of 'guid' and 'size' since no guid can have two thumbnails of the same size.

SQL creates a default index on the primary key.

