var request = require('request');

var program = {
    script : "",
    language: "java",
    versionIndex: "3",
    clientId: "f09ff16aed0322f99d5051c1076667b5",
    clientSecret:"36bbfab973fb73461c12dcb4acaf90e3896e687e563845ddfc10444756e1516e"
};
request({
    url: 'https://api.jdoodle.com/v1/execute',
    method: "POST",
    json: program
},
function (error, response, body) {
    console.log('error:', error);
    console.log('statusCode:', response && response.statusCode);
    console.log('body:', body);
});  