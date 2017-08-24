bColor=1;
bExperiment=0;

$("#footer").hide();

//create a synth and connect it to the master output (your speakers)
//Tone.Transport.setBpm(130);
// var synth = new Tone.Synth();
// //var synth = new Tone.MembraneSynth();
// var synth1 = new Tone.Synth();
// //var panner = new Tone.Panner(-1).toMaster();
// panner = new Tone.Panner(0).toMaster();
// panner1 = new Tone.Panner(-1).toMaster();
// panner2 = new Tone.Panner(1).toMaster();


function actualizaVoice(){

  v=n("voice-sel");
  console.log(v);

  if(v==1){
    $("#quantity-notes-sel").val("4");
    $("#footer-l").hide();
    $("#pm").hide();
    $("#footer-r").html(`<br><center><span class="noselect">Logic</span></center>`);
    $("#footer-r").css("width","100%");
  }

  if(v==2){
    $("#quantity-notes-sel").val("2");
    $("#footer-l").show();
    $("#pm").show();
    $("#footer-l").html("<br><center>Op</center>");
    $("#footer-r").html("<br><center>Truth</center>");
    $("#footer-l").css("width","50%");
    $("#footer-r").css("width","50%");
  }
}
actualizaVoice();

estadoMemorizar=1;

//var synth = new Tone.Synth().connect(panner);

//play a middle 'C' for the duration of an 8th note

arr=[-1,0,1];
arr1=["C","D","E","F","G","A","B"]; // D#
allNotes=[];

//tonoArray=[0,1,2,3,4,5,6,7,8,9,10,11,]

z=0;
level=3;
for(let i=0;;){

  sostenido="";
  if(i>0 && allNotes[i-1].length==2 && allNotes[i-1]!="E"+level && allNotes[i-1]!="B"+level && i%12!=0){
    sostenido="#";
  }

  allNotes[i]=arr1[z]+sostenido+level;

  if(sostenido=="#" || allNotes[i]=="E"+level || allNotes[i]=="B"+level)
    z++;

  if(z==7){
    z=0;
    level++;
  }

  if(level==8) break;

  i++;

  if(i==200) break;


}
console.log(allNotes)



//Tone.Panner(-1);
$("#mySnd").click(function(){

  //synth.triggerAttackRelease("C4", "8n").connect(panner);


  
  rndSound();
  
  
})

function rndSound(){
   p=parseInt(arr[_.random(0, 2)]);
   panner2= new Tone.Panner(p).toMaster();
    

    //synth.triggerAttackRelease(arr1[_.random(0,arr1.length-1)]+""+_.random(1,4), "8n").connect(panner2);
    synth.triggerAttackRelease(_.random(20,7000), "8n").connect(panner2);

    //p=parseInt(arr[_.random(0, 2)]);
    //panner2= new Tone.Panner(p).toMaster();

    //synth.triggerAttackRelease(arr1[_.random(0,arr1.length-1)]+""+_.random(1,4), "8n").connect(panner2);

    setTimeout(function(){ rndSound(); },500);

}

//setTimeout(function(){synth.triggerAttackRelease("C5", "8n");},1000);

// rndSound();

var selScale2=0;
function createMelody(){

  scaleNotes=[];
  scaleIntervals=[];
  selScale=n("selected-scale");
  if(selScale==-1){
    if(currentPasada==0){
      selScale=_.random(0,arrayScales.length-1); 
      selScale2=selScale;
    }
    else
      selScale=selScale2
  }
  scaleForm=arrayScales[selScale][1];

  //console.log(arrayScales[selScale][0]);

  arrayScaleForm=scaleForm.split(" ");

  //detecto intervalos de la escala
  for(let i=0;i<arrayScaleForm.length;i++){

    if(arrayScaleForm[i]=="1/2") d=1;
    if(arrayScaleForm[i]=="1") d=2;
    if(arrayScaleForm[i]=="1½") d=3;
    if(arrayScaleForm[i]=="2") d=4;

    scaleIntervals[i]=d;

  }

  firstNote=n("tone-sel");
  if(firstNote==-1){
    firstNote=_.random(0,23);
  }
  if(firstNote>=12) firstNote-=12;

  //2,2,1,2,2,2, 1
  //      a b


  //saco las notas de la escala
  var level=0, next=-1, firstNext=-1;

  for(let i=0,x=0,z=0;i<allNotes.length;i++){
    if(i>=firstNote){
      if(x==0 || i==next || i==firstNext){
        if(i==firstNext){
          z=0;
        }
        if(x==0 || i==firstNext){
          firstNext=i+12;
        }
        
        scaleNotes[x]=allNotes[i];
        x++;
        if(z<scaleIntervals.length){
          next=i+scaleIntervals[z];
          z++;
        }
        
      }
    }
  }

  rnd=_.random(0,scaleNotes.length-1)
  firstNote=scaleNotes[rnd];
  maxInterval=n("max-interval-sel");
  maxCantidadNotas=n("quantity-notes-sel");

  myMelody="";
  myMelody+=firstNote+" ";
  arrMelody=[];
  arrMelody[0]=firstNote;

  z=1; 
  for(let i=0; i<maxCantidadNotas-1;i++){
    x=0;
    for(;;){

      num=_.random(1,maxInterval);
      if(_.random(0,1)) 
        next=rnd+num;
      else
        next=rnd-num;

      if(next>=0 && next<=scaleNotes.length && typeof scaleNotes[next] !== "undefined" && arrMelody[z-1]!=scaleNotes[next]){

          if(getDistance(arrMelody[z-1],scaleNotes[next])<=maxInterval){
            //console.log("pass");
            break;
          }
        
      }

      if(x>=100){
        next=_.random(0,scaleNotes.length-1);
        console.log("prevent error");

        break;
      }
      x++;


    }

    myMelody+=scaleNotes[next]+" ";
    arrMelody[z]=scaleNotes[next];
    z++;
  }

  //genero melodía



  //alert(scaleIntervals);
  //alert(scaleNotes);
  //alert(myMelody);

  //console.log(myMelody);

  return myMelody;
}

