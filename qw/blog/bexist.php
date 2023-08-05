<!DOCTYPE html>
<html lang="en" dir="ltr">
  <head>
    <meta charset="utf-8">
    <title>Blog</title>
    <style media="screen">

      #mainContainer{
        max-width: 700px;
        display: flex;
        flex-direction: column;
      }

      .imgLft{
        float: left;
        border: 1px solid black;
        width: 300px;
        height: 200px;
        text-align: center;
      }

      .imgRht{
        float: right;
        border: 1px solid black;
        width: 300px;
        height: 200px;
      }
    </style>
  </head>
  <body>

    <button type="button" name="button" onclick="addbtn()">Paragraph</button>
    <button type="button" name="button" onclick="addhead()">Heading</button>
    <button type="button" name="button" onclick="addLimg()">Image on left</button>
    <button type="button" name="button" onclick="addRimg()">Image onRight</button>

    <section id="mainContainer" >

    </section>

<script type="text/javascript">
var sec = document.querySelector("#mainContainer");

function addbtn(){
  var span1 = document.createElement("DIV");
  var spanText1 = document.createTextNode('This is div');
  span1.className = "close";
  span1.setAttribute("contenteditable", "true");
  sec.appendChild(span1);
  span1.appendChild(spanText1);
}


function addhead(){
  var span1 = document.createElement("H3");
  var spanText1 = document.createTextNode('Hello');
  span1.className = "close";
  span1.setAttribute("contenteditable", "true");
  sec.appendChild(span1);
  span1.appendChild(spanText1);
}

function addLimg(){
  var span1 = document.createElement("IMG");
  span1.className = "imgLft";
  span1.setAttribute("src", "img.png");
  span1.setAttribute("alt", "Left Image");
  sec.appendChild(span1);
  span1.appendChild(spanText1);
}

function addRimg(){
  var span1 = document.createElement("IMG");
  span1.className = "imgRht";
  span1.setAttribute("src", "img.png");
  span1.setAttribute("alt", "Right Image");
  sec.appendChild(span1);
  span1.appendChild(spanText1);
}

</script>
  </body>
</html>
