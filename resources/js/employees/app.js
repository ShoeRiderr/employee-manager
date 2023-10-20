import { _setAttributes, addOnClickNodeListEl } from "../utils/node";

const phoneNumList = document.getElementById("phone_numbers");
const addPhoneNumBtn = document.getElementById("add_phone_num");
const deletePhoneBtnList = document.querySelectorAll('[data-id="phone-btn"]');

// Listener for adding new phone number
addPhoneNumBtn.addEventListener("click", () => {
    addPhoneNumber();
});

addOnClickNodeListEl(deletePhoneBtnList, deleteNumber)

function addPhoneNumber() {
    const nextIndex = deletePhoneBtnList.length;

    const parentDiv = document.createElement("div");

    _setAttributes(parentDiv, {
        class: "d-flex mb-2",
        id: `phone_numbers[${nextIndex}]`,
    });

    const phoneNumber = document.createElement("input");

    _setAttributes(phoneNumber, {
        type: "text",
        name: `phone_numbers[${nextIndex}]`,
        class: "form-control",
        value: '',
    });

    const deleteBtn = document.createElement("input");

    _setAttributes(deleteBtn, {
        type: "button",
        "data-id": "phone-btn",
        "data-parent": `phone_numbers[${nextIndex}]`,
        class: "btn btn-outline-danger ms-2",
        value: 'X'
    });

    parentDiv.appendChild(phoneNumber);
    parentDiv.appendChild(deleteBtn);

    phoneNumList.append(parentDiv);
}


function deleteNumber(event, node) {
    const parentId = node.getAttribute('data-parent')
    document.getElementById(parentId).remove()
}
