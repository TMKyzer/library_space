{"filter":false,"title":"roomtimetable.js","tooltip":"/roomtable/roomtimetable.js","undoManager":{"mark":0,"position":0,"stack":[[{"start":{"row":0,"column":0},"end":{"row":16,"column":1},"action":"insert","lines":["// When the user scrolls the page, execute myFunction ","window.onscroll = function() {myFunction()};","","// Get the navbar","var navbar = document.getElementById(\"navbar\");","","// Get the offset position of the navbar","var sticky = navbar.offsetTop;","","// Add the sticky class to the navbar when you reach its scroll position. Remove \"sticky\" when you leave the scroll position","function myFunction() {","  if (window.pageYOffset >= sticky) {","    navbar.classList.add(\"sticky\")","  } else {","    navbar.classList.remove(\"sticky\");","  }","}"],"id":1}]]},"ace":{"folds":[],"scrolltop":0,"scrollleft":0,"selection":{"start":{"row":9,"column":43},"end":{"row":9,"column":43},"isBackwards":false},"options":{"guessTabSize":true,"useWrapMode":false,"wrapToView":true},"firstLineState":0},"timestamp":1557239549480,"hash":"e7e7eb4d18c0c41b0694d2fcfeb97fc092f6970f"}