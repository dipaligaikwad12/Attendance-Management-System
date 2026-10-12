let sideItemShow = document.getElementsByClassName('show');
let sideItemClose = document.getElementsByClassName('close');
function showSubItems() {
    sideItemShow.style.visibility = "hidden";
    sideItemClose.style.visibility = "visible";
}
function closeSubItems() {
    sideItemShow.style.visibility = "visible";
    sideItemClose.style.visibility = "hidden";
}