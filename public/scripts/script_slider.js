const slider = document.querySelector(".aktuality-slider")

const leftArrow = document.querySelector(".left")
const rightArrow = document.querySelector(".right")

const indicatorParents = document.querySelector(".controls ul")

let num_sections = 3
let trans_perct = 100/num_sections

var sectionIndex = 0
var mouseOn = true

function moveRight() {
    sectionIndex = (sectionIndex < (num_sections-1)) ? sectionIndex + 1 : (num_sections - 1)
    document.querySelector(".controls .selected").classList.remove("selected")
    indicatorParents.children[sectionIndex].classList.add("selected")
    slider.style.transform = "translate("+ (sectionIndex * (-1) * trans_perct) + "%)";
}

function moveLeft() {
    sectionIndex = (sectionIndex > 0) ? sectionIndex - 1 : 0
    document.querySelector(".controls .selected").classList.remove("selected")
    indicatorParents.children[sectionIndex].classList.add("selected")
    slider.style.transform = "translate("+ (sectionIndex * (-1) * trans_perct) + "%)";
}

function selectSlide(indicator, ind) {
    indicator.addEventListener("click", function(){
        sectionIndex = ind
        document.querySelector(".controls .selected").classList.remove("selected")
        indicator.classList.add("selected")
        slider.style.transform = "translate("+ (sectionIndex * (-1) * trans_perct) + "%)";
    })
}

rightArrow.addEventListener("click", moveRight)
leftArrow.addEventListener("click", moveLeft)

document.querySelectorAll(".controls li").forEach(selectSlide)

function autoPlay() {
    if (mouseOn === true) {
        sectionIndex = (sectionIndex < (num_sections-1)) ? sectionIndex + 1 : 0
        document.querySelector(".controls .selected").classList.remove("selected")
        indicatorParents.children[sectionIndex].classList.add("selected")
        slider.style.transform = "translate("+ (sectionIndex * (-1) * trans_perct) + "%)";
        setTimeout(autoPlay, 3000)
    } 
}

document.querySelector(".aktuality-carusel").onmouseover = function () {
    mouseOn = false
    console.log(mouseOn)
    setTimeout(autoPlay, 3000)
}

setTimeout(autoPlay, 3000)