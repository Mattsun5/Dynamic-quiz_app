const mysql = require('mysql');


const db = mysql.createConnection({
    host: "localhost",
    user: "root",
    password: "",
    database: "quiz_app"
});

module.exports = { db }