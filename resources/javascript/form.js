const errorColor = 'red';
const successColor = 'green';

document.addEventListener('DOMContentLoaded', () => {
    let form = document.getElementById('file-form');

    form.addEventListener('submit', async (event) => {
        event.preventDefault();

        let file = document.getElementById("file").files[0];
        let delimiter = document.getElementById('delimeter').value;

        if (!file || !delimiter || !isFileTxt(file)) {
            drawCircle(errorColor);
            return;
        }

        let response = await sendForm(file, delimiter);
        let result = document.getElementById("result");

        Object.keys(response).forEach((element) => {
            let node = document.createTextNode(element + ' ' + response[element]);
            let p = document.createElement('P');
            p.appendChild(node);

            result.appendChild(p);
        });


    })
});


const sendForm = async (file, delimiter) => {
    let formData = new FormData();

    formData.append('file', file);
    formData.append('delimiter', delimiter);

    let response = await fetch('/form', {method: "POST", body: formData});

    if (response.ok) {
        drawCircle(successColor)
    }


    return await response.json()
};

const drawCircle = (color) => {
    let cirlce = document.getElementById('circle');
    cirlce.style.visibility = 'initial';
    cirlce.style.background = color;
};

const isFileTxt = (file) => {
    return file.name.split('.').pop() === 'txt'
};