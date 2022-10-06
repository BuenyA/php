function colorSwitchPKW() {
    document.getElementById('PKW').style.backgroundColor = 'rgb(255, 77, 0)';
    document.getElementById("filterBoxLeftPKWImg").style.filter="invert(100%)";
    document.getElementById('MOPED').style.backgroundColor = 'white';
    document.getElementById("filterBoxLeftMOPEDImg").style.filter="invert(0%)";
    document.getElementById('LKW').style.backgroundColor = 'white';
    document.getElementById("filterBoxLeftLKWImg").style.filter="invert(0%)";
}

function colorSwitchMOPED() {
    document.getElementById('PKW').style.backgroundColor = 'white';
    document.getElementById("filterBoxLeftPKWImg").style.filter="invert(0%)";
    document.getElementById('MOPED').style.backgroundColor = 'rgb(255, 77, 0)';
    document.getElementById("filterBoxLeftMOPEDImg").style.filter="invert(100%)";
    document.getElementById('LKW').style.backgroundColor = 'white';
    document.getElementById("filterBoxLeftLKWImg").style.filter="invert(0%)";
}

function colorSwitchLKW() {
    document.getElementById('PKW').style.backgroundColor = 'white';
    document.getElementById("filterBoxLeftPKWImg").style.filter="invert(0%)";
    document.getElementById('MOPED').style.backgroundColor = 'white';
    document.getElementById("filterBoxLeftMOPEDImg").style.filter="invert(0%)";
    document.getElementById('LKW').style.backgroundColor = 'rgb(255, 77, 0)';
    document.getElementById("filterBoxLeftLKWImg").style.filter="invert(100%)";
}