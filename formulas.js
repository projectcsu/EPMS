
function calSalary(){


    $wh=+document.getElementById('work/hours').value;
    $ot=+document.getElementById('o/t_hours').value;
    $rph=+document.getElementById('rph').value;
    $rph_ot=+document.getElementById('rph_o/t').value;


    $total=($wh*$rph)+ ($ot*$rph_ot);
    
    return $total;
   
}

function selectAll() {
    $items = document.getElementsByName('deleteKey[]');
    $selectkey= document.getElementsByName('selectKey[]');
    for (var i = 0; i < $items.length; ++i) {
       
          if($selectkey[0].checked==true){

              $items[i].checked=true;

          }
          else{
            $items[i].checked = false;
          }
          
    }

}
  function checkDate() {
    var startDate = document.getElementById("s_date").value;
    var endDate = document.getElementById("e_date").value;

    if(startDate=="")
    {
      alert("Please select a start date");
      document.getElementById("e_date").value ="";
    }
    if ((Date.parse(endDate) < Date.parse(startDate))) {
      alert("Please select a date not below "+startDate);
      document.getElementById("e_date").value ="";
    }
    
  }

  function loadCombo()
{
  window.location.href = "payments.php";
}



function loadEmp(obj)
{
  
  var empidindex =obj.selectedIndex;
  $empid=obj.options[empidindex].text;  
  window.location.href = "payments.php?empid=" + $empid;
}



function checkEnter(obj,obj2){

  var value = document.getElementById(obj).value;
  var rgex = /^$|[0-9]([.][0-9]{1,2})*$/
  if(rgex.test(value)){
  }
  else{
    alert("Please enter correct value for "+obj2);
    document.getElementById(obj).value='';
  }
}

function checkName(obj,obj2){

  var value = document.getElementById(obj).value;
  if( value != ""){
  var rgex = /^[a-z][a-z\s]*$/
  if(rgex.test(value)){
  }
  else{
    alert("Please enter letters for "+obj2);
    document.getElementById(obj).value='';
  }
  }
  }

function datepicker(){
    
 
  if ( $('#s_date').prop('type') != 'date' )
  {
    $('#s_date').datepicker();
  }
  if ( $('#e_date').prop('type') != 'date' )
  {
    $('#e_date').datepicker();
  }

 
}

function getURL(pname){

  var page=window.location.href;
  var res = page.split("/");
  var finalres=res[res.length-1];
  document.cookie = pname+"=; expires=Thu, 01 Jan 1970 00:00:00 UTC;"
  document.cookie =pname+"="+finalres;
  
  }
  function lastPage(pname){
    
  if(getCookie(pname) == "")
  {
    window.location.href ="useraccounts.php"
  }
  else{
    window.location.href = getCookie(pname);
  }
    }
  

function getCookie(name) {
  var cookieArr = document.cookie.split(";");
  for(var i = 0; i < cookieArr.length; i++) {
      var cookiePair = cookieArr[i].split("=");
  
      if(name == cookiePair[0].trim()) {
         
          if( cookiePair[2] ==null){
            return decodeURIComponent(cookiePair[1]);
          }
          else{
            return decodeURIComponent(cookiePair[1]+"="+cookiePair[2]);
          }
      }
  }
  return null;
}



