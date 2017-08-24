<!DOCTYPE html>
<html>
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=0"/>
  <title>Logic3 N-back</title>

  <script src="js/datos.js"></script>

  <script src='js/jquery.min.js'></script>
  <script src="js/underscore-min.js"></script>  
  <!--<script src="js/Tone.min.js"></script> -->
  <script type="text/javascript" src="js/jquery.msgbox.js"></script>
  <script src="js/jquery.cookie.js" type="text/javascript"></script> 
  <script src="js/em22.js" type="text/javascript"></script> 

  <style type="text/css">

    #canvas {
        height: 400px;
        display:table;
        width:100%;
        z-index: 500;
        
    }

    #canvas11 {

        height:100%;
        display:table-cell;
        vertical-align:middle;
        text-align:center;
        z-index: 1000;
        /*height: 60px;*/
       
        /*width: 60px;*/

    }
    #cnv {

        height:100%;
        display:table-cell;
        vertical-align:middle;
        text-align:center;
        z-index: 1000;
        /*height: 60px;*/
       
        /*width: 60px;*/

    }
    #controls-r{



    }
    #controls-l{


    }

        .dropdown {
            position: relative;
            display: inline-block;
        }

        .dropdown-content {
            display: none;
            position: absolute;
            background-color: #f9f9f9;
            min-width: 160px;
            box-shadow: 0px 8px 16px 0px rgba(0,0,0,0.2);
            padding: 12px 16px;
           
        }
        .dropdown:hover .dropdown-content {
            display: block;
        }

        #footer {
            position:fixed;
            bottom:0;
            background-color: gray;
        }

          .circleGreen {
          border-radius: 50%;
          width: 22px;
          height: 22px; 
          display: inline;
          /* width and height can be anything, as long as they're equal */
          background-color: green;
        }
        .circleRed {
          border-radius: 50%;
          width: 22px;
          height: 22px; 
          display: inline;

          /* width and height can be anything, as long as they're equal */
          background-color: red;
        }

        .noselect {
  -webkit-touch-callout: none; /* iOS Safari */
    -webkit-user-select: none; /* Safari */
     -khtml-user-select: none; /* Konqueror HTML */
       -moz-user-select: none; /* Firefox */
        -ms-user-select: none; /* Internet Explorer/Edge */
            user-select: none; /* Non-prefixed version, currently
                                  supported by Chrome and Opera */
}


      </style> 
      <script>
    (function(i,s,o,g,r,a,m){i['GoogleAnalyticsObject']=r;i[r]=i[r]||function(){
    (i[r].q=i[r].q||[]).push(arguments)},i[r].l=1*new Date();a=s.createElement(o),
    m=s.getElementsByTagName(o)[0];a.async=1;a.src=g;m.parentNode.insertBefore(a,m)
    })(window,document,'script','//www.google-analytics.com/analytics.js','ga');

    ga('create', 'UA-45359665-6', 'auto');
    ga('send', 'pageview');

  </script>
</head>
<body>
<div id="fb-root"></div>
<script>(function(d, s, id) {
  var js, fjs = d.getElementsByTagName(s)[0];
  if (d.getElementById(id)) return;
  js = d.createElement(s); js.id = id;
  js.src = "//connect.facebook.net/en_US/sdk.js#xfbml=1&version=v2.5";
  fjs.parentNode.insertBefore(js, fjs);
}(document, 'script', 'facebook-jssdk'));</script>
<div id="controls">
<b><span style="font-size: 40px" id="logo-span">Logic<sup>3</sup></span> <!--<span style="font-size: 40px">𝄢</span>--></b> 
<a href="#" id="mas" style="text-decoration:none; color: #7D0552;"><b>+</b></a> 
<b><span id="cantidadBack">2</span></b>
<a href="#" id="menos"  style="text-decoration:none; color: #7D0552;"><b>-</b></a>
<b>Back</b>&nbsp;
 <select id="myLevelLogic" style="display:none;">
  <option value="3" selected>level 0</option>
  <option value="4">level 1</option>
  <option value="5">level 2</option>
</select>
<span id="tono-span">
  <select id="tone-sel" style="display:none;">
    <option value="-1">random</option>
    <option value="0" selected>C</option>
    <option value="1">C#</option>
    <option value="2">D</option>
    <option value="3">D#</option>
    <option value="4">E</option>
    <option value="5">F</option>
    <option value="6">F#</option>
    <option value="7">G</option>
    <option value="8">G#</option>
    <option value="9">A</option>
    <option value="10">A#</option>
    <option value="11">B</option>
    <option value="12">C</option>
    <option value="13">Db</option>
    <option value="14">D</option>
    <option value="15">Eb</option>
    <option value="16">E</option>
    <option value="17">F</option>
    <option value="18">Gb</option>
    <option value="19">G</option>
    <option value="20">Ab</option>
    <option value="21">A</option>
    <option value="22">Bb</option>
    <option value="23">B</option>
  </select>
</span>
<span id="scale-span" style="display:none;"></span>
<span id="max-span">
  <select id="max-interval-sel" style="display:none;">
    <option value="3">m3</option>
    <option value="4">M3</option>
    <option value="5">P4</option>
    <option value="6">A4</option>
    <option value="7" selected>P5</option>
    <option value="8">m6</option>
    <option value="9">M6</option>
    <option value="10">m7</option>
    <option value="11">M7</option>
    <option value="12">P8</option>
  </select>
