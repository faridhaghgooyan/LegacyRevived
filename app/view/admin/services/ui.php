<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>DropZone with Pure JS</title>
    <style>
        .drop-zone {
            max-width: 100%;
            min-height: 200px;
            padding: 25px;
            display: flex;
            align-items: center;
            justify-content: center;
            text-align: center;
            font-family: "Quicksand", sans-serif;
            font-weight: 500;
            font-size: 20px;
            cursor: pointer;
            color: #cccccc;
            border: 2px dashed #2980b9;
            border-radius: 10px;
        }
        .drop-zone-click{
            color: #2980b9;

        }
    </style>
</head>
<body>
    <label for="dropZone">تصویر شاخص</label>
    <div id="dropZone" class="drop-zone" onclick="dropZone()">
        <div class="drop-zone-description">
            Drag & Drop your File Here or
            <span class="drop-zone-click">Click Here</span>
            <input id="fileUpload" type="file" name="fileUpload">
        </div>
    </div>

    <script>
        function dropZone(e){
            let dropZone = document.getElementById('dropZone');
            dropZone.addEventListener("click",function (){
                let file = document.getElementById('fileUpload');
                file.click();
                file.addEventListener('change',function (){
                    console.log(this.value);
                    let img = document.createElement("img");
                    img.src = this.value;
                    let src = document.getElementById("dropZone");
                    src.appendChild(img);

                })


            })
        }
    </script>
</body>
</html>