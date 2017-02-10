<!DOCTYPE html>
<!-- To do add: random image figures -->
<html>
   <head>
      <meta charset="utf-8">
      <title>3D Dual N-Back</title>

    <meta name="description" content="3D Dual N-back: Train your mind in 3D">
    <meta name="keywords" content="mental training, memory, working memory">

      <script src="scripts/gl-matrix.js"></script>
      <script src="scripts/phoria-util.js"></script>
      <script src="scripts/phoria-entity.js"></script>
      <script src="scripts/phoria-scene.js"></script>
      <script src="scripts/phoria-renderer.js"></script>
      <script src='scripts/dat.gui.min.js'></script>
      <script src='scripts/jquery.min.js'></script>
      <!--<script src="scripts/buzz.min.js"></script>-->
      <script src="js/underscore-min.js"></script>
      <script src="js/jquery.cookie-dist.js" type="text/javascript"></script> 
      <!--<script src="https://ajax.googleapis.com/ajax/libs/jquery/1.12.3/jquery.min.js"></script>-->
      <script src="/js/waud.min.js"></script>
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
Waud.init();


/*
Quitado plano base linea



*/


stopPrevent=0;

document.addEventListener("click",handler1,true);

function handler1(e){
    if(stopPrevent){


    }else{
       e.stopPropagation();
       e.preventDefault();

    } 
}

      /*
        @keyActions -> Go to keypress

    
      */
var requestAnimFrame = window.requestAnimationFrame || window.webkitRequestAnimationFrame ||
                       window.mozRequestAnimationFrame || window.msRequestAnimationFrame || 
                       function(c) {window.setTimeout(c, 15)};
/**
   Phoria
   pho·ri·a (fôr-)
   n. The relative directions of the eyes during binocular fixation on a given object
*/

// bind to window onload event
window.addEventListener('load', onloadHandler, false);
var scene;

casillerosEs=["tea","noe","humo","oca","ola","oso","ufo","hacha","ave","toro","teta","tina","atomo","taco","tela","tos","tufo","techo","tuvo","noria","nota","nene","nemo","nuca","nilo","anis","nife","nicho","nube","muro","moto","mono","momia","amaca","mula","mesa","mafia","mecha","ameba","caro","cohete","cono","cama","coco","cola","casa","cafe","coche","cubo","ilar","late","luna","lima","loco","lulu","losa","alfa","lucha","lobo","sor","seta","sena","sumo","saco","sal","seso","sofa","sacha","sebo","faro","foto","faena","fama","foca","falo","fosa","fofo","ficha","efebo","hachero","chita","chino","chama","chica","chile","chas","chufa","chucho","chivo","bar","bota","vino","bum","vaca","vela","vaso","bofia","bache","bebe"];
casillerosEn=["tie","noah","ma","rye","law","shoe","cow","ivy","bee","toes","tot","tin","tomb","tyre","towel","dish","tack","dove","tub","nose","net","nun","nemmo","nero","nail","notch","neck","knife","knob","mice","mat","moon","mummy","mower","mule","match","mug","movie","mop","rose","rod","rain","ram","rower","roll","roach","rock","roof","rope","lace","loot","lion","loom","lure","lily","leach","log","lava","lip","cheese","sheet","chain","chum","cherry","jail","choo","chalk","chef","ship","case","cot","coin","comb","car","coal","cage","coke","cave","cob","fez","fit","phone","foam","fur","file","fish","fog","fifi","fob","bus","bat","bone","bumm","bear","bell","beach","book","poof","pipe"];
casillerosDe=["nase","rosse","schusse","fass","tee","naht","ratte","schutt","noahh","nonne","rune","scheune","fahne","mai","nemmmo","rum","schaum","wm","reh","narr","rohr","schere","feuer","lee","nil","rolle","schal","falle","schi","nische","rauch","schach","fisch","kuh","nike","rockk","scheck","waage","fee","neffe","reif","schaf","waffe","po","neubau","raupe","scheibe","wabe","tasse","maus","lasso","kase","buss","toot","matte","latte","kette","bett","tanne","mine","linie","kanne","bahn","team","mumie","leim","kamm","baum","teer","meer","leier","karre","bier","tal","mull","lolli","keule","ball","tasche","masche","loch","koch","buch","theke","mac","lack","kacke","backe","taufe","maffia","lavva","kaffee","bifi","taube","map","lupe","kippe","baby","sau"];
//console.log(casillerosDe.length);
//console.log(casillerosEs.length);

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
selectCasillerosDe=_.first(miRnd, 8);
//console.log(selectCasillerosEs);

for(i=0;i<selectCasillerosEs.length;i++){

  n=casillerosEs[selectCasillerosEs[i]];
  //eval("__s"+n+" = new buzz.sound( \"/sound/"+n+"\" , {formats: [ \"mp3\" ] })");
  eval("__s"+n+" = new WaudSound(\"/sound/"+n+".mp3\");");
  selectCasillerosEs[i]=n;

}

for(i=0;i<selectCasillerosEn.length;i++){

  n=casillerosEn[selectCasillerosEn[i]];
  //eval("__s"+n+" = new buzz.sound( \"/sound/"+n+"\" , {formats: [ \"mp3\" ] })");
  eval("__s"+n+" = new WaudSound(\"/sound/"+n+".mp3\");");
  selectCasillerosEn[i]=n;

}

for(i=0;i<selectCasillerosDe.length;i++){

  n=casillerosDe[selectCasillerosDe[i]];
  //eval("__s"+n+" = new buzz.sound( \"/sound/"+n+"\" , {formats: [ \"mp3\" ] })");
  eval("__s"+n+" = new WaudSound(\"/sound/"+n+".mp3\");");
  selectCasillerosDe[i]=n;

}

//__sc = new buzz.sound( "/sound/c" , {formats: [ "mp3" ] });
__sc = new WaudSound( "/sound/c.mp3");
//__sh = new buzz.sound( "/sound/h" , {formats: [ "mp3" ] });
__sh = new WaudSound( "/sound/h.mp3");
//__sk = new buzz.sound( "/sound/k" , {formats: [ "mp3" ] });
__sk = new WaudSound( "/sound/k.mp3");
//__sl = new buzz.sound( "/sound/l" , {formats: [ "mp3" ] });
__sl = new WaudSound( "/sound/l.mp3");

