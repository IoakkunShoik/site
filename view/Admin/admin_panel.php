<!DOCTYPE html>
<html lang="ru">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <style>
            body{
                margin: 0px;
                padding: 0px;
            }
            textarea{
                height: 10vw;
                width: 30vw;
            }
            form{
                margin: 0;
            }
            form {display: inline-block;}
            div{
                display: inline-block;
            }
            td{
                background-color: #aaa;
            }
            td:nth-child(even){
                background-color: #eee;
            }
            tr:nth-child(even){
                background-color: grey;
            }
            .control_panel{
                width: 100%;
                background-color: #aad
            }
    </style>
    <title>Document</title>
</head>
<body>
<div class='control_panel'>

            <div id='add'>


            <form  method='post'>
                <input value='28' type='hidden' name='add-article'>
                <input value='ADD ARTICLE' type='submit'>
            </form>
            <form  method='post'>
                <input value='' type='hidden' name='add-article'>
                <input value='SHOW ARTICLES' type='submit'>
            </form>
            <form  method='post'>
                <input value='28' type='hidden' name='add-image'>
                <input value='ADD IMAGE' type='submit'>
            </form>
            <form  method='post'>
                <input value='44' type='hidden' name='add-image'>
                <input value='SHOW IMAGES' type='submit'>
            </form>
            <form  method='post'>
                <input value='28' type='hidden' name='add-category'>
                <input value='SHOW CATEGORIES' type='submit'>
            </form>

            
            </div>
            <div id='search'>

                <form  method='post'>
                    <input type='text' name='admin-search'>
                    <input value='search' type='submit'>
                </form>

            </div>
        </div>
        $$$CONTENT$$$
</body>
</html>
