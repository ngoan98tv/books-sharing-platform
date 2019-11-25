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

const searchForm = document.querySelector('#searcher');
const container = document.querySelector("div[class=books-container]");
const text = document.querySelector("input[name=searchValue]");

text.addEventListener('input', function (e) {
    fetch('/search?q=' + e.target.value).then(res => {
        res.json().then(json => {
            container.innerHTML = '';
            container.innerHTML = json.join('');
        });
    });
});

searchForm.addEventListener('submit', function (e) {   
    e.preventDefault();
    fetch('/search?q=' + text.value).then(res => {
        res.json().then(json => {
            container.innerHTML = '';
            container.innerHTML = json.join('');
        });
    });
});