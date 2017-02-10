<?	
if(isset($_GET["load"])){

	function UniqueRandomNumbersWithinRange($min, $max, $quantity) {
    $numbers = range($min, $max);
    shuffle($numbers);
    return array_slice($numbers, 0, $quantity);
}

function rand_line($fileName, $maxLineLength = 40,$maxQuantity, $bQ) {

    $handle = @fopen($fileName, "r");
    
    $cantidad=27; if(isset($_GET["cantidad"])){ $cantidad=intval($_GET["cantidad"]); }
    
    //valido cantidades
    if($cantidad>40) die;
    if($cantidad<0) die;

    if ($handle) {
        $random_line = null;
        $line = null;
        $count = 0;
        $total = 0;

        $myArray = UniqueRandomNumbersWithinRange(0,$maxQuantity,$cantidad);

        while (($line = fgets($handle, $maxLineLength)) !== false) {

            /*
            if(strlen($line)){
              array_push($myArray, $count++);
              $count++;
              die;
              continue;
            }*/

        		if($total>=$cantidad)
        			continue;

            $count++;

            // P(1/$count) probability of picking current line as random line
            if(in_array($count, $myArray)) {
             //echo ($total+1)."-".strlen($line)."->".$line;
              /*
              if($bQ){
                if($line=="\n" || $line==" " || strlen($line)<20){
                  array_push($myArray,$count+1);
                  $count--;
                  continue;

                }
              }*/
              $line= strtolower(str_replace("\n", "", $line));
              $random_line[$total] = $line;
              $total++;

            }
        }
        if (!feof($handle)) {
            echo "Error: unexpected fgets() fail\n";
            fclose($handle);
            return null;
        } else {
            fclose($handle);
        }
        return $random_line;
	    }
	}

	// usage

	$tipo=3; if(isset($_GET["imagenTipo"])){ $tipo=intval($_GET["imagenTipo"]); }

  $txtToLoad = "db/iamimages.txt"; $mq=2315;

  if($tipo==2){ $txtToLoad = "db/emo.txt"; $mq=45; } 
  if($tipo==3){ $txtToLoad = "db/flags.txt"; $mq=200; } 

	$bQ=0; $mLL=70;

	$txt = rand_line($txtToLoad,$mLL,$mq,$bQ);
	//$a = explode("\n", $txt,30);
	//var_export($a);
	shuffle($txt);

	$salida = "[";
  //echo count($txt); die;
	for($i=0;$i<count($txt);$i++){
		/*
		arrayImages[z]="figuras/"+_p+".png";
		*/
     if($tipo==2){
      $salida .= "\"emociones/".$txt[$i]."\",";

     }elseif($tipo==3){
      $salida .= "\"flags/".$txt[$i]."\",";

     }else{
      $salida .= "\"iam/".$txt[$i]."\",";


     }
		
	}
	$salida = rtrim($salida, ",");
	$salida .= "]";

	echo $salida;

	die();
}
?>
<!DOCTYPE html>
<html>
<head>
	<title>Loci N-back!</title>

	<meta name="description" content="Loci N-back">
  <meta name="keywords" content="mental training, memory, working memory">

	<script src='scripts/jquery.min.js'></script>
	<script src="js/underscore-min.js"></script>
	<script src="js/jquery.cookie-dist.js" type="text/javascript"></script>

	<style type="text/css">
		#canvas {
		    height: 600px;
		    display:table;
		    width:100%;
		    z-index: 500;
		    
		}

		#canvas1 {

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

<div id="loading"><h1>Loading...<span><img src="/img/loading.gif"></span></h1></div>

<!-- Controles -->
<div>
 <b>Loci</b> 
 <a href="#" id="mas" style="text-decoration:none; color: #7D0552;"><b>+</b></a> 
 <span id="cantidadBack">2</span>
 <a href="#" id="menos"  style="text-decoration:none; color: #7D0552;"><b>-</b></a> Back&nbsp;

 <select id="cantidadElementos" style="width: 55px">
  <option value="1">1 object</option>
  <option value="2">2 objects</option>
  <option value="3" selected>3 objects</option>
  <option value="4">4 objects</option>
