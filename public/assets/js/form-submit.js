const forms = document.querySelectorAll("form");
forms.forEach((form) => {
    form.addEventListener("submit", () => {
        const btn = form.querySelector(".btn-submit");
        btn.setAttribute("disabled", true);

        const loadier = btn.querySelector('i');
        loadier.style.opacity = 1;
        loadier.style.width = "fit-content";
    });
});
