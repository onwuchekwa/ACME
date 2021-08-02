//Date function
function getFullDate() {
    const monthNames = ['January', 'February', 'March', 'April', 'May', 'June', 'July', 'August', 'September', 'October', 'November', 'December'];
    const dt = new Date();
    const date = dt.getDate();
    const monthName = monthNames[dt.getMonth()];
    const fullYear = dt.getFullYear();
    const date_value = `${date} ${monthName}, ${fullYear}`;
    return date_value;
}

//Footer Date
document.getElementById("lastUpdated").innerHTML = getFullDate();

// Add active class to the current button (highlight it)
var path = window.location.href.split("=").pop();

var liContainer = document.getElementById("navMenu");
const navAnchor = liContainer.getElementsByClassName('mainMenu');

for (var i = 0; i < navAnchor.length; i++) {  
  var liAnchor = navAnchor[i].getElementsByTagName("a");
  for (var j = 0; j < liAnchor.length; j++) {
    linkPath = liAnchor[j].getAttribute("href").split("=").pop();
    if (linkPath === path) {
      var current = document.getElementsByClassName("active");
      current[0].className = current[0].className.replace(" active", "");
      navAnchor[i].className += " active";
    } 
  }
}