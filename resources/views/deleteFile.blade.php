<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <title>Document</title>
    </head>
    
    <body>
        <form action="/delete-file/_5b0138a0-ae65-4c76-b13d-4bdf70c3dca0.jpeg" method="post">
            @method('DELETE')
            @csrf
            <input type="submit" value="delete">
        </form>
    </body>

</html>