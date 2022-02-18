# COMP2001 Jacob_Whitwell CW2

## Part 1 - RESTful API
The RESTful API has been created to allow an administrator of the organisation to add, update and delete programmes. The context chosen for this application has been to add in dummy data to simulate a university course, which has been taken from the University of Plymouths course pages. This has been written in .NET, using the MVC and Repository structure.

### Note: when installing the FrameworkCore Tools and SqlServer, -version 5.0.12 was used



The API has been uploaded at http://web.socem.plymouth.ac.uk/COMP2001/jwhitwell/showcase/programmes. Data integrity has been maintained via using Stored Procedures, created in the Microsoft SQL Database. This also adds a layer of security by using parameters, preventing SQL injection.

GET: /programmes<br>
PUT: /programmes/{code}<br>
POST: /programmes/{newCode}<br>
DELETE: /programmes/{code}<br>

The API is a representation of machine to machine communication and the endpoints are as per the swagger file which can be found within this repo.

![swagger image](https://github.com/Plymouth-University/comp2001_assignment-jacob-whitwell/blob/main/swagger.png?raw=true)

## Part 2 - Linked Data Application

The base HTML for this application was provided by Shirley Atkinson repo. Find a link to her repo below. This application has three pages:

**index.php**<br> Displays a link to the original data set, a link to the data.php page, additional buttons and a link to the resource directory with the JSON-LD output.

**data.php**<br> Displays the JSON data in human readable format via an HTML table. 
![data table](https://github.com/Plymouth-University/comp2001_assignment-jacob-whitwell/blob/main/data-table.png?raw=true)

<br>
Additionally, pins have been added into the map to make the information digestible and to add relevant context. If a user clicks on the pin, the recording of PM<sub>2.5</sub> in that area will be displayed in a tooltip above the pin.

![data map](https://github.com/Plymouth-University/comp2001_assignment-jacob-whitwell/blob/main/leaflet.png?raw=true)


**/quality**, which outputs the JSON data in a JSON-LD format. The resource name has been shortened to /quality to enable easier access to the data set. 

## Credits
Plymouth DATA Place: https://plymouth.thedata.place/dataset<br>
Bootstrap 4: https://getbootstrap.com/<br>
Mapbox API: https://www.mapbox.com/<br>
Leaflet.js: https://leafletjs.com/<br>
Shirley Atkinson: https://github.com/shirleyatkinson/COMP2001_SW
# API-COMP2001-
