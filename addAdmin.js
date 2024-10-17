const url = require('url');
const fs = require('fs');
const express = require('express');
const mysql = require('mysql');
const db = require('db_connection');

const app = express();

app.post('/admin/addAdmin', (req, res) => {
    const myUrl = url.parse(req.url, true);
    const log = `${Date.now()}: ${req.url} sent a ${req.method} request`;
    fs.appendFile('log.txt', log, () => {
        db.connect((err) => {
            if (err){
                console.log('connection failed');
                return;
            }
            console.log('connection successful');
    
            let sql = "INSERT INTO `admin` (admin_id, first_name, last_name, email, pass, avatar) VALUES ('01', 'James', 'Adam', 'james@gmail.com', '12345', '1234hg.jpg');";
            // const sql = "SELECT * FROM `admin`";
            db.query(sql, (err, data) => {
                if (err) throw err;
                res.json(data);
            })
        })
    })
})

