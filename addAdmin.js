const express = require('express');
app.get('/admin', (req, res) => {
    db.connect((err) => {
        if (err){
            console.log('connection failed');
            return;
        }
        console.log('connection successful');
        // let sql = "INSERT INTO `admin` (admin_id,first_name, last_name, email, pass, avatar) VALUES ('01', 'James', 'Adam', 'james@gmail.com', '12345', '1234hg.jpg');";
        const sql = "SELECT * FROM `admin`";
        db.query(sql, (err, data) => {
            if (err) throw err;
            res.json(data);
        })
    })
})

app.listen(port, (err) => {
    if (err) {
        console.log('server failed with' + err);
        return;
    }
    console.log('server running at port ' + port)
})