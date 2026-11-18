function podmienObraz(nazwaPliku) {
    const glowny = document.getElementById('glownyObraz');
    glowny.src = nazwaPliku;
}
function otworzOkno() {
    const okno = document.getElementById('kontenerOkno');
    const oknoFoto = document.getElementById('oknoFoto');
    const glowny = document.getElementById('glownyObraz');
    okno.style.display = 'block';
    oknoFoto.src = glowny.src;
}
function zamknijOkno() {
    const okno = document.getElementById('kontenerOkno');
    okno.style.display = 'none'
}