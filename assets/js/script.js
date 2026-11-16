function checkdata(){
  var mypass=document.getElementById("pass");
  if(mypass.value.length<5){
    window.alert("La password deve essere di almeno 5 caratteri");
    return false;
  }
  return true;
}

function getXMLHttpRequestObject() {
  var ref = null;
  if (window.XMLHttpRequest) {
    ref = new XMLHttpRequest();
  } else if (window.ActiveXObject){
    ref = new ActiveXObject("MSXML2.XMLHTTP.3.0");
  }
  return ref;
}

function checkEmail() {
  let url=encodeURI("checkEmail.php?email="+document.getElementById("email").value);
  xhr = getXMLHttpRequestObject();
  xhr.onreadystatechange = function () {
    if ((xhr.readyState == 4) & (xhr.status == 200)) {
      window.alert(xhr.responseText);
    }
  }
  xhr.open('GET', url, true);
  xhr.send(null);
}
