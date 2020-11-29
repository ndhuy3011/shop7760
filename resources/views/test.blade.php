<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>test</title>
</head>
<body>
    <img src="{{asset('images/product/2R1xRWHszG_1605804339.jpg')}}" alt="" srcset="" style="width: 200px;height: 200px;">
    <form action="test" method="post" enctype="multipart/form-data">
        @csrf
        <input type="file" name="upload" id="">
        <button type="submit">submit</button>
    </form>
</body>
</html>
