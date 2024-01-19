<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <title>upload file</title>
    </head>
    
    <body>
        
        <form action="/upload-file/public" method="post" enctype="multipart/form-data">
            @csrf
            <input type="file" name="file" id="">
            <input type="submit" value="save">
        </form>

    </body>

</html>