This script will help you export all of your blipfoto text to a .csv format (comma separated values) which can then be opened in a spreadsheet programme.

To run it, you will need a PHP5.4 web server or be able to set up a php server on your local machine. This will require some knowledge of what you are doing but google is your friend if you need help...

Next you will need to create your own blipfoto "app" to use the API: https://www.polaroidblipfoto.com/developer/apps
Once you have done this, copy your Client ID, CLient Secret and Access Token that the Poloarid API assigns you and put these into the file named user_details.php.

Once you have done that, upload all of the files to your php server and go to the page "process.php". This might take a long time (up to 10 min?) so be very patient.

This file will then loop through all of your entries and pull the text and present them as a comma separated output.
IMPORTANT NOTE: Your web browser will automatically convert encoded quote marks (") into quotes as it displays them, this will cause problems reading the .csv file. To get around this, once the page has loaded your content, right click and select 'view source' and then save this 'raw' view of the file as a .csv file.


Again, in short...

1) Set up an app on Polaroid Blipfoto. https://www.polaroidblipfoto.com/developer/apps
2) Copy your Client ID, CLient Secret and Access Token into the file named user_details.php
3) Load the "process.php" file (it will take a while to run!)
4) Once loaded, right click and choose view source. Copy all this text and save as a .csv file.
5) Open the csv in the spreadsheet programme of your choice.




FAQ:
Can't you just run this for me?
Unfortinuately I don't have a webserver capable of running this for everyone so have chosen to distribute it in the hope others can use it to help the community. Also the API limits would almost certainly limit how many people can use a single deployment of this.

Why do I need to set up a new app?
Mainly this is because of the API limits. Everyone will need to get their own API key to ensure this script does not hit the API limits.