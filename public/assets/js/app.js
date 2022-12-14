let files = [],
button = document.querySelector(".top button"),
form = document.querySelector("form"),
container = document.querySelector(".container");
text = document.querySelector(".inner");
browse = document.querySelector(".select");
input = document.querySelector(".file");
let images = [];

browse.addEventListener("click", () => input.click());

input.addEventListener("change", () => {
    let file = input.files;
    for (let i = 0; i < file.length; i++) {
        if (files.every((e) => e.name != file[i].name)) files.push(file[i]);
        images.push(file[i]);
    }
    // form.reset();
    showImages();
});

const showImages = () => {
    let images = "";
    files.forEach((e, i) => {
        images += `<div class="image">
                    <img src="${URL.createObjectURL(e)}" alt="image">
                    <span onclick="delImage(${i})">&times;</span>
                </div>`;
    });
    container.innerHTML = images;
};

const delImage = (index) => {
    delete files[index];
    images.splice(index);
    console.log(index);
    showImages();
};

function performDelete(url,id) {
    axios
        .delete(url + id)
        .then(function (response) {
            //2xx
            console.log(response);
            $(".container").load(window.location.href + " .container");
        })
        .catch(function (error) {
            //4xx - 5xx
            console.log(error.response.data.message);
        });
}

//add compound and update
function addCompound(id) {
    let formData = new FormData();

    formData.append('name',document.getElementById('name').value);
    formData.append('city', document.getElementById('city').value);
    formData.append('address', document.getElementById('address').value);
    for (const image of images) {
        formData.append("images[]",image);
    }
    const button = document.getElementById("button");
        console.log(button.innerHTML);

    if(button.innerHTML === 'Submit'){

        formData.append('_method', 'POST');
        store('/compound',formData,'/compound');

    }else{
        formData.append('_method', 'PUT');
        updatefromdata('/compound/'+id,formData,'/compound');
    }

}

//add building and update
function addBuilding(id) {
    let formData = new FormData();

    formData.append('kind',document.getElementById('kind').value);
    formData.append('name', document.getElementById('name').value);
    formData.append('compound_id', document.getElementById('compound_id').value);
    formData.append('city', document.getElementById('city').value);
    formData.append('address', document.getElementById('address').value);

    for (const image of images) {
        formData.append("images[]",image);
    }
    const button = document.getElementById("button");
        console.log(button.innerHTML);

    if(button.innerHTML === 'Submit'){

        formData.append('_method', 'POST');
        store('/building',formData,'/building');

    }else{
        formData.append('_method', 'PUT');
        updatefromdata('/building/'+id,formData,'/building');
    }

}


