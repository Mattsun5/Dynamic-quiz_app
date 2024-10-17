app.listen(port, (err) => {
    if (err) {
        console.log('server failed with' + err);
        return;
    }
    console.log('server running at port ' + port)
})