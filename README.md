# GLENN

### Installing
Based on Google code labs tutorial 
https://codelabs.developers.google.com/codelabs/cloud-speech-nodejs/index.html

Set cloud console project and credentials
```
export GCLOUD_PROJECT=<YOUR-PROJECT-ID>
export GOOGLE_APPLICATION_CREDENTIALS= /path/to/service_account_file.json 
```

Install dependencies 
```
npm install
```

To run speech recognition
```
node recognize listen
```