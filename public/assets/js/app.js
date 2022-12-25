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

function performDelete(url, id) {
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

    formData.append("name", document.getElementById("name").value);
    formData.append("city", document.getElementById("city").value);
    formData.append("address", document.getElementById("address").value);
    for (const image of images) {
        formData.append("images[]", image);
    }
    const button = document.getElementById("button");
    console.log(button.innerHTML);

    if (button.innerHTML === "Submit" || button.innerHTML === "إرسال") {
        formData.append("_method", "POST");
        store("/compound", formData, "/compound");
    } else {
        formData.append("_method", "PUT");
        updatefromdata("/compound/" + id, formData, "/compound");
    }
}

//add building and update
function addBuilding(id) {
    let formData = new FormData();

    formData.append("kind", document.getElementById("kind").value);
    formData.append("name", document.getElementById("name").value);
    formData.append(
        "compound_id",
        document.getElementById("compound_id").value
    );
    formData.append("city", document.getElementById("city").value);
    formData.append("address", document.getElementById("address").value);

    for (const image of images) {
        formData.append("images[]", image);
    }
    const button = document.getElementById("button");
    console.log(button.innerHTML);

    if (button.innerHTML === "Submit" || button.innerHTML === "إرسال") {
        formData.append("_method", "POST");
        store("/building", formData, "/building");
    } else {
        formData.append("_method", "PUT");
        updatefromdata("/building/" + id, formData, "/building");
    }
}

//add apartment and update
function addApartment(id) {
    let formData = new FormData();
    formData.append("kind",document.querySelector('[name="kind"]:checked').value);
    formData.append("name", document.getElementById("name").value);
    formData.append("city", document.getElementById("city").value);
    formData.append("address", document.getElementById("address").value);
    formData.append("space", document.getElementById("space").value);
    formData.append("date", document.getElementById("dateId").value);
    formData.append("conditioning",document.querySelector('[name="conditioning"]:checked').value);
    formData.append("floor", document.getElementById("floorid").value);
    formData.append("bedroom", document.getElementById("bedroomId").value);
    formData.append("bathroom", document.getElementById("bathroomId").value);
    formData.append("councils", document.getElementById("councils").value);
    formData.append("lounges", document.getElementById("lounges").value);
    formData.append("electricity_meter_number",document.getElementById("electricity_meter_number").value);
    formData.append("water_meter_number",document.getElementById("water_meter_number").value);
    formData.append("furnishing_condition",document.querySelector('[name="furnishing_condition"]:checked').value);
    formData.append("parking",document.querySelector('[name="parking"]:checked').value);
    formData.append("kitchen",document.querySelector('[name="kitchen"]:checked').value);

    for (const image of images) {
        formData.append("images[]", image);
    }
    const button = document.getElementById("button");
    console.log(button.innerHTML);

    if (button.innerHTML === "Submit" || button.innerHTML === "إرسال") {
        formData.append("_method", "POST");
        store("/apartment", formData, "/apartment");
    } else {
        formData.append("_method", "PUT");
        updatefromdata("/apartment/" + id, formData, "/apartment");
    }
}

function importFile(fileElement,url,redirectUrl) {
    let formData = new FormData();

    formData.append("file",fileElement);
    store(url, formData, redirectUrl);
}


