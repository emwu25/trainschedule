trainschedule
=============

This is the requested simple train schedule application.  User is first presented with empty table of schedules.
User needs to select CSV file with data formated exactly as in problem description.(delimiter is ", ").

Once user uploads the file, the user is presented with unique schedule data in a table, sorted by the run number. 
NOTE: 
Two schedules will be unique if ANY of the fields is different. That means two train lines can share the same run number. 
Please sorting mechanics employed to determine order of two unique items with the same run number. 

User has a chance to save the data to a presistent storage.  Here I employed MySQL database to server as a storage.  
User is than taken back to the main screen with data being populated from the database.  From there user can delete or
edit each record.  User can also upload additional csv files. 

I was not really sure if the data in the database has to be unique or not. As implemented right now, the data in the
database does not have to be unique.  If we upload the same csv file twice we're going to get a duplicate of each record, 
with different id.  Assignment was specific on the fact that csv has to be parsed with unique data, but did not mention
anything about unique data in two separate upload requests. 

To speed things up I ommited some parts of the application that real world app should have like input validation and program
routing.  I did implement frienldy urls with htaccess but this solution would not scale properly. 
Although I'm using DAO object for database access to show CRUD, Persistance layer should be better structured in real world app.

I uploaded the application to openshift, to be able to demo it.  I did have some problem with paths that were specific to
openshift but I tested it and the demo should be working fine.  

Please find the demo at http://schedules-punker.rhcloud.com/schedule
