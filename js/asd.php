/*
JavaScript Bible, Fourth Edition
by Danny Goodman 

John Wiley & Sons CopyRight 2001
*/



<HTML>
<HEAD>
<TITLE>Window Gymnastics</TITLE>
<SCRIPT LANGUAGE="JavaScript1.2">
var isNav4 = ((navigator.appName == "Netscape") && (parseInt(navigator.appVersion) >= 4))
// wait in onLoad for page to load and settle in IE
function init() {
    // fill missing IE properties
    if (!window.outerWidth) {
        window.outerWidth = document.body.clientWidth
        window.outerHeight = document.body.clientHeight + 30
    }
    // fill missing IE4 properties
    if (!screen.availWidth) {
        screen.availWidth = 640
        screen.availHeight = 480
    }
}
// function to run when window captures a click event
function moveOffScreen() {
    // branch for NN security
    if (isNav4) {
        netscape.security.PrivilegeManager.enablePrivilege("UniversalBrowserWrite")
    }
    var maxX = screen.width
    var maxY = screen.height
    window.moveTo(maxX+1, maxY+1)
    setTimeout("window.moveTo(0,0)",500)
    if (isNav4) {
        netscape.security.PrivilegeManager.disablePrivilege("UniversalBrowserWrite")
    }
}
// moves window in a circular motion
function revolve() {
    var winX = (screen.availWidth - window.outerWidth) / 2
    var winY = 50
    window.resizeTo(400,300)
    window.moveTo(winX, winY)
    
    for (var i = 1; i < 36; i++) {
        winX += Math.cos(i * (Math.PI/18)) * 5
        winY += Math.sin(i * (Math.PI/18)) * 5
        window.moveTo(winX, winY)
    }
}
// moves window in a horizontal zig-zag pattern
function zigzag() {
    window.resizeTo(400,300)
    window.moveTo(0,80)
    var incrementX = 2
    var incrementY = 2
    var floor = screen.availHeight - window.outerHeight
    var rightEdge = screen.availWidth - window.outerWidth
    for (var i = 0; i < rightEdge; i += 2) {
        window.moveBy(incrementX, incrementY)
        if (i%60 == 0) {
            incrementY = -incrementY
        }
    }
}
// resizes window to occupy all available screen real estate
function maximize() {
    window.moveTo(0,0)
    window.resizeTo(screen.availWidth, screen.availHeight)
}
</SCRIPT>
</HEAD>
<BODY onLoad="init()">
<FORM NAME="buttons">
<B>Window Gymnastics</B><P>
<UL>
<LI><INPUT NAME="offscreen" TYPE="button" VALUE="Disappear a Second" onClick="moveOffScreen()">
<LI><INPUT NAME="circles" TYPE="button" VALUE="Circular Motion" onClick="revolve()">
<LI><INPUT NAME="bouncer" TYPE="button" VALUE="Zig Zag" onClick="zigzag()">
<LI><INPUT NAME="expander" TYPE="button" VALUE="Maximize" onClick="maximize()">
</UL>
</FORM>
</BODY>
</HTML>