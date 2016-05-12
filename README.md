# squareapi_spec
Square API specification

### loading up on local
- git clone https://github.com/digitalgaia/squareapi_spec

### serve with PHP built-in server
- cd into the project folder (squareapi_spec)
- then run serve the public folder with below command
```
php wizard serve -p 9000 -r router.php
```

the server will be listening on port 9000. accessible through http://localhost:9000

### on editing
- feel free to review and update the API spec here.

#### api
- to edit the api design, under /app/data is the storage for the api (in json)
- index.json map the list of api modules
- followed by list of jsons on the same folder

#### model
- model updating is GUI based