currentMelody="";
melodyIndex=0;
melodyIndex1=0;
melodyArray=[];
melodyArray1=[];
finishMelody=0;

function playMelody(x,y){


  if(x==0){

    /*
    currentMelody=x;
    melodyArray=[];*/
   
    melodyIndex=0;
    melodyArray=y.split(" ");
     

  }

  //console.log(melodyArray[melodyIndex])
  
  synth.triggerAttackRelease(melodyArray[melodyIndex], n("delay-note-sel")/1000).connect(panner);  
  
  melodyIndex++;

  if(melodyIndex<melodyArray.length-1){

    
    setTimeout(function(){
    
      playMelody(1,"");


    },n("delay-note-sel"))
    /*
    setTimeout(function(index){
      return function() {  console.log(voiceSelected); playMelody(1,"",voiceSelected); }
    }(voiceSelected), n("delay-note-sel"));*/


  }
}
function playMelody1(x,y){


  if(x==0){

    /*
    currentMelody=x;
    melodyArray=[];*/
   
    melodyIndex1=0;
    melodyArray1=y.split(" ");
    console.log(melodyArray1);
     
  }

  //console.log(melodyArray[melodyIndex])
  
  synth1.triggerAttackRelease(melodyArray1[melodyIndex1], n("delay-note-sel")/1000).connect(panner1);     
  //synth1.triggerAttackRelease(melodyArray1[melodyIndex1], "8n").connect(panner1);     

  melodyIndex1++;

  if(melodyIndex1<melodyArray1.length-1){

    
    setTimeout(function(){
    
      playMelody1(1,"");


    },n("delay-note-sel"))
    /*
    setTimeout(function(index){
      return function() {  console.log(voiceSelected); playMelody(1,"",voiceSelected); }
    }(voiceSelected), n("delay-note-sel"));*/


  }
}
function playMelody2(x,y){

  if(x==0){


    /*
    currentMelody=x;
    melodyArray=[];*/
   
    melodyIndex=0;
    melodyArray=y.split(" ");
    console.log(melodyArray);
     

  }

  //console.log(melodyArray[melodyIndex])
  
  synth.triggerAttackRelease(melodyArray[melodyIndex], n("delay-note-sel")/1000).connect(panner2);     

  melodyIndex++;

  if(melodyIndex<melodyArray.length-1){

    
    setTimeout(function(){
    
      playMelody2(1,"");


    },n("delay-note-sel"))
    /*
    setTimeout(function(index){
      return function() {  console.log(voiceSelected); playMelody(1,"",voiceSelected); }
    }(voiceSelected), n("delay-note-sel"));*/


  }
}


$("#resultsList").hide();

$("#loading").hide();
//$("#controls-div").hide();
$("#stop1").hide();
$("#clearResultsList").hide();


function n(x){ return parseInt($("#"+x).val()); }

bMobile=0;
if( /Android|webOS|iPhone|iPad|iPod|Opera Mini/i.test(navigator.userAgent) ) {
  bMobile=1;
  $(".fb-share-button").hide();
} 


arrayImages=[];
arrayImages1=[];
arrayImages2=[];
arrayPreloadImages=[];

zPreload=0;
imgLoadedCount=0;

bOnGame=0;

var tcAct=0;
var cAct=0, iAct=0, sAct=1;
var salidas = [], salidas1 = [],cantidadBack=2, pasadas=36, currentPasada=0;
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
var cantidadLoci=2;

var bVariable=1;
var currentVariable=1;
var realCantidadBack=1;
var sel=0;
var max=0;
var kill2;
var kill3;
var time;
var bMismo=0;
var posibleMismo="";


var arrayClaro=[],arrayOscuro=[];