//__sq = new buzz.sound( "/sound/q" , {formats: [ "mp3" ] });
__sq = new WaudSound( "/sound/q.mp3");
//__sr = new buzz.sound( "/sound/r" , {formats: [ "mp3" ] });
__sr = new WaudSound( "/sound/r.mp3");
//__ss = new buzz.sound( "/sound/s" , {formats: [ "mp3" ] });
__ss = new WaudSound( "/sound/s.mp3");
//__st = new buzz.sound( "/sound/t" , {formats: [ "mp3" ] });
__st = new WaudSound( "/sound/t.mp3");

letras=["c","h","k","l","q","r","s","t"];

//__sdo = new buzz.sound( "/sound/do" , {formats: [ "mp3" ] });
__sdo = new WaudSound( "/sound/do.mp3");
//__sre = new buzz.sound( "/sound/re" , {formats: [ "mp3" ] });
__sre = new WaudSound( "/sound/re.mp3");
//__smi = new buzz.sound( "/sound/mi" , {formats: [ "mp3" ] });
__smi = new WaudSound( "/sound/mi.mp3");
//__sfa = new buzz.sound( "/sound/fa" , {formats: [ "mp3" ] });
__sfa = new WaudSound( "/sound/fa.mp3");

//__ssol = new buzz.sound( "/sound/sol" , {formats: [ "mp3" ] });
__ssol = new WaudSound( "/sound/sol.mp3");
//__sla = new buzz.sound( "/sound/la" , {formats: [ "mp3" ] });
__sla = new WaudSound( "/sound/la.mp3");
//__ssi = new buzz.sound( "/sound/si" , {formats: [ "mp3" ] });
__ssi = new WaudSound( "/sound/si.mp3");
//__sdo1 = new buzz.sound( "/sound/do1" , {formats: [ "mp3" ] });
__sdo1 = new WaudSound( "/sound/do1.mp3");

notas=["do","re","mi","fa","sol","la","si","do1"];
alfabeto=["a1","a2","a3","a4","b","c","d","e1","e2","e3","e4","f","g","h","i","l","m","n1","n2","n3","n4","o1","o2","o3","o4","p","q","r1","r2","r3","r4","s1","s2","s3","s4","t","u","v","y","00","01","02","03","04","05","06","07","08","09","30","31","32","33","34","35","36","37","38","39","40","41","42","43","44","45","46","47","48","49","50","51","52","53","54","55","56","57","58","59","60","61","62","63","64","65","66","67","68","69","70","71","72","73","74","75","76","77","78","79","80","81","82","83","84","85","86","87","88","89","90","91","92","93","94","95","96","97","98","99","1","2","3","4","5","6","7","8","9","10","11","12","13","14","15","16","17","18","19","20","21","22","23","24","25","26","27","28","29","30","31","32","33","34","35","36","37","38","39","40","41","42","43","44","45","46","47","48","49","50","51","52","1","2","3","4","5","6","7","8","9","c","h","k","l","q","r","s","t"];

//console.log(alfabeto[180]);
//console.log(alfabeto[187]);

alpha = _.range(0,39);

figuras = _.range(39,118);
figurasBlancas = [39,49,59,69,79,89,109];
cartas = _.range(118,alfabeto.length);
numeros = _.range(alfabeto.length-17,alfabeto.length-9);
misLetras = _.range(alfabeto.length-8,alfabeto.length-1); 
console.log(alfabeto.length);
//console.log("->"+alfabeto[alfabeto.length-8]);
//console.log(alfabeto[alfabeto.length-9]);
//console.log(alfabeto[alfabeto.length-1]);

misColores = ["0,0,0","151,75,0","255,0,0","255,242,0","0,255,0","0,0,255","128,0,128","255,255,255"];

//console.log(alfabeto[118]);
//_.shuffle(list) _.sample([1, 2, 3, 4, 5, 6],3); _.range(0, 30, 5);

var loader;
var bitmaps = [];

function onloadHandler()
{
   // get the images loading
   loader = new Phoria.Preloader();
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
      if(i>alfabeto.length-18){
        carpeta="emociones";
      }
      if(i>alfabeto.length-9){
        carpeta="letrasImg";
      }

      
      //console.log('/emociones/'+letra+'.gif');

      bitmaps.push(new Image());
      loader.addImage(bitmaps[i], '/'+carpeta+'/'+letra+ext);
      //console.log(carpeta+"/"+letra+ext);
   }
   loader.onLoadCallback(iniciar);
  
}

var largoX = 4;
var largoY = 4;
opcionXBy=0;

