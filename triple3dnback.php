<!DOCTYPE html>
<html>
   <head>
      <meta charset="utf-8">
      <title>Triple Position 3D N-Back</title>

    <meta name="description" content="Triple Position N-back: Train your mind in 3D">
    <meta name="keywords" content="mental training, memory, working memory">

      <script src="scripts/gl-matrix.js"></script>
      <script src="scripts/phoria-util.js"></script>
      <script src="scripts/phoria-entity.js"></script>
      <script src="scripts/phoria-scene.js"></script>
      <script src="scripts/phoria-renderer.js"></script>
      <script src='scripts/dat.gui.min.js'></script>
      <script src='scripts/jquery.min.js'></script>
      <script src="scripts/buzz.min.js"></script>
      <script src="js/underscore-min.js"></script>
      <script src="js/jquery.cookie-dist.js" type="text/javascript"></script> 
      <!--<script src="https://ajax.googleapis.com/ajax/libs/jquery/1.12.3/jquery.min.js"></script>-->
       <style type="text/css">

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
      bCorrectionCheck=1;

var requestAnimFrame = window.requestAnimationFrame || window.webkitRequestAnimationFrame ||
                       window.mozRequestAnimationFrame || window.msRequestAnimationFrame || 
                       function(c) {window.setTimeout(c, 15)};

var requestAnimFrame1 = window.requestAnimationFrame || window.webkitRequestAnimationFrame ||
                       window.mozRequestAnimationFrame || window.msRequestAnimationFrame || 
                       function(c) {window.setTimeout(c, 15)};

var requestAnimFrame2 = window.requestAnimationFrame || window.webkitRequestAnimationFrame ||
                       window.mozRequestAnimationFrame || window.msRequestAnimationFrame || 
                       function(c) {window.setTimeout(c, 15)};

//var requestAnimFrame = window.requestAnimationFrame || window.webkitRequestAnimationFrame ||
//                      window.mozRequestAnimationFrame || window.msRequestAnimationFrame || 
//                      function(c) {window.setTimeout(c, 15)};                       
/**
   Phoria
   pho·ri·a (fôr-)
   n. The relative directions of the eyes during binocular fixation on a given object
*/

// bind to window onload event
//window.addEventListener('load', onloadHandler, false);
window.addEventListener('load', iniciar, false);
var scene;
var scene1;
var scene2;

casillerosEs=["tea","noe","humo","oca","ola","oso","ufo","hacha","ave","toro","teta","tina","atomo","taco","tela","tos","tufo","techo","tuvo","noria","nota","nene","nemo","nuca","nilo","anis","nife","nicho","nube","muro","moto","mono","momia","amaca","mula","mesa","mafia","mecha","ameba","caro","cohete","cono","cama","coco","cola","casa","cafe","coche","cubo","ilar","late","luna","lima","loco","lulu","losa","alfa","lucha","lobo","sor","seta","sena","sumo","saco","sal","seso","sofa","sacha","sebo","faro","foto","faena","fama","foca","falo","fosa","fofo","ficha","efebo","hachero","chita","chino","chama","chica","chile","chas","chufa","chucho","chivo","bar","bota","vino","bum","vaca","vela","vaso","bofia","bache","bebe"];
casillerosEn=["tie","noah","ma","rye","law","shoe","cow","ivy","bee","toes","tot","tin","tomb","tyre","towel","dish","tack","dove","tub","nose","net","nun","nemmo","nero","nail","notch","neck","knife","knob","mice","mat","moon","mummy","mower","mule","match","mug","movie","mop","rose","rod","rain","ram","rower","roll","roach","rock","roof","rope","lace","loot","lion","loom","lure","lily","leach","log","lava","lip","cheese","sheet","chain","chum","cherry","jail","choo","chalk","chef","ship","case","cot","coin","comb","car","coal","cage","coke","cave","cob","fez","fit","phone","foam","fur","file","fish","fog","fifi","fob","bus","bat","bone","bumm","bear","bell","beach","book","poof","pipe"];

/*
for(i=0;i<casillerosEs.length;i++){

  console.log((i+1)+" "+casillerosEs[i]);
  console.log((i+1)+" "+casillerosEn[i]);

  n=casillerosEs[i];
  eval("__s"+n+" = new buzz.sound( \"/sound/"+n+"\" , {formats: [ \"mp3\" ] })");
   n=casillerosEn[i];
  eval("__s"+n+" = new buzz.sound( \"/sound/"+n+"\" , {formats: [ \"mp3\" ] })");
}

console.log(casillerosEn.length+"-"+casillerosEs.length);
*/

miRnd=_.range(0,casillerosEn.length-1);
miRnd = _.shuffle(miRnd);

r1=_.random(0,casillerosEs.length-9);
r2=r1+8;
selectCasillerosEs=_.first(miRnd, 8);
selectCasillerosEn=_.first(miRnd, 8);
//console.log(selectCasillerosEs);
/*
for(i=0;i<selectCasillerosEs.length;i++){

  n=casillerosEs[selectCasillerosEs[i]];
  eval("__s"+n+" = new buzz.sound( \"/sound/"+n+"\" , {formats: [ \"mp3\" ] })");
  selectCasillerosEs[i]=n;
}

for(i=0;i<selectCasillerosEn.length;i++){

  n=casillerosEn[selectCasillerosEn[i]];
  eval("__s"+n+" = new buzz.sound( \"/sound/"+n+"\" , {formats: [ \"mp3\" ] })");
  selectCasillerosEn[i]=n;
}
*/

/*
__sc = new buzz.sound( "/sound/c" , {formats: [ "mp3" ] });
__sh = new buzz.sound( "/sound/h" , {formats: [ "mp3" ] });
__sk = new buzz.sound( "/sound/k" , {formats: [ "mp3" ] });
__sl = new buzz.sound( "/sound/l" , {formats: [ "mp3" ] });

__sq = new buzz.sound( "/sound/q" , {formats: [ "mp3" ] });
__sr = new buzz.sound( "/sound/r" , {formats: [ "mp3" ] });
__ss = new buzz.sound( "/sound/s" , {formats: [ "mp3" ] });
__st = new buzz.sound( "/sound/t" , {formats: [ "mp3" ] });

letras=["c","h","k","l","q","r","s","t"];

__sdo = new buzz.sound( "/sound/do" , {formats: [ "mp3" ] });
__sre = new buzz.sound( "/sound/re" , {formats: [ "mp3" ] });
__smi = new buzz.sound( "/sound/mi" , {formats: [ "mp3" ] });
__sfa = new buzz.sound( "/sound/fa" , {formats: [ "mp3" ] });

__ssol = new buzz.sound( "/sound/sol" , {formats: [ "mp3" ] });
__sla = new buzz.sound( "/sound/la" , {formats: [ "mp3" ] });
__ssi = new buzz.sound( "/sound/si" , {formats: [ "mp3" ] });
__sdo1 = new buzz.sound( "/sound/do1" , {formats: [ "mp3" ] });
*/
notas=["do","re","mi","fa","sol","la","si","do1"];
alfabeto=["a1","a2","a3","a4","b","c","d","e1","e2","e3","e4","f","g","h","i","l","m","n1","n2","n3","n4","o1","o2","o3","o4","p","q","r1","r2","r3","r4","s1","s2","s3","s4","t","u","v","y","00","01","02","03","04","05","06","07","08","09","30","31","32","33","34","35","36","37","38","39","40","41","42","43","44","45","46","47","48","49","50","51","52","53","54","55","56","57","58","59","60","61","62","63","64","65","66","67","68","69","70","71","72","73","74","75","76","77","78","79","80","81","82","83","84","85","86","87","88","89","90","91","92","93","94","95","96","97","98","99","1","2","3","4","5","6","7","8","9","10","11","12","13","14","15","16","17","18","19","20","21","22","23","24","25","26","27","28","29","30","31","32","33","34","35","36","37","38","39","40","41","42","43","44","45","46","47","48","49","50","51","52"];

alpha = _.range(0,39);

figuras = _.range(39,118);
figurasBlancas = [39,49,59,69,79,89,99,109];
cartas = _.range(118,alfabeto.length);

misColores = ["0,0,0","151,75,0","255,0,0","255,242,0","0,255,0","0,0,255","128,0,128","255,255,255"];

//console.log(alfabeto[118]);
//_.shuffle(list) _.sample([1, 2, 3, 4, 5, 6],3); _.range(0, 30, 5);

var loader;
var bitmaps = [];

function onloadHandler()
{
   // get the images loading
   //loader = new Phoria.Preloader();
   /*
   poner="";
   for(i=1;i<53;i++){

    add="0"
    if(i>9){
      add="";
    }
    if(i<=9 || i>29){
      poner+=",\""+i+"\"";

    }
   }
  $("#results").html(poner);*/
   

   //console.log(alfabeto.length);

/*
   for (var i=0; i<alfabeto.length; i++)
   {

      letra = alfabeto[i];

      ext=".gif";
      carpeta="emociones";

      if(i>38){

        ext=".png";
        carpeta="figuras";

      }
      if(i>118){

        ext=".png";
        carpeta="cartas";

      }

      
      //console.log('/emociones/'+letra+'.gif');

      bitmaps.push(new Image());
      loader.addImage(bitmaps[i], '/'+carpeta+'/'+letra+ext);
   }
   loader.onLoadCallback( iniciar);

   */
  
}
var canvas, canvas1, canvas2, renderer, renderer1, renderer2;

