<!DOCTYPE html>
<html>
  <head> 
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <style>
      * {box-sizing: border-box;}
      body {padding: 0; margin: 0;overflow: 0;}
      .img-magnifier-container {position:relative; width: 100%;}
      .img-magnifier-glass-overlay {width: 100%;height: 50%;}
      #glass_btm{height: 50%;}

      img#myimage { top: 0; left: 0;          
      }
      .lensOverlay {
        position: absolute;
        top: 0;
        border-radius: 0%;
        width: 740px;
        height: 210px;
        cursor: none;
        -webkit-mask-image: url(img/black.png);
        mask-image: url(img/black.png);
        -webkit-mask-position: 0 0;
        mask-position: 0 0;
        -webkit-mask-size: contain;
        mask-size: contain;
        -webkit-mask-repeat: no-repeat;
        mask-repeat: no-repeat;
        mask-border:
        background-image: url(img/8ebd3337a4d0a744507ac70297aa6bc8.svg);
        background-size: contain;
        background-repeat: no-repeat; 
      }

      .lens-magnifier-glass{
        width: 100%;
        height: 100%;
        background-image: url(img/8ebd3337a4d0a744507ac70297aa6bc8.svg);
        background-size: contain;
        background-repeat: no-repeat;
        position: absolute;
        top: 0;
        z-index: 999;
      }
    </style>
    <script>
      function magnify(imgID, lensOverlay , lens_upr, lens_mdl, lens_btm) {
        var img, glass, lens_upr, lens_mdl, w, h, lensOverlay;
        img = document.getElementById(imgID);
        lensOverlay = document.getElementById(lensOverlay);

        var lens_height = lensOverlay.offsetHeight;


        lens_upr = document.getElementById(lens_upr);        
        lens_mdl = document.getElementById(lens_mdl);
        lens_btm = document.getElementById(lens_btm);

        lensOverlay.style.backgroundSize = img.width+"px " + img.height+"px";
          lens_upr.style.backgroundImage = "url('" + img.dataset.effect_upr + "')";
          lens_upr.style.backgroundRepeat = "no-repeat";
          lens_upr.style.backgroundSize = img.width+"px " + img.height+"px";

          // lens_mdl.style.backgroundImage = "url('" + img.dataset.effect_mdl + "')";
          // lens_mdl.style.backgroundRepeat = "no-repeat";
          // lens_mdl.style.backgroundSize = img.width+"px " + img.height+"px";

          lens_btm.style.backgroundImage = "url('" + img.dataset.effect_btm + "')";
          lens_btm.style.backgroundRepeat = "no-repeat";
          lens_btm.style.backgroundSize = img.width+"px " + img.height+"px";

        w = lensOverlay.offsetWidth / 2;
        h = lensOverlay.offsetHeight / 2;

        lensOverlay.addEventListener("mousemove", moveMagnifier);
        img.addEventListener("mousemove", moveMagnifier);
        lensOverlay.addEventListener("touchmove", moveMagnifier);
        img.addEventListener("touchmove", moveMagnifier);

        //var lens_mdl_pos = (lens_height*33/100);
        var lens_btm_pos = (lens_height*50/100);

        lens_upr.style.backgroundPosition = "-0px -0px";
        //lens_mdl.style.backgroundPosition = "-0px -"+lens_mdl_pos+"px";
        lens_btm.style.backgroundPosition = "-0px -"+lens_btm_pos+"px";


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
          lensOverlay.style.left = (x - w) + "px";
          lensOverlay.style.top = (y - h) + "px";

          //var lens_mdl_pos = +(y-h)+(lens_height*33/100);
          var lens_btm_pos = +(y-h)+(lens_height*50/100);

          //console.log(lens_btm_pos);
          /*display what the magnifier overlay "sees":*/
          lens_upr.style.backgroundPosition = "-" + (x-w)+"px -"+(y-h)+"px";
          //lens_mdl.style.backgroundPosition = "-" + (x-w)+"px -"+lens_mdl_pos+"px";
          lens_btm.style.backgroundPosition = "-" + (x-w)+"px -"+lens_btm_pos+"px";
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
    <div class="img-magnifier-container">
      <img id="myimage" src="img/normal.jpg" width="1360" height="680" 
        data-effect_upr="img/img_top.jpg"
        data-effect_mdl="img/lens_effect.jpg"
        data-effect_btm="img/img_btm.jpg">

      <div class="lensOverlay" id="lensOverlay">        
          <div class="img-magnifier-glass-overlay" id="glass_upr"></div>
          <div class="img-magnifier-glass-overlay" style="display: none" id="glass_mdl"></div>
          <div class="img-magnifier-glass-overlay" id="glass_btm"></div>

        <div class="lens-magnifier-glass"> </div>
      </div>
      

    </div>
    <script>
      /* Initiate Magnify Function with the id of the image, and the strength of the magnifier glass:*/
      magnify("myimage", "lensOverlay", "glass_upr", "glass_mdl", "glass_btm");
    </script>
  </body>
</html>