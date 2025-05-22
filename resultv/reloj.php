<head>
  <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
  <style type="text/css">
  #reloj2 {
    font-family: 'calibri';
    font-size: 26px;
    color: ffffff;
    text-align: center;
    /*border-radius: 20px;
    border: 2px dotted #EA1212;*/
    padding: -2px; 
    width: 300px;
    height: 60px;
    margin: 10px 970px;
    position: absolute;  
    //-webkit-box-shadow: 10px 10px 20px #aaa;;
    //-moz-box-shadow: 10px 10px 20px #aaa;;
   // background-color: 0A49BF;
}
  </style>
</head>
<div id="reloj2"> 
<SCRIPT>//style=" top: 10px;  font-size: 20px;"
 var tick;
 function stop() {
   clearTimeout(tick);
   }
 function simple_reloj() {
   var ut=new Date();
   var h,m,s;
   var time="        ";
   h=ut.getHours();
   m=ut.getMinutes();
   s=ut.getSeconds();
   if(s<=9) s="0"+s;
  if(m<=9) m="0"+m;
  if(h<=9) h="0"+h;
  time+=h+":"+m+":"+s;
  document.getElementById('reloj').innerHTML=time;
  tick=setTimeout("simple_reloj()",1000);    
  }
</SCRIPT>
<BODY  onLoad="simple_reloj();" onUnload="stop();">
<span id="reloj">reloj</span><br>




<font size="1">
<script languaje="JavaScript"> 
var mydate=new Date() 
var year=mydate.getYear() 
if (year < 1000) 
year+=1900 
var day=mydate.getDay() 
var month=mydate.getMonth() 
var daym=mydate.getDate() 
if (daym<10) 
daym="0"+daym 
var dayarray=new Array("Domingo,","Lunes,","Martes,","Miércoles,","Jueves,","Viernes,","Sábado")
var montharray=new Array("Enero","Febrero","Marzo","Abril","Mayo","Junio","Julio","Agosto","Septiembre","Octubre","Noviembre","Diciembre")
document.write("<font color='white' face='calibri' style='font-size:14pt' text-shadow='1px 000000'>"+dayarray[day]+" "+daym+" de "+montharray[month]+" de "+year+"</font>") 
</script></font>

</div>