</select> &nbsp;


 <a href="#" id="start" onclick="play(0)">Play</a>&nbsp;
 <a href="#" id="stop1">Stop&nbsp;</a>
 
 <span>t: <input type="text" value="3000" id="timeValue" style="width: 30px;">&nbsp;<input type="text" value="2600" id="timeValue1" style="width: 28px;"></span>&nbsp;
 c: <span id="pasadas">36</span>&nbsp;

 <span class="oke">ok: <span id="ok">0</span>&nbsp;</span>
 <span class="oke">E: <span id="error">0</span>&nbsp;</span>

<select id="imagenesTipos" style="width: 100px">
  <option value="1" selected>IAM OpenDb</option>
  <option value="2">Emotions</option>
  <option value="3">flags</option>
</select> &nbsp;

%: <input type="text" value="20" id="rndPorcentaje" style="width: 25px;">&nbsp; <!--deffault: 20-->
<span id="myOther">
                <div class="dropdown">
                <a href="#" class="dropbtn">Other N-back</a>
                <div class="dropdown-content" style="width: 150px !important;">
                   <a href="/locinback">Loci N-back</a><br>
                   <a href="/tts3dnback">Tts 3D N-back</a><br>
                   <a href="/tcTts3dNback">3 Comb. 3D N-back</a><br>
                   <a href="/double3dnback">Double 3D N-back</a><br>
                   <a href="/triple3dnback">Triple 3D N-back</a><br>
                   <a href="/xBy3DNback">XByX 3D N-back</a><br>
                </div>
              </div>
        </span>
<a href="#" onclick="alert('To learn the n-back trainning please find Brain Workshop tutorial in Google.\n%: is the probability of elements repetition\nThis software is experimental and may contain errors.\nContact: robertchalean@gmail.com');">?</a>
&nbsp;<div class="fb-share-button" data-href="http://competicionmental.appspot.com/locinback" data-layout="button_count" style="float: right;"></div>
</div> <!-- Fin Controles -->

<!-- Canvas - Resultados -->
<div>
<div style="float: left;" style="width:50px;"   id="controls-l"></div>
<div style="float: left;">
  <div id="canvas" style="width: 600px; height: 600px; background-color: white; z-index: 1000;"> <!-- #eee;" > -->
  		<div id="canvas1" class="content" style="">
      Hello!<br>
       Here the instructions of the original nback game to guide you in locinback: <a href="http://brainworkshop.sourceforge.net/tutorial.html">http://brainworkshop.sourceforge.net/tutorial.html</a> 

      </div>
  </div>
  
</div>
<div style="float:right; width:50px; margin-left: 0px;" id="controls-r">
<!--
  <div id="resultsList"></div>
  <br><input type="button" name="" value="clear" id="clearResultsList">
</div>
-->
</div> <!-- Fin Canvas - Resultados -->
<div style="clear: both"></div>
<!-- Botonera -->
<div style="float: left; zoom: 150%; margin-left: 20px; width: 450px;" id="botonera">
<center>
<div id="controls-div">
<input type="button" value="A: Loci Match" id="pm" style="">

<!--
<input type="button" value="S: vis and n-vis" id="vvm" style="">
<input type="button" value="D: vis and n-audio" id="vam" style="">
<input type="button" value="J: audio and n-vis" id="avm" style="">
<input type="button" value="F: Color Match" id="cm" style="">
<input type="button" value="J: Image Match" id="im" style="">
-->

<input type="button" value="L: Image Match" id="sm" style="">
</div>
</center>
</div><!-- Fin Botonera -->
<div style="clear: both"></div>
<div id="results"></div>
<br>
<div id="preload"></div>

<script type="text/javascript">

imagenDimension=600;

$("#resultsList").hide();

$("#loading").hide();
$("#controls-div").hide();
$("#stop1").hide();
$("#clearResultsList").hide();


function n(x){ return parseInt($("#"+x).val()); }

bMobile=0;
if( /Android|webOS|iPhone|iPad|iPod|Opera Mini/i.test(navigator.userAgent) ) {
 	bMobile=1;
  $(".fb-share-button").hide();
}	

