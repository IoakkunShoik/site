<link href="https://fonts.googleapis.com/css?family=Open+Sans+Condensed:300&display=swap" rel="stylesheet">
<style>
    body{
        display: flex;
        justify-content: center;
        align-items: center;
        font-family: 'Open Sans Condensed', sans-serif;
        background-color: gray;
    }
    .form{
        display:flex;
        justify-content: center;
        align-items: center;
        flex-direction: column;
        background-color: #fff;
        box-shadow: 0px 0px 50px 4px  #ccc;
        border-radius: 6px 100px;
        height: 30vw;
        width: 20vw;
        text-shadow: 0px 0px 5px gray;
    }

    input{
        font-family: 'Open Sans Condensed', sans-serif;
        font-size: 1.2vw;
        border: none;
        width: 10vw;
        height: 2vw;
        margin: 1%;
        text-align: center;
        border-radius: 6px;
        box-shadow: 0px 0px 5px 0px gray;
    }
</style>
<title>Authorization</title>
<div class="form">
    <h1>Authorization <br> for <br> admin</h1>
    <form method='post' action=<?php echo 'http://'.$_SERVER['HTTP_HOST'].'/?page=admin_panel'; ?> >
        <input type="text" name="login" placeholder='login'>
        <br>
        <input type="password" name="password" placeholder='password'>
        <br>
        <input type="submit">
    </form>
</div>