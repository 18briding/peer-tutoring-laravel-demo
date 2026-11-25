Part 1: Run application

    I created a fork repository because I was unsure of the best approach to generate a unique link that ties to the work I performed inside of the lab. 
    Walkthrough complete and 2 fake tutoring requests have been submitted. Confirmed that application checks for validation (date cannot be in past, must have 10+ characters in description, must choose a topic, must choose a time of day).


Part 2: Explore MVC

    1 the business purpose for the peer tutoring hub application is to submit a tutoring request with the intentions that a tutor / teacher will review the request for consideration of a tutoring session. The application allows you to submit a request and view a list of current requests.

    2 one of the routes used by the appliation is "GET /requests/create" it is found in the routes/web.php file. This route runs when the user naviagates to the /requests/create page in the web application. This is done by clicking on the "request a session" button found on the header / navigation bar or on the /requests page.

    3 The controller involved in the applications main workflow is the TutoringRequestController.php file. This is found in in the app/Http/Controller/ path. It is responsible coordinating requests and responses between the HTTP requests and the application logic, almost like the mailman delivering a letter between two friends. It uses the create and store methods to prepare, validate and save new tutoring requests to the database.

    4 One of the models is the TutoringRequest.php file that is found in the app/Models/ path. The business data represented on this page is the actual tutoring request being made. It directs the course, reason, topic, preferred time, and preferred date to the tutoring_requests database table.
    
    5 One of the views or blade templates is the create.blade.php file which is found in the resources/views/requests/ path. This specific view / template is what a user will see when they are on the tutoring request web page. Specifically it shows the form, the fillable areas and the submit button when making a tutoring request.

    6 The primary workflow of the application is to submit a tutoring request. It starts when a user fills out the form that is found on the .../requests/create page of the website. Laravel checks the routes/web.php route and matches it and sends it to the controller. Once on the controller (TutoringRequestController.php) the data input on the form is validated. If it is good to go then it gets send to the Model (app/Models/TutoringRequest.php) where it will then insert the information into the tutoring_requets table of the SQLite database. After the request is placed in the database, the controller then redirects the user to the .../requests page where the user can see all of the submitted requsts (and confirm that there most recent request was successful).

    7 There are quite a few differences between the architecture of the peer tutoring hub in lab 7 and the peer tutoring hub in lab 8 (with the Laravel framework). The primary difference is the very clear division of the web application: seperating into the view, model, and controller layers. One of the benefits I enjoyed seeing is that each view / template was strictly HTML with nothing else to sift through. This would make adjustments to forms and page structure easy to follow. I am not surpised that we are not now converting our project ot the Laravel framework because it would be extremely time consuming seperating the code from the already built pages. Not to mention there are built in features to the framework we have not learned yet. However, the point can be made that taking the initial time investment to switch the project to the Laravel framework would eventually save time if you had to make later adjustments to the web application.


Part 3: Evidence

    1 *screenshot

    2 *screenshots
    
    Route:
    Controller:
    Model:
    View:

    3 *reflection paragraph.