<? include "db/worldPositions.php"; ?>

arrayImages=[];
arrayImages1=[];
arrayImages2=[];
arrayPreloadImages=[];

zPreload=0;
imgLoadedCount=0;

function preload() {

		$("#preload").html(""); 

    for(i=0;i<arrayPreloadImages.length;i++){

      //console.log(`<img src="${arrayImages[i]}" id="imgPreload-${zPreload}">`);

       $("#preload").append(`<img src="${arrayPreloadImages[i]}" id="imgPreload-${zPreload}"  width="32" height="32" style="opacity: 0.5;">`);

       $(`#imgPreload-${zPreload}`).on("load",function(){
       		
          imgLoadedCount++;

          if(imgLoadedCount==cantidadElementos*9){      

            //$("#screen").html(""); 
            $("#preload").hide(); 
            $("#loading").hide(); 
             $("#stop1").show();
            //$("#recall-btn").show(); 
            $("#controls-div").show();

            console.log(imgLoadedCount);

            setTimeout(play(1),500); 
                         
           // init(0);

         }
       });

     zPreload++;

	} //end for
} //end preload

bOnGame=0;

var tcAct=0;
var cAct=0, iAct=0, sAct=1;
var salidas = [], salidas1 = [], salidas2 = [], salidas3 = [], salidas4 = [], salidas5 = [],cantidadBack=2, pasadas=36, currentPasada=0;
var bIntroducir=0, bIntroducir1=0, bIntroducir2=0, bIntroducir3=0, bIntroducir4=0, bIntroducir5=0;
var ok=0, ok1=0, ok2=0, ok3=0, ok4=0, ok5=0;
var error=0 , error1=0, error2=0, error3=0, error4=0, error5=0, mismo=0,mismo1=0, mismo2=0,mismo3=0,mismo4=0,mismo5=0;
var killInterval,myInterval,killCamera;
var bOk=0,bOk1=0,bOk2=0,bOk3=0,bOk4=0,bOk5=0;
var arrayImagenes=[];
var acumuladorSuma=0;

function actualizarOk(){
  $("#ok").html(parseInt(ok)+parseInt(ok1)+parseInt(ok2)+parseInt(ok3));
}

function actualizarErrores(){
  $("#error").html(parseInt(error)+parseInt(error1)+parseInt(error2)+parseInt(error2));
}

var perdidas=0;
var cantidadElementos=3;

