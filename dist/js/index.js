document.addEventListener("DOMContentLoaded", () => {

    let content = document.querySelector("#content");
    let result = document.querySelector("#result");

    let url = "index.php";
    var interval;
    document.forms[0].addEventListener("submit", (e) => {
        e.preventDefault();
        content.innerHTML = getProgressBarIndeterminate();

        let formData = new FormData(e.target);
        formData.append("submit", "ok");
        postForm(formData);
    });

    function getProgressBarIndeterminate() {
        return `<div class="progress">
    <div id="progress"
         class="progress-bar progress-bar-striped progress-bar-animated"
         role="progressbar"
         aria-valuenow="100"
         aria-valuemin="0"
         aria-valuemax="100"
         style="width: 100%">
    </div>
</div>`;
    }

    function postForm(formData) {
        let xhr = new XMLHttpRequest();
        xhr.open("POST", url);
        xhr.onreadystatechange = () => {
            if (xhr.readyState === XMLHttpRequest.DONE) {
                clearInterval(interval);
                window.location.replace(url);
            }
        }
        xhr.send(formData);
    }
});
