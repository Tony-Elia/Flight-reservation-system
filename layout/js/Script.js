
// document.getElementById("eye-login").addEventListener("click", togglePassword);
// document.getElementById("eye-login").setAttribute("onclick", "togglePassword(event)");
Array.from(document.getElementsByClassName("eye")).forEach(eye => {
    eye.addEventListener("click", togglePassword);
})

function togglePassword(e) {
    const tar = e.target.dataset.show;
    const passbox = document.getElementById(tar);

    // console.log(passbox);
    if(passbox.getAttribute("type") === "password") {
        passbox.setAttribute("type", "text");
        e.target.className = "fa fa-eye-slash eye";
    } else {
        passbox.setAttribute("type", "password");
        e.target.className = "fa fa-eye eye";
    }
}