function iniciar()
{

  opcionXBy = parseInt($("#xBy").val());
  if(opcionXBy==0){ largoX = 2; }
  if(opcionXBy==1){ largoX = 3; }
  if(opcionXBy==2){ largoX = 4; }
  if(opcionXBy==3){ largoX = 5; }
  if(opcionXBy==4){ largoX = 6; }

  //console.log(opcionXBy);

  cargarResultados();
  
   // get the canvas DOM element and the 2D drawing context
   var canvas = document.getElementById('canvas');
   
   // create the scene and setup camera, perspective and viewport
   scene = new Phoria.Scene();
   scene.camera.position = {x:5.0, y:2.0, z:-20.0};
   scene.perspective.aspect = canvas.width / canvas.height;
   scene.viewport.width = canvas.width;
   scene.viewport.height = canvas.height;
   
   // create a canvas renderer
   var renderer = new Phoria.CanvasRenderer(canvas);
   
   // add a grid to help visualise camera position etc.
  // var plane = Phoria.Util.generateTesselatedPlane(8,8,0,20);
   var plane = Phoria.Util.generateTesselatedPlane(8,8,0,20);

/*
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
   }));*/
  
   init(); 
   limpiarCubos();

   //[0,0,180]
   lightColor = [0,0,180];
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

  scene.graph.push(new Phoria.DistantLight());

   var pause = false;
   var fnAnimate = function() {
      if (!pause)
      {
         // rotate local matrix of the cube
         //cube.rotateY(0.5*Phoria.RADIANS);

         
         // execute the model view 3D pipeline and render the scene
         scene.modelView();
         renderer.render(scene);
      }
      requestAnimFrame(fnAnimate);
   };

   //@keysActions
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
                  $("#pm").css("color","green");
                  //console.log("ok");

                  
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
       }//wiich a


       //Sound match letter L
       if(e.which==108){

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
       }//wiich l

       //Image Match or audio & n-vis letter J
       if(e.which==106){

          if(tcAct){
            if(bIntroducir5){ //audio & n-vis
            
              if(currentPasada>cantidadBack){
                 //console.log(bIntroducir);
                  _s=currentPasada-1;
                  _b=currentPasada-1-cantidadBack;

                  if(salidas1[_s]==salidas4[_b]){
                    bOk5=1;
                    ok5++;
                    //$("#ok").html(parseInt(ok)+parseInt(ok1));
                    actualizarOk();
                    $("#avm").css("color","green");
                    //console.log("ok-s");   
                  }else{
                    $("#avm").css("color","red");

                    //console.log("error-s");
                    error5++;
                    bOk5=1;
                    //$("#error").html(parseInt(error)+parseInt(error1));
                    actualizarErrores();

                 } //si coincide
              }//pasadas>cantidadBack
           }//bIntroducir
           bIntroducir5=0;
           setTimeout(function(){ $("#avm").css("color","black"); },500);

          }else{//tcAct
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

          }//tcAct three combination  
       }//wiich j

       //wich d vis & n-audio
        if(e.which==100){

          if(tcAct){
            if(bIntroducir4){ //vis & n-audio
             
              if(currentPasada>cantidadBack){
                 //console.log(bIntroducir);
                  _s=currentPasada-1;
                  _b=currentPasada-1-cantidadBack;

                  if(salidas4[_s]==salidas1[_b]){
                    bOk4=1;
                    ok4++;
                    //$("#ok").html(parseInt(ok)+parseInt(ok1));
                    actualizarOk();
                    $("#vam").css("color","green");
                    //console.log("ok-s");   
                  }else{
                    $("#vam").css("color","red");

                    //console.log("error-s");
                    error4++;
                    bOk4=1;
                    //$("#error").html(parseInt(error)+parseInt(error1));
                    actualizarErrores();

                 } //si coincide
              }//pasadas>cantidadBack
           }//bIntroducir
           bIntroducir4=0;
           setTimeout(function(){ $("#vam").css("color","black"); },500);
         }//tcAct
       }//e.which

       //Image Match or vis-vis letter S
       if(e.which==115){

         if(!tcAct)
         {
          return;
         }

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
                  $("#vvm").css("color","green");
                  //console.log("ok-s");

                  
                }else{
                  $("#vvm").css("color","red");

                  //console.log("error-s");
                  error2++;
                  bOk2=1;
                  //$("#error").html(parseInt(error)+parseInt(error1));
                  actualizarErrores();

                } //si coincide
            }//pasadas>cantidadBack
         }//bIntroducir
         bIntroducir2=0;
         setTimeout(function(){ $("#vvm").css("color","black"); },500);
       }//wiich s

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

      //console.log(e.which);
   });//on keypress

   // key binding
   document.addEventListener('keydown', function(e) {
      switch (e.keyCode)
      {
         case 27: // ESC
            
            pause = !pause;
           

            break;
      }
   }, false); // key binding

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

   //Match Buttons

   $("#pm").click(function(){
   	   if(bIntroducir){
            
            if(currentPasada>cantidadBack){
               //console.log(bIntroducir);
                _s=currentPasada-1;
                _b=currentPasada-1-cantidadBack;

                if(salidas[_s][0]==salidas[_b][0] && salidas[_s][1]==salidas[_b][1] && salidas[_s][2]==salidas[_b][2]){
                  bOk=1;
                  ok++;
                  $("#ok").html(ok);
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

   $("#vvm").click(function(){
     if(!tcAct)
         {
          return;
         }

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
                  $("#vvm").css("color","green");
                  //console.log("ok-s");

                  
                }else{
                  $("#vvm").css("color","red");

                  //console.log("error-s");
                  error2++;
                  bOk2=1;
                  //$("#error").html(parseInt(error)+parseInt(error1));
                  actualizarErrores();

                } //si coincide
            }//pasadas>cantidadBack
         }//bIntroducir
         bIntroducir2=0;
         setTimeout(function(){ $("#vvm").css("color","black"); },500);

   });

  $("#vam").click(function(){
      if(tcAct){
        if(bIntroducir4){ //vis & n-audio
         
          if(currentPasada>cantidadBack){
             //console.log(bIntroducir);
              _s=currentPasada-1;
              _b=currentPasada-1-cantidadBack;

              if(salidas4[_s]==salidas1[_b]){
                bOk4=1;
                ok4++;
                //$("#ok").html(parseInt(ok)+parseInt(ok1));
                actualizarOk();
                $("#vam").css("color","green");
                //console.log("ok-s");   
              }else{
                $("#vam").css("color","red");

                //console.log("error-s");
                error4++;
                bOk4=1;
                //$("#error").html(parseInt(error)+parseInt(error1));
                actualizarErrores();

             } //si coincide
          }//pasadas>cantidadBack
       }//bIntroducir
       bIntroducir4=0;
       setTimeout(function(){ $("#vam").css("color","black"); },500);
     }
  });
  $("#avm").click(function(){
    if(tcAct){
        if(bIntroducir5){ //audio & n-vis
          if(currentPasada>cantidadBack){
             //console.log(bIntroducir);
              _s=currentPasada-1;
              _b=currentPasada-1-cantidadBack;

              if(salidas1[_s]==salidas4[_b]){
                bOk5=1;
                ok5++;
                //$("#ok").html(parseInt(ok)+parseInt(ok1));
                actualizarOk();
                $("#avm").css("color","green");
                //console.log("ok-s");   
              }else{
                $("#avm").css("color","red");

                //console.log("error-s");
                error5++;
                bOk5=1;
                //$("#error").html(parseInt(error)+parseInt(error1));
                actualizarErrores();

             } //si coincide
          }//pasadas>cantidadBack
       }//bIntroducir
       bIntroducir5=0;
       setTimeout(function(){ $("#avm").css("color","black"); },500);
    }
  });

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

    if(sTipoImagen!=5){
      $('#threeCombination').attr('checked', false);
      $("#vvm").hide();
      $("#vam").hide();
      $("#avm").hide();
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

    if(sTipoSonido!=1){
      $('#threeCombination').attr('checked', false);
       $("#vvm").hide();
       $("#vam").hide();
       $("#avm").hide();
    }
    sAct=sTipoSonido;
  
    setMargin();

   });//tipo sonido change

  $("#tipoCamera").change(function(){
    if($("#tipoCamera").val()>0){
     // $('#colorActivo').attr('checked', false);
      //$("#tipoImagen").val(0);

    }
    
  });//tipo camera change

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

   });//color activo click

   $("#threeCombination").click(function(){
     tcAct=!tcAct;

     if(tcAct){
       $("#vvm").show();
       $("#vam").show();
       $("#avm").show();

       $("#im").hide();

       $("#tipoImagen").val(5);
       $("#tipoSonido").val(1);

       iAct=5;


     }else{
       $("#vvm").hide();
       $("#vam").hide();
       $("#avm").hide();

       if(parseInt($("#tipoImagen").val())>0){
        $("#im").show();

       }


     }
     setMargin();
    /*
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
    */
   }); // three combination

  $("#stop1").click(function(){
    $("#stop1").hide();
    clearTimeout(killInterval);

  });

  $("#loading").hide();
  $("#cm").hide();
  $("#im").hide();

  $("#vvm").hide();
  $("#vam").hide();
  $("#avm").hide();
  //$("#botonera").css("margin-left","150px");
  //console.log($("#sm").width());
  $("#stop1").hide();
  $("#colorActivo").hide;
  $(".oke").hide();
  stopPrevent=1;

   $("#xBy").change(function(){

      opcionXBy = parseInt($("#xBy").val());

      if(opcionXBy==0){ largoX = 2; scene.camera.position = {x:-6.0, y:6.0, z:-15.0}; }
      if(opcionXBy==1){ largoX = 3; scene.camera.position = {x:-4, y:3.0, z:-15.0}; }
      if(opcionXBy==2){ largoX = 4; scene.camera.position = {x:5.0, y:2.0, z:-20.0}; }
      if(opcionXBy==3){ largoX = 5; scene.camera.position = {x:5.0, y:-2.5, z:-25.0}; }
      if(opcionXBy==4){ largoX = 6; scene.camera.position = {x:3.0, y:-5.0, z:-30.0}; }

      console.log(opcionXBy);
      limpiarCubos();


   });


  // start(0);
}

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
  if(tcAct){
    marginTotal=0;
    $("#botonera").css("width","768px");
    
  }

  //$("#botonera").css("margin-left",marginTotal+"px");

}
var xCamera = 0, yCamera=0, zCamera=0, myFrame=0, iniX=0, iniZ=10;
var estadoCamera=0;
function cameraMove(){
  //return;

  myFrame++;
  r=20; T=parseInt($("#camVelocity").val());
  pi=Math.PI;

  /*
  if(scene.camera.up.x.toFixed(1)==1.5){
    estadoCamera=1;
  }
  if(scene.camera.up.x.toFixed(1)==-1.5){
    estadoCamera=0;
  }


  if(estadoCamera==0){
    cambio=+0.1;
     
  }else{
    cambio=-0.1;
    console.log(cambio);
    
  }
  scene.camera.up.x += cambio; 

  console.log(scene.camera.up.x);

  return;*/

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

var tipoCameraVal=0;
var rrrr,rrrx;
var rndPorcentaje=0;
var perdidas=0;

function start(xxx){
   if(xxx==0){
      acumuladorSuma=0;
      //random
      //console.log(cantidadBack);
      rrrr=_.random(0,2);
      rrrx=_.random(0,2);
      rndPorcentaje=parseInt($("#rndPorcentaje").val());

      xCamera = 0, yCamera=0, zCamera, myFrame=0, iniX=0, iniZ=10;
      salidas=[]; 
      salidas1=[]; 
      salidas2=[]; //image or visual visual
      salidas3=[]; 
      //Tc Salidas

      salidas4=[]; //vis audio
      salidas5=[]; //audio visual

      //cantidadBack=parseInt( $("#cantidadBack1").val() );

      //console.log($("#cantidadBack1").val());

      currentPasada=0;
      pasadas = 30 + (cantidadBack-1) * 6;
      //pasadas=5;
      ok=0; ok1=0; ok2=0; ok3=0; ok4=0; ok5=0;
      error=0; error1=0; error2=0; error3=0; error4=0; error5=0;
      myInterval=parseInt($("#timeValue").val());
      myInterval1=parseInt($("#timeValue1").val());
      clearTimeout(killInterval); 
      clearInterval(killCamera); 
      bOk=0; bOk1=0; bOk2=0; bOk3=0; bOk4=0; bOk5=0;
      mismo=0; mismo1=0; mismo2=0; mismo3=0; mismo4=0; mismo5=0;
      $("#error").html(parseInt(error)+parseInt(error1));
      $("#ok").html(parseInt(ok)+parseInt(ok1));
      $("#results").html("");

      if(iAct==6){
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
         if(iAct==4)
           arrayImagenes = _.first(_.shuffle(numeros.slice()),8);
         if(iAct==5)
           arrayImagenes = _.first(_.shuffle(misLetras.slice()),8);
         if(iAct==2 && cAct==1)
           arrayImagenes = figuras.slice()
         console.log(arrayImagenes);
      }//iAct==4 (random)

      console.log(arrayImagenes);

      tipoCameraVal=parseInt($("#tipoCamera").val());

      if(tipoCameraVal==5)
        tipoCameraVal=_.random(1,3);


      if(tipoCameraVal>0){
        
        killCamera = setInterval(cameraMove,100);
      }else{

        if(opcionXBy==0){ largoX = 2; scene.camera.position = {x:-6.0, y:6.0, z:-15.0}; }
        if(opcionXBy==1){ largoX = 3; scene.camera.position = {x:-4, y:3.0, z:-15.0}; }
        if(opcionXBy==2){ largoX = 4; scene.camera.position = {x:5.0, y:2.0, z:-20.0}; }
        if(opcionXBy==3){ largoX = 5; scene.camera.position = {x:5.0, y:-2.5, z:-25.0}; }
        if(opcionXBy==4){ largoX = 6; scene.camera.position = {x:3.0, y:-5.0, z:-30.0}; }

      }
      $("#stop1").show();

      
   }


   limpiarCubos();
   bIntroducir=0; bIntroducir1=0; bIntroducir2=0; bIntroducir3=0; bIntroducir4=0; bIntroducir5=0;  

   //position match error
   if(currentPasada>cantidadBack && bOk==0){

      _s=currentPasada-1;
      _b=currentPasada-1-cantidadBack;

      if(salidas[_s][0]==salidas[_b][0] && salidas[_s][1]==salidas[_b][1] && salidas[_s][2]==salidas[_b][2]){
        console.log("e pm");
         error++;
         $("#pm").css("color","red");
         actualizarErrores();
         setTimeout(function(){ $("#pm").css("color","black"); },500);
      }
   }
   bOk=0;

   //sound match error
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

   //image match error
   if(currentPasada>cantidadBack && bOk2==0 && iAct>0){

      _s=currentPasada-1;
      _b=currentPasada-1-cantidadBack;

      if(salidas2[_s]==salidas2[_b]){
         error2++;

         buttonInputToChangeColor="#im";
         if(tcAct)
            buttonInputToChangeColor="#vvm";

         $(buttonInputToChangeColor).css("color","red");
         actualizarErrores();
         setTimeout(function(){ $(buttonInputToChangeColor).css("color","black"); },500);
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

   if(tcAct){
     //visual audio
     if(currentPasada>cantidadBack && bOk4==0){

        _s=currentPasada-1;
        _b=currentPasada-1-cantidadBack;

        if(salidas4[_s]==salidas1[_b]){
           error4++;
           $("#vam").css("color","red");
           actualizarErrores();
           setTimeout(function(){ $("#vam").css("color","black"); },500);
        }
     }
     bOk4=0;

     //visual audio
     if(currentPasada>cantidadBack && bOk5==0){

        _s=currentPasada-1;
        _b=currentPasada-1-cantidadBack;

        if(salidas1[_s]==salidas4[_b]){
           error5++;
           $("#avm").css("color","red");
           actualizarErrores();
           setTimeout(function(){ $("#avm").css("color","black"); },500);
        }
     }
     bOk5=0;


   }//tcAct)


   if(pasadas==0){
     $("#stop1").hide();

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

      positionTxt = ""; soundTxt = ""; imageTxt= ""; colorTxt=""; vaTxt=""; avTxt="";
      if(ok!=0 || error!=0){

        positionTxt="positions: "+ok+"-"+error;

      }
      if(ok1!=0 || error1!=0){

        soundTxt="sounds: "+ok1+"-"+error1;

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

      $("html, body").animate({ scrollTop: $(document).height() }, 1000);

      return;

   }


   _r=rnd(1,100);
   //console.log(_r);

   //Position
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
       
         _x = rnd(0,largoX-1);
         _y = rnd(0,largoX-1);
         _z = rnd(0,largoX-1);
         

         if(largoX==3){
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
              
           }//_x!=1 ...


         }else{
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
         }//largoX==3
         
         
       // break;
      }//for  
   }//currentPasada>cantidadBack

   //console.log("position: "+_txt+" x:"+_x+" y:"+_y+" z:"+_z);

   multiTc = 1;
   if(tcAct){
    multiTc=2;
   }

   //Sound
   _r=rnd(1,100);
   _txt="misma";
   if(sAct>0){
    if(currentPasada>cantidadBack && _r<=rndPorcentaje*multiTc){

        if(rnd(0,1) || (tcAct==0)){
          _poner = currentPasada-cantidadBack;
          _mySound=salidas1[_poner];
          mismo1++;
          console.log("audio & audio")
        }else{
          _poner = currentPasada-cantidadBack;
          _mySound=salidas4[_poner];
          mismo1++;
          console.log("audio & n-vis")
        }
         
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
            if(parseInt($( "#tipoSonido" ).val())==5){
              _mySound=selectCasillerosDe[rnd(0,7)];
            }

              myTipoSonido = parseInt($( "#tipoSonido" ).val());

              if(myTipoSonido>=6){
          
                if(rrrr==0)
                  _mySound=notas[rnd(0,7)];
                if(rrrr==1)
                   _mySound=letras[rnd(0,7)];

                if(rrrr==2){

                  if(myTipoSonido==6)
                     _mySound=selectCasillerosEs[rnd(0,7)];

                  if(myTipoSonido==7)
                     _mySound=selectCasillerosEn[rnd(0,7)];

                  if(myTipoSonido==8)
                     _mySound=selectCasillerosDe[rnd(0,7)];

                  if(myTipoSonido==9){

                      if(rrrx==0)
                        _mySound=selectCasillerosEs[rnd(0,7)];
                      if(rrrx==1)  
                        _mySound=selectCasillerosEn[rnd(0,7)];
                      if(rrrx==2)  
                        _mySound=selectCasillerosDe[rnd(0,7)];

                  }//myTipoSonido==7

                }//rrrr==2

            }// tipo sonido val == 5
            
           
           if(currentPasada>cantidadBack){
              if(_mySound!=salidas1[currentPasada-cantidadBack])
                 break;        
           }else{/*
              if(currentPasada>0){
                 if(_mySound!=salidas1[currentPasada-1])
                    break;

             }
             if(currentPasada==0)*/
                 break;

           }
            
             //break;
        }//for  
     }//currentPasada>cantidadBack

   //console.log("sound code: " + _mySound);
   }//is sAct
   

  //Image
   _r=rnd(1,100);
   _txt="misma";
   if(iAct>0){
    if(currentPasada>cantidadBack && _r<=rndPorcentaje*multiTc){

        if(rnd(0,1) || (tcAct==0)){
           _poner = currentPasada-cantidadBack;
           _myImagen=salidas2[_poner];
           mismo2++;
            
           miNum= _myImagen-170; 
           acumuladorSuma+=miNum;
          //console.log(miNum+":"+acumuladorSuma);
           console.log("vis & n-vis: " + _myImagen);

        }else{

           _poner = currentPasada-cantidadBack;
           _myImagen=searchIndexImageLetras(alfabeto,salidas1[_poner]);
           mismo2++;
           console.log("vis & n-sound: " + _myImagen);
  
           /*miNum= _myImagen-170; 
           acumuladorSuma+=miNum;*/
          //console.log(miNum+":"+acumuladorSuma);

        }

      
     }else{//currentPasada>cantidadBack
        _txt="random";
        
        for(;;){
           _myImagen=arrayImagenes[_.random(0,arrayImagenes.length-1)]; 
          
           miNum=_myImagen-170; 
           acumuladorSuma+=miNum;
           //console.log(miNum+":"+acumuladorSuma);
           
           if(currentPasada>cantidadBack){
              if(_myImagen!=salidas2[currentPasada-cantidadBack])
                 break;        
           }else{/*
              if(currentPasada>0){
                 if(_mySound!=salidas1[currentPasada-1])
                    break;

             }
             if(currentPasada==0)*/
                 break;

           }
            
             //break;
        }//for  
     }//currentPasada>cantidadBack
     //console.log("image code: "+_myImagen);
     /*
     186=s
     */
   }//iAct
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
           }else{/*
              if(currentPasada>0){
                 if(_mySound!=salidas1[currentPasada-1])
                    break;

             }
             if(currentPasada==0)*/
                 break;

           }
            
             //break;
        }//for  
     }//currentPasada>cantidadBack
     salidas3[currentPasada]=_myColor;

   }//is cAct
   

   //console.log("sound: "+_txt+" letra:"+_mySound);

   salidas[currentPasada] = [];
   salidas[currentPasada][0] = _x;
   salidas[currentPasada][1] = _y;
   salidas[currentPasada][2] = _z;

   
   //__sc.stop();
   //__sc.play();
   if(tcAct){
    salidas4[currentPasada]=alfabeto[_myImagen];
   }

   if(sAct>0){
    salidas1[currentPasada]=_mySound;
     eval("__s"+_mySound+".stop();");
     eval("__s"+_mySound+".play();");

   }

   if(iAct!=0){
    //console.log("imagen: " + _myImagen);
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

   }else{
   
     e2_1="for (var m=0; m<6; m++)"+
             "{"+
                "cube"+_x+_y+_z+".textures=[];"+ //"cube"+_x+_y+_z+".textures[0]=bitmaps[6];"+
                "cube"+_x+_y+_z+".polygons[m].texture = undefined;"+
             "}";
    eval(e2_1);

    _ccc="0,0,128";
    if(cAct==1)
      _ccc=_myColor;
      
    eval("cube"+_x+_y+_z+".style.drawmode = 'solid';");
    eval("cube"+_x+_y+_z+".style.color = ["+_ccc+"];");
   }
  
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
   bIntroducir=1; bIntroducir1=1; bIntroducir2=1; bIntroducir3=1;  bIntroducir4=1;  bIntroducir5=1;
   pasadas--;

   $("#pasadas").html(pasadas);

   killInterval = setTimeout(function(){start(1);},myInterval);
   setTimeout(function(){limpiarCubos();},myInterval1);
   
}


function limpiarCubos(){

   for(i=0;i<6;i++){


      for(j=0;j<6;j++){

         for(k=0;k<6;k++){
            _opacity = 0.6;
          
            if(k>=largoX || j>=largoX || i>=largoX){
              _opacity=0.0;
              
            }

            eval("cube"+k+j+i+".style.color = [128,128,128];");
            eval("cube"+k+j+i+".style.drawmode = 'wireframe';");

            e1="cube"+k+j+i+".style.opacity= "+_opacity+";";
            eval(e1);
            

         }
      }
   }


}

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

  acumTX = 0;
  acumTY = 0;
  acumTZ = 0;
  corregirX=-0.05;

   for(i=0;i<6;i++){

      for(j=0;j<6;j++){

         for(k=0;k<6;k++){

          e1="c"+k+j+i+" = Phoria.Util.generateUnitCube();";
          eval(e1);
          //console.log(e1);

          //e2="cube"+k+j+i+" = Phoria.Entity.create({points: c"+k+j+i+".points,edges: c"+k+j+i+".edges,polygons: c"+k+j+i+".polygons, style: {color: [128,128,128],opacity: 0.5, drawmode: 'wireframe'} });";
          e2="cube"+k+j+i+" = Phoria.Entity.create({points: c"+k+j+i+".points,edges: c"+k+j+i+".edges,polygons: c"+k+j+i+".polygons, style: {color: [128,128,128],opacity: 0.6, drawmode: 'wireframe', shademode : 'plain'} });";
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

          if(k==0 && j==0 && i==0){ tY=3; tX=-3; tZ=-3.5; }
          

          e4="cube"+k+j+i+".translateY("+tY+");cube"+k+j+i+".translateX("+tX+");cube"+k+j+i+".translateZ("+tZ+");cube"+k+j+i+".rotateY(10*Phoria.RADIANS);";
          //console.log(e4);
          eval(e4);
          //console.log(e3);

          tX+=2;
          acumTX+=2;

         }
         tY-=2; acumTY+=2; tX-=acumTX; acumTX=0; //tX-=corregirX;
      }
      tY+=acumTY; acumTY=0; tZ+=2; tX+=0.4;//corregirX+=0.1;
   }


   //z0

   /*
   cube000.translateY(3);cube000.translateX(-3);cube000.translateZ(-3.5);cube000.rotateY(10*Phoria.RADIANS);

   cube100.translateY(3);cube100.translateX(-1.0);cube100.translateZ(-3.5);cube100.rotateY(10*Phoria.RADIANS);
   cube200.translateY(3);cube200.translateX(0.9);cube200.translateZ(-3.5);cube200.rotateY(10*Phoria.RADIANS);
   cube300.translateY(3);cube300.translateX(2.9);cube300.translateZ(-3.5);cube300.rotateY(10*Phoria.RADIANS);
   cube400.translateY(3);cube400.translateX(4.9);cube400.translateZ(-3.5);cube400.rotateY(10*Phoria.RADIANS);
   cube500.translateY(3);cube500.translateX(6.9);cube500.translateZ(-3.5);cube500.rotateY(10*Phoria.RADIANS);

   cube010.translateY(1.06);cube010.translateX(-3);cube010.translateZ(-3.5);cube010.rotateY(10*Phoria.RADIANS);
   cube110.translateY(1.06);cube110.translateX(-1);cube110.translateZ(-3.5);cube110.rotateY(10*Phoria.RADIANS);
   cube210.translateY(1.06);cube210.translateX(0.9);cube210.translateZ(-3.5);cube210.rotateY(10*Phoria.RADIANS);
   cube310.translateY(1.06);cube310.translateX(2.9);cube310.translateZ(-3.5);cube310.rotateY(10*Phoria.RADIANS);
   cube410.translateY(1.06);cube410.translateX(4.9);cube410.translateZ(-3.5);cube410.rotateY(10*Phoria.RADIANS);
   cube510.translateY(1.06);cube510.translateX(6.9);cube510.translateZ(-3.5);cube510.rotateY(10*Phoria.RADIANS);

   cube020.translateY(-1);cube020.translateX(-3);cube020.translateZ(-3.5);cube020.rotateY(10*Phoria.RADIANS);
   cube120.translateY(-1);cube120.translateX(-1);cube120.translateZ(-3.5);cube120.rotateY(10*Phoria.RADIANS);
   cube220.translateY(-1);cube220.translateX(0.9);cube220.translateZ(-3.5);cube220.rotateY(10*Phoria.RADIANS);
   cube320.translateY(-1);cube320.translateX(2.9);cube320.translateZ(-3.5);cube320.rotateY(10*Phoria.RADIANS);
   cube420.translateY(-1);cube420.translateX(4.9);cube420.translateZ(-3.5);cube420.rotateY(10*Phoria.RADIANS);
   cube520.translateY(-1);cube520.translateX(6.9);cube520.translateZ(-3.5);cube520.rotateY(10*Phoria.RADIANS);
   
   //z1 aqui
   cube001.translateY(3);cube001.translateX(-2.7);cube001.translateZ(-1);cube001.rotateY(10*Phoria.RADIANS);
   cube101.translateY(3);cube101.translateX(-0.7);cube101.translateZ(-1);cube101.rotateY(10*Phoria.RADIANS);
   cube201.translateY(3);cube201.translateX(1.3);cube201.translateZ(-1);cube201.rotateY(10*Phoria.RADIANS);
   cube301.translateY(3);cube301.translateX(3.3);cube301.translateZ(-1);cube301.rotateY(10*Phoria.RADIANS);
   cube401.translateY(3);cube401.translateX(5.3);cube401.translateZ(-1);cube401.rotateY(10*Phoria.RADIANS);
   cube501.translateY(3);cube501.translateX(7.3);cube501.translateZ(-1);cube501.rotateY(10*Phoria.RADIANS);

   cube011.translateY(1.06);cube011.translateX(-2.7);cube011.translateZ(-1);cube011.rotateY(10*Phoria.RADIANS);
   cube111.translateY(1.06);cube111.translateX(-0.7);cube111.translateZ(-1);cube111.rotateY(10*Phoria.RADIANS);
   cube211.translateY(1.06);cube211.translateX(1.3);cube211.translateZ(-1);cube211.rotateY(10*Phoria.RADIANS);
   cube311.translateY(1.06);cube311.translateX(3.3);cube311.translateZ(-1);cube311.rotateY(10*Phoria.RADIANS);
   cube411.translateY(1.06);cube411.translateX(5.3);cube411.translateZ(-1);cube411.rotateY(10*Phoria.RADIANS);
   cube511.translateY(1.06);cube511.translateX(7.3);cube511.translateZ(-1);cube511.rotateY(10*Phoria.RADIANS);

   cube021.translateY(-1);cube021.translateX(-2.7);cube021.translateZ(-1);cube021.rotateY(10*Phoria.RADIANS);
   cube121.translateY(-1);cube121.translateX(-0.7);cube121.translateZ(-1);cube121.rotateY(10*Phoria.RADIANS);
   cube221.translateY(-1);cube221.translateX(1.3);cube221.translateZ(-1);cube221.rotateY(10*Phoria.RADIANS);
   cube321.translateY(-1);cube321.translateX(3.3);cube321.translateZ(-1);cube321.rotateY(10*Phoria.RADIANS);
   cube421.translateY(-1);cube421.translateX(5.3);cube421.translateZ(-1);cube421.rotateY(10*Phoria.RADIANS);
   cube521.translateY(-1);cube521.translateX(7.3);cube521.translateZ(-1);cube521.rotateY(10*Phoria.RADIANS);
  
   //z2
   cube002.translateY(3);cube002.translateX(-2.4);cube002.translateZ(1.4);cube002.rotateY(10*Phoria.RADIANS);
   cube102.translateY(3);cube102.translateX(-0.4);cube102.translateZ(1.4);cube102.rotateY(10*Phoria.RADIANS);
   cube202.translateY(3);cube202.translateX(1.6);cube202.translateZ(1.4);cube202.rotateY(10*Phoria.RADIANS);
   cube302.translateY(3);cube302.translateX(3.6);cube302.translateZ(1.4);cube302.rotateY(10*Phoria.RADIANS);
   cube402.translateY(3);cube402.translateX(5.6);cube402.translateZ(1.4);cube402.rotateY(10*Phoria.RADIANS);
   cube502.translateY(3);cube502.translateX(7.6);cube502.translateZ(1.4);cube502.rotateY(10*Phoria.RADIANS);

   cube012.translateY(1.06);cube012.translateX(-2.4);cube012.translateZ(1.4);cube012.rotateY(10*Phoria.RADIANS);
   cube112.translateY(1.06);cube112.translateX(-0.4);cube112.translateZ(1.4);cube112.rotateY(10*Phoria.RADIANS);
   cube212.translateY(1.06);cube212.translateX(1.6);cube212.translateZ(1.4);cube212.rotateY(10*Phoria.RADIANS);
   cube312.translateY(1.06);cube312.translateX(3.6);cube312.translateZ(1.4);cube312.rotateY(10*Phoria.RADIANS);
   cube412.translateY(1.06);cube412.translateX(5.6);cube412.translateZ(1.4);cube412.rotateY(10*Phoria.RADIANS);
   cube512.translateY(1.06);cube512.translateX(7.6);cube512.translateZ(1.4);cube512.rotateY(10*Phoria.RADIANS);

   cube022.translateY(-1);cube022.translateX(-2.4);cube022.translateZ(1.4);cube022.rotateY(10*Phoria.RADIANS);
   cube122.translateY(-1);cube122.translateX(-0.4);cube122.translateZ(1.4);cube122.rotateY(10*Phoria.RADIANS);
   cube222.translateY(-1);cube222.translateX(1.6);cube222.translateZ(1.4);cube222.rotateY(10*Phoria.RADIANS);
   cube322.translateY(-1);cube322.translateX(3.6);cube322.translateZ(1.4);cube322.rotateY(10*Phoria.RADIANS);
   cube422.translateY(-1);cube422.translateX(5.6);cube422.translateZ(1.4);cube422.rotateY(10*Phoria.RADIANS);
   cube522.translateY(-1);cube522.translateX(7.6);cube522.translateZ(1.4);cube522.rotateY(10*Phoria.RADIANS);

   //z3
   cube003.translateY(3);cube003.translateX(-2.1);cube003.translateZ(3.4);cube003.rotateY(10*Phoria.RADIANS);
   cube103.translateY(3);cube103.translateX(-0.1);cube103.translateZ(3.4);cube103.rotateY(10*Phoria.RADIANS);
   cube203.translateY(3);cube203.translateX(1.9);cube203.translateZ(3.4);cube203.rotateY(10*Phoria.RADIANS);
   cube303.translateY(3);cube303.translateX(3.9);cube303.translateZ(3.4);cube303.rotateY(10*Phoria.RADIANS);
   cube403.translateY(3);cube403.translateX(5.9);cube403.translateZ(3.4);cube403.rotateY(10*Phoria.RADIANS);
   cube503.translateY(3);cube503.translateX(7.9);cube503.translateZ(3.4);cube503.rotateY(10*Phoria.RADIANS);

   
   cube012.translateY(1.06);cube012.translateX(-2.1);cube012.translateZ(3.4);cube012.rotateY(10*Phoria.RADIANS);
   cube112.translateY(1.06);cube112.translateX(-0.1);cube112.translateZ(3.4);cube112.rotateY(10*Phoria.RADIANS);
   cube212.translateY(1.06);cube212.translateX(1.9);cube212.translateZ(3.4);cube212.rotateY(10*Phoria.RADIANS);
   cube312.translateY(1.06);cube312.translateX(3.9);cube312.translateZ(3.4);cube312.rotateY(10*Phoria.RADIANS);
   cube412.translateY(1.06);cube412.translateX(5.9);cube412.translateZ(3.4);cube412.rotateY(10*Phoria.RADIANS);
   cube512.translateY(1.06);cube512.translateX(7.9);cube512.translateZ(3.4);cube512.rotateY(10*Phoria.RADIANS);

   cube022.translateY(-1);cube022.translateX(-2.4);cube022.translateZ(3.4);cube022.rotateY(10*Phoria.RADIANS);
   cube122.translateY(-1);cube122.translateX(-0.4);cube122.translateZ(3.4);cube122.rotateY(10*Phoria.RADIANS);
   cube222.translateY(-1);cube222.translateX(1.6);cube222.translateZ(3.4);cube222.rotateY(10*Phoria.RADIANS);
   cube322.translateY(-1);cube322.translateX(3.6);cube322.translateZ(3.4);cube322.rotateY(10*Phoria.RADIANS);
   cube422.translateY(-1);cube422.translateX(5.6);cube422.translateZ(3.4);cube422.rotateY(10*Phoria.RADIANS);
   cube522.translateY(-1);cube522.translateX(7.6);cube522.translateZ(3.4);cube522.rotateY(10*Phoria.RADIANS);
   
  */
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