function iniciar()
{

  //cargarResultados();
  
   // get the canvas DOM element and the 2D drawing context
   canvas = document.getElementById('canvas');
   canvas1 = document.getElementById('canvas1');
   canvas2 = document.getElementById('canvas2');

   //console.log(canvas2)
   
   // create the scene and setup camera, perspective and viewport
   scene = new Phoria.Scene();
   scene1 = new Phoria.Scene();
   scene2 = new Phoria.Scene();

   //console.log(scene2);

   scene.camera.position = {x:-3.5, y:5.0, z:-15.0};
   scene.perspective.aspect = canvas.width / canvas.height;
   scene.viewport.width = canvas.width;
   scene.viewport.height = canvas.height;

   scene1.camera.position = {x:-3.5, y:5.0, z:-15.0};
   scene1.perspective.aspect = canvas1.width / canvas1.height;
   scene1.viewport.width = canvas1.width;
   scene1.viewport.height = canvas1.height;

   scene2.camera.position = {x:-3.5, y:5.0, z:-15.0};
   scene2.perspective.aspect = canvas2.width / canvas2.height;
   scene2.viewport.width = canvas2.width;
   scene2.viewport.height = canvas2.height;

  // console.log(scene2.viewport.height);
   
   // create a canvas renderer
   renderer = new Phoria.CanvasRenderer(canvas);
   renderer1 = new Phoria.CanvasRenderer(canvas1);
   renderer2 = new Phoria.CanvasRenderer(canvas2);
   
   // add a grid to help visualise camera position etc.
  // var plane = Phoria.Util.generateTesselatedPlane(8,8,0,20);
   var plane = Phoria.Util.generateTesselatedPlane(8,8,0,20);
  // var plane1 = Phoria.Util.generateTesselatedPlane(8,8,0,20);
  // var plane2 = Phoria.Util.generateTesselatedPlane(8,8,0,20);

   scene.graph.push(Phoria.Entity.create({
      points: plane.points,
      edges: plane.edges,
      polygons: plane.polygons,
      style: {
         drawmode: "wireframe",
         shademode: "plain",
         linewidth: 0.5,
         objectsortmode: "back"
      }
   }));
  
   scene1.graph.push(Phoria.Entity.create({
      points: plane.points,
      edges: plane.edges,
      polygons: plane.polygons,
      style: {
         drawmode: "wireframe",
         shademode: "plain",
         linewidth: 0.5,
         objectsortmode: "back"
      }
   }));

    scene2.graph.push(Phoria.Entity.create({
      points: plane.points,
      edges: plane.edges,
      polygons: plane.polygons,
      style: {
         drawmode: "wireframe",
         shademode: "plain",
         linewidth: 0.5,
         objectsortmode: "back"
      }
   }));


   init(); init1(); init2();

   //[0,0,180]

   //lightColor = [0,0,180];
/*
    var blueLightObj = Phoria.Entity.create({
      points: [{x:0, y:5, z:-8}],
      style: {
         color: [0,0,255],
         drawmode: "point",
         shademode: "plain",
         linewidth: 5,
         linescale: 2
      }
   });
   scene.graph.push(blueLightObj);
  
 //  var blueLight = Phoria.PointLight.create({
  //    position: {x:0, y:2, z:-5},
   //   color: [0,0,1]
  // });
*/
  //////////////////////////////////////////
  /*
  var blueLight = Phoria.PointLight.create({
      position: {x:3, y:5, z:-8}, //x:3
      color: lightColor
  });
  //blueLightObj.children.push(blueLight);
  scene.graph.push(blueLight);

  var blueLight = Phoria.PointLight.create({
      position: {x:-4, y:2, z:-5}, //-4
      color: lightColor
   });
  scene.graph.push(blueLight);

  var blueLight = Phoria.PointLight.create({
      position: {x:-10, y:12, z:10}, //x:0 z:10
      color: lightColor
   });
  scene.graph.push(blueLight);

  var blueLight = Phoria.PointLight.create({ //x:0 y;5 z:-8
      position: {x:-10, y:5, z:-8},
      color: lightColor
  });
  scene.graph.push(blueLight);

  var blueLight = Phoria.PointLight.create({
      position: {x:-10, y:-5, z:8},  //x:0 y;5 z:8
      color: lightColor
  });
  scene.graph.push(blueLight);
  */

  scene.graph.push(new Phoria.DistantLight());
  scene1.graph.push(new Phoria.DistantLight());
  scene2.graph.push(new Phoria.DistantLight());

   var pause = false;

   var fnAnimate = function() {
      //console.log("hoa");
      if (!pause)
      {
         // rotate local matrix of the cube
         //cube.rotateY(0.5*Phoria.RADIANS);

         
         // execute the model view 3D pipeline and render the scene
         scene.modelView();
         //scene1.modelView();

         renderer.render(scene);
         //renderer.render(scene1);

      }
      requestAnimFrame(fnAnimate);
   };
   var fnAnimate1 = function() {
      //console.log("hoa");
      if (!pause)
      {
         // rotate local matrix of the cube
         //cube.rotateY(0.5*Phoria.RADIANS);

         
         // execute the model view 3D pipeline and render the scene
         scene1.modelView();
         //scene1.modelView();

         renderer1.render(scene1);
         //renderer.render(scene1);

      }

      requestAnimFrame(fnAnimate1);
   };

    var fnAnimate2 = function() {
      //console.log("hoa");
      if (!pause)
      {
        //console.log("hola");
         // rotate local matrix of the cube
         //cube.rotateY(0.5*Phoria.RADIANS);

         
         // execute the model view 3D pipeline and render the scene
         scene2.modelView();
         //scene1.modelView();

         renderer2.render(scene2);
         //renderer.render(scene1);
         //console.log("hola");
      }
      requestAnimFrame(fnAnimate2);
   };

   $(document).keypress(function(e) {
       if(e.which == 13) {
           cube.style.color = [0,128,0];
           cube.translateX(0.1);
           scene.modelView();

         renderer.render(scene);
         //scene.graph.push(cube);

       }

       //Position match letter A
       if(e.which==97){

         if(bIntroducir){
            
            if(currentPasada>cantidadBack){
               //console.log(bIntroducir);
                _s=currentPasada-1;
                _b=currentPasada-1-cantidadBack;

                if(salidas[_s][0]==salidas[_b][0] && salidas[_s][1]==salidas[_b][1] && salidas[_s][2]==salidas[_b][2]){
                  bOk=1;
                  ok++;
                  //$("#ok").html(ok);
                  actualizarOk();
                  if(bCorrectionCheck)
                    $("#pm").css("color","green");
                  //console.log("ok");

                  
                }else{
                  if(bCorrectionCheck)
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
       }//wiich a


       //Position match C - letter j
       //if(e.which==108){
       if(e.which==106){
         if(bIntroducir1){
            
            if(currentPasada>cantidadBack){
               //console.log(bIntroducir);
                _s=currentPasada-1;
                _b=currentPasada-1-cantidadBack;

                if(salidas1[_s][0]==salidas1[_b][0] && salidas1[_s][1]==salidas1[_b][1] && salidas1[_s][2]==salidas1[_b][2]){
                  bOk1=1;
                  ok1++;
                  //$("#ok").html(ok);
                  actualizarOk();
                  if(bCorrectionCheck)
                    $("#pm1").css("color","green");
                  //console.log("ok");

                  
                }else{
                  if(bCorrectionCheck)
                    $("#pm1").css("color","red");

                  //console.log("error");
                  error1++;
                  bOk1=1;
                  //$("#error").html(error);
                  actualizarErrores();

                } //si coincide
            }//pasadas>cantidadBack
         }//bIntroducir
         bIntroducir1=0;
         setTimeout(function(){ $("#pm1").css("color","black"); },500);


        /*
         if(bIntroducir1 && sAct>0){  
            if(currentPasada>cantidadBack){
               //console.log(bIntroducir);
                _s=currentPasada-1;
                _b=currentPasada-1-cantidadBack;

                if(salidas1[_s]==salidas1[_b]){
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

         */
       }//wiich j
       

       //right Match letter L
       //if(e.which==106){
       if(e.which==108){
        console.log("L-right");

         if(bIntroducir2){
            
            if(currentPasada>cantidadBack){
               //console.log(bIntroducir);
                _s=currentPasada-1;
                _b=currentPasada-1-cantidadBack;

                 if(salidas2[_s][0]==salidas2[_b][0] && salidas2[_s][1]==salidas2[_b][1] && salidas2[_s][2]==salidas2[_b][2]){
                  bOk2=1;
                  ok2++;
                  //$("#ok").html(parseInt(ok)+parseInt(ok1));
                  actualizarOk();
                  if(bCorrectionCheck)
                    $("#pm2").css("color","green");
                  //console.log("ok-s");

                  
                }else{
                  if(bCorrectionCheck)
                    $("#pm2").css("color","red");

                  //console.log("error-s");
                  error2++;
                  bOk2=1;
                  //$("#error").html(parseInt(error)+parseInt(error1));
                  actualizarErrores();

                } //si coincide
            }//pasadas>cantidadBack
         }//bIntroducir
         bIntroducir2=0;
         setTimeout(function(){ $("#pm2").css("color","black"); },500);
       }//wiich a
       
       /*

       //color match
       if(e.which==102){

         if(bIntroducir3 && cAct==1){
               
            if(currentPasada>cantidadBack){
               //console.log(bIntroducir);
                _s=currentPasada-1;
                _b=currentPasada-1-cantidadBack;

                if(salidas3[_s]==salidas3[_b]){
                  bOk3=1;
                  ok3++;
                  //$("#ok").html(parseInt(ok)+parseInt(ok1));
                  actualizarOk();
                  $("#cm").css("color","green");
                  //console.log("ok-s");

                  
                }else{
                  $("#cm").css("color","red");

                  //console.log("error-s");
                  error3++;
                  bOk3=1;
                  //$("#error").html(parseInt(error)+parseInt(error1));
                  actualizarErrores();

                } //si coincide
            }//pasadas>cantidadBack
         }//bIntroducir
         bIntroducir3=0;
         setTimeout(function(){ $("#cm").css("color","black"); },500);

       }//wiich a

       */

      //console.log(e.which);
   });// key binding



   
   document.addEventListener('keydown', function(e) {
      switch (e.keyCode)
      {
         case 27: // ESC
            
            pause = !pause;
           

            break;
      }
   }, false);
   // add GUI controls
   
   /*
   var gui = new dat.GUI();
   var f = gui.addFolder('Perspective');
   f.add(scene.perspective, "fov").min(5).max(175);
   f.add(scene.perspective, "near").min(1).max(100);
   f.add(scene.perspective, "far").min(1).max(1000);

   //f.open();
   f = gui.addFolder('Camera LookAt');
   f.add(scene.camera.lookat, "x").min(-100).max(100);
   f.add(scene.camera.lookat, "y").min(-100).max(100);
   f.add(scene.camera.lookat, "z").min(-100).max(100);
   f.open();
   f = gui.addFolder('Camera Position');
   f.add(scene.camera.position, "x").min(-100).max(100);
   f.add(scene.camera.position, "y").min(-100).max(100);
   f.add(scene.camera.position, "z").min(-100).max(100);
   f.open();
   f = gui.addFolder('Camera Up');
   f.add(scene.camera.up, "x").min(-10).max(10).step(0.1);
   f.add(scene.camera.up, "y").min(-10).max(10).step(0.1);
   f.add(scene.camera.up, "z").min(-10).max(10).step(0.1);
   */

   /*
   f = gui.addFolder('Rendering');
   f.add(cube.style, "drawmode", ["point", "wireframe", "solid"]);
   f.add(cube.style, "shademode", ["plain", "lightsource"]);
   f.add(cube.style, "fillmode", ["fill", "filltwice", "inflate", "fillstroke", "hiddenline"]);
   f.open();
   */
   // start animation
   requestAnimFrame(fnAnimate);
   requestAnimFrame1(fnAnimate1);
   requestAnimFrame1(fnAnimate2);
   

   $("#clearResultsList").click(function(){
      limpiarResultados();   
   });

   $("#start").click(function(){
      start(0);
   });

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

   $("#pm").click(function(){
   	   if(bIntroducir){
            
            if(currentPasada>cantidadBack){
               //console.log(bIntroducir);
                _s=currentPasada-1;
                _b=currentPasada-1-cantidadBack;

                if(salidas[_s][0]==salidas[_b][0] && salidas[_s][1]==salidas[_b][1] && salidas[_s][2]==salidas[_b][2]){
                  bOk=1;
                  ok++;
                  //$("#ok").html(ok);
                  $("#pm").css("color","green");
                  console.log("ok");

                  
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

    $("#pm1").click(function(){
       if(bIntroducir1){
            
            if(currentPasada>cantidadBack){
               //console.log(bIntroducir);
                _s=currentPasada-1;
                _b=currentPasada-1-cantidadBack;

                if(salidas1[_s][0]==salidas1[_b][0] && salidas1[_s][1]==salidas1[_b][1] && salidas1[_s][2]==salidas1[_b][2]){
                  bOk1=1;
                  ok1++;
                  //$("#ok").html(ok);
                  $("#pm1").css("color","green");
                  console.log("ok");

                  
                }else{
                  $("#pm1").css("color","red");

                  //console.log("error");
                  error1++;
                  bOk1=1;
                  //$("#error").html(error);
                  actualizarErrores();

                } //si coincide
            }//pasadas>cantidadBack
         }//bIntroducir
         bIntroducir1=0;
         setTimeout(function(){ $("#pm1").css("color","black"); },500);
    

   });



   /*

   $("#sm").click(function(){
   	
	   	 if(bIntroducir1 && sAct>0){
	            
	            if(currentPasada>cantidadBack){
	               //console.log(bIntroducir);
	                _s=currentPasada-1;
	                _b=currentPasada-1-cantidadBack;

	                if(salidas1[_s]==salidas1[_b]){
	                  bOk1=1;
	                  ok1++;
	                  $("#ok").html(parseInt(ok)+parseInt(ok1));
	                  $("#sm").css("color","green");
	                  console.log("ok-s");

	                  
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

   $("#im").click(function(){

    if(bIntroducir2 && iAct>0){
            
            
            if(currentPasada>cantidadBack){
               //console.log(bIntroducir);
                _s=currentPasada-1;
                _b=currentPasada-1-cantidadBack;

                if(salidas2[_s]==salidas2[_b]){
                  bOk2=1;
                  ok2++;
                  //$("#ok").html(parseInt(ok)+parseInt(ok1));
                  actualizarOk();
                  $("#im").css("color","green");
                  //console.log("ok-s");

                  
                }else{
                  $("#im").css("color","red");

                  //console.log("error-s");
                  error2++;
                  bOk2=1;
                  //$("#error").html(parseInt(error)+parseInt(error1));
                  actualizarErrores();

                } //si coincide
            }//pasadas>cantidadBack
         }//bIntroducir
         bIntroducir2=0;
         setTimeout(function(){ $("#im").css("color","black"); },500);
   });

    $("#cm").click(function(){
      if(bIntroducir3 && cAct==1){
     
            if(currentPasada>cantidadBack){
               //console.log(bIntroducir);
                _s=currentPasada-1;
                _b=currentPasada-1-cantidadBack;

                if(salidas3[_s]==salidas3[_b]){
                  bOk3=1;
                  ok3++;
                  //$("#ok").html(parseInt(ok)+parseInt(ok1));
                  actualizarOk();
                  $("#cm").css("color","green");
                  //console.log("ok-s");

                  
                }else{
                  $("#cm").css("color","red");

                  //console.log("error-s");
                  error3++;
                  bOk3=1;
                  //$("#error").html(parseInt(error)+parseInt(error1));
                  actualizarErrores();

                } //si coincide
            }//pasadas>cantidadBack
         }//bIntroducir
         bIntroducir3=0;
         setTimeout(function(){ $("#cm").css("color","black"); },500);
       //wiich 
    });

  */

   $("#tipoImagen").change(function(){
    sTipoImagen=parseInt($("#tipoImagen").val());
  
    if(sTipoImagen==1 || sTipoImagen==3){
      cAct=0;
      $('#colorActivo').attr('checked', false);
      //$("#tipoCamera").val(0);
      $("#cm").hide();
    }
    if(sTipoImagen>0){
      $("#im").show();
     // $("#tipoCamera").val(0);


    }else{
      $("#im").hide();
    }
    iAct=sTipoImagen;
    setMargin();
    console.log("iAct:"+iAct);

   });

   $("#tipoSonido").change(function(){
    sTipoSonido=parseInt($("#tipoSonido").val());
    if(sTipoSonido==0){
      $("#sm").hide();
      
    }else{
      $("#sm").show();

    }
    sAct=sTipoSonido;
  
    setMargin();

   });

  $("#tipoCamera").change(function(){
    if($("#tipoCamera").val()>0){
     // $('#colorActivo').attr('checked', false);
      //$("#tipoImagen").val(0);

    }
    
  });

  $("#colorActivo").click(function(){
    cAct=!cAct;
    imageGameType=parseInt($("#tipoImagen").val());
    //console.log(imageGameType);
    if(cAct==1 && (imageGameType==1 || imageGameType==3)){
      $("#tipoImagen").val(0);
      $("#im").hide();

    }
    if(cAct==0){
      $("#cm").hide();
      
    }else{
      $("#cm").show();
     // $("#tipoCamera").val(0);

    }

    imageGameType=parseInt($("#tipoImagen").val());
    iAct=imageGameType;

    setMargin();

   });

  $("#stop1").click(function(){
    $("#stop1").hide();
    clearTimeout(killInterval);

  });

   $("#loading").hide();
   $("#cm").hide();
   //$("#im").hide();
   $("#sm").hide();
   $("#tipoSonido").hide();
   $("#tipoImagen").hide();
   $("#escondeColor").hide();
   //$("#tipoCamera").hide();
   //$("#botonera").css("margin-left","150px");
   //console.log($("#sm").width());
   $("#stop1").hide();
   $("#colorActivo").hide;
   $(".oke").hide();


  // start(0);
}

var cAct=0, iAct=0, sAct=1;
var salidas = [], salidas1 = [], salidas2 = [], salidas3 = [], cantidadBack=1, pasadas=36, currentPasada=0;
var bIntroducir=0, bIntroducir1=0, bIntroducir2=0, bIntroducir3=0;
var ok=0, ok1=0, ok2=0, ok3=0;
var error=0 , error1=0, error2=0, error3=0, mismo=0,mismo1=0, mismo2=0,mismo3=0;
var killInterval,myInterval,killCamera;
var bOk=0,bOk1=0,bOk2=0,bOk3=0;
var arrayImagenes=[];

function actualizarOk(){
  $("#ok").html(parseInt(ok)+parseInt(ok1)+parseInt(ok2)+parseInt(ok3));
}

function actualizarErrores(){
  $("#error").html(parseInt(error)+parseInt(error1)+parseInt(error2)+parseInt(error2));
}

function setMargin(){
  return;
  marginTotal=150;
  
  sTipoImagen=parseInt($("#tipoImagen").val());
  sTipoSonido=parseInt($("#tipoSonido").val());

  if(sTipoImagen>0)
    marginTotal-=70;
  if(sTipoSonido>0)
    marginTotal-=79;
  if(cAct==1)
    marginTotal-=70;

  //$("#botonera").css("margin-left",marginTotal+"px");

}
var xCamera = 0, yCamera=0, zCamera=0, myFrame=0, iniX=0, iniZ=10;

function cameraMove(){
  //return;

  myFrame++;
  r=20; T=parseInt($("#camVelocity").val());
  pi=Math.PI;

  if(tipoCameraVal==1){

    xCamera = r * Math.cos(myFrame / T * (2 * pi))
    zCamera = r * Math.sin(myFrame / T * (2 * pi))
    scene.camera.position = {x:0.0+xCamera, y:5.0+yCamera, z:-3.0+zCamera};
    //xCamera+=0.5;
    //yCamera+=0.5;
   // scene.camera.position = {x:0.0+xCamera, y:5.0+yCamera, z:-15.0};
    
    //console.log(xCamera+"-"+yCamera);
  }
    if(tipoCameraVal==2){
     // console.log("camera 2");
      xCamera = r * Math.sin(myFrame / T * (2 * pi))
      zCamera = r * Math.cos(myFrame / T * (2 * pi))
      //xCamera+=0.5;
      //yCamera+=0.5;
     // scene.camera.position = {x:0.0+xCamera, y:5.0+yCamera, z:-15.0};
      scene.camera.position = {x:0.0-xCamera, y:5.0+yCamera, z:-3.0-zCamera};
      //console.log(xCamera+"-"+yCamera);

    }
  if(tipoCameraVal==3){

    r=25; 

    yCamera = r * Math.sin(myFrame / T * (2 * pi))
    zCamera = r * Math.cos(myFrame / T * (2 * pi))

    scene.camera.lookat = {x: 0, y: 0, z: 0};

    scene.camera.position = {x: -15.0-xCamera, y: 10.0+yCamera, z: 10.0-zCamera};
    //xCamera+=0.5;
    //yCamera+=0.5;
    // scene.camera.position = {x:0.0+xCamera, y:5.0+yCamera, z:-15.0};
    

    //console.log(xCamera+"-"+yCamera+"-"+zCamera);

  }
}


var xCamera1 = 0, yCamera1=0, zCamera1=0, myFrame1=0, iniX1=0, iniZ1=10;
function cameraMove1(){
  //return;

  myFrame1++;
  r=20; T=parseInt($("#camVelocity").val());
  pi=Math.PI;



  if(tipoCameraVal1==1){

    xCamera1 = r * Math.cos(myFrame1 / T * (2 * pi))
    zCamera1 = r * Math.sin(myFrame1 / T * (2 * pi))
    scene1.camera.position = {x:0.0+xCamera1, y:5.0+yCamera1, z:-3.0+zCamera1};
    //xCamera+=0.5;
    //yCamera+=0.5;
   // scene.camera.position = {x:0.0+xCamera, y:5.0+yCamera, z:-15.0};
    
    //console.log(xCamera+"-"+yCamera);
  }
  if(tipoCameraVal1==2){
     // console.log("camera 2");
      xCamera1 = r * Math.sin(myFrame1 / T * (2 * pi))
      zCamera1 = r * Math.cos(myFrame1 / T * (2 * pi))
      //xCamera+=0.5;
      //yCamera+=0.5;
     // scene.camera.position = {x:0.0+xCamera, y:5.0+yCamera, z:-15.0};
      scene1.camera.position = {x:0.0-xCamera1, y:5.0+yCamera1, z:-3.0-zCamera1};
      //console.log(xCamera+"-"+yCamera);

  }
  if(tipoCameraVal1==3){

    r=25; 

    yCamera1 = r * Math.sin(myFrame1 / T * (2 * pi))
    zCamera1 = r * Math.cos(myFrame1 / T * (2 * pi))

    scene1.camera.lookat = {x: 0, y: 0, z: 0};

    scene1.camera.position = {x: -15.0-xCamera1, y: 10.0+yCamera1, z: 10.0-zCamera1};
    //xCamera+=0.5;
    //yCamera+=0.5;
    // scene.camera.position = {x:0.0+xCamera, y:5.0+yCamera, z:-15.0};
    

    //console.log(xCamera+"-"+yCamera+"-"+zCamera);

  }
}

var xCamera2 = 0, yCamera2=0, zCamera2=0, myFrame2=0, iniX2=0, iniZ2=10;

function cameraMove2(){
  console.log("camera 2");
  //return;

  myFrame2++;
  r=20; T=parseInt($("#camVelocity").val());
  pi=Math.PI;


  if(tipoCameraVal2==1){

    xCamera2 = r * Math.cos(myFrame2 / T * (2 * pi))
    zCamera2 = r * Math.sin(myFrame2 / T * (2 * pi))
    scene2.camera.position = {x:0.0+xCamera2, y:5.0+yCamera2, z:-3.0+zCamera2};
    //xCamera+=0.5;
    //yCamera+=0.5;
   // scene.camera.position = {x:0.0+xCamera, y:5.0+yCamera, z:-15.0};
    
    //console.log(xCamera+"-"+yCamera);
  }
  if(tipoCameraVal2==2){
     // console.log("camera 2");
      xCamera2 = r * Math.sin(myFrame2 / T * (2 * pi))
      zCamera2 = r * Math.cos(myFrame2 / T * (2 * pi))
      //xCamera+=0.5;
      //yCamera+=0.5;
     // scene.camera.position = {x:0.0+xCamera, y:5.0+yCamera, z:-15.0};
      scene2.camera.position = {x:0.0-xCamera2, y:5.0+yCamera2, z:-3.0-zCamera2};
      //console.log(xCamera+"-"+yCamera);

  }
  if(tipoCameraVal2==3){

    r=25; 

    yCamera2 = r * Math.sin(myFrame2 / T * (2 * pi))
    zCamera2 = r * Math.cos(myFrame2 / T * (2 * pi))

    scene2.camera.lookat = {x: 0, y: 0, z: 0};

    scene2.camera.position = {x: -15.0-xCamera2, y: 10.0+yCamera2, z: 10.0-zCamera2};
    //xCamera+=0.5;
    //yCamera+=0.5;
    // scene.camera.position = {x:0.0+xCamera, y:5.0+yCamera, z:-15.0};
    

    //console.log(xCamera+"-"+yCamera+"-"+zCamera);

  }
}

var tipoCameraVal=0, tipoCameraVal1=0, tipoCameraVal2=0;
var rrrr,rrrx;
var rndPorcentaje=0;
var perdidas=0;
var killCamera1;
var killCamera2;


function start(xxx){
   if(xxx==0){
      //random
      //console.log(cantidadBack);
      rrrr=_.random(0,2);
      rrrx=_.random(0,1);
      rndPorcentaje=parseInt($("#rndPorcentaje").val());

      xCamera = 0, yCamera=0, zCamera, myFrame=0, iniX=0, iniZ=10;
      xCamera1 = 0, yCamera1=0, zCamera1, myFrame1=0, iniX1=0, iniZ1=10;
      xCamera2 = 0, yCamera2=0, zCamera2, myFrame2=0, iniX2=0, iniZ2=10;

      salidas=[]; 
      salidas1=[]; 
      salidas2=[]; 
      salidas3=[]; 
      //cantidadBack=parseInt( $("#cantidadBack1").val() );
      //console.log($("#cantidadBack1").val());

      currentPasada=0;
      pasadas = 30 + (cantidadBack-1) * 6;
      //pasadas=5;
      ok=0; ok1=0; ok2=0; ok3=0;
      error=0; error1=0; error2=0; error3=0;
      myInterval=parseInt($("#timeValue").val());
      myInterval1=parseInt($("#timeValue1").val());

      clearTimeout(killInterval); 
      clearInterval(killCamera); 
      clearInterval(killCamera1); 
      clearInterval(killCamera2); 

      bOk=0; bOk1=0; bOk2=0; bOk3=0;
      mismo=0; mismo1=0; mismo2=0; mismo3=0;
      $("#error").html(parseInt(error)+parseInt(error1));
      $("#ok").html(parseInt(ok)+parseInt(ok1));
      $("#results").html("");

      if(iAct==4){
        if(_.random(0,1))
           arrayImagenes = _.first(_.shuffle(alpha.slice()),8);

         else
          arrayImagenes = _.first(_.shuffle(cartas.slice()),8);
      }else{
         if(iAct==1)
           arrayImagenes = _.first(_.shuffle(alpha.slice()),8);
         if(iAct==2)
           arrayImagenes = figurasBlancas.slice();
         if(iAct==3)
           arrayImagenes = _.first(_.shuffle(cartas.slice()),8);
         if(iAct==2 && cAct==1)
           arrayImagenes = figuras.slice()
      }//iAct==4 (random)

      console.log(arrayImagenes);

      tipoCameraVal=parseInt($("#tipoCamera").val());
      tipoCameraVal1=parseInt($("#tipoCamera1").val());
      tipoCameraVal2=parseInt($("#tipoCamera2").val());

      if(tipoCameraVal==5)
        tipoCameraVal=_.random(1,3);

      if(tipoCameraVal1==5)
        tipoCameraVal1=_.random(1,3);

       if(tipoCameraVal2==5)
        tipoCameraVal2=_.random(1,3);


      if(tipoCameraVal>0){
        
        killCamera = setInterval(cameraMove,100);
      }else{
        //scene.camera.position = {x:0.0+xCamera, y:5.0+yCamera, z:-15.0};
        scene.camera.position = {x:-3.5, y:5.0, z:-15.0};
      }

      if(tipoCameraVal1>0){
        
        killCamera1 = setInterval(cameraMove1,100);
      }else{
        //scene.camera.position = {x:0.0+xCamera, y:5.0+yCamera, z:-15.0};
        scene1.camera.position = {x:-3.5, y:5.0, z:-15.0};
      }

      if(tipoCameraVal2>0){
        
        killCamera2 = setInterval(cameraMove2,100);
      }else{
        //scene.camera.position = {x:0.0+xCamera, y:5.0+yCamera, z:-15.0};
        scene2.camera.position = {x:-3.5, y:5.0, z:-15.0};
      }
      $("#stop1").show();

      
   }


   limpiarCubos();
   limpiarCubos1();
   limpiarCubos2();


   bIntroducir=0; bIntroducir1=0; bIntroducir2=0; bIntroducir3=0;

   //position L match error
   if(currentPasada>cantidadBack && bOk==0){

      _s=currentPasada-1;
      _b=currentPasada-1-cantidadBack;

      if(salidas[_s][0]==salidas[_b][0] && salidas[_s][1]==salidas[_b][1] && salidas[_s][2]==salidas[_b][2]){
        console.log("e pm");
         error++;
         if(bCorrectionCheck)
          $("#pm").css("color","red");
         actualizarErrores();
         setTimeout(function(){ $("#pm").css("color","black"); },500);
      }
   }
   bOk=0;

    //position C match error
   if(currentPasada>cantidadBack && bOk1==0){

      _s=currentPasada-1;
      _b=currentPasada-1-cantidadBack;

      if(salidas1[_s][0]==salidas1[_b][0] && salidas1[_s][1]==salidas1[_b][1] && salidas1[_s][2]==salidas1[_b][2]){
        console.log("e pm1");
         error1++;
         if(bCorrectionCheck)
          $("#pm1").css("color","red");
         actualizarErrores();
         setTimeout(function(){ $("#pm1").css("color","black"); },500);
      }
   }
   bOk1=0;

    //position R match error
   if(currentPasada>cantidadBack && bOk2==0){

      _s=currentPasada-1;
      _b=currentPasada-1-cantidadBack;

      if(salidas2[_s][0]==salidas2[_b][0] && salidas2[_s][1]==salidas2[_b][1] && salidas2[_s][2]==salidas2[_b][2]){
        console.log("e pm2");
         error2++;
         if(bCorrectionCheck)
          $("#pm2").css("color","red");
         actualizarErrores();
         setTimeout(function(){ $("#pm2").css("color","black"); },500);
      }
   }
   bOk2=0;





   //position R

   /*
   if(currentPasada>cantidadBack && bOk1==0 && sAct>0){

      _s=currentPasada-1;
      _b=currentPasada-1-cantidadBack;

      if(salidas1[_s]==salidas1[_b]){
         error1++;
         $("#sm").css("color","red");
         actualizarErrores();
         setTimeout(function(){ $("#sm").css("color","black"); },500);
      }
   }
   bOk1=0;
  */
   /*
    //image match erroR
   if(currentPasada>cantidadBack && bOk2==0 && iAct>0){

      _s=currentPasada-1;
      _b=currentPasada-1-cantidadBack;

      if(salidas2[_s]==salidas2[_b]){
         error2++;
         $("#im").css("color","red");
         actualizarErrores();
         setTimeout(function(){ $("#im").css("color","black"); },500);
      }
   }
   bOk2=0;

  //color match error
   if(currentPasada>cantidadBack && bOk3==0 && cAct==1){

      _s=currentPasada-1;
      _b=currentPasada-1-cantidadBack;

      if(salidas3[_s]==salidas3[_b]){
         error3++;
         $("#cm").css("color","red");
         actualizarErrores();
         setTimeout(function(){ $("#cm").css("color","black"); },500);
      }
   }
   bOk3=0;
   */


   if(pasadas==0){
     $("#stop1").hide();

      total_p = ok + error;
      total_s =  ok1 + error1;
      total_i = ok2 + error2;
      total_c = ok3 + error3;

      total_ps = total_p + total_s + total_i + total_c;
      total_ok = ok + ok1 + ok2 + ok3;

      if(total_ps==0)
        total_ps=1;

      porcentaje_ok = (total_ok * 100)/total_ps;
      porcentaje_ok = Math.round(porcentaje_ok);

      agregarResultado(cantidadBack,porcentaje_ok);

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

      positionTxt = ""; soundTxt = ""; imageTxt= ""; colorTxt="";
      if(ok!=0 || error!=0){

        positionTxt="positions L: "+ok+"-"+error;

      }
      if(ok1!=0 || error1!=0){

        soundTxt="positions C: "+ok1+"-"+error1;

      }
       if(ok2!=0 || error2!=0){

        imageTxt="positions R: "+ok2+"-"+error2;
      }
      if(ok3!=0 || error3!=0){

        colorTxt = "colors: "+ok3+"-"+error3;
      }



      txt="<h3>Results</h3>" + positionTxt + " " + soundTxt + " " + imageTxt + " " + colorTxt + "<br>" +
         "Score: "+ porcentaje_ok + "%<br>" + recomendacion;

      $("#results").html(txt);

      return;

   }


   _r=rnd(1,100);
   //console.log(_r);
   //Position L
   _txt="misma";
   if(currentPasada>cantidadBack && _r<=rndPorcentaje){
      _poner = currentPasada-cantidadBack;
      _x=salidas[_poner][0];
      _y=salidas[_poner][1];
      _z=salidas[_poner][2];
      mismo++;
     
   }else{
      _txt="random";
   

      for(;;){
       
         _x = rnd(0,2);
         _y = rnd(0,2);
         _z = rnd(0,2);
         
         if(_x!=1 || _y!=1 || _z!=1){
            if(currentPasada>cantidadBack){

               if(_x!=salidas[currentPasada-cantidadBack][0] && _y!=salidas[currentPasada-cantidadBack][1] && _z!=salidas[currentPasada-cantidadBack][2]){
                  break;
               }
            }else{

               /*
               if(currentPasada>0){
                   if(_x!=salidas[currentPasada-1][0] && _y!=salidas[currentPasada-1][1] && _z!=salidas[currentPasada-1][2])
                     break;

               }
               if(currentPasada==0)*/
                  break; 


            }
              
         }
         
       // break;
      }//for  
   }//currentPasada>cantidadBack


    _r=rnd(1,100);
   //console.log(_r);
   //Position R
   _txt="misma";
   if(currentPasada>cantidadBack && _r<=rndPorcentaje){
      _poner = currentPasada-cantidadBack;
      _x1=salidas1[_poner][0];
      _y1=salidas1[_poner][1];
      _z1=salidas1[_poner][2];
      mismo1++;
     
   }else{
      _txt="random";
   

      for(;;){
       
         _x1 = rnd(0,2);
         _y1 = rnd(0,2);
         _z1 = rnd(0,2);
         
         if(_x1!=1 || _y1!=1 || _z1!=1){
            if(currentPasada>cantidadBack){

               if(_x1!=salidas1[currentPasada-cantidadBack][0] && _y1!=salidas1[currentPasada-cantidadBack][1] && _z1!=salidas1[currentPasada-cantidadBack][2]){
                  break;
               }
            }else{

               /*
               if(currentPasada>0){
                   if(_x!=salidas[currentPasada-1][0] && _y!=salidas[currentPasada-1][1] && _z!=salidas[currentPasada-1][2])
                     break;

               }
               if(currentPasada==0)*/
                  break; 


            }
              
         }
         
       // break;
      }//for  
   }//currentPasada>cantidadBack


   //salidas 2
  _r=rnd(1,100);
   //console.log(_r);
   //Position R
   _txt="misma";
   if(currentPasada>cantidadBack && _r<=rndPorcentaje){
      _poner = currentPasada-cantidadBack;
      _x2=salidas2[_poner][0];
      _y2=salidas2[_poner][1];
      _z2=salidas2[_poner][2];
      mismo1++;
     
   }else{
      _txt="random";
   

      for(;;){
       
         _x2 = rnd(0,2);
         _y2 = rnd(0,2);
         _z2 = rnd(0,2);
         
         if(_x2!=1 || _y2!=1 || _z2!=1){
            if(currentPasada>cantidadBack){

               if(_x2!=salidas2[currentPasada-cantidadBack][0] && _y2!=salidas2[currentPasada-cantidadBack][1] && _z2!=salidas2[currentPasada-cantidadBack][2]){
                  break;
               }
            }else{

               /*
               if(currentPasada>0){
                   if(_x!=salidas[currentPasada-1][0] && _y!=salidas[currentPasada-1][1] && _z!=salidas[currentPasada-1][2])
                     break;

               }
               if(currentPasada==0)*/
                  break; 


            }
              
         }
         
       // break;
      }//for  
   }//currentPasada>cantidadBack

   //console.log("position: "+_txt+" x:"+_x+" y:"+_y+" z:"+_z);

   /*
   //Sound
   _r=rnd(1,100);
   _txt="misma";
   if(sAct>0){
    if(currentPasada>cantidadBack && _r<=rndPorcentaje){
        _poner = currentPasada-cantidadBack;
        _mySound=salidas1[_poner];
        mismo1++;
       
       
     }else{
        _txt="random";
        
        for(;;){
            if(parseInt($( "#tipoSonido" ).val())==1){
              _mySound=letras[rnd(0,7)];

            }
            if(parseInt($( "#tipoSonido" ).val())==2){
              _mySound=notas[rnd(0,7)];
            }
            if(parseInt($( "#tipoSonido" ).val())==3){
              _mySound=selectCasillerosEs[rnd(0,7)];
            }
            if(parseInt($( "#tipoSonido" ).val())==4){
              _mySound=selectCasillerosEn[rnd(0,7)];
            }

              myTipoSonido = parseInt($( "#tipoSonido" ).val());

              if(myTipoSonido>=5){
          
                if(rrrr==0)
                  _mySound=notas[rnd(0,7)];
                if(rrrr==1)
                   _mySound=letras[rnd(0,7)];

                if(rrrr==2){

                  if(myTipoSonido==5)
                     _mySound=selectCasillerosEs[rnd(0,7)];

                  if(myTipoSonido==6)
                     _mySound=selectCasillerosEn[rnd(0,7)];

                  if(myTipoSonido==7){

                      if(rrrx)
                        _mySound=selectCasillerosEs[rnd(0,7)];
                      else
                        _mySound=selectCasillerosEn[rnd(0,7)];

                  }//myTipoSonido==7

                }//rrrr==2

            }// tipo sonido val == 5
            
           
           if(currentPasada>cantidadBack){
              if(_mySound!=salidas1[currentPasada-cantidadBack])
                 break;        
           }else{
           
             // if(currentPasada>0){
              //   if(_mySound!=salidas1[currentPasada-1])
              //      break;

           //  }
           //  if(currentPasada==0)
                break;

           }
            
             //break;
        }//for  
     }//currentPasada>cantidadBack´
   }//is sAct
  //Image
   _r=rnd(1,100);
   _txt="misma";
   if(iAct>0){
    if(currentPasada>cantidadBack && _r<=rndPorcentaje){
        _poner = currentPasada-cantidadBack;
        _myImagen=salidas2[_poner];
        mismo2++;
       
       
     }else{
        _txt="random";
        
        for(;;){
           _myImagen=arrayImagenes[_.random(0,arrayImagenes.length-1)];    
           
           if(currentPasada>cantidadBack){
              if(_myImagen!=salidas2[currentPasada-cantidadBack])
                 break;        
           }else{
                 break;

           }
            
             //break;
        }//for  
     }//currentPasada>cantidadBack

   }
   _r=rnd(1,100);
   if(cAct==1){
    if(currentPasada>cantidadBack && _r<=rndPorcentaje){
        _poner = currentPasada-cantidadBack;
        _myColor=salidas3[_poner];
        mismo3++;
       
       
     }else{
        _txt="random";
        
        for(;;){
           
           _myColor=misColores[rnd(0,misColores.length)];

           if(currentPasada>cantidadBack){
              if(_myColor!=salidas3[currentPasada-cantidadBack])
                 break;        
           }else{
                 break;

           }
            
             //break;
        }//for  
     }//currentPasada>cantidadBack
     salidas3[currentPasada]=_myColor;

   }//is cAct

   */
   

   //console.log("sound: "+_txt+" letra:"+_mySound);

   salidas[currentPasada] = [];
   salidas[currentPasada][0] = _x;
   salidas[currentPasada][1] = _y;
   salidas[currentPasada][2] = _z;

   salidas1[currentPasada] = [];
   salidas1[currentPasada][0] = _x1;
   salidas1[currentPasada][1] = _y1;
   salidas1[currentPasada][2] = _z1;

   salidas2[currentPasada] = [];
   salidas2[currentPasada][0] = _x2;
   salidas2[currentPasada][1] = _y2;
   salidas2[currentPasada][2] = _z2;
   
   //__sc.stop();
   //__sc.play();

   /*
   if(sAct>0){
    salidas1[currentPasada]=_mySound;
     eval("__s"+_mySound+".stop();");
     eval("__s"+_mySound+".play();");

   }
    */


   if(iAct!=0){

    /*
    console.log("imagen: " + _myImagen);
    salidas2[currentPasada]=_myImagen;

    eval("cube"+_x+_y+_z+".style.drawmode='solid'; ");
    eval("cube"+_x+_y+_z+".style.opacity= 1;");
    //"cube"+_x+_y+_z+".textures[0]=bitmaps[6];"+
    //"cube"+_x+_y+_z+".textures.push(bitmaps[_.random(0,38)]);"+
     e2_1="for (var m=0; m<6; m++)"+
             "{"+
                "cube"+_x+_y+_z+".textures[0]=bitmaps[_myImagen];"+ //"cube"+_x+_y+_z+".textures[0]=bitmaps[6];"+
                "cube"+_x+_y+_z+".polygons[m].texture = 0;"+
             "}";
    eval(e2_1);
    */
   }else{ //iAct
    //left
    
     e2_1="for (var m=0; m<6; m++)"+
             "{"+
                "cube"+_x+_y+_z+".textures=[];"+ //"cube"+_x+_y+_z+".textures[0]=bitmaps[6];"+
                "cube"+_x+_y+_z+".polygons[m].texture = undefined;"+
             "}";
    eval(e2_1);
    

    _ccc="0,0,128";

      
    eval("cube"+_x+_y+_z+".style.drawmode = 'solid';");
    
    
    if (!$('#axisColor').is(':checked')){
      eval("cube"+_x+_y+_z+".style.color = ["+_ccc+"];");
    }else{
      eval("cube"+_x+_y+_z+".style.opacity = 0.8;");

    }

    //center
    
     e2_1="for (var m=0; m<6; m++)"+
             "{"+
                "_cube"+_x1+_y1+_z1+".textures=[];"+ //"cube"+_x+_y+_z+".textures[0]=bitmaps[6];"+
                "_cube"+_x1+_y1+_z1+".polygons[m].texture = undefined;"+
             "}";
    eval(e2_1);
  
    _ccc="0,0,128";

    console.log(_ccc);
    //if(cAct==1)
    //  _ccc=_myColor;
      
    eval("_cube"+_x1+_y1+_z1+".style.drawmode = 'solid';");
    
     if (!$('#axisColor').is(':checked')){
        eval("_cube"+_x1+_y1+_z1+".style.color = ["+_ccc+"];");
     }else{
      eval("_cube"+_x1+_y1+_z1+".style.opacity = 0.8;");
     }
  
  

    //right
    
     e2_1="for (var m=0; m<6; m++)"+
             "{"+
                "__cube"+_x1+_y1+_z1+".textures=[];"+ //"cube"+_x+_y+_z+".textures[0]=bitmaps[6];"+
                "__cube"+_x1+_y1+_z1+".polygons[m].texture = undefined;"+
             "}";
    eval(e2_1);
  
    _ccc="0,0,128";

    console.log(_ccc);
    //if(cAct==1)
    //  _ccc=_myColor;
      
    eval("__cube"+_x2+_y2+_z2+".style.drawmode = 'solid';");
    
     if (!$('#axisColor').is(':checked')){
        eval("__cube"+_x2+_y2+_z2+".style.color = ["+_ccc+"];");
     }else{
      eval("__cube"+_x2+_y2+_z2+".style.opacity = 0.8;");
     }
   }//iAct else
  /*
  e3="scene.graph.push(cube"+_x+_y+_z+");"
  eval(e3);
  e2_1=" cube"+_x+_y+_z+".textures.push(bitmaps[1]); cube"+_x+_y+_z+".polygons[i].texture = 1";
  eval(e2_1);
  e3="scene.graph.push(cube"+_x+_y+_z+");"
  eval(e3);
  */

   //$("#pm").css("color","black");

   //console.log("cp "+currentPasada+"-p "+pasadas);

   currentPasada++; 
   bIntroducir=1; bIntroducir1=1; bIntroducir2=1; bIntroducir3=1;
   pasadas--;

   $("#pasadas").html(pasadas);

   killInterval = setTimeout(function(){start(1);},myInterval);
   setTimeout(function(){limpiarCubos(); limpiarCubos1(); limpiarCubos2(); },myInterval1);
   
}


function limpiarCubos(){

   for(i=0;i<3;i++){

      for(j=0;j<3;j++){

         for(k=0;k<3;k++){
            colorCube = "[128,128,128]";
            if ($('#axisColor').is(':checked')){
               //new colors
            if(k==0 && j==0 && i==2){ //m
              colorCube="[205, 145, 63]";
            }
            
            if(k==1 && j==0 && i==2){ //b
              colorCube="[175, 13, 102]";
            }
            if(k==2 && j==0 && i==2){ //n
              colorCube="[12, 75, 100]";
            }
            if(k==0 && j==1 && i==2){ //r
              colorCube="[37, 70, 25]";
            }
            if(k==2 && j==1 && i==2){ //z
              colorCube="[65, 25, 12]";
            }
            if(k==0 && j==2 && i==2){ //f
              colorCube="[255, 152, 213]";
            }
            if(k==2 && j==2 && i==2){ //w
              colorCube="[169, 34, 0]";
            }
            if(k==0 && j==2 && i==1){ //x
              colorCube="[0, 0, 74]";
            }
            if(k==2 && j==2 && i==1){ //k
              colorCube="[55, 19, 112]";
            }
            if(k==0 && j==1 && i==1){ //h
              colorCube="[100, 100, 100]";
            }
            if(k==2 && j==0 && i==1){ //q i=1
              colorCube="[185, 185, 185]";
            }
            if(k==0 && j==0 && i==0){ //g
              colorCube="[235, 235, 222]";
            }
            if(k==2 && j==0 && i==0){ //
              colorCube="[178,220,205]";
            }
            if(k==0 && j==1 && i==0){ //d
              colorCube="[255,200,47]";
            }
            if(k==2 && j==1 && i==0){ //i
              colorCube="[255, 255, 150]";
            }
            if(k==0 && j==2 && i==0){ //l
              colorCube="[202,62,94]";
            }
            if(k==1 && j==2 && i==0){ //u
              colorCube="[0,154,37]";
            }
            if(k==2 && j==2 && i==0){ //t
              colorCube="[83,140,208]";
            }

              //arriba red
              if(k==1 && j==0 && i==1){
                colorCube="[255,0,0]";
              }
              //derecha green
              if(k==2 && j==1 && i==1){
                colorCube="[51,204,0]";
              }
              //eje z blue
              if(k==1 && j==1 && i==0){
                colorCube="[51,51,255]";
              }
              ////
              //abajo
              if(k==1 && j==2 && i==1){
                colorCube="[255,88,0]";
              }
               //izquierda
              if(k==0 && j==1 && i==1){
                colorCube="[255,213,0]";
              }
              
              //atras
              if(k==1 && j==1 && i==2){
                colorCube="[140,72,159]";
              }
            }

            eval("cube"+k+j+i+".style.color = " + colorCube + ";");
            eval("cube"+k+j+i+".style.drawmode = 'wireframe';");
            eval("cube"+k+j+i+".style.opacity= 0.6;");

         }
      }
   }
} //limpiarCubos

function limpiarCubos1(){

   for(i=0;i<3;i++){

      for(j=0;j<3;j++){

         for(k=0;k<3;k++){

            colorCube = "[128,128,128]";
            if ($('#axisColor').is(':checked')){
               //new colors
            if(k==0 && j==0 && i==2){ //m
              colorCube="[205, 145, 63]";
            }
            
            if(k==1 && j==0 && i==2){ //b
              colorCube="[175, 13, 102]";
            }
            if(k==2 && j==0 && i==2){ //n
              colorCube="[12, 75, 100]";
            }
            if(k==0 && j==1 && i==2){ //r
              colorCube="[37, 70, 25]";
            }
            if(k==2 && j==1 && i==2){ //z
              colorCube="[65, 25, 12]";
            }
            if(k==0 && j==2 && i==2){ //f
              colorCube="[255, 152, 213]";
            }
            if(k==2 && j==2 && i==2){ //w
              colorCube="[169, 34, 0]";
            }
            if(k==0 && j==2 && i==1){ //x
              colorCube="[0, 0, 74]";
            }
            if(k==2 && j==2 && i==1){ //k
              colorCube="[55, 19, 112]";
            }
            if(k==0 && j==1 && i==1){ //h
              colorCube="[100, 100, 100]";
            }
            if(k==2 && j==0 && i==1){ //q i=1
              colorCube="[185, 185, 185]";
            }
            if(k==0 && j==0 && i==0){ //g
              colorCube="[235, 235, 222]";
            }
            if(k==2 && j==0 && i==0){ //
              colorCube="[178,220,205]";
            }
            if(k==0 && j==1 && i==0){ //d
              colorCube="[255,200,47]";
            }
            if(k==2 && j==1 && i==0){ //i
              colorCube="[255, 255, 150]";
            }
            if(k==0 && j==2 && i==0){ //l
              colorCube="[202,62,94]";
            }
            if(k==1 && j==2 && i==0){ //u
              colorCube="[0,154,37]";
            }
            if(k==2 && j==2 && i==0){ //t
              colorCube="[83,140,208]";
            }

              //arriba red
              if(k==1 && j==0 && i==1){
                colorCube="[255,0,0]";
              }
              //derecha green
              if(k==2 && j==1 && i==1){
                colorCube="[51,204,0]";
              }
              //eje z blue
              if(k==1 && j==1 && i==0){
                colorCube="[51,51,255]";
              }
              ////
              //abajo
              if(k==1 && j==2 && i==1){
                colorCube="[255,88,0]";
              }
               //izquierda
              if(k==0 && j==1 && i==1){
                colorCube="[255,213,0]";
              }
              
              //atras
              if(k==1 && j==1 && i==2){
                colorCube="[140,72,159]";
              }
            }

            eval("_cube"+k+j+i+".style.color = " + colorCube + ";");
            eval("_cube"+k+j+i+".style.drawmode = 'wireframe';");
            eval("_cube"+k+j+i+".style.opacity= 0.6;");

         }
      }
   }
} //limpiarCubos1

function limpiarCubos2(){

   for(i=0;i<3;i++){

      for(j=0;j<3;j++){

         for(k=0;k<3;k++){

            colorCube = "[128,128,128]";
            if ($('#axisColor').is(':checked')){
               //new colors
            if(k==0 && j==0 && i==2){ //m
              colorCube="[205, 145, 63]";
            }
            
            if(k==1 && j==0 && i==2){ //b
              colorCube="[175, 13, 102]";
            }
            if(k==2 && j==0 && i==2){ //n
              colorCube="[12, 75, 100]";
            }
            if(k==0 && j==1 && i==2){ //r
              colorCube="[37, 70, 25]";
            }
            if(k==2 && j==1 && i==2){ //z
              colorCube="[65, 25, 12]";
            }
            if(k==0 && j==2 && i==2){ //f
              colorCube="[255, 152, 213]";
            }
            if(k==2 && j==2 && i==2){ //w
              colorCube="[169, 34, 0]";
            }
            if(k==0 && j==2 && i==1){ //x
              colorCube="[0, 0, 74]";
            }
            if(k==2 && j==2 && i==1){ //k
              colorCube="[55, 19, 112]";
            }
            if(k==0 && j==1 && i==1){ //h
              colorCube="[100, 100, 100]";
            }
            if(k==2 && j==0 && i==1){ //q i=1
              colorCube="[185, 185, 185]";
            }
            if(k==0 && j==0 && i==0){ //g
              colorCube="[235, 235, 222]";
            }
            if(k==2 && j==0 && i==0){ //
              colorCube="[178,220,205]";
            }
            if(k==0 && j==1 && i==0){ //d
              colorCube="[255,200,47]";
            }
            if(k==2 && j==1 && i==0){ //i
              colorCube="[255, 255, 150]";
            }
            if(k==0 && j==2 && i==0){ //l
              colorCube="[202,62,94]";
            }
            if(k==1 && j==2 && i==0){ //u
              colorCube="[0,154,37]";
            }
            if(k==2 && j==2 && i==0){ //t
              colorCube="[83,140,208]";
            }

              //arriba red
              if(k==1 && j==0 && i==1){
                colorCube="[255,0,0]";
              }
              //derecha green
              if(k==2 && j==1 && i==1){
                colorCube="[51,204,0]";
              }
              //eje z blue
              if(k==1 && j==1 && i==0){
                colorCube="[51,51,255]";
              }
              ////
              //abajo
              if(k==1 && j==2 && i==1){
                colorCube="[255,88,0]";
              }
               //izquierda
              if(k==0 && j==1 && i==1){
                colorCube="[255,213,0]";
              }
              
              //atras
              if(k==1 && j==1 && i==2){
                colorCube="[140,72,159]";
              }
            }

            eval("__cube"+k+j+i+".style.color = " + colorCube + ";");
            eval("__cube"+k+j+i+".style.drawmode = 'wireframe';");
            eval("__cube"+k+j+i+".style.opacity= 0.6;");

         }
      }
   }
} //limpiarCubos1

function rnd(min,max)
{
    return Math.floor(Math.random()*(max-min+1)+min);
}

for(i=0;i<3;i++){

      for(j=0;j<3;j++){

         for(k=0;k<3;k++){

          e2="var cube"+k+j+i+";";
          eval(e2);
          //console.log(e2);


         }
      }
   }



function init(){

   for(i=0;i<3;i++){

      for(j=0;j<3;j++){

         for(k=0;k<3;k++){

          e1="c"+k+j+i+" = Phoria.Util.generateUnitCube();";
          eval(e1);
          //console.log(e1);

          colorCube = "[128,128,128]";
          if ($('#axisColor').is(':checked')){
            //new colors
            if(k==0 && j==0 && i==2){ //m
              colorCube="[205, 145, 63]";
            }
            
            if(k==1 && j==0 && i==2){ //b
              colorCube="[175, 13, 102]";
            }
            if(k==2 && j==0 && i==2){ //n
              colorCube="[12, 75, 100]";
            }
            if(k==0 && j==1 && i==2){ //r
              colorCube="[37, 70, 25]";
            }
            if(k==2 && j==1 && i==2){ //z
              colorCube="[65, 25, 12]";
            }
            if(k==0 && j==2 && i==2){ //f
              colorCube="[255, 152, 213]";
            }
            if(k==2 && j==2 && i==2){ //w
              colorCube="[169, 34, 0]";
            }
            if(k==0 && j==2 && i==1){ //x
              colorCube="[0, 0, 74]";
            }
            if(k==2 && j==2 && i==1){ //k
              colorCube="[55, 19, 112]";
            }
            if(k==0 && j==1 && i==1){ //h
              colorCube="[100, 100, 100]";
            }
            if(k==2 && j==0 && i==1){ //q i=1
              colorCube="[185, 185, 185]";
            }
            if(k==0 && j==0 && i==0){ //g
              colorCube="[235, 235, 222]";
            }
            if(k==2 && j==0 && i==0){ //
              colorCube="[178,220,205]";
            }
            if(k==0 && j==1 && i==0){ //d
              colorCube="[255,200,47]";
            }
            if(k==2 && j==1 && i==0){ //i
              colorCube="[255, 255, 150]";
            }
            if(k==0 && j==2 && i==0){ //l
              colorCube="[202,62,94]";
            }
            if(k==1 && j==2 && i==0){ //u
              colorCube="[0,154,37]";
            }
            if(k==2 && j==2 && i==0){ //t
              colorCube="[83,140,208]";
            }

            

            //arriba red
            if(k==1 && j==0 && i==1){
              colorCube="[255,0,0]";
            }
            //derecha green
            if(k==2 && j==1 && i==1){
              colorCube="[51,204,0]";
            }
            //eje z blue
            if(k==1 && j==1 && i==0){
              colorCube="[51,51,255]";
            }
            ////
            //abajo
            if(k==1 && j==2 && i==1){
              colorCube="[255,88,0]";
            }
             //izquierda
            if(k==0 && j==1 && i==1){
              colorCube="[255,213,0]";
            }
            
            //atras
            if(k==1 && j==1 && i==2){
              colorCube="[140,72,159]";
            }
          }


          //e2="cube"+k+j+i+" = Phoria.Entity.create({points: c"+k+j+i+".points,edges: c"+k+j+i+".edges,polygons: c"+k+j+i+".polygons, style: {color: [128,128,128],opacity: 0.5, drawmode: 'wireframe'} });";
          e2="cube"+k+j+i+" = Phoria.Entity.create({points: c"+k+j+i+".points,edges: c"+k+j+i+".edges,polygons: c"+k+j+i+".polygons, style: {linewidth: 1.5, color: " + colorCube + ",opacity: 1.0, drawmode: 'wireframe', shademode : 'plain'} });";
          eval(e2);
          //console.log(e2);

          /*
          e2_1="for (var xxx=0; xxx<6; xxx++)"+
           "{"+
              "cube"+k+j+i+".style.drawmode='solid'; " +
              "cube"+k+j+i+".textures.push(bitmaps[xxx]);"+
              "cube"+k+j+i+".polygons[i].texture = xxx;"+
           "}";
          eval(e2_1);
          */

          e3="scene.graph.push(cube"+k+j+i+");"
          eval(e3);
          //console.log(e3);



         }
      }
   }

   //y0
   cube000.translateY(3);cube000.translateX(-3);cube000.translateZ(-3.5);cube000.rotateY(10*Phoria.RADIANS);
   cube100.translateY(3);cube100.translateX(-1.0);cube100.translateZ(-3.5);cube100.rotateY(10*Phoria.RADIANS);
   cube200.translateY(3);cube200.translateX(0.9);cube200.translateZ(-3.5);cube200.rotateY(10*Phoria.RADIANS);

   cube010.translateY(1.06);cube010.translateX(-3);cube010.translateZ(-3.5);cube010.rotateY(10*Phoria.RADIANS);
   cube110.translateY(1.06);cube110.translateX(-1);cube110.translateZ(-3.5);cube110.rotateY(10*Phoria.RADIANS);
   cube210.translateY(1.06);cube210.translateX(0.9);cube210.translateZ(-3.5);cube210.rotateY(10*Phoria.RADIANS);

   cube020.translateY(-1);cube020.translateX(-3);cube020.translateZ(-3.5);cube020.rotateY(10*Phoria.RADIANS);
   cube120.translateY(-1);cube120.translateX(-1);cube120.translateZ(-3.5);cube120.rotateY(10*Phoria.RADIANS);
   cube220.translateY(-1);cube220.translateX(0.9);cube220.translateZ(-3.5);cube220.rotateY(10*Phoria.RADIANS);
   
   //y1
   cube001.translateY(3);cube001.translateX(-2.7);cube001.translateZ(-1);cube001.rotateY(10*Phoria.RADIANS);
   cube101.translateY(3);cube101.translateX(-0.8);cube101.translateZ(-1);cube101.rotateY(10*Phoria.RADIANS);
   cube201.translateY(3);cube201.translateX(1.4);cube201.translateZ(-1);cube201.rotateY(10*Phoria.RADIANS);

   cube011.translateY(1.06);cube011.translateX(-2.7);cube011.translateZ(-1);cube011.rotateY(10*Phoria.RADIANS);
   cube111.translateY(1.06);cube111.translateX(-0.8);cube111.translateZ(-1);cube111.rotateY(10*Phoria.RADIANS);
   cube211.translateY(1.06);cube211.translateX(1.4);cube211.translateZ(-1);cube211.rotateY(10*Phoria.RADIANS);

   cube021.translateY(-1);cube021.translateX(-2.7);cube021.translateZ(-1);cube021.rotateY(10*Phoria.RADIANS);
   cube121.translateY(-1);cube121.translateX(-0.8);cube121.translateZ(-1);cube121.rotateY(10*Phoria.RADIANS);
   cube221.translateY(-1);cube221.translateX(1.4);cube221.translateZ(-1);cube221.rotateY(10*Phoria.RADIANS);
  
   //y2
   cube002.translateY(3);cube002.translateX(-2.4);cube002.translateZ(1.8);cube002.rotateY(10*Phoria.RADIANS);
   cube102.translateY(3);cube102.translateX(-0.4);cube102.translateZ(1.8);cube102.rotateY(10*Phoria.RADIANS);
   cube202.translateY(3);cube202.translateX(1.8);cube202.translateZ(1.8);cube202.rotateY(10*Phoria.RADIANS);


   cube012.translateY(1.06);cube012.translateX(-2.4);cube012.translateZ(1.8);cube012.rotateY(10*Phoria.RADIANS);
   cube112.translateY(1.06);cube112.translateX(-0.4);cube112.translateZ(1.8);cube112.rotateY(10*Phoria.RADIANS);
   cube212.translateY(1.06);cube212.translateX(1.8);cube212.translateZ(1.8);cube212.rotateY(10*Phoria.RADIANS);

   cube022.translateY(-1);cube022.translateX(-2.4);cube022.translateZ(1.8);cube022.rotateY(10*Phoria.RADIANS);
   cube122.translateY(-1);cube122.translateX(-0.4);cube122.translateZ(1.8);cube122.rotateY(10*Phoria.RADIANS);
   cube222.translateY(-1);cube222.translateX(1.8);cube222.translateZ(1.8);cube222.rotateY(10*Phoria.RADIANS);
   
  /*
   cube.rotateY(15*Phoria.RADIANS);
   cube1.rotateY(15*Phoria.RADIANS);
   cube2.rotateY(15*Phoria.RADIANS);
   */

   /*
   cube.translateX(2);
   cube2.translateZ(2);
   cube.translateZ(-2);
*/

}

function init1(){

   for(i=0;i<3;i++){

      for(j=0;j<3;j++){

         for(k=0;k<3;k++){

          e1="c"+k+j+i+" = Phoria.Util.generateUnitCube();";
          eval(e1);
          //console.log(e1);

          colorCube = "[128,128,128]";
          if ($('#axisColor').is(':checked')){
             //new colors
            if(k==0 && j==0 && i==2){ //m
              colorCube="[205, 145, 63]";
            }
            
            if(k==1 && j==0 && i==2){ //b
              colorCube="[175, 13, 102]";
            }
            if(k==2 && j==0 && i==2){ //n
              colorCube="[12, 75, 100]";
            }
            if(k==0 && j==1 && i==2){ //r
              colorCube="[37, 70, 25]";
            }
            if(k==2 && j==1 && i==2){ //z
              colorCube="[65, 25, 12]";
            }
            if(k==0 && j==2 && i==2){ //f
              colorCube="[255, 152, 213]";
            }
            if(k==2 && j==2 && i==2){ //w
              colorCube="[169, 34, 0]";
            }
            if(k==0 && j==2 && i==1){ //x
              colorCube="[0, 0, 74]";
            }
            if(k==2 && j==2 && i==1){ //k
              colorCube="[55, 19, 112]";
            }
            if(k==0 && j==1 && i==1){ //h
              colorCube="[100, 100, 100]";
            }
            if(k==2 && j==0 && i==1){ //q i=1
              colorCube="[185, 185, 185]";
            }
            if(k==0 && j==0 && i==0){ //g
              colorCube="[235, 235, 222]";
            }
            if(k==2 && j==0 && i==0){ //
              colorCube="[178,220,205]";
            }
            if(k==0 && j==1 && i==0){ //d
              colorCube="[255,200,47]";
            }
            if(k==2 && j==1 && i==0){ //i
              colorCube="[255, 255, 150]";
            }
            if(k==0 && j==2 && i==0){ //l
              colorCube="[202,62,94]";
            }
            if(k==1 && j==2 && i==0){ //u
              colorCube="[0,154,37]";
            }
            if(k==2 && j==2 && i==0){ //t
              colorCube="[83,140,208]";
            }

            //arriba red
            if(k==1 && j==0 && i==1){
              colorCube="[255,0,0]";
            }
            //derecha green
            if(k==2 && j==1 && i==1){
              colorCube="[51,204,0]";
            }
            //eje z blue
            if(k==1 && j==1 && i==0){
              colorCube="[51,51,255]";
            }
            ////
            //abajo
            if(k==1 && j==2 && i==1){
              colorCube="[255,88,0]";
            }
             //izquierda
            if(k==0 && j==1 && i==1){
              colorCube="[255,213,0]";
            }
            
            //atras
            if(k==1 && j==1 && i==2){
              colorCube="[140,72,159]";
            }
          }

          //e2="cube"+k+j+i+" = Phoria.Entity.create({points: c"+k+j+i+".points,edges: c"+k+j+i+".edges,polygons: c"+k+j+i+".polygons, style: {color: [128,128,128],opacity: 0.5, drawmode: 'wireframe'} });";
          e2="_cube"+k+j+i+" = Phoria.Entity.create({points: c"+k+j+i+".points,edges: c"+k+j+i+".edges,polygons: c"+k+j+i+".polygons, style: {linewidth: 1.5, color: " + colorCube + ",opacity: 1.0, drawmode: 'wireframe', shademode : 'plain'} });";
          eval(e2);
          //console.log(e2);

          /*
          e2_1="for (var xxx=0; xxx<6; xxx++)"+
           "{"+
              "cube"+k+j+i+".style.drawmode='solid'; " +
              "cube"+k+j+i+".textures.push(bitmaps[xxx]);"+
              "cube"+k+j+i+".polygons[i].texture = xxx;"+
           "}";
          eval(e2_1);
          */

          e3="scene1.graph.push(_cube"+k+j+i+");"
          eval(e3);
          //console.log(e3);



         }
      }
   }

   //y0
   _cube000.translateY(3);_cube000.translateX(-3);_cube000.translateZ(-3.5);_cube000.rotateY(10*Phoria.RADIANS);
   _cube100.translateY(3);_cube100.translateX(-1.0);_cube100.translateZ(-3.5);_cube100.rotateY(10*Phoria.RADIANS);
   _cube200.translateY(3);_cube200.translateX(0.9);_cube200.translateZ(-3.5);_cube200.rotateY(10*Phoria.RADIANS);

   _cube010.translateY(1.06);_cube010.translateX(-3);_cube010.translateZ(-3.5);_cube010.rotateY(10*Phoria.RADIANS);
   _cube110.translateY(1.06);_cube110.translateX(-1);_cube110.translateZ(-3.5);_cube110.rotateY(10*Phoria.RADIANS);
   _cube210.translateY(1.06);_cube210.translateX(0.9);_cube210.translateZ(-3.5);_cube210.rotateY(10*Phoria.RADIANS);

   _cube020.translateY(-1);_cube020.translateX(-3);_cube020.translateZ(-3.5);_cube020.rotateY(10*Phoria.RADIANS);
   _cube120.translateY(-1);_cube120.translateX(-1);_cube120.translateZ(-3.5);_cube120.rotateY(10*Phoria.RADIANS);
   _cube220.translateY(-1);_cube220.translateX(0.9);_cube220.translateZ(-3.5);_cube220.rotateY(10*Phoria.RADIANS);
   
   //y1
   _cube001.translateY(3);_cube001.translateX(-2.7);_cube001.translateZ(-1);_cube001.rotateY(10*Phoria.RADIANS);
   _cube101.translateY(3);_cube101.translateX(-0.8);_cube101.translateZ(-1);_cube101.rotateY(10*Phoria.RADIANS);
   _cube201.translateY(3);_cube201.translateX(1.4);_cube201.translateZ(-1);_cube201.rotateY(10*Phoria.RADIANS);

   _cube011.translateY(1.06);_cube011.translateX(-2.7);_cube011.translateZ(-1);_cube011.rotateY(10*Phoria.RADIANS);
   _cube111.translateY(1.06);_cube111.translateX(-0.8);_cube111.translateZ(-1);_cube111.rotateY(10*Phoria.RADIANS);
   _cube211.translateY(1.06);_cube211.translateX(1.4);_cube211.translateZ(-1);_cube211.rotateY(10*Phoria.RADIANS);

   _cube021.translateY(-1);_cube021.translateX(-2.7);_cube021.translateZ(-1);_cube021.rotateY(10*Phoria.RADIANS);
   _cube121.translateY(-1);_cube121.translateX(-0.8);_cube121.translateZ(-1);_cube121.rotateY(10*Phoria.RADIANS);
   _cube221.translateY(-1);_cube221.translateX(1.4);_cube221.translateZ(-1);_cube221.rotateY(10*Phoria.RADIANS);
  
   //y2
   _cube002.translateY(3);_cube002.translateX(-2.4);_cube002.translateZ(1.8);_cube002.rotateY(10*Phoria.RADIANS);
   _cube102.translateY(3);_cube102.translateX(-0.4);_cube102.translateZ(1.8);_cube102.rotateY(10*Phoria.RADIANS);
   _cube202.translateY(3);_cube202.translateX(1.8);_cube202.translateZ(1.8);_cube202.rotateY(10*Phoria.RADIANS);


   _cube012.translateY(1.06);_cube012.translateX(-2.4);_cube012.translateZ(1.8);_cube012.rotateY(10*Phoria.RADIANS);
   _cube112.translateY(1.06);_cube112.translateX(-0.4);_cube112.translateZ(1.8);_cube112.rotateY(10*Phoria.RADIANS);
   _cube212.translateY(1.06);_cube212.translateX(1.8);_cube212.translateZ(1.8);_cube212.rotateY(10*Phoria.RADIANS);

   _cube022.translateY(-1);_cube022.translateX(-2.4);_cube022.translateZ(1.8);_cube022.rotateY(10*Phoria.RADIANS);
   _cube122.translateY(-1);_cube122.translateX(-0.4);_cube122.translateZ(1.8);_cube122.rotateY(10*Phoria.RADIANS);
   _cube222.translateY(-1);_cube222.translateX(1.8);_cube222.translateZ(1.8);_cube222.rotateY(10*Phoria.RADIANS);
   
  /*
   _cube.rotateY(15*Phoria.RADIANS);
   _cube1.rotateY(15*Phoria.RADIANS);
   _cube2.rotateY(15*Phoria.RADIANS);
   */

   /*
   cube.translateX(2);
   cube2.translateZ(2);
   cube.translateZ(-2);
*/

}

function init2(){
  console.log("init2");

   for(i=0;i<3;i++){

      for(j=0;j<3;j++){

         for(k=0;k<3;k++){

          e1="c"+k+j+i+" = Phoria.Util.generateUnitCube();";
          eval(e1);
          //console.log(e1);

          colorCube = "[128,128,128]";
          if ($('#axisColor').is(':checked')){
             //new colors
            if(k==0 && j==0 && i==2){ //m
              colorCube="[205, 145, 63]";
            }
            
            if(k==1 && j==0 && i==2){ //b
              colorCube="[175, 13, 102]";
            }
            if(k==2 && j==0 && i==2){ //n
              colorCube="[12, 75, 100]";
            }
            if(k==0 && j==1 && i==2){ //r
              colorCube="[37, 70, 25]";
            }
            if(k==2 && j==1 && i==2){ //z
              colorCube="[65, 25, 12]";
            }
            if(k==0 && j==2 && i==2){ //f
              colorCube="[255, 152, 213]";
            }
            if(k==2 && j==2 && i==2){ //w
              colorCube="[169, 34, 0]";
            }
            if(k==0 && j==2 && i==1){ //x
              colorCube="[0, 0, 74]";
            }
            if(k==2 && j==2 && i==1){ //k
              colorCube="[55, 19, 112]";
            }
            if(k==0 && j==1 && i==1){ //h
              colorCube="[100, 100, 100]";
            }
            if(k==2 && j==0 && i==1){ //q i=1
              colorCube="[185, 185, 185]";
            }
            if(k==0 && j==0 && i==0){ //g
              colorCube="[235, 235, 222]";
            }
            if(k==2 && j==0 && i==0){ //
              colorCube="[178,220,205]";
            }
            if(k==0 && j==1 && i==0){ //d
              colorCube="[255,200,47]";
            }
            if(k==2 && j==1 && i==0){ //i
              colorCube="[255, 255, 150]";
            }
            if(k==0 && j==2 && i==0){ //l
              colorCube="[202,62,94]";
            }
            if(k==1 && j==2 && i==0){ //u
              colorCube="[0,154,37]";
            }
            if(k==2 && j==2 && i==0){ //t
              colorCube="[83,140,208]";
            }

            //arriba red
            if(k==1 && j==0 && i==1){
              colorCube="[255,0,0]";
            }
            //derecha green
            if(k==2 && j==1 && i==1){
              colorCube="[51,204,0]";
            }
            //eje z blue
            if(k==1 && j==1 && i==0){
              colorCube="[51,51,255]";
            }
            ////
            //abajo
            if(k==1 && j==2 && i==1){
              colorCube="[255,88,0]";
            }
             //izquierda
            if(k==0 && j==1 && i==1){
              colorCube="[255,213,0]";
            }
            
            //atras
            if(k==1 && j==1 && i==2){
              colorCube="[140,72,159]";
            }
          }

          //e2="cube"+k+j+i+" = Phoria.Entity.create({points: c"+k+j+i+".points,edges: c"+k+j+i+".edges,polygons: c"+k+j+i+".polygons, style: {color: [128,128,128],opacity: 0.5, drawmode: 'wireframe'} });";
          e2="__cube"+k+j+i+" = Phoria.Entity.create({points: c"+k+j+i+".points,edges: c"+k+j+i+".edges,polygons: c"+k+j+i+".polygons, style: {linewidth: 1.5, color: " + colorCube + ",opacity: 1.0, drawmode: 'wireframe', shademode : 'plain'} });";
          eval(e2);
          //console.log(e2);

          /*
          e2_1="for (var xxx=0; xxx<6; xxx++)"+
           "{"+
              "cube"+k+j+i+".style.drawmode='solid'; " +
              "cube"+k+j+i+".textures.push(bitmaps[xxx]);"+
              "cube"+k+j+i+".polygons[i].texture = xxx;"+
           "}";
          eval(e2_1);
          */

          e3="scene2.graph.push(__cube"+k+j+i+");"
          eval(e3);
          //console.log(e3);



         }
      }
   }

   //y0
   __cube000.translateY(3);__cube000.translateX(-3);__cube000.translateZ(-3.5);__cube000.rotateY(10*Phoria.RADIANS);
   __cube100.translateY(3);__cube100.translateX(-1.0);__cube100.translateZ(-3.5);__cube100.rotateY(10*Phoria.RADIANS);
   __cube200.translateY(3);__cube200.translateX(0.9);__cube200.translateZ(-3.5);__cube200.rotateY(10*Phoria.RADIANS);

   __cube010.translateY(1.06);__cube010.translateX(-3);__cube010.translateZ(-3.5);__cube010.rotateY(10*Phoria.RADIANS);
   __cube110.translateY(1.06);__cube110.translateX(-1);__cube110.translateZ(-3.5);__cube110.rotateY(10*Phoria.RADIANS);
   __cube210.translateY(1.06);__cube210.translateX(0.9);__cube210.translateZ(-3.5);__cube210.rotateY(10*Phoria.RADIANS);

   __cube020.translateY(-1);__cube020.translateX(-3);__cube020.translateZ(-3.5);__cube020.rotateY(10*Phoria.RADIANS);
   __cube120.translateY(-1);__cube120.translateX(-1);__cube120.translateZ(-3.5);__cube120.rotateY(10*Phoria.RADIANS);
   __cube220.translateY(-1);__cube220.translateX(0.9);__cube220.translateZ(-3.5);__cube220.rotateY(10*Phoria.RADIANS);
   
   //y1
   __cube001.translateY(3);__cube001.translateX(-2.7);__cube001.translateZ(-1);__cube001.rotateY(10*Phoria.RADIANS);
   __cube101.translateY(3);__cube101.translateX(-0.8);__cube101.translateZ(-1);__cube101.rotateY(10*Phoria.RADIANS);
   __cube201.translateY(3);__cube201.translateX(1.4);__cube201.translateZ(-1);__cube201.rotateY(10*Phoria.RADIANS);

   __cube011.translateY(1.06);__cube011.translateX(-2.7);__cube011.translateZ(-1);__cube011.rotateY(10*Phoria.RADIANS);
   __cube111.translateY(1.06);__cube111.translateX(-0.8);__cube111.translateZ(-1);__cube111.rotateY(10*Phoria.RADIANS);
   __cube211.translateY(1.06);__cube211.translateX(1.4);__cube211.translateZ(-1);__cube211.rotateY(10*Phoria.RADIANS);

   __cube021.translateY(-1);__cube021.translateX(-2.7);__cube021.translateZ(-1);__cube021.rotateY(10*Phoria.RADIANS);
   __cube121.translateY(-1);__cube121.translateX(-0.8);__cube121.translateZ(-1);__cube121.rotateY(10*Phoria.RADIANS);
   __cube221.translateY(-1);__cube221.translateX(1.4);__cube221.translateZ(-1);__cube221.rotateY(10*Phoria.RADIANS);
  
   //y2
   __cube002.translateY(3);__cube002.translateX(-2.4);__cube002.translateZ(1.8);__cube002.rotateY(10*Phoria.RADIANS);
   __cube102.translateY(3);__cube102.translateX(-0.4);__cube102.translateZ(1.8);__cube102.rotateY(10*Phoria.RADIANS);
   __cube202.translateY(3);__cube202.translateX(1.8);__cube202.translateZ(1.8);__cube202.rotateY(10*Phoria.RADIANS);


   __cube012.translateY(1.06);__cube012.translateX(-2.4);__cube012.translateZ(1.8);__cube012.rotateY(10*Phoria.RADIANS);
   __cube112.translateY(1.06);__cube112.translateX(-0.4);__cube112.translateZ(1.8);__cube112.rotateY(10*Phoria.RADIANS);
   __cube212.translateY(1.06);__cube212.translateX(1.8);__cube212.translateZ(1.8);__cube212.rotateY(10*Phoria.RADIANS);

   __cube022.translateY(-1);__cube022.translateX(-2.4);__cube022.translateZ(1.8);__cube022.rotateY(10*Phoria.RADIANS);
   __cube122.translateY(-1);__cube122.translateX(-0.4);__cube122.translateZ(1.8);__cube122.rotateY(10*Phoria.RADIANS);
   __cube222.translateY(-1);__cube222.translateX(1.8);__cube222.translateZ(1.8);__cube222.rotateY(10*Phoria.RADIANS);
   
  /*
   _cube.rotateY(15*Phoria.RADIANS);
   _cube1.rotateY(15*Phoria.RADIANS);
   _cube2.rotateY(15*Phoria.RADIANS);
   */

   /*
   cube.translateX(2);
   cube2.translateZ(2);
   cube.translateZ(-2);
*/

}

cantidadEntrenos=0;
arrayEntrenos=[];
save="";


function cargarResultados(){

 
  myCookie = $.cookie('init3d');

  save="";

  if(myCookie==null){
    save="";
    $.cookie('init3d', save, { expires: 300 })
    //console.log("cookie undefined");

  }else{
     
      arrayBase = myCookie.split("-");

      save="";
      $.cookie('init3d', save, { expires: 300 })

      if(arrayBase.length==null){
        $("#clearResultsList").hide();

      }else{

         for(i=0;i<arrayBase.length;i++){

          txt = arrayBase[i];

          if(txt.search(" ")==0 || txt.search(" ")==-1)
            return;

          //console.log(txt.search(" "));

          arrayBase1=txt.split(" ");
          agregarResultado(arrayBase1[0],arrayBase1[1]);
        }
      }
  }
}

function agregarResultado(b,porcentaje){

  //console.log(b+" "+porcentaje);
  arrayEntrenos[cantidadEntrenos]=[];

  arrayEntrenos[cantidadEntrenos][0]=b;
  arrayEntrenos[cantidadEntrenos][1]=porcentaje;

  clearTxt="<div style='clear: both'></div>";

  $("#resultsList").append(clearTxt+"<b>#</b>"+(cantidadEntrenos+1)+" "+b+"B "+porcentaje+"%");

  myCookie = $.cookie('init3d');

  p="-";
  if(cantidadEntrenos==0)
    p=""

  myCookie += p + b +" "+porcentaje;

  $.cookie('init3d', myCookie, { expires: 300 })

  cantidadEntrenos++;
  $("#clearResultsList").show();

}

function limpiarResultados(){
  console.log("limpiar");
  cantidadEntrenos=0;
  $.cookie('init3d', "", { expires: 300 })
  $("#resultsList").html("");


  $("#clearResultsList").hide();


}


      </script>
<script>
       
  (function(i,s,o,g,r,a,m){i['GoogleAnalyticsObject']=r;i[r]=i[r]||function(){
  (i[r].q=i[r].q||[]).push(arguments)},i[r].l=1*new Date();a=s.createElement(o),
  m=s.getElementsByTagName(o)[0];a.async=1;a.src=g;m.parentNode.insertBefore(a,m)
  })(window,document,'script','//www.google-analytics.com/analytics.js','ga');

  ga('create', 'UA-45359665-6', 'auto');
  ga('send', 'pageview');

</script>
   </head>
   
   <body style="background-color: #bfbfbf">
      <div id="loading"><h1>Loading...<span><img src="/img/loading.gif"></span></h1></div>

      <!-- Controles -->
      <div>
         <b>Triple 3D</b> 
         <a href="#" id="mas" style="text-decoration:none; color: #7D0552;"><b>+</b></a> 
         <span id="cantidadBack">1</span>
         <a href="#" id="menos"  style="text-decoration:none; color: #7D0552;"><b>-</b></a> Back&nbsp;
         
         <a href="#" id="start">Play</a>&nbsp;
         <a href="#" id="stop1">Stop&nbsp;</a>
         
         <span>t: <input type="text" value="3000" id="timeValue" style="width: 35px;">&nbsp;<input type="text" value="1000" id="timeValue1" style="width: 30px;"></span>&nbsp;
         c: <span id="pasadas">36</span>&nbsp;
       
         <span class="oke">ok: <span id="ok">0</span>&nbsp;</span>
         <span class="oke">E: <span id="error">0</span>&nbsp;</span>
 
         <select id="tipoSonido" style="width: 59px;">
          <option value="0" selected>no Sound</option>
          <option value="1">Letters</option>
          <option value="2">Piano</option>
          <option value="3">Major System ES</option>
          <option value="4">Major System EN</option>
          <option value="5">Random Sound Es</option>
          <option value="6">Random Sound En</option>
          <option value="7">Random Sound All</option>
        </select>&nbsp;
        
        <select id="tipoImagen">
          <option value="0" selected>no Image</option>
          <option value="1">Emotion</option>
         <!-- <option value="2">Figures</option> -->
          <option value="3">cards</option>
          <option value="4">Random image</option>
        </select>&nbsp;
        
        <span id="escondeColor">Color <input type="checkbox" value="1" id="colorActivo">&nbsp;</span>
        
        CL<select id="tipoCamera">
          <option value="0" selected>no Cam move</option>
          <option value="1">move Cam xz R</option>
          <option value="2">move Cam xz L</option>
          <option value="3">move Cam yz</option>
          <option value="5">Random Cam Mov</option>
        </select>&nbsp;
        CC:<select id="tipoCamera1">
          <option value="0" selected>no Cam move</option>
          <option value="1">move Cam xz R</option>
          <option value="2">move Cam xz L</option>
          <option value="3">move Cam yz</option>
          <option value="5">Random Cam Mov</option>
        </select>&nbsp;
        CR:<select id="tipoCamera2">
          <option value="0" selected>no Cam move</option>
          <option value="1">move Cam xz R</option>
          <option value="2">move Cam xz L</option>
          <option value="3">move Cam yz</option>
          <option value="5">Random Cam Mov</option>
        </select>&nbsp;

        &nbsp;<a href="#" onclick="$('#tipoCamera').val(5); $('#tipoCamera1').val(5); $('#tipoCamera2').val(5);" id="rc-click">RC</a>
        &nbsp;Correction <input type="checkbox" onclick="bCorrectionCheck=!bCorrectionCheck" checked>
        CubeColor <input type="checkbox" value="1" id="axisColor" onclick="limpiarCubos(); limpiarCubos1();">&nbsp;
        
        v: <input type="text" value="100" id="camVelocity" style="width: 30px;">&nbsp;
        %: <input type="text" value="22" id="rndPorcentaje" style="width: 25px;">/100&nbsp;
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
        <a href="#" onclick="alert('To learn the n-back trainning please google Brain Workshop.\nv: is the camera velocity, %: is the probability of repetition\nThis software is experimental and may contain errors.\nContact: robertchalean@gmail.com');">?</a>
      </div> <!-- Fin Controles -->

      <!-- Canvas - Resultados -->
      <div>
        <div style="float: left;">
          <canvas id="canvas" width="500" height="512" style="background-color: #eee"></canvas>
        </div>
        <div style="float:left;  margin-left: 10px;">
          <canvas id="canvas1" width="500" height="512" style="background-color: #eee"></canvas>
          
        </div>
         <div style="float: left; margin-left: 10px;">
          <canvas id="canvas2" width="500" height="512" style="background-color: #eee"></canvas>
        </div>
      </div> <!-- Fin Canvas - Resultados -->
      <div style="clear: both"></div>
      <!-- Botonera -->
      <div style="float: left; zoom: 150%; margin-left: 20px; width: 450px;" id="botonera">
      <center>
        <div>
        <input type="button" value="A: Position Match L" id="pm" style="">
         <input type="button" value="J: Position Match C" id="pm1" style="">
        <input type="button" value="L: Position Match R" id="pm2" style="">

        <input type="button" value="F: Color Match" id="cm" style="">
       
        <input type="button" value="L: Sound Match" id="sm" style="">
        </div>
        </center>
      </div><!-- Fin Botonera -->
      <div style="clear: both"></div>
      <div id="results"></div>
      <script type="text/javascript">
        $("#rc-click").click();
      </script>
   </body>
</html>