function play(_x){

	if(_x==0){

		if(bOnGame)
			return;

    cantidadElementos=n("cantidadElementos");

		$("#stop1").hide();

    $("#resultsList").hide();
		
		bOnGame=1;

		imgLoadedCount=0;

		$("#preload").show(); 
    	$("#loading").show(); 
    	$("#controls-div").hide();

    	rndPorcentaje=parseInt($("#rndPorcentaje").val());

    	salidas=[]; 
		salidas1=[]; 
		salidas2=[]; //image or visual visual
		salidas3=[]; 

		salidas4=[]; //vis audio
		salidas5=[]; //audio visual

		currentPasada=0;
		pasadas = 30 + (cantidadBack-1) * 6;	

		ok=0; ok1=0; ok2=0; ok3=0; ok4=0; ok5=0;
		error=0; error1=0; error2=0; error3=0; error4=0; error5=0;

		myInterval=parseInt($("#timeValue").val());
		myInterval1=parseInt($("#timeValue1").val());

		clearTimeout(killInterval); 
		clearInterval(killCamera); 

		bOk=0; bOk1=0; bOk2=0; bOk3=0; bOk4=0; bOk5=0;
		mismo=0; mismo1=0; mismo2=0; mismo3=0; mismo4=0; mismo5=0;

		arrayImages=[];
		arrayImages1=[];
		arrayPreloadImages=[];

		zPreload=0;
		imgLoadedCount=0;

		$("#error").html(parseInt(error)+parseInt(error1));
		$("#ok").html(parseInt(ok)+parseInt(ok1));
		$("#results").html("");	

		//arrayImagenes = _.shuffle(arrayImages);
		//arrayImagenes1 =  _.shuffle(arrayImages1);

		cl=myLibrary.length;
		//console.log("library length");
		//console.log(cl);

		aux=_.shuffle(myLibrary);
		aux= _.first(aux,9);

		for(i=0;i<aux.length;i++){
				
			zzz=1;
			
			latitude=(aux[i][0]*zzz)+"";
			longitude=(aux[i][1]*zzz)+"";
			
			//kiev pano pano=RJd2HuqmShMAAAQfCa3ulg&
			xx=(longitude+"").split(".");
       heading=_.random(0,360);
			//console.log(xx);
			xx=xx[1];


			if(xx.length==8){
				//console.log("indoor");

				latitude=parseFloat(latitude).toFixed(7);
				longitude=parseFloat(longitude).toFixed(7);

				arrayImages[i]=`https://maps.googleapis.com/maps/api/streetview?size=600x300&location=${latitude},${longitude}&heading=${heading}&pitch=28&scale=2&key=AIzaSyB-CedQccD4tyO5TGMOSb5s1fMb-c6Nh-A`;

			}else{
				arrayImages[i]=`https://maps.googleapis.com/maps/api/streetview?size=600x600&location=${latitude},${longitude}
				&fov=90&heading=${heading}&pitch=10
				&key=AIzaSyB-CedQccD4tyO5TGMOSb5s1fMb-c6Nh-A`;


			}			
		}

		$.ajax({url: "/locinback?load=1&imagenTipo="+n("imagenesTipos")+"&cantidad="+cantidadElementos*9, success: function(result){
		  	//console.log(result);
		   arrayImages1=JSON.parse(result);
		   arrayPreloadImages = _.union(arrayImages,arrayImages1);
		   //console.log(arrayPreloadImages);
		   preload();
		   //console.log(arrayImages1);
		}});



		return;
	}//end x==0

	bOnGame=1;

	bIntroducir=0; bIntroducir1=0; bIntroducir2=0; bIntroducir3=0; bIntroducir4=0; bIntroducir5=0;  

	//Loci match error
	if(currentPasada>cantidadBack && bOk==0){

      _s=currentPasada-1;
      _b=currentPasada-1-cantidadBack;

     if(salidas[_s]==salidas[_b]){
        //console.log("e pm");
         error++;
         $("#pm").css("color","red");
         actualizarErrores();
         setTimeout(function(){ $("#pm").css("color","black"); },500);
 	   }
  	}
	bOk=0;

	//Image match error
	if(currentPasada>cantidadBack && bOk1==0 && sAct>0){

	  _s=currentPasada-1;
	  _b=currentPasada-1-cantidadBack;

	  comparar=-1; comparar1=-1; comparar2=-1;

     if(cantidadElementos==2)
       comparar=salidas1[_b][1];

     if(cantidadElementos==3){
       comparar=salidas1[_b][1];
       comparar1=salidas1[_b][2];
     }

     if(cantidadElementos==4){
       comparar=salidas1[_b][1];
       comparar1=salidas1[_b][2];
       comparar2=salidas1[_b][3];
     }

    if(salidas1[_s][0]==salidas1[_b][0] && salidas1[_s][1]==comparar && salidas1[_s][2]==comparar1 && salidas1[_s][3]==comparar2){
	     error1++;
	     $("#sm").css("color","red");
	     actualizarErrores();
	     setTimeout(function(){ $("#sm").css("color","black"); },500);
	  }
	}
	bOk1=0;

	if(pasadas==0){
     $("#stop1").hide();
     //$("#resultsList").show();

      total_p = ok + error;
      total_s =  ok1 + error1;
      total_i = ok2 + error2;
      total_c = ok3 + error3;
      //tc  
      total_va = ok4 + error4;
      total_av = ok5 + error5;


      total_ps = total_p + total_s + total_i + total_c + total_va + total_av;
      total_ok = ok + ok1 + ok2 + ok3 + ok4 + ok5;

      if(total_ps==0)
        total_ps=1;

      porcentaje_ok = (total_ok * 100)/total_ps;
      porcentaje_ok = Math.round(porcentaje_ok);

      //agregarResultado(cantidadBack,porcentaje_ok);

      recomendacion="Same level";
      if(porcentaje_ok>=75){
         recomendacion="Level augmented";
         cantidadBack++;
         pasadas = 30 + (cantidadBack-1) * 6;
         $("#cantidadBack").html(cantidadBack);
         $("#pasadas").html(pasadas);
      
      }
      if(porcentaje_ok<75 && porcentaje_ok>=50){
         recomendacion="Keep on the same level";
         perdidas=0;
      }
      if(porcentaje_ok<50){
         perdidas++;
         recomendacion="If persist in this Score is recomended decrease the level. Low score count: " + perdidas; //decrease
      }

      //ok=1; ok1=1; ok2=1; ok3=1; error=1; error1=1; error2=1; error3=1;  

      positionTxt = ""; soundTxt = ""; imageTxt= ""; colorTxt=""; vaTxt=""; avTxt="";
      if(ok!=0 || error!=0){

        positionTxt="Loci: "+ok+"-"+error;

      }
      if(ok1!=0 || error1!=0){

        soundTxt="Image: "+ok1+"-"+error1;

      }

       if(ok2!=0 || error2!=0){

        imageTxt="images: "+ok2+"-"+error2;
      }
      if(ok3!=0 || error3!=0){

        colorTxt = "colors: "+ok3+"-"+error3;
      }
      if(ok4!=0 || error4!=0){

        vaTxt = "vis & n-audio: "+ok4+"-"+error4;
      }
      if(ok5!=0 || error5!=0){

        avTxt = "audio & n-vis: "+ok5+"-"+error5;
      }
      sumaTxtTxt="";
      if(iAct==4){
        sumaTxtTxt=" Sum of numbers= " + acumuladorSuma + "<br>";
      }

      txt="<h3>Results</h3>" + positionTxt + " " + soundTxt + " " + imageTxt + " " + colorTxt + " " + vaTxt + " " + avTxt + "<br>" + sumaTxtTxt +
         "Score: "+ porcentaje_ok + "%<br>" + recomendacion;

      $("#results").html(txt);
      $("#canvas").html(`<div id="canvas1">Hello!<br>Here the instructions of the original nback game to guide you in locinback: <a href="http://brainworkshop.sourceforge.net/tutorial.html">http://brainworkshop.sourceforge.net/tutorial.html</a></div>`);

      bOnGame=0;

      $("html, body").animate({ scrollTop: $(document).height() }, 1000);

      return;

   }

	//Loci
  _r=rnd(1,100);
  _txt="misma";
 
  if(currentPasada>cantidadBack && _r<=rndPorcentaje){

    
		_poner = currentPasada-cantidadBack;
		_myImagen=salidas[_poner];
		mismo++;

		//console.log("vis & n-vis: " + _myImagen);

      
   }else{//currentPasada>cantidadBack
      _txt="random";
      
      for(;;){
         _myImagen=arrayImages[_.random(0,arrayImages.length-1)]; 
                
         if(currentPasada>cantidadBack){
            if(_myImagen!=salidas2[currentPasada-cantidadBack])
               break;        
         }else{
               break;

         }
          
           //break;
      }//for  
   }

   //Image
  _r=rnd(1,100);
  _r1=rnd(1,100);
  _txt="misma";

  if(currentPasada>cantidadBack && _r<=rndPorcentaje){

		_poner = currentPasada-cantidadBack;

		_myImagen1=salidas1[_poner][0];

     if(cantidadElementos==2);
      _myImagen2=salidas1[_poner][1];

     if(cantidadElementos==3){
      _myImagen2=salidas1[_poner][1];
      _myImagen3=salidas1[_poner][2];

     }

    if(cantidadElementos==4){
      _myImagen2=salidas1[_poner][1];
      _myImagen3=salidas1[_poner][2];
      _myImagen4=salidas1[_poner][3];

     }
      
		mismo1++;

		//console.log("vis & n-vis: " + _myImagen + "-" + _myImagen2 + "-" + _myImagen3);   
   }else{//currentPasada>cantidadBack
      _txt="random";
      
      contador=0;
      for(;;){

         _myImagen1=arrayImages1[_.random(0,8)]; 

         _myImagen2=-1;
         _myImagen3=-1;
         _myImagen4=-1;

         if(cantidadElementos==2){
            _myImagen2=arrayImages1[_.random(9,17)]; 
         }
         if(cantidadElementos==3){
            _myImagen2=arrayImages1[_.random(9,17)]; 
            _myImagen3=arrayImages1[_.random(18,arrayImages1.length-1)]; 
         }
          if(cantidadElementos==4){
            _myImagen2=arrayImages1[_.random(9,17)]; 
            _myImagen3=arrayImages1[_.random(18,26)]; 
            _myImagen4=arrayImages1[_.random(27,arrayImages1.length-1)]; 
         }

         //trick estimulus (parecido al anterior)
          if(currentPasada>cantidadBack && _r<=20){
           
            
              _poner = currentPasada-cantidadBack;

             if(cantidadElementos==2){
               
                if(rnd(0,1)){
                  _myImagen1=salidas1[_poner][0];

                }else{
                  myImagen2=salidas1[_poner][1];


                }


             }//cantidadE == 2

             if(cantidadElementos==3){

                if(rnd(0,1)) _myImagen1=salidas1[_poner][0];
                if(rnd(0,1)) _myImagen2=salidas1[_poner][1];
                if(rnd(0,1)) _myImagen3=salidas1[_poner][2];

             }//cantidadE == 3

             if(cantidadElementos==4){

                if(rnd(0,1)) _myImagen1=salidas1[_poner][0];
                if(rnd(0,1)) _myImagen2=salidas1[_poner][1];
                if(rnd(0,1)) _myImagen3=salidas1[_poner][2];
                if(rnd(0,1)) _myImagen4=salidas1[_poner][3];

             } // cantidadE == 4
            
          }//currentPasada>cantidadBack
        

         //contador++;

         if(contador==10) break;
        
         if(currentPasada>cantidadBack){
            if(_myImagen1!=salidas1[currentPasada-cantidadBack][0] || _myImagen2!=salidas1[currentPasada-cantidadBack][1] )
               break;        
         }else{
               break;

         }
          
           //break;
      }//for  
   }//currentPasada>cantidadBack
  
   salidas[currentPasada]=_myImagen;

   salidas1[currentPasada]=[];


   salidas1[currentPasada][0]=_myImagen1;

   salidas1[currentPasada][1]=-1;
   salidas1[currentPasada][2]=-1;
   salidas1[currentPasada][3]=-1;

   if(cantidadElementos==2)
    salidas1[currentPasada][1]=_myImagen2;

   if(cantidadElementos==3){
    salidas1[currentPasada][1]=_myImagen2;
    salidas1[currentPasada][2]=_myImagen3;
   }

   if(cantidadElementos==4){
    salidas1[currentPasada][1]=_myImagen2;
    salidas1[currentPasada][2]=_myImagen3;
    salidas1[currentPasada][3]=_myImagen4;
   }
    

   //console.log(salidas[currentPasada]);
   //console.log(_myImagen1);

   //$("#canvas").css("background-image",`url(${salidas[currentPasada]})`);
   //$("#canvas").css("background-image",`url('${salidas[currentPasada]}')`);
   //document.getElementById("canvas").style.backgroundImage = `url('${salidas[currentPasada]}')`;
   //console.log($("#canvas").css("background-image"));
   
   $("#canvas").html(`
    <img src="${salidas[currentPasada]}" width="${imagenDimension}px" height="${imagenDimension}px">
    <div id="cnv">
      <div id="canvas1"></div><br>
      <div id="canvas2"></div><br>
      <div id="canvas3"></div>
      <div id="canvas4"></div>
    </div>
   `);
   $("#canvas").css(`width`,imagenDimension+"px");

   myZoom="1";
   if(cantidadElementos==3)
    myZoom="0.55";

   if(cantidadElementos==4)
    myZoom="0.4";

   if(n("imagenesTipos")==3)
    myZoom="3";
   if(n("imagenesTipos")==2)
    myZoom="1.5";

   $("#canvas1").html(`<img src="${salidas1[currentPasada][0]}" style="zoom: ${myZoom};">`);

   if(cantidadElementos==2)
    $("#canvas2").html(`<img src="${salidas1[currentPasada][1]}" style="zoom: ${myZoom};">`);

   if(cantidadElementos==3){

     $("#canvas2").html(`<img src="${salidas1[currentPasada][1]}" style="zoom: ${myZoom};">`);
     $("#canvas3").html(`<img src="${salidas1[currentPasada][2]}" style="zoom: ${myZoom};">`);

   }

   if(cantidadElementos==4){

     $("#canvas2").html(`<img src="${salidas1[currentPasada][1]}" style="zoom: ${myZoom};">`);
     $("#canvas3").html(`<img src="${salidas1[currentPasada][2]}" style="zoom: ${myZoom};">`);
     $("#canvas4").html(`<img src="${salidas1[currentPasada][3]}" style="zoom: ${myZoom};">`);

   }
   

   currentPasada++; 
   bIntroducir=1; bIntroducir1=1; bIntroducir2=1; bIntroducir3=1;  bIntroducir4=1;  bIntroducir5=1;
   pasadas--;

   $("#pasadas").html(pasadas);


  killInterval = setTimeout(function(){play(1);},myInterval);
  setTimeout(function(){limpiar();},myInterval1);
   

}//en play()