</span>
<span id="quantity-notes-span">
  <select id="quantity-notes-sel" style="display:none;">
    <option value="1">1</option>
    <option value="2">2</option>
    <option value="3">3</option>
    <option value="4" selected>4</option>
    <option value="5">5</option>
    <option value="6">6</option>
    <option value="7">7</option>
    <option value="8">8</option>
    <option value="9">9</option>
    <option value="10">10</option>
    <option value="11">11</option>
    <option value="12">12</option>
    <option value="13">13</option>
    <option value="14">14</option>
  </select>
</span>
<span id="delay-note-span">
  <select id="delay-note-sel" style="display:none;">
    <option value="50">0.05</option>
    <option value="100">0.1</option>
    <option value="150">0.15</option>
    <option value="200">0.2</option>
    <option value="250" selected>0.25</option>
    <option value="300">0.3</option>
    <option value="400">0.4</option>
    <option value="500">0.5</option>
    <option value="600">0.6</option>
    <option value="700">0.7</option>
    <option value="800">0.8</option>
    <option value="900">0.9</option>
    <option value="1000">1</option>
  </select>
</span>
<span id="voice-span">
  <select id="voice-sel" onchange="actualizaVoice();" style="display:none;">
    <option value="1">1 voice</option>
    <option value="2" selected>2 voices</option>
  </select>
</span>
<b>
 <a href="#" id="start" onclick="play(0)">Play</a>&nbsp;
 <a href="#" id="stop1">Stop&nbsp;</a>
</b>
 <span>
 <span>t: <input type="text" value="6000" id="timeValue" style="width: 30px;">
 </span>
 c: <span id="pasadas">36</span>&nbsp;

 <span class="oke">ok: <span id="ok">0</span>&nbsp;</span>
 <span class="oke">E: <span id="error">0</span>&nbsp;</span>
 <span style="display:none;">
 color <input type="checkbox" onclick="bColor=!bColor;" checked>
 e <input type="checkbox" onclick="bExperiment=!bExperiment;">
</span>

 %: <input type="text" value="20" id="rndPorcentaje" style="width: 25px;">&nbsp; <!--deffault: 20-->
<? include "otherNback.php"; ?>
<a href="#" onclick="alert('Logic N-Back\To learn the n-back trainning please find Brain Workshop tutorial in Google.\nDark colors: false, light colors: true\nThis software is experimental and may contain errors.\nLicense: MIT\nSource Code: https://github.com/vernetit/3dnback\nContact: robertchalean@gmail.com'); ponerAyuda();">?</a>
&nbsp;<div class="fb-share-button" data-href="http://competicionmental.appspot.com/router?page=logicnback3" data-layout="button_count" style="float: right;"></div>
</div>

<br><br><br>

<!-- <input type="button" value="Sound" id="mySnd"> -->

<div>
<div style=""   id="controls-l"></div>
<div id="cnv111">
  <div id="canvas" style="height: 400px; background-color: white; z-index: 1000;"> <!-- #eee;" > -->
    <!--
     <center>
       <table border="1" id="myTable">
         <tr style="height: 190px;">
           <td  style="width: 290px;"><div id="d00"></div></td>
           <td  style="width: 290px;"><div id="d10"></div></td>
           <td  style="width: 290px;"><div id="d20"></div></td>
         </tr>
          <tr style="height: 190px;">
           <td  style="width: 290px;"><div id="d01"></div></td>
           <td  style="width: 290px;"><div id="d11"></div></td>
           <td  style="width: 290px;"><div id="d21"></div></td>
         </tr>
          <tr style="height: 190px;">
           <td  style="width: 290px;"><div id="d02"></div></td>
           <td  style="width: 290px;"><div id="d12"></div></td>
           <td  style="width: 290px;"><div id="d22"></div></td>
         </tr>
       </table>
     </center>

     -->
  </div>
</div>
<div style="" id="controls-r"></div>
<!--
  <div id="resultsList"></div>
  <br><input type="button" name="" value="clear" id="clearResultsList">
</div>
-->
 <!-- Fin Canvas - Resultados -->
<div style="clear: both"></div>
<!-- Botonera -->
<br>
<center>
<div id="controls-div" style="width:700px;">
<input type="button" value="A: Operator Match" id="pm" style="font-size: 20px; zoom: 1.2;">

<!--
<input type="button" value="S: vis and n-vis" id="vvm" style="">
<input type="button" value="D: vis and n-audio" id="vam" style="">
<input type="button" value="J: audio and n-vis" id="avm" style="">
<input type="button" value="F: Color Match" id="cm" style="">
<input type="button" value="J: Image Match" id="im" style="">
-->

<input type="button" value="L: Truth Match" id="sm" style="font-size: 20px; zoom: 1.2;">
<input type="button" value="N: Next" id="next-btn" style="display:none;">
</div>
</center>

<div style="clear: both"></div>
<div id="results"></div>
<br>
<div id="preload"></div>

<div id="footer" style="height: 120px; width:100%;">

<div style="float: left; width: 50%; height: 80px;" id="footer-l"><br><center>Op</center></div>
<div style="float: left; width: 50%; height: 80px;" id="footer-r"><br><center>Truth</center></div>
  
</div>

<div class="wrapper" style="display:none;">
                        <div class="container">
                            <div class="element">
                                
                            </div>
                        </div>
                    </div>

<div style="display:none;">
<img src="img/nor.png" width="30px">    <img src="img/smash.gif" width="30px">    <img src="img/xor.png" width="30px">    <img src="img/wedge.gif" width="30px">  <img src="img/nand.png" width="30px"> 

</div>   

<script type="text/javascript">

idioma=1;

<? if(isset($_GET["en"])){ ?>

idioma=2;

<? } ?>

function ponerAyuda(){
  _texto=`<img src="img/logic.png">`;
  $("#canvas").html(_texto);

}


</script>               

<script src="js/app/logicnback3.js"></script> 
</body>
</html>