var slideIndex = 0;
var divSections = document.getElementsByClassName("form");
divSections[slideIndex].style.display = "block";
//Hide all sections except first.
for (i = 1; i < divSections.length; i++) {
    divSections[i].style.display = "none";
}
//Switch section by hiding visible and showing chosen hidden section.
function slideIndexed(a) {
    if (a > divSections.length) {
        slideIndex = (slideIndex + 1) % divSections.length;
        divSections[slideIndex].style.display = "block";
        if (slideIndex == 0) {
            slideIndex = 3;
        }
        divSections[slideIndex - 1].style.display = "none";
    } else if (a < divSections.length) {
        divSections[slideIndex].style.display = "none";
        slideIndex = (slideIndex + 2) % divSections.length;
        divSections[slideIndex].style.display = "block";

        divSections[slideIndex - 1].style.display = "none";
    }
}