function limpiar(){
	//$("#canvas").css("background-image",``);
	$("#canvas").html("");

}

$(document).keypress(function(e) {
  console.log("key");

	console.log("key" + e.which);

	if(!bOnGame) return;


   //Loci
   if(e.which==97){

     if(bIntroducir){
        
        if(currentPasada>cantidadBack){
            console.log("A");
           //console.log(bIntroducir);
            _s=currentPasada-1;
            _b=currentPasada-1-cantidadBack;

            if(salidas[_s]==salidas[_b]){
              bOk=1;
              ok++;
              $("#ok").html(ok);
              actualizarOk();
              $("#pm").css("color","green");
              //console.log("ok");

              
            }else{
              $("#pm").css("color","red");

              console.log("error");
              error++;
              bOk=1;
              //$("#error").html(error);
              actualizarErrores();

            } //si coincide
        }//pasadas>cantidadBack
     }//bIntroducir
     bIntroducir=0;
     setTimeout(function(){ $("#pm").css("color","black"); },500);
   }//wich a


   //Image
   if(e.which==108){

     if(bIntroducir1 && sAct>0){
        
        
        if(currentPasada>cantidadBack){
           //console.log(bIntroducir);
            _s=currentPasada-1;
            _b=currentPasada-1-cantidadBack;

            comparar=-1; comparar1=-1; comparar2=-1;

            if(cantidadElementos==2)
              comparar=salidas1[_b][1];

            if(cantidadElementos==3){
              comparar=salidas1[_b][1];
              comparar1=salidas1[_b][2];

            }

            if(cantidadElementos==4){
              comparar=salidas1[_b][1];
              comparar1=salidas1[_b][2];
              comparar2=salidas1[_b][3];

            }

            if(salidas1[_s][0]==salidas1[_b][0] && salidas1[_s][1]==comparar && salidas1[_s][2]==comparar1 && salidas1[_s][3]==comparar2){
              bOk1=1;
              ok1++;
              //$("#ok").html(parseInt(ok)+parseInt(ok1));
              actualizarOk();
              $("#sm").css("color","green");
              //console.log("ok-s");

              
            }else{
              $("#sm").css("color","red");

              //console.log("error-s");
              error1++;
              bOk1=1;
              //$("#error").html(parseInt(error)+parseInt(error1));
              actualizarErrores();


            } //si coincide
        }//pasadas>cantidadBack
     }//bIntroducir
     bIntroducir1=0;
     setTimeout(function(){ $("#sm").css("color","black"); },500);
   }//wiich l

  //console.log(e.which);
});//on keypress

