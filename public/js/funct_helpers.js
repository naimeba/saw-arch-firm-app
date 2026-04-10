function openForm(idElement) {
    document.getElementById(idElement).style.display = "block";
  }
  
function closeForm(idElement) {
    document.getElementById(idElement).style.display = "none";
}

function loadProfile() {
    var xhttp = new XMLHttpRequest();
  xhttp.onreadystatechange = function() {
    if (this.readyState == 4 && this.status == 200) {
      document.getElementById("userid").innerHTML =
      this.responseText;
      
      if (this.responseText.length > 0){ 
        closeForm("loginid");

        var aShowProfile = document.createElement("a");
        aShowProfile.appendChild( document.createTextNode("Show Profile"));
        var aShowProfileAttr = document.createAttribute("href");
        aShowProfileAttr.value="show_profile.php";
        aShowProfile.setAttributeNode(aShowProfileAttr);

        var aUpdateProfile = document.createElement("a");
        aUpdateProfile.appendChild(document.createTextNode("Update Profile"));
        var aUpdateProfileAttr = document.createAttribute("href");
        aUpdateProfileAttr.value="update_profile.html";
        aUpdateProfile.setAttributeNode(aUpdateProfileAttr);

        var aCreateBlogProfile = document.createElement("a");
        aCreateBlogProfile.appendChild(document.createTextNode("New Blog Page"));
        var aCreateBlogProfileAttr = document.createAttribute("href");
        aCreateBlogProfileAttr.value="blog.html";
        aCreateBlogProfile.setAttributeNode(aCreateBlogProfileAttr);

        var aLogoutProfile = document.createElement("a");
        aLogoutProfile.appendChild(document.createTextNode("Log Out"));
        var aLogoutProfileAttr = document.createAttribute("href");
        aLogoutProfileAttr.value="logout.php";
        aLogoutProfile.setAttributeNode(aLogoutProfileAttr);

        var menudropdown = document.getElementById("myDropdown");
        menudropdown.appendChild(aCreateBlogProfile);
        menudropdown.appendChild(aShowProfile);
        menudropdown.appendChild(aUpdateProfile);
        menudropdown.appendChild(aLogoutProfile);
        var tobeRemoved = document.getElementById("linklogin");
        var tobeRemoved2 = document.getElementById("linkregister");
        menudropdown.removeChild(tobeRemoved);
        menudropdown.removeChild(tobeRemoved2);

      }
    }
  };
  xhttp.open("GET", "load_profile.php", true);
  xhttp.send();
}

function copyKeyWords(){
   var inKey =  document.getElementById("inputKeyWords");
   inKey.select();
   inKey.setSelectionRange(0, 99999)

    document.getElementById("storedKeyWord").value = document.getElementById("storedKeyWord").value + ' '+ inKey.value;
    openForm("storedidbtn");
    openForm("keywords");
}
function deleteKeyWords(){
  var str=document.getElementById("storedKeyWord").value;
  var pos= str.lastIndexOf(" ");
  document.getElementById("storedKeyWord").value= str.substr(0,pos);
  
  if (document.getElementById("storedKeyWord").value.length == 0){
    document.getElementById("storedKeyWord").style.display = "none";
    document.getElementById("storedidbtn").style.display = "none";
  }
}

function changeMenuIcon(x) {
  x.classList.toggle("change");
  if (document.getElementById("myDropdown").style.display == "block") {
    document.getElementById("myDropdown").style.display = "none";
  } else {
    document.getElementById("myDropdown").style.display = "block";
  }
}

window.onclick = function(event) {
  if (!event.target.matches('.dropbtn')) {
    var dropdowns = document.getElementsByClassName("dropdown-content");
    var i;
    for (i = 0; i < dropdowns.length; i++) {
      var openDropdown = dropdowns[i];
      if (openDropdown.classList.contains('show')) {
        openDropdown.classList.remove('show');
      }
    }
  }
}