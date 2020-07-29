# TheUnionJacks

####### Use Case 1 [Semafone and Workspaces Integration (Secure Agent Assisted Payment) #######

1. color2.html = home page of the application that is embedded as a Workspaces Widget
2. post.php = scripts that triggers the CPaaS SMS flow and Semafone API that creates the link for the payment flow.
3. main.css = stylesheet of the app
4. semafoneNotifcation.php = Receives the XML data coming from Semafone that provides the updates for the agent (Future project). *This is reading from a Google sheet that obtains the XML data from webhook.site* 	https://webhook.site/a4d867bf-19e2-4e16-96ff-c19b9306de56

####### Use Case 2 Mass Notification Flood Warning #######

1. massnote.php = connects to Google Sheets and CPaaS API's. Filters the spreadsheet by postcode, copies and pastes the results to Sheet 3 and sends SMS to the phone numbers in the filter.
2. mass-note-form.html = webpage for mass notification. user can input the filter details, the notification and push submit
3. mass-note-success.html = success page after notification has been sent. user can hit the back button to go back to the homepage.
4. main1.css = stylesheet for the webpages. 
