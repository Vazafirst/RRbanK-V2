<!DOCTYPE html>
<html>
    <head>
        <?php include_once("./ga.php"); ?>
        <meta charset="UTF-8">
        <title>Support</title>
        <link rel="stylesheet" href="css/style.css">
        <link rel="stylesheet" href="css/support.css">
    </head>
    <body>
        <h1 style="text-align: center;">SUPPORT (offline)</h1>
        <div class="main">
            <p style="text-align: center;">Got something to say ? A suggestion ? A bug ? something you would like to be changed on RRBanK ? Write to us here !</p>
            <p>Username: <input class="campo" type="text" disabled autofocus required/></p>
            <p>Email:&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; <input disabled class="campo" type="email" required/></p>
            <p>Category: &nbsp;&nbsp;<select id=sq class="select" disabled required>
                    <option value=""></option>
                    <option value="mom">Password lost</option>
                    <option value="color">Email change</option>
                    <option value="animal">Feedback</option>
                    <option value="team">Suggestion</option>
                    <option value="hobby">Other</option>
                </select></p>
            <p>Subject: &nbsp;&nbsp;&nbsp;&nbsp;<input disabled class="campo" type="text" required /></p>
            <p>Message: </p>
            <textarea disabled class="textarea" required minlength="10" maxlength="140"></textarea>
            <input disabled type="submit" class="btn" value="Submit" />
        </div>
    </body>
</html>
