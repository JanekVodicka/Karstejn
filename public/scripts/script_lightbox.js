
const picture = document.getElementsByClassName("pic")

// Create elements
// for lightbox
const lightBoxContainer = document.createElement("div")
// for basic area
const lightBoxContent = document.createElement("div")
// for Image
const lightBoxImg = document.createElement("img")
// for "Prev button"
const lightBoxPrev = document.createElement("i")
// for "Next button"
const lightBoxNext = document.createElement("i")
// for "Close button"
const lightClose = document.createElement("i")

// Create Classlist
// for lightbox
lightBoxContainer.classList.add("lightbox")
// for basic area
lightBoxContent.classList.add("lightbox-content")
// for Image
    // = picture v uvodu
// for "Prev button"
lightBoxPrev.classList.add("fa", "fa-angle-left", "lightbox-prev")

// for "Next button"
lightBoxNext.classList.add("fa", "fa-angle-right", "lightbox-next")
// for "Close button"
lightClose.classList.add("fa", "fa-close", "lightbox-close")

// AppendChild
lightBoxContainer.appendChild(lightBoxContent)
lightBoxContent.appendChild(lightBoxImg)
lightBoxContent.appendChild(lightBoxPrev)
lightBoxContent.appendChild(lightBoxNext)
lightBoxContent.appendChild(lightClose)
document.body.appendChild(lightBoxContainer)

let index = 1

// Create functions
function showLightBox(n) {
    if (n > picture.length) {       // picture.length - kolik je tam divů kterým v js říkám picture (v html pic)
        index = 1
    }
    else if (n < 1) {
        index = picture.length
    }

    let imageLocation = picture[index - 1].children[0].getAttribute("src")
    lightBoxImg.setAttribute("src", imageLocation)
}

function currentImage() {
    lightBoxContainer.style.display="block"

    let imageIndex = parseInt(this.getAttribute("data-index"))
    showLightBox(index = imageIndex)
}

for (let i = 0; i < picture.length; i++) {
    picture[i].addEventListener("click", currentImage)
}

function sliderImage(n) {
    showLightBox(index += n)
}

function prevImage() {
    sliderImage(-1);
}

function nextImage() {
    sliderImage(1)
}

lightBoxPrev.addEventListener("click", prevImage)
lightBoxNext.addEventListener("click", nextImage)
document.onkeyup = nextImage

// Clost LightBox

function closeLightBox() {
    if(this === event.target){
        lightBoxContainer.style.display = "none"
    }
}

lightBoxContainer.addEventListener("click", closeLightBox)
lightClose.addEventListener("click", closeLightBox)