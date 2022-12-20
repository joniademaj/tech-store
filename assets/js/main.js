const validateForm = (fields = []) => {

    for(let i = 0; i < fields.length; i++){
        let element = document.querySelector("." + fields[i].className);
        let inputValue = element.value;

        if(element.className == "email"){
            if(inputValue == "" || !inputValue.includes("@")){
                element.style.border = "1px solid red";
            }else{
                element.style.border = "1px solid black";
            }
        }if(element.className == "name"){
            if(inputValue == "" || inputValue.length < 4){
                element.style.border = "1px solid red";
            }else{
                element.style.border = "1px solid black";
            }
        }if(element.className == "password"){
            if(inputValue == "" || inputValue.length < 4){
                element.style.border = "1px solid red";
            }else{
                element.style.border = "1px solid black";
            }
        }if(element.className == "confirm-password"){
            console.log(fields[i - 1].value);
            if(inputValue == "" || fields[i - 1].value != inputValue){
                element.style.border = "1px solid red";
            }else{
                element.style.border = "1px solid black";
            }
        }
    }

}

const slider = document.querySelector(".slider");
const sliderLeftBtn = document.getElementById("slider-left-btn");
const sliderRightBtn = document.getElementById("slider-right-btn");
const sliderProducts = document.querySelector(".slider-product-cards");

let folder = "images/";
let images = ["1.png", "2.png", "3.png"];
let currentImage = 0;
// var menu = true;

const leftBtn = document.querySelector(".left-btn");
const rightBtn = document.querySelector(".right-btn");

try {
    leftBtn.addEventListener("click", () => {
        sliderProducts.scrollLeft -= 100;
    })
    
    rightBtn.addEventListener("click", () => {
        sliderProducts.scrollLeft += 100;
    })


    document.querySelector(".slider-image").innerHTML = `<img src=${folder}${images[currentImage]} />`;

    sliderLeftBtn.addEventListener("click", () => {
        if(currentImage != 0){
            currentImage--;
            document.querySelector(".slider-image").innerHTML = `<img src="${folder}${images[currentImage]}" />`
        }else{
            currentImage = images.length - 1;
            document.querySelector(".slider-image").innerHTML = `<img src="${folder}${images[currentImage]}" />`
        }
    })

    sliderRightBtn.addEventListener("click", () => {
        if(currentImage < images.length - 1){
            currentImage++;
            document.querySelector(".slider-image").innerHTML = `<img src="${folder}${images[currentImage]}" />`
        }else{
            currentImage = 0;
            document.querySelector(".slider-image").innerHTML = `<img src="${folder}${images[currentImage]}" />`
        }

    })
}
catch(err) {
    console.log(err);
}

const menuIcon = document.querySelector(".burger");
const firstLine = document.querySelector(".first-line");
const middleLine = document.querySelector(".middle-line");
const thirdLine = document.querySelector(".third-line");
const navBar = document.querySelector(".second-nav");
const ul = document.querySelector(".ul");

menuIcon.addEventListener("click", () => {
    middleLine.classList.toggle("activeMiddleLine");
    firstLine.classList.toggle("activeFirstLine");
    thirdLine.classList.toggle("activeThirdLine");
    navBar.classList.toggle("active");
    ul.classList.toggle("navbar");
    console.log(navBar);
});
