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
    //Get datepicker selected date values
    var startDate = document.getElementById("s_date").value;
    var endDate = document.getElementById("e_date").value;
    //check if start date is selected
    if(startDate==""){
      alert("Please select a start date");
      document.getElementById("e_date").value ="";
    }
    //check if start date value is lower than end date value
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


//validation - check input value is integer or decimal numbers
function checkEnter(obj,obj2){
  //get textbox value from obj variable
  var value = document.getElementById(obj).value;
  //regex for numbers and decimals
  var rgex = /^$|[0-9]([.][0-9]{1,2})*$/
  if(rgex.test(value)){
  }
  else{
    //if value doesn't equal to regex *obj2 is message name passed with textbox id
    alert("Please enter correct value for "+obj2);
    //clear textbox
    document.getElementById(obj).value='';
  }
}
//validation - check input value is letters and spaces
function checkName(obj,obj2){
  //get textbox value from obj variable
  var value = document.getElementById(obj).value;
  //check if value isnot empty
  if( value != ""){
        //regex for letters and spaces
        var rgex = /^[a-zA-Z\s]*$/;
        if(rgex.test(value)){
        }
        else{
          //if value doesn't equal to regex *obj2 is message name passed with textbox id
          alert("Please enter letters for "+obj2);
          //clear textbox
          document.getElementById(obj).value='';
        }
  }
  }
//Declare jquery datepicker as default html date input not supported in some browsers
function datepicker(){
  //set start date picker
  if ( $('#s_date').prop('type') != 'date' ){
    $('#s_date').datepicker();
  }
  //set end date picker
  if ( $('#e_date').prop('type') != 'date' ){
    $('#e_date').datepicker();
  }
}

//getURL name and save it in a cookie to navigate to last opened page on each tab (Home/Settings)
function getURL(pname){
  //get current page link
  var page=window.location.href;
  //split url to get page name and extension
  var res = page.split("/");
  var finalres=res[res.length-1];
  //reset cookie
  document.cookie = pname+"=; expires=Thu, 01 Jan 1970 00:00:00 UTC;"
   //store filename in a cookie
  document.cookie =pname+"="+finalres;
  
  }

  //load last page
  function lastPage(pname){
  //check if last page is null at start, if yes redirect to a page.
  if(getCookie(pname) == null)
  {
    window.location.href ="useraccounts.php"
  }
  //redirect to last saved page
  else{
    window.location.href = getCookie(pname);
  }
    }
  
//function to read saved cookie
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