function generateColors(){


  for(i=0;i<15;i++){
    arrayClaro[i]=[]  

    a=_.random(0,360)
    b=50//_.random(25,40) // 75
    c=_.random(58,63)

    arrayClaro[i][0]=a
    arrayClaro[i][1]=b
    arrayClaro[i][2]=c

  }
  for(i=0;i<15;i++){
    arrayOscuro[i]=[]  

    a=_.random(0,360)
    b=50//_.random(60,75) // 75
    c=_.random(20,26)

    arrayOscuro[i][0]=a
    arrayOscuro[i][1]=b
    arrayOscuro[i][2]=c
  }

  
}

var arrayMemo=[],arrayMemo1=[];
palabras_english=["zoo", "nose",  "rose",  "cheese",  "fez", "tie", "net", "rod", "sheet", "fit", "Noah",  "nun", "rain",  "chain", "phone", "Ma",  "Nemo",  "ram", "chum",  "foam", "Rye", "Nero",  "rower", "cherry",  "fur", "law", "nail",  "roll",  "jail",  "file", "shoe",  "notch", "roach", "choo", "choo", "fish", "cow", "neck",  "rock",  "chalk", "fog", "ivy", "knife", "roof",  "chef",  "FiFi", "bee", "knob",  "rope",  "ship",  "fob", "toes", "mice",  "lace",  "case",  "bus", "tot", "mat", "loot",  "cot", "bat", "tin", "moon",  "lion",  "coin",  "bone", "tomb",  "mummy", "loom",  "comb",  "bum", "tyre",  "mower", "lure",  "car", "bear", "towel", "mule",  "lily",  "coal",  "bell", "dish",  "match", "leech", "cage",  "beach", "tack",  "mug", "log", "coke",  "book",  "dove",  "movie", "lava",  "cave",  "poof", "tub", "mop", "lip", "cob", "pipe" ];



function creaMemoria(){

  estadoMemorizar=1;

  if(idioma==1)
    arrayMemo=_.extend(window.palabras);
  else
    arrayMemo=_.extend(palabras_english);


  arrayMemo=_.shuffle(arrayMemo);

  arrayMemo1=[];

  for(i=0;i<20;i++){

    arrayMemo1[i]=[];

    arrayMemo1[i][0]=arrayMemo[i];
    arrayMemo1[i][1]=arrayMemo[20+i];
    arrayMemo1[i][2]=arrayMemo[40+i];
    arrayMemo1[i][3]=arrayMemo[60+i];
    arrayMemo1[i][4]=arrayMemo[80+i];

  }

  poner="";

  for(i=0;i<7;i++){

    poner += "<b>" + arrayMemo1[i][0] + " is " + arrayMemo1[i][1] + "</b><br>"; 
  }

  $("#canvas").html("<center>"+poner+"<br><br> key L (Truth) to Start.</center>");


}



