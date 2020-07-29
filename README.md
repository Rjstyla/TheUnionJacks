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

####### Use Case 3 Appointment Booking and Council Tax Payments through Koopid chatbot #######

1. Avaya Jacks Koopid Flow = JSON file (open in notepad). Holds the chatbot workflow that allows a citizen to go through a smart form for paying council tax and links to a semafone secure payment via webpage. Also has chatbot/smart form appointment booking for birth and death registrations with the local council. Citizen can book an appointment through calendly integration.

####### Use Case 4 Local Council App #######
1. app-debug(1).apk = Citizen's app with use cases such as report flytipping/potholes(cpaas/firebase/geolocation), Koopid integration, secure payment of council tax(Koopid/Semafone), birth and death registration(Koopid), appointment booking(Koopid/Calendly), bin collection (dialogflow)