$("#mas").click(function(){
      cantidadBack++;
      pasadas = 30 + (cantidadBack-1) * 6;
      $("#cantidadBack").html(cantidadBack);
      $("#pasadas").html(pasadas);
      clearTimeout(killInterval);
      perdidas=0;
      

   });
   $("#menos").click(function(){
      if(cantidadBack==1)
         return;
       perdidas=0;
      cantidadBack--;
      pasadas = 30 + (cantidadBack-1) * 6;
      $("#cantidadBack").html(cantidadBack);
      $("#pasadas").html(pasadas);
      clearTimeout(killInterval);

   });

   //Match Buttons

   $("#pm, #controls-l").click(function(){
   	   if(bIntroducir){
            
            if(currentPasada>cantidadBack){
               //console.log(bIntroducir);
                _s=currentPasada-1;
                _b=currentPasada-1-cantidadBack;

                if(salidas[_s]==salidas[_b]){
                  bOk=1;
                  ok++;
                  $("#ok").html(ok);
                  $("#pm").css("color","green");
                  console.log("ok");
                  actualizarOk();

                  
                }else{
                  $("#pm").css("color","red");

                  //console.log("error");
                  error++;
                  bOk=1;
                  //$("#error").html(error);
                  actualizarErrores();

                } //si coincide
            }//pasadas>cantidadBack
         }//bIntroducir
         bIntroducir=0;
         setTimeout(function(){ $("#pm").css("color","black"); },500);
   	

   });

   $("#sm, #controls-r").click(function(){
   	
	   	 if(bIntroducir1 && sAct>0){
	            
	            if(currentPasada>cantidadBack){
	               //console.log(bIntroducir);
	                _s=currentPasada-1;
	                _b=currentPasada-1-cantidadBack;

                  comparar=-1; comparar1=-1; comparar2=-1;

                  if(cantidadElementos==2)
                    comparar=salidas1[_b][1];

                  if(cantidadElementos==3){
                    comparar=salidas1[_b][1];
                    comparar1=salidas1[_b][2];

                  }

                  if(cantidadElementos==4){
                    comparar=salidas1[_b][1];
                    comparar1=salidas1[_b][2];
                    comparar2=salidas1[_b][3];

                  }

                  if(salidas1[_s][0]==salidas1[_b][0] && salidas1[_s][1]==comparar && salidas1[_s][2]==comparar1 && salidas1[_s][3]==comparar2){
	                  bOk1=1;
	                  ok1++;
	                  $("#ok").html(parseInt(ok)+parseInt(ok1));
	                  $("#sm").css("color","green");
	                  console.log("ok-s");
                    actualizarOk();

	                  
	                }else{
	                  $("#sm").css("color","red");

	                  console.log("error-s");
	                  error1++;
	                  bOk1=1;
	                  //$("#error").html(parseInt(error)+parseInt(error1));
                    actualizarErrores();
	                } //si coincide
	            }//pasadas>cantidadBack
	         }//bIntroducir
	         bIntroducir1=0;
	         setTimeout(function(){ $("#sm").css("color","black"); },500);
    	  
});

