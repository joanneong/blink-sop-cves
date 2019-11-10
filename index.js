var path = require('path');
var express = require('express');
var app = express();

const PORT = process.env.PORT || 5000;

var dir = path.join(__dirname, '/public');
app.use(express.static(dir));

app.listen(PORT, function () {
    console.log(`Listening on localhost:${PORT}/`);
});
