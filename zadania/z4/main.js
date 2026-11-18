var arrImg = ["1.jpg","2.jpg","3.jpg"];
var arrPlace = ["Barcelona","Rzym","Londyn"];
var i = 0;
var uczestnik = document.getElementById("uczestnik");
var rezerwacja = document.getElementById("rezerwacja")

uczestnik.style.backgroundColor = 'DodgerBlue';

const controlSectionOne = (active) => {
    document.getElementById("imie").disabled = !active;
    document.getElementById("nazwisko").disabled = !active;
}

const controlSectionTwo = (active) => {
    document.getElementById("sumP").disabled = !active;
    document.getElementById("placeP").disabled = !active;
    document.getElementById("r1").disabled = !active;
    document.getElementById("r2").disabled = !active;
    document.getElementById("r3").disabled = !active;
}

const uczestnikF = () => {
    uczestnik.style.backgroundColor = "DodgerBlue";
    rezerwacja.style.backgroundColor = "SkyBlue";
    controlSectionOne(true);
    controlSectionTwo(false);
}
const rezerwacjaF = () => {
    rezerwacja.style.backgroundColor = "DodgerBlue";
    uczestnik.style.backgroundColor = "SkyBlue";
    controlSectionOne(false);
    controlSectionTwo(true);
}

const showTrip = () => {
    document.getElementById("img").src = arrImg[i];
    document.getElementById("place").innerHTML = arrPlace[i];
}

const turnRight = () => {
    i = (i + 1) % arrImg.length;
    showTrip();
}
const turnLeft = () => {
    i = (i - 1 + arrImg.length) % arrImg.length;
    showTrip();
}