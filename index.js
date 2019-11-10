let http = require('http');
let fs = require('fs');

const PORT = process.env.PORT || 5000;
 
let handleRequest = (request, response) => {
    response.writeHead(200, {
        'Content-Type': 'text/html'
    });
    fs.readFile('./image_leak.html', null, function (error, data) {
        if (error) {
            response.writeHead(404);
            respone.write('Whoops! File not found!');
        } else {
            response.write(data);
        }
        response.end();
    });
};
 
http.createServer(handleRequest).listen(PORT, () => {
    console.log(`Server running on ${PORT}/`);
});
