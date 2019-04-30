const handleUploadImageChange = function(event) {
    const file = event.target.files[0];
    const label = document.querySelector("label[for='image']");
    if (file) {
        label.innerHTML = file.name;
    }
}