function searchIndexImageLetras(arr,search){
  j=0;
  for(i=0;i<arr.length;i++){

    if(arr[i]==search){
       if(i>100)
        return i;
    }
  }
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
        <select id="xBy" style="width: 60px;">
          <option value="0">2x2x2</option>
          <option value="1">3x3x3</option>
          <option value="2" selected>4x4x4</option>
          <option value="3">5x5x5</option>
          <option value="4">6x6x6</option>
        </select>&nbsp;
         <b>3D</b> 
         <a href="#" id="mas" style="text-decoration:none; color: #7D0552;"><b>+</b></a> 
         <span id="cantidadBack">2</span>
         <a href="#" id="menos"  style="text-decoration:none; color: #7D0552;"><b>-</b></a> Back&nbsp;
         
         <a href="#" id="start">Play</a>&nbsp;
         <a href="#" id="stop1">Stop&nbsp;</a>
         
         <span>t: <input type="text" value="3000" id="timeValue" style="width: 30px;">&nbsp;<input type="text" value="500" id="timeValue1" style="width: 28px;"></span>&nbsp;
         c: <span id="pasadas">36</span>&nbsp;
       
         <span class="oke">ok: <span id="ok">0</span>&nbsp;</span>
         <span class="oke">E: <span id="error">0</span>&nbsp;</span>
 
         <select id="tipoSonido" style="width: 59px;">
          <option value="0">no Sound</option>
          <option value="1" selected>Letters</option>
          <option value="2">Piano</option>
          <option value="3">Major System ES</option>
          <option value="4">Major System EN</option>
          <option value="5">Major System DE</option>
          <option value="6">Random Sound Es</option>
          <option value="7">Random Sound En</option>
          <option value="8">Random Sound De</option>
          <option value="9">Random Sound All</option>
        </select>&nbsp;
        
        <select id="tipoImagen" style="width: 70px;">
          <option value="0" selected>no Image</option>
          <option value="1">Emotion</option>
         <option value="2">Figures</option> 
          <option value="3">cards</option>
          <option value="4">Numbers sum</option>
          <option value="5">Letras</option>
          <option value="6">Random image</option>
        </select>&nbsp;
        
        Color <input type="checkbox" value="1" id="colorActivo">&nbsp;
        Tc <input type="checkbox" value="1" id="threeCombination">&nbsp;
        
        <select id="tipoCamera" style="width: 100px;">
          <option value="0" selected>no Cam move</option>
          <option value="1">move Cam xz R</option>
          <option value="2">move Cam xz L</option>
          <option value="3">move Cam yz</option>
          <option value="5">Random Cam Mov</option>
        </select>&nbsp;
        
        v: <input type="text" value="120" id="camVelocity" style="width: 30px;">&nbsp;
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
        <a href="#" onclick="alert('To learn the n-back trainning please google Brain Workshop.\nTc: Is tree combination nback, v: is the camera velocity, %: is the probability of repetition\nThis software is experimental and may contain errors.\nContact: robertchalean@gmail.com');">?</a>
      </div> <!-- Fin Controles -->

      <!-- Canvas - Resultados -->
      <div>
        <div style="float: left;">
          <canvas id="canvas" width="768" height="512" style="background-color: #eee"></canvas>
        </div>
        <div style="float:left; width:100px; margin-left: 10px;">
          <div id="resultsList"></div>
          <br><input type="button" name="" value="clear" id="clearResultsList">
        </div>
      </div> <!-- Fin Canvas - Resultados -->
      <div style="clear: both"></div>
      <!-- Botonera -->
      <div style="float: left; zoom: 150%; margin-left: 20px; width: 450px;" id="botonera">
      <center>
        <div>
        <input type="button" value="A: Position Match" id="pm" style="">

        <input type="button" value="S: vis and n-vis" id="vvm" style="">
        <input type="button" value="D: vis and n-audio" id="vam" style="">
        <input type="button" value="J: audio and n-vis" id="avm" style="">

        <input type="button" value="F: Color Match" id="cm" style="">
        <input type="button" value="J: Image Match" id="im" style="">

        <input type="button" value="L: Sound Match" id="sm" style="">
        </div>
        </center>
      </div><!-- Fin Botonera -->
      <div style="clear: both"></div>
      <div id="results"></div>
      <script type="text/javascript">
         if( /Android|webOS|iPhone|iPad|iPod|Opera Mini/i.test(navigator.userAgent) || $(window).width()<900 ) {
           // run your code here
           $("#myOther").hide();

          }
      </script>
   </body>
</html>