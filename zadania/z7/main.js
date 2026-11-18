let aG = "O";

function uS(img) {
    const left = document.getElementById('left');
    const right = document.getElementById('right');

    if(!img.src.endsWith('nic.png')) {
        return;
    }
    if(aG === 'O') {
        img.src = 'o.png';
        img.alt = 'o.png';
        left.style.display = "none";
        right.style.display = "block";
        aG = "X";
    } else if (aG === "X") {
        img.src = 'x.png';
        img.alt = 'x.png';
        left.style.display = "block";
        right.style.display = "none";
        aG = "O";
    }
}
