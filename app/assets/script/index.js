const category = document.getElementById('categoryId');

if (category) 
    category.addEventListener('change', (event) => {
        if (event.target.value === 'new') {
            document.getElementById('categoryName').style.display = 'block';
        } else {
            document.getElementById('categoryName').style.display = 'none';
        }
    });

const inputImg = document.getElementById('inputImage');

if (inputImg) {
    inputImg.addEventListener('change', (event) => {
        document.getElementById('previewImg').src = window.URL.createObjectURL(event.target.files[0]);
    });
}

const searchInput = document.querySelector("input[name=searchValue]");

searchInput.addEventListener('input', function (e) {
    const container = document.getElementById('search-result');
    if (e.target.value) {
        fetch('/search?q=' + e.target.value).then(res => {
            res.json().then(json => {
                container.innerHTML = json.join('');
            });
        });
    } else {
        container.innerHTML = '';
    }
});