function play(_xxx){

  if(_xxx==0){

    if(bOnGame)
      return;

    generateColors();

    bVariable=n("isVariable");

    cantidadElementos=n("cantidadElementos");
    cantidadLoci=n("cantidadLoci");

    realCantidadBack=parseInt($("#cantidadBack").html());
    //console.log(realCantidadBack);

    cantidadBack=realCantidadBack;
    currentVariable=cantidadBack;

    $("#stop1").show();

    $("#resultsList").hide();
    
    bOnGame=1;

    imgLoadedCount=0;

    //$("#preload").show(); 
      //$("#loading").show(); 
      //$("#controls-div").hide();

      rndPorcentaje=parseInt($("#rndPorcentaje").val());

    salidas=[]; 
     salidas1=[]; 
  

    currentPasada=0;
    pasadas = 20 + (cantidadBack-1) * 6;  

    ok=0; ok1=0; ok2=0; ok3=0; ok4=0; ok5=0;
    error=0; error1=0; error2=0; error3=0; error4=0; error5=0;

    myInterval=parseInt($("#timeValue").val());
    myInterval1=parseInt($("#timeValue1").val());

    clearTimeout(killInterval); 
    
    clearInterval(kill2); 
    clearInterval(kill3); 

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

     //arrayImages1=[0,1,2,3,4,5,6,7,8,9];
     creaMemoria();
     return;

  }//end x==0

  estadoMemorizar=0;


  bOnGame=1; 

  bIntroducir=0; bIntroducir1=0; bIntroducir2=0; bIntroducir3=0; bIntroducir4=0; bIntroducir5=0;  

   //position match error
   
   if(currentPasada>cantidadBack && bOk==0){

      _s=currentPasada-1;
      _b=currentPasada-1-cantidadBack;

      if(salidas[_s]==salidas[_b] /*&& salidas[_s][1]==salidas[_b][1]*/){
        console.log("e pm");
         error++;
         $("#pm").css("color","red");
         actualizarErrores();
         setTimeout(function(){ $("#pm").css("color","black"); },300);
      }
   }
   bOk=0;
   

   //sound match error
   if(currentPasada>cantidadBack && bOk1==0){

      _s=currentPasada-1;
      _b=currentPasada-1-cantidadBack;

      if(salidas1[_s]==salidas1[_b]){
         error1++;
         $("#sm").css("color","red");
         actualizarErrores();
         setTimeout(function(){ $("#sm").css("color","black"); },300);
      }
   }
   bOk1=0;


  //Loci match error
  /*
  if(currentPasada>cantidadBack && bOk==0){

      _s=currentPasada-1;
      _b=currentPasada-1-cantidadBack;

      comparar=-1; comparar1=-1; comparar2=-1;

      if(cantidadLoci==2)
       comparar=salidas[_b][1];

     if(cantidadLoci==3){
       comparar=salidas[_b][1];
       comparar1=salidas[_b][2];
     }

     if(cantidadLoci==4){
       comparar=salidas[_b][1];
       comparar1=salidas[_b][2];
       comparar2=salidas[_b][3];
     }

     if(salidas[_s][0]==salidas[_b][0] && salidas[_s][1]==comparar && salidas[_s][2]==comparar1 && salidas[_s][3]==comparar2){
        //console.log("e pm");
         //error++;
         $("#pm").css("color","red");
         actualizarErrores();
         setTimeout(function(){ $("#pm").css("color","black"); },500);
     }
    }
  bOk=0;

  //Number match error
  if(currentPasada>cantidadBack && bOk1==0 && sAct>0){

    _s=currentPasada-1;
    _b=currentPasada-1-cantidadBack;

    comparar=-1; comparar1=-1; comparar2=-1; comparar3=-1; comparar4=-1; comparar5=-1; comparar6=-1;

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

     if(cantidadElementos==5){
       comparar=salidas1[_b][1];
       comparar1=salidas1[_b][2];
       comparar2=salidas1[_b][3];
       comparar3=salidas1[_b][4];
     }

     if(cantidadElementos==6){
       comparar=salidas1[_b][1];
       comparar1=salidas1[_b][2];
       comparar2=salidas1[_b][3];
       comparar3=salidas1[_b][4];
       comparar4=salidas1[_b][5];
     }

     if(cantidadElementos==7){
       comparar=salidas1[_b][1];
       comparar1=salidas1[_b][2];
       comparar2=salidas1[_b][3];
       comparar3=salidas1[_b][4];
       comparar4=salidas1[_b][5];
       comparar5=salidas1[_b][6];
     }

    if(cantidadElementos==8){
       comparar=salidas1[_b][1];
       comparar1=salidas1[_b][2];
       comparar2=salidas1[_b][3];
       comparar3=salidas1[_b][4];
       comparar4=salidas1[_b][5];
       comparar5=salidas1[_b][6];
       comparar6=salidas1[_b][7];
     }

    if(salidas1[_s][0]==salidas1[_b][0] && salidas1[_s][1]==comparar && salidas1[_s][2]==comparar1 && salidas1[_s][3]==comparar2 && salidas1[_s][4]==comparar3  && salidas1[_s][5]==comparar4  && salidas1[_s][6]==comparar5  && salidas1[_s][7]==comparar6){
       error1++;
       $("#sm").css("color","red");
       actualizarErrores();
       setTimeout(function(){ $("#sm").css("color","black"); },500);
    }
  }*/
  bOk1=0;

  if(pasadas==0){
     $("#stop1").hide();
     $("#canvas").html("");
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
         pasadas = 20 + (cantidadBack-1) * 6;
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
         recomendacion="";
      }

      //ok=1; ok1=1; ok2=1; ok3=1; error=1; error1=1; error2=1; error3=1;  

      positionTxt = ""; soundTxt = ""; imageTxt= ""; colorTxt=""; vaTxt=""; avTxt="";
      if(ok!=0 || error!=0){

        positionTxt="Logic:"+ok+"-"+error;

      }
      if(ok1!=0 || error1!=0){

        soundTxt="Logic: "+ok1+"-"+error1;

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
         "Score: "+ porcentaje_ok + "%<br>" + recomendacion + "<br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br>";

      $("#results").html(txt);
      //$("#canvas").html(`<div id="canvas11">Hello!<br>Here the instructions of the original nback game to guide you in locinback: <a href="http://brainworkshop.sourceforge.net/tutorial.html">http://brainworkshop.sourceforge.net/tutorial.html</a></div>`);

      bOnGame=0;

      $("html, body").animate({ scrollTop: $(document).height() }, 1000);

      //limpiar();

       clearTimeout(killInterval);
      clearTimeout(kill2);
      clearTimeout(kill3);

      return;

   }

   /*
    if(bVariable==1){
    
      currentVariable=_.random(1,realCantidadBack);
      //console.log(realCantidadBack);
      cantidadBack=currentVariable;

    }*/

    /*

   _r=_.random(1,100);
   //console.log(_r);

   //Position
  
   _txt="misma";
   if(currentPasada>cantidadBack && _r<=rndPorcentaje){
      _poner = currentPasada-cantidadBack;
      __x=salidas[_poner][0];
      __y=salidas[_poner][1];
  
      mismo++;
     
   }else{
      _txt="random";
   

      for(;;){
       
         __x = _.random(0,2);
         __y = _.random(0,2);
         
         
         if(__x!=1 || __y!=1){
            if(currentPasada>cantidadBack){

               if(__x!=salidas[currentPasada-cantidadBack][0] && __y!=salidas[currentPasada-cantidadBack][1]){
                  break;
               }
            }else{

              
               if(currentPasada>0){
                   if(_x!=salidas[currentPasada-1][0] && _y!=salidas[currentPasada-1][1] && _z!=salidas[currentPasada-1][2])
                     break;

               }
               if(currentPasada==0)
                  break; 


            }
              
         }
         
       // break;
      }//for  
   }//currentPasada>cantidadBack
   */


   /////////////////////////////////////////////////////////////////////////////

    //Sound 0
  _r=_.random(1,100);;
  _txt="misma";

  if((currentPasada>cantidadBack && _r<=rndPorcentaje)/* || currentPasada==2*/){

    _poner = currentPasada-cantidadBack;

    _myImagen=salidas[_poner];
      
    mismo++; bMismo=1;

    //console.log("vis & n-vis: " + _myImagen + "-" + _myImagen2 + "-" + _myImagen3);   
   }else{//currentPasada>cantidadBack
      _txt="random";
      
      contador=0;


      /*
      bMismo=0;

      _pon = currentPasada-cantidadBack;

      if(currentPasada>cantidadBack)
        posibleMismo = salidas1[_pon];
      else
        posibleMismo = _.random(0,9)+""+_.random(0,9);*/


      for(;;){

         _myImagen=createMelody(); 

        //checkear
         if(currentPasada>cantidadBack){
            if(_myImagen!=salidas[currentPasada-cantidadBack])
               break;        
         }else{
               break;

         }
          
           //break;
      }//for  
   }//currentPasada>cantidadBack

   //Sound 1
  _r=_.random(1,100);;
  _txt="misma";

  if((currentPasada>cantidadBack && _r<=rndPorcentaje)/* || currentPasada==2*/){

    _poner = currentPasada-cantidadBack;

    _myImagen1=salidas1[_poner];
      
    mismo1++; bMismo=1;

    //console.log("vis & n-vis: " + _myImagen + "-" + _myImagen2 + "-" + _myImagen3);   
   }else{//currentPasada>cantidadBack
      _txt="random";
      
      contador=0;


      /*
      bMismo=0;

      _pon = currentPasada-cantidadBack;

      if(currentPasada>cantidadBack)
        posibleMismo = salidas1[_pon];
      else
        posibleMismo = _.random(0,9)+""+_.random(0,9);*/


      for(;;){

         _myImagen1=createMelody(); 

        //checkear
         if(currentPasada>cantidadBack){
            if(_myImagen1!=salidas1[currentPasada-cantidadBack])
               break;        
         }else{
               break;

         }
          
           //break;
      }//for  
   }//currentPasada>cantidadBack
    
   //salidas[currentPasada]=[];

   //console.log(salidas[currentPasada])
/*
   salidas[currentPasada][0] = __x;
   salidas[currentPasada][1] = __y;
*/
   //console.log(currentPasada+"-"+__x+"-"+__y+"-"+ salidas[currentPasada][1]);
   //console.log(salidas[currentPasada][1]);

   /*
   salidas1[currentPasada]=[];*/

   requerido=_.random(0,1)

   _poner = currentPasada-cantidadBack;
   anteriorLogic=salidas[_poner];

   bRepetir=0;
   currentLogicType="";

   if(currentPasada>cantidadBack && _.random(1,100)<=20) bRepetir=1

   for(;;){
    window.juegoReaction.logica(0); 

    currentLogicType="0";


     if(textLogic.search("smash")!=-1) currentLogicType="0";
    if(textLogic.search("wedge")!=-1) currentLogicType="1";
    if(textLogic.search("-&#62;")!=-1) currentLogicType="2";
    if(textLogic.search("&#60-&#62;")!=-1) currentLogicType="3";
    if(textLogic.search("xor")!=-1) currentLogicType="4";
    if(textLogic.search("nand")!=-1) currentLogicType="5";
    if(textLogic.search("nor")!=-1) currentLogicType="6";


    if(bRepetir){
       if(valueLogic==requerido && currentLogicType==anteriorLogic) break;


    }else{
      if(valueLogic==requerido) break;

    }

    




   }

   window.juegoReaction.logica(0); 

   _myImagen=valueLogic;
   _myImagen1=valueLogic;

   console.log(valueLogic);

   if(bColor){


    if(!bExperiment){
       
        options_options=_.shuffle(_.range(0,7));

        console.log(options_options)
        console.log(arrayMemo1)

       for(x=0;x<5;x++){     

        //console.log(arrayMemo1[options_options[x+5]][0])

        textLogic=textLogic.replace("V"," "+arrayMemo1[options_options[x]][0]+" is "+arrayMemo1[options_options[x]][1]).replace("F"," "+arrayMemo1[options_options[x+2]][0]+" is "+arrayMemo1[options_options[x+2]][_.random(2,4)])

       //if(idioma==1) $("#canvas").html(`<center>${textLogic}</center>`);
      }
      $("#canvas").html(`<center>${textLogic}</center>`);


    }else{
      aC=_.random(0,14)
      aO=_.random(0,14)

      for(x=0;x<10;x++){     

        

        textLogic=textLogic.replace("V",`<div class="circleGreen" style="background-color: hsl(${arrayClaro[aC][0]}, ${arrayClaro[aC][1]}%, ${arrayClaro[aC][2]}%);">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</div>`).replace("F",`<div class="circleRed" style="background-color: hsl(${arrayOscuro[aO][0]}, ${arrayOscuro[aO][1]}%, ${arrayOscuro[aO][2]}%);">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</div>`)

       //if(idioma==1) $("#canvas").html(`<center>${textLogic}</center>`);
      }
      $("#canvas").html(`<center>${textLogic}</center>`);

    }


   }else{
    if(idioma==1) $("#canvas").html(`<center>${textLogic}</center>`);
   if(idioma==2) $("#canvas").html(`<center>${textLogic.replace("V","T")}</center>`);

   }
   
   salidas[currentPasada]="0";

   if(textLogic.search("smash")!=-1) salidas[currentPasada]="0";
   if(textLogic.search("wedge")!=-1) salidas[currentPasada]="1";
   if(textLogic.search("-&#62;")!=-1) salidas[currentPasada]="2";
   if(textLogic.search("&#60-&#62;")!=-1) salidas[currentPasada]="3";
   if(textLogic.search("xor")!=-1) salidas[currentPasada]="4";
   if(textLogic.search("nand")!=-1) salidas[currentPasada]="5";
   if(textLogic.search("nor")!=-1) salidas[currentPasada]="6";



   


   salidas1[currentPasada]=_myImagen1;



  //  if(n("voice-sel")==1){
  //   playMelody(0,_myImagen1);

  //  }
    

  // if(n("voice-sel")==2){
  //   console.log(_myImagen+"-"+_myImagen1)
   
  //   playMelody1(0,_myImagen);
  //   playMelody2(0,_myImagen1);

  // }
    


   /*
  bRespuesta=0;
  test=0;
  

  at=n("at-sel");
  //test=0;

  max=n("milis-val");

  time=n("tt"+(test+1));

  p="+";

  $("#d"+ salidas[currentPasada][0] + "" + salidas[currentPasada][1] ).html("<center><b>"+p+"</b></center>");

  kill2=setTimeout(function(){ muestra(); },300);*/
    
   bIntroducir=1; bIntroducir1=1; bIntroducir2=1; bIntroducir3=1;  bIntroducir4=1;  bIntroducir5=1;
   pasadas--;

   $("#pasadas").html(pasadas);

  killInterval = setTimeout(function(){ currentPasada++; play(1);},myInterval);
  kill4=setTimeout(function(){ /*limpiar();*/ },myInterval1);
   

}//en play()


$(document).keypress(function(e) {
  console.log("");

  //console.log("key" + e.which);

  if(!bOnGame) return;

    
   //Position match letter A
       if(e.which==97){
           if(bIntroducir){
                 
            if(currentPasada+1>cantidadBack){
               //console.log(bIntroducir);
                _s=currentPasada;
                _b=currentPasada-cantidadBack;

                if(salidas[_s]==salidas[_b]){
                  bOk=1;
                  ok++;
                  //$("#ok").html(parseInt(ok)+parseInt(ok1));
                  actualizarOk();
                  $("#pm").css("color","green");
                  //console.log("ok-s");

                  
                }else{
                  $("#pm").css("color","red");

                  //console.log("error-s");
                  error++;
                  bOk=1;
                  //$("#error").html(parseInt(error)+parseInt(error1));
                  actualizarErrores();


                } //si coincide
            }//pasadas>cantidadBack
         }//bIntroducir
         bIntroducir=0;
         setTimeout(function(){ $("#pm").css("color","black"); },300);
          /*
         if(bIntroducir){
            
            if(currentPasada>cantidadBack){
                console.log("A");
               //console.log(bIntroducir);
                _s=currentPasada;
                _b=currentPasada-cantidadBack;

                if(salidas[_s][0]==salidas[_b][0] && salidas[_s][1]==salidas[_b][1]){
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
         setTimeout(function(){ $("#pm").css("color","black"); },300);*/
       }//wich a
      

       //Number letter L
       if(e.which==108){

        if(estadoMemorizar==1){

          play(1); return;
        }

         if(bIntroducir1 && sAct>0){
            
            
            if(currentPasada+1>cantidadBack){
               //console.log(bIntroducir);
                _s=currentPasada;
                _b=currentPasada-cantidadBack;

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
         setTimeout(function(){ $("#sm").css("color","black"); },300);
       }//wiich l

  //console.log(e.which);
});//on keypress


$("#mas").click(function(){
      cantidadBack++;
      pasadas = 20 + (cantidadBack-1) * 6;
      $("#cantidadBack").html(cantidadBack);
      $("#pasadas").html(pasadas);
      clearTimeout(killInterval);
      clearTimeout(kill2);
    clearTimeout(kill3);
      perdidas=0;
      

   });
   $("#menos").click(function(){
      if(cantidadBack==1)
         return;
       perdidas=0;
      cantidadBack--;
      pasadas = 20 + (cantidadBack-1) * 6;
      $("#cantidadBack").html(cantidadBack);
      $("#pasadas").html(pasadas);
      clearTimeout(killInterval);
      clearTimeout(kill2);
    clearTimeout(kill3);

   });

   //Match Buttons

   $("#pm, #controls-l, #footer-l").click(function(){

     if(bIntroducir){
                 
            if(currentPasada+1>cantidadBack){
               //console.log(bIntroducir);
                _s=currentPasada;
                _b=currentPasada-cantidadBack;

                if(salidas[_s]==salidas[_b]){
                  bOk=1;
                  ok++;
                  //$("#ok").html(parseInt(ok)+parseInt(ok1));
                  actualizarOk();
                  $("#pm").css("color","green");
                  //console.log("ok-s");

                  
                }else{
                  $("#pm").css("color","red");

                  //console.log("error-s");
                  error++;
                  bOk=1;
                  //$("#error").html(parseInt(error)+parseInt(error1));
                  actualizarErrores();


                } //si coincide
            }//pasadas>cantidadBack
         }//bIntroducir
         bIntroducir=0;
         setTimeout(function(){ $("#pm").css("color","black"); },300);
     /*

    if(bIntroducir){
            
            if(currentPasada>cantidadBack){
                console.log("A");
               //console.log(bIntroducir);
                _s=currentPasada;
                _b=currentPasada-cantidadBack;

                if(salidas[_s][0]==salidas[_b][0] && salidas[_s][1]==salidas[_b][1]){
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
         setTimeout(function(){ $("#pm").css("color","black"); },300);
  */

   });

   $("#sm, #controls-r, #footer-r").click(function(){

    if(estadoMemorizar==1){

          play(1); return;
        }


         if(bIntroducir1){
            
            if(currentPasada+1>cantidadBack){
               //console.log(bIntroducir);
                _s=currentPasada;
                _b=currentPasada-cantidadBack;

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
         setTimeout(function(){ $("#sm").css("color","black"); },300);

});

$("#stop1").click(function(){
    $("#stop1").hide();
    clearTimeout(killInterval);
    clearTimeout(kill2);
    clearTimeout(kill3);
    $("#canvas").html("");
    bOnGame=0;

});


if(bMobile==1){
    _ww=$(window).width();
    _wh=$(window).height();

    //$("#logo-span").html("Melody ");

    if(_ww<900){
      $("#footer").show();

      
    }else{
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

      $("#controls-l").hide();

      $("#cnv111").css("float","left");


    }
    
}

function getDistance(x,y){

  x1=0;
  for(let i=0;i<allNotes.length;i++){
    if(allNotes[i]==x){
      x1=i; break;
    }

  }
  x2=0;
  for(let i=0;i<allNotes.length;i++){
    if(allNotes[i]==y){
      x2=i; break;
    }
  }

  //console.log(x1-x2);

  return Math.abs(x1-x2);
}

arrayScales=[
["Major","1 1 1/2 1 1 1"],
["Pentatonic Major","1 1 1½ 1"],
["Blues Major","1½ 1 ½ ½ 1"],
["Minor","1 ½ 1 1 ½ 1"],
["Melodic Minor","1 ½ 1 1 1 1"],
["Armonic Minor","1 ½ 1 1 ½ 1½"],
["Pentatonic Minor","1½ 1 1 1½"],
["Blues Minor","1½ 1 ½ ½ 1½"],
["Augmented","1½ ½ 1½ ½ 1½"],
["Be-Bop","1 1 1½ 1 1 ½ ½"],
["Chromatic","½ ½ ½ ½ ½ ½ ½ ½ ½ ½ ½"],
["Whole-Half","1 ½ 1 ½ 1 ½ 1"],
["Half-Whole","½ 1 ½ 1 ½ 1 ½"],
["Whole Tone","1 1 1 1 1"],
["Augmented fifth","1 1 ½ 1 ½ ½ 1"],
["Algerian","1 ½ 1½ ½ ½ 1½"],
["Arabian","1 1 ½ ½ 1 1"],
["Balinese","½ 1 2 ½"],
["Bartok","1 1 1 ½ 1 ½"],
["Byzantine","½ 1½ ½ 1 ½ 1½"],
["Chinese","1 1 1½ 1"],
["Egyptian","1 1½ 1 1½"],
["Enigmatic","½ 1½ 1 1 1 ½"],
["Spanish","½ 1½ ½ 1 ½ 1"],
["Spanish 8 Tone","½ 1 ½ ½ ½ 1 1"],
["Ethiopian","1 ½ 1 1 ½ 1"],
["Gypsy","½ 1½ ½ 1 1 ½"],
["Hungarian Gypsy","1 ½ 1½ ½ ½ 1"],
["Hindu","1 1 ½ 1 ½ 1"],
["Iwato","½ 2 ½ 2"],
["Japanese","½ 2 1 ½"],
["Javanese","½ 1 1 1 1 ½"],
["Jewish","½ 1½ ½ 1 ½ 1"],
["Hawaiian","1 ½ 1 1 1 1"],
["Hirajoshi","1 ½ 2 ½"],
["Hungarian Minor","1 ½ 1½ ½ ½ 1½"],
["Hungarian Major","1½ ½ 1 ½ 1 ½"],
["Kumoi","½ 2 1 ½"],
["Leading Whole Tone","1 1 1 1 1 ½"],
["Mohammedan","1 ½ 1 1 ½ 1½"],
["Mongolian","1 1 1½ 1"],
["Neapolitan Minor","½ 1 1 1 ½ 1½"],
["Neapolitan Major","½ 1 1 1 1 1"],
["Oriental","½ 1½ ½ ½ 1½ ½"],
["Overtone","1 1 1 ½ 1 ½"],
["Pelog","½ 1 2 1½"],
["Persian","½ 1½ ½ ½ 1 1½"],
["Ionian","1 1 ½ 1 1 1"],
["Dorian","1 ½ 1 1 1 ½"],
["Phrygian","½ 1 1 1 ½ 1"],
["Lydian","1 1 1 ½ 1 1"],
["Mixolydian","1 1 ½ 1 1 ½"],
["Aeolian","1 ½ 1 1 ½ 1"],
["Locrian","½ 1 1 ½ 1 1"],
["Ionian Harmonic","1 ½ 1 1 ½ 1½"],
["Locrian Nat 6 Mode","½ 1 1 ½ 1½ ½"],
["Major Sharp 5 Mode","1 1 ½ 1½ ½ 1"],
["Dorian Sharp 4 Mode","1 ½ 1½ ½ 1 ½"],
["Phrygian Major Mode","½ 1½ ½ 1 ½ 1"],
["Lydian Sharp 2 Mode","1½ ½ 1 ½ 1 1"],
["Superlocrian Double Flat 7 Mode","½ 1 ½ 1 1 ½"],
["Jazz Minor Mode","1 ½ 1 1 1 1"],
["Dorian b2 Minor Mode","½ 1 1 1 1 1"],
["Lydian Augmented Minor Mode","1 1 1 1 ½ 1"],
["Lydian Flat 7 Minor Mode","1 1 1 ½ 1 ½"],
["Mixolydian Flat 6 Minor Mode","1 1 ½ 1 ½ 1"],
["Locrian Sharp 2 Minor Mode","1 ½ 1 ½ 1 1"],
["Super Locrian Minor Mode","½ 1 ½ 1 1 1"],
["Pentatonic Majeur Mode","1 1 1½ 1"],
["Pentatonic Majeur Mode 2","1 1½ 1 1½"],
["Pentatonic Majeur Mode 3","1½ 1 1½ 1"],
["Pentatonic Majeur Mode 4","1 1½ 1 1"],
["Pentatonic Dominant Mode","1 1 1½ 1½"],
["Pentatonic Minor Mode","1½ 1 1 1½"],
["Altered Pentatonic Mode","½ 1½ 1½ 1"],
["Blues Mode","1½ 1 ½ ½ 1"],
["Major Arpeggio","2 1½"],
["Minor Arpeggio","1½ 2"],
["Major 7th Major Arpeggio","2 1½ 2"],
["Major 7th Minor Arpeggio","2 1½ 1½"],
["Minor 7th Major Arpeggio","1½ 2 2"],
["Minor 7th Minor Arpeggio","1½ 2 1½"],
["Major 9th Arpeggio","1 1 1½ 1½"],
["Minor 9th Arpeggio","1 ½ 2 1½"],
["Major 11th Arpeggio","1 1 ½ 1 1½"],
["Minor 11th Arpeggio","1 ½ 1 1 1½"],
["Major 13th Arpeggio","1 1 ½ 1 1 1½"],
["Minor 13th Arpeggio","1 ½ 1 1 1 ½"],
["Augmented Arpeggio","2 2"],
["Disminished Arpeggio","1½ 1½ 1½"]
];

poner=`<select id="selected-scale" style="width: 100px;"><option value="-1">random</option>`;
for(let i=0;i<arrayScales.length;i++){

  sel="";
  if(i==0){
    sel="selected";

  }
  poner+=`<option value="${i}" ${sel}>${arrayScales[i][0]}</option>`


}
poner+=`</select>`
$("#scale-span").html(poner);

//createMelody();
//playMelody(0,createMelody())

var textLogic="";
var valueLogic="";

// setTimeout( function(){ window.juegoReaction.logica(0); alert(textLogic) }, 1000 );


function makeLogic(){





}

$("#canvas").css("zoom","1.5");