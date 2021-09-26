<!DOCTYPE html>
<html>
  <head> 
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <style>
      * {box-sizing: border-box;}
      body {padding: 0; margin: 0;overflow: overflow: hidden; width: 100%;}
      .img-magnifier-container {position:relative; width: 100%}
      .img-magnifier-glass-overlay {
        position: absolute;
        top: 0;
        border-radius: 0%;
        width: 450px;
        height: 125px;
        cursor: none;
        -webkit-mask-image: url(img/black.png);
        mask-image: url(img/black.png);
        -webkit-mask-position: 0 0;
        mask-position: 0 0;
        -webkit-mask-size: contain;
        mask-size: contain;
        -webkit-mask-repeat: no-repeat;
        mask-repeat: no-repeat;        
      }

      #glass_overlay .img-magnifier-glass {
        width: 100%;
        height: 100%;
        background-image: url(img/8ebd3337a4d0a744507ac70297aa6bc8.svg);
        background-size: contain;
        background-repeat: no-repeat;
      }      
    </style>
    <script>
      function magnify(imgID, overlay) {
        var img, glass, overlay, w, h;
        img = document.getElementById(imgID);

        /*create magnifier glass:*/
        glass = document.createElement("DIV");
        glass.setAttribute("class", "img-magnifier-glass");
        overlay = document.getElementById(overlay);
        document.getElementById("glass_overlay").appendChild(glass);
                      
        overlay.style.backgroundImage = "url('" + img.dataset.img + "')";
        overlay.style.backgroundRepeat = "no-repeat";
        overlay.style.backgroundSize = img.width+"px " + img.height+"px";                      
        w = overlay.offsetWidth / 2;
        h = overlay.offsetHeight / 2;

       /*execute a function when someone moves the magnifier overlay over the image:*/
        overlay.addEventListener("mousemove", moveMagnifier);                      
        img.addEventListener("mousemove", moveMagnifier);
        /*and also for touch screens:*/
        overlay.addEventListener("touchmove", moveMagnifier);                      
        img.addEventListener("touchmove", moveMagnifier);
        function moveMagnifier(e) {
          var pos, x, y;
          /*prevent any other actions that may occur when moving over the image*/
          e.preventDefault();
          /*get the cursor's x and y positions:*/
          pos = getCursorPos(e);
          x = pos.x;
          y = pos.y;
          /*prevent the magnifier overlay from being positioned outside the image:*/
          if (x > img.width - w) {x = img.width - w;}
          if (x < w) {x = w;}
          if (y > img.height - h) {y = img.height - h;}
          if (y < h) {y = h;}
          /*set the position of the magnifier overlay:*/
          overlay.style.left = (x - w) + "px";
          overlay.style.top = (y - h) + "px";
          /*display what the magnifier overlay "sees":*/
          overlay.style.backgroundPosition = "-" + (x-w)+"px -"+(y-h)+"px";
        }
        function getCursorPos(e) {
          var a, x = 0, y = 0;
          e = e || window.event;
          /*get the x and y positions of the image:*/
          a = img.getBoundingClientRect();
          /*calculate the cursor's x and y coordinates, relative to the image:*/
          x = e.pageX - a.left;
          y = e.pageY - a.top;
          /*consider any page scrolling:*/
          x = x - window.pageXOffset;
          y = y - window.pageYOffset;
          return {x : x, y : y};
        }

        
      }
    </script>
  </head>
  <body>
    <div class="img-magnifier-container" >
      <img id="myimage" src="img/tnc_81337825_1640x1025.png" width="824" height="515" data-img="img/tnc_81337825_1640x1025.jpg">
      <div class="img-magnifier-glass-overlay" id="glass_overlay"></div>
    </div>
    <script>
      /* Initiate Magnify Function with the id of the image, and the strength of the magnifier glass:*/
      magnify("myimage", "glass_overlay");
    </script>
  </body>
</html>