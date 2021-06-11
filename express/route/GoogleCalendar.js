const fs = require('fs');
const readline = require('readline');
const {google} = require('googleapis');
const express = require("express");
let router = express.Router();

router.get("/",(req,res)=>{
    // If modifying these scopes, delete token.json.
    const SCOPES = ['https://www.googleapis.com/auth/calendar.events'];
    // The file token.json stores the user's access and refresh tokens, and is
    // created automatically when the authorization flow completes for the first
    // time.
    const TOKEN_PATH = 'token/google_calendar/token.json';
    function sendBackToPHP(data){
        res.send(data);
    }
    // Load client secrets from a local file.
    fs.readFile('credentials.json', (err, content) => {
    if (err) return console.log('Error loading client secret file:', err);
    // Authorize a client with credentials, then call the Google Calendar API.
        authorize(JSON.parse(content), listEvents);
        authorize(JSON.parse(content),createEvents);
    });

    /**
     * Create an OAuth2 client with the given credentials, and then execute the
     * given callback function.
     * @param {Object} credentials The authorization client credentials.
     * @param {function} callback The callback to call with the authorized client.
     */
    function authorize(credentials, callback) {
    const {client_secret, client_id, redirect_uris} = credentials.installed;
    const oAuth2Client = new google.auth.OAuth2(
        client_id, client_secret, redirect_uris[0]);

    // Check if we have previously stored a token.
    fs.readFile(TOKEN_PATH, (err, token) => {
        if (err) return getAccessToken(oAuth2Client, callback);
        oAuth2Client.setCredentials(JSON.parse(token));
        callback(oAuth2Client);
    });
    }

    /**
     * Get and store new token after prompting for user authorization, and then
     * execute the given callback with the authorized OAuth2 client.
     * @param {google.auth.OAuth2} oAuth2Client The OAuth2 client to get token for.
     * @param {getEventsCallback} callback The callback for the authorized client.
     */
    function getAccessToken(oAuth2Client, callback) {
    const authUrl = oAuth2Client.generateAuthUrl({
        access_type: 'offline',
        scope: SCOPES,
    });
    console.log('Authorize this app by visiting this url:', authUrl);
    const rl = readline.createInterface({
        input: process.stdin,
        output: process.stdout,
    });
    rl.question('Enter the code from that page here: ', (code) => {
        rl.close();
        oAuth2Client.getToken(code, (err, token) => {
        if (err) return console.error('Error retrieving access token', err);
        oAuth2Client.setCredentials(token);
        // Store the token to disk for later program executions
        fs.writeFile(TOKEN_PATH, JSON.stringify(token), (err) => {
            if (err) return console.error(err);
            console.log('Token stored to', TOKEN_PATH);
        });
        callback(oAuth2Client);
        });
    });
    }

    /**
     * Lists the next 10 events on the user's primary calendar.
     * @param {google.auth.OAuth2} auth An authorized OAuth2 client.
     */
    function createEvents(auth){
        const calendar = google.calendar({version: 'v3', auth});
        // var event = {
        //     'summary': 'Meeting today',
        //     'location': 'St. Dominic Medical Center',
        //     'description': 'A chance to hear more about Google\'s developer products.',
        //     'start': {
        //         'dateTime': '2021-06-10T09:00:00-07:00',
        //         'timeZone': 'America/Los_Angeles',
        //     },
        //     'end': {
        //         'dateTime': '2021-06-11T17:00:00-07:00',
        //         'timeZone': 'America/Los_Angeles',
        //     },
        //     'recurrence': [
        //         'RRULE:FREQ=DAILY;COUNT=2'
        //     ],
        //     'attendees': [
        //         {'email': 'lpage@example.com'},
        //         {'email': 'sbrin@example.com'},
        //     ],
        //     'conferenceData': {
        //         'createRequest': {
        //           'requestId': "sample123",
        //           'conferenceSolutionKey': {'type': "hangoutsMeet" },
        //         },
        //       },
        //     'reminders': {
        //         'useDefault': false,
        //         'overrides': [
        //         {'method': 'email', 'minutes': 24 * 60},
        //         {'method': 'popup', 'minutes': 10},
        //         ],
        //     },
        //     };
        const event = {
            start: { dateTime: "2021-06-11T00:00:00.000+09:00" },
            end: { dateTime: "2021-06-11T00:30:00.000+09:00" },
            attendees: [
                        {'email': 'lpage@example.com'},
                        {'email': 'sbrin@example.com'},
                    ],
            conferenceData: {
              createRequest: {
                requestId: "646asdasd",
                conferenceSolutionKey: { type: "hangoutsMeet" },
              },
            },
            summary: "sample event with Meet link",
            description: "sample description",
        };
        calendar.events.insert({
            auth: auth,
            calendarId: 'primary',
            resource: event,
            }, function(err, event) {
            if (err) {
                console.log('There was an error contacting the Calendar service: ' + err);
                return;
            }
            console.log('Event created: %s', event.htmlLink);
           
        });
    }
    function listEvents(auth) {
        const calendar = google.calendar({version: 'v3', auth});
        calendar.events.list({
            calendarId: 'primary',
            timeMin: (new Date()).toISOString(),
            maxResults: 10,
            singleEvents: true,
            orderBy: 'startTime',
        }, (err, res) => {
            if (err) return console.log('The API returned an error: ' + err);
            const events = res.data.items;
            if (events.length) {
                sendBackToPHP('Event created: %s', event.htmlLink);
            console.log('Upcoming 10 events:');
            events.map((event, i) => {
                console.log(event)
                const start = event.start.dateTime || event.start.date;
                console.log(`${start} - ${event.summary}`);
            });
            } else {
            console.log('No upcoming events found.');
            }
        });
    }
});
module.exports = router;