$("#stop1").click(function(){
    $("#stop1").hide();
    clearTimeout(killInterval);
    bOnGame=0;

});

function rnd(min,max)
{
    return Math.floor(Math.random()*(max-min+1)+min);
}



if(bMobile==1){
     _ww=$(window).width();
    _wh=$(window).height();
    _cw = (_ww - canvas.width)/2-20;

    imagenDimension=500;

   //$("#controls-l").css("width",_cw+"px"); 
	 $("#controls-l").css("width","70px"); 
   $("#controls-l").css("height",_wh+"px"); 
   $("#controls-l").css("display","flex");  
   //$("#controls-l").css("z-index","10000");

    //$("#controls-r").css("width",_cw+"px"); 
    $("#controls-r").css("width","70px"); 
    $("#controls-r").css("height",_wh+"px"); 
    $("#controls-r").css("display","flex"); 
   // $("#controls-r").css("z-index","10000");
    
    
    $("#controls-l").html(`<div style="align-self: center; margin-left: 30%;">A</div>`);
    $("#controls-r").html(`<div style="align-self: center; margin-left: 40%;">S</div>`);
}

</script>
<script type="text/javascript">
   if( /Android|webOS|iPhone|iPad|iPod|Opera Mini/i.test(navigator.userAgent) || $(window).width()<900 ) {
     // run your code here
     $("#myOther").hide();

    }
</script>

</body>
</html>