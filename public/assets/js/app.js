const mobileToggle = document.querySelector('.mobile-toggle');
const nav = document.querySelector('.nav-links');

mobileToggle.addEventListener('click', () => {
    nav.classList.toggle('nav-active');
});

nav.addEventListener('click', (event) => {
    if (event.target.classList.contains('nav-links')) {
        nav.classList.toggle('nav-active');
    }
});

function showsubsection(subNumber) {
    var arrow_button = document.getElementById("test" + subNumber);
    var content = document.getElementById("subsection" + subNumber);

    if (content.style.display == "block") {
        content.style.display = "none";
        arrow_button.classList.add("fa-arrow-down");
        arrow_button.classList.remove("fa-arrow-up");
    }
    else {

        document.querySelectorAll('.subsection').forEach((elem) => {
            elem.style.display = "none"
        })
        document.querySelectorAll('.icone').forEach((elem) => {
            elem.classList.add("fa-arrow-down");
        })
        content.style.display = "block";
        arrow_button.classList.add("fa-arrow-up");
        arrow_button.classList.remove("fa-arrow-down");
    }

};

function showDescription(event) {
    var description = event?.innerText;
    var full_description = event.getAttribute("full-description");

    if (description.length > 50 && description.length != full_description.length) {
        event.innerText = full_description;
    }else{
        event.innerText = full_description.substring(0, 50) + "...";
    }
}