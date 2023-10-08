import './bootstrap';

import '@fortawesome/fontawesome-free/css/fontawesome.css';


//Vars
let toggle = false;
const locale = document.getElementsByTagName("html")[0].getAttribute("lang");
let task = 0;

window.toggle = function () {

    const sidebar = document.getElementById('sidebar');
    const spans = document.getElementsByClassName("sidebarlinknames");
    const arrowsdiv = document.getElementById('arrowsdiv');
    const arrows = document.getElementById('arrows');
    const arrow = document.getElementById('arrow');
    const main = document.getElementById('main');

    if (!toggle) {

        sidebar.style.width = '300px';
        arrow.src = "/img/icons/arrows-left.svg";

        //Move arrows to the right

        arrowsdiv.style.width = '300px';
        arrows.classList.add("ms-auto");
        arrows.classList.remove("mx-auto");

        //Change title of sidebar arrowbtn

        if (locale == 'en') {

            arrows.title = "Close Sidebar";

        } else if (locale == 'de') {

            arrows.title = "Seitenleiste Schließen";

        } else if (locale == 'it') {

            arrows.title = "Chiudere";

        }

        //Display names of sidebar-links

        for (var i = 0; i < spans.length; i++) {

            spans[i].classList.remove("d-none");

        }

        //Change margin-left of main

        main.style.marginLeft = "300px";

    } else {

        sidebar.style.width = '60px';
        arrow.src = "/img/icons/arrows-right.svg";

        //Move arrows to the left

        arrowsdiv.style.width = '60px';
        arrows.classList.remove("ms-auto");
        arrows.classList.add("mx-auto");

        //Change title of sidebar arrowbtn

        if (locale == 'en') {

            arrows.title = "Open Sidebar";

        } else if (locale == 'de') {

            arrows.title = "Seitenleiste Öffnen";

        } else if (locale == 'it') {

            arrows.title = "Aprire";

        }

        //Hide names of sidebar-links

        for (var i = 0; i < spans.length; i++) {

            spans[i].classList.add("d-none");

        }

        //Change margin-left of main

        main.style.marginLeft = "60px";

    }

    toggle = !toggle;

}

// News show create article
window.showCreatePostForm = function () {

    const createpostform = document.getElementById('createpostform');
    const createpostbtn = document.getElementById('createpostbtn');

    createpostform.classList.remove("d-none");
    createpostbtn.classList.add("d-none");

}

// News hide create article
window.hideCreatePostForm = function () {

    const createpostform = document.getElementById('createpostform');
    const createpostbtn = document.getElementById('createpostbtn');
    const text = document.getElementById('text');

    createpostform.classList.add("d-none");
    createpostbtn.classList.remove("d-none");
    text.value = '';

}

// News show read more articles
window.showNews = function () {

    const readmorearticles = document.getElementById('readmorearticles');
    const readmorebtn = document.getElementById('readmorebtn');
    const readlessbtn = document.getElementById('readlessbtn');

    readmorearticles.classList.remove("d-none");
    readmorebtn.classList.add("d-none");
    readlessbtn.classList.remove("d-none");

}

// News hide read more articles
window.hideNews = function () {

    const readmorearticles = document.getElementById('readmorearticles');
    const createpostbtn = document.getElementById('readmorebtn');
    const readlessbtn = document.getElementById('readlessbtn');

    readmorearticles.classList.add("d-none");
    readmorebtn.classList.remove("d-none");
    readlessbtn.classList.add("d-none");

}

// News show edit article
window.showEditPostForm = function(id) {

    const articlecontent = document.getElementById('articlecontent' + id);

    articlecontent.querySelector("#articletext").classList.add('d-none');
    articlecontent.querySelector("#articleedit").classList.remove('d-none');

}

// News hide edit article
window.hideEditPostForm = function (id) {

    const articlecontent = document.getElementById('articlecontent' + id);
    const articletext = articlecontent.querySelector("#articletext");

    articletext.classList.remove('d-none');
    articlecontent.querySelector("#articleedit").classList.add('d-none');

    //Set textarea value back to news text
    articlecontent.querySelector("#text").value = articletext.textContent.replace(/[\n\r]+|[\s]{2,}/g, ' ').trim();

}

// Delete alert modal change submit button
window.changeModalSubmitButton = function(form) {

    const btn = document.getElementById('deletemodalbtn');

    btn.removeAttribute('form');
    btn.setAttribute('form', form);

}

// Delete alert modal change text button
window.changeModalText = function(text) {

    const deletemodaltext = document.getElementById('deletemodaltext');

    deletemodaltext.innerText = text;

}

// Admin Panel change addmember img on hover
window.addMemberHover = function (element) {

    element.setAttribute('src', '/img/icons/gray/plus-solid.svg');

}

// Admin Panel change addmember img on unhover
window.addMemberUnhover = function (element) {

    element.setAttribute('src', '/img/icons/plus-solid.svg');

}

// Admin Panel show user change password
window.showChangePassword = function (index) {

    const changepassworddivs = document.querySelectorAll('[id=changepassworddiv]');
    const changepassworddiv = changepassworddivs[index];

    changepassworddiv.classList.remove('d-none');

}

// Admin Panel hide user change password
window.hideChangePassword = function (index) {

    const changepassworddivs = document.querySelectorAll('[id=changepassworddiv]');
    const changepassworddiv = changepassworddivs[index];
    const newpasswords = document.querySelectorAll('[id=newPassword]');
    const newpassword = newpasswords[index];

    changepassworddiv.classList.add('d-none');

    newpassword.value = "";

}

// Admin Panel show default task edit
window.showDefaulttaskEdit = function (id) {

    const savecancelbtndiv = document.getElementById('savecancelbtndiv'+id);
    const defaulttasktext = document.getElementById('defaulttasktext'+id);
    const devicetypedropdownbtn = document.getElementById('devicetypedropdownbtn'+id);

    savecancelbtndiv.classList.remove('d-none');
    defaulttasktext.disabled = false;
    devicetypedropdownbtn.disabled = false;
    devicetypedropdownbtn.style.setProperty('--displayvar', 'inline-block');

}

// Admin Panel hide default task edit
window.hideDefaulttaskEdit = function (v, key, id) {

    const savecancelbtndiv = document.getElementById('savecancelbtndiv'+id);
    const defaulttasktext = document.getElementById('defaulttasktext'+id);
    const devicetypedropdownbtn = document.getElementById('devicetypedropdownbtn'+id);

    savecancelbtndiv.classList.add('d-none');
    defaulttasktext.disabled = true;
    devicetypedropdownbtn.disabled = true;
    devicetypedropdownbtn.style.setProperty('--displayvar', 'none');

    changeDevicetypedropdownbtnValue(v, key, id);

}

// Admin Panel show add default task
window.showAddDefaultTaskForm = function () {

    const adddefaulttaskbtn = document.getElementById('adddefaulttaskbtn');
    const adddefaulttaskform = document.getElementById('adddefaulttaskform');

    adddefaulttaskbtn.classList.add('d-none');
    adddefaulttaskform.classList.remove('d-none');

}

// Admin Panel hide add default task
window.hideAddDefaultTaskForm = function () {

    const adddefaulttaskbtn = document.getElementById('adddefaulttaskbtn');
    const adddefaulttaskform = document.getElementById('adddefaulttaskform');

    adddefaulttaskbtn.classList.remove('d-none');
    adddefaulttaskform.classList.add('d-none');

}

// Admin Panel change device type dropdown value
window.changeDevicetypedropdownbtnValue = function (v, key, id) {

    const devicetypedropdownbtn = document.getElementById('devicetypedropdownbtn'+id);
    const devicetyperadio = document.getElementById('devicetyperadio' + id + key);

    devicetypedropdownbtn.innerText = v;
    devicetyperadio.checked = true;

}

// Admin Panel show workshop edit
window.showWorkshopEdit = function (id) {

    const workshopeditbtnsdiv = document.getElementById('workshopeditbtnsdiv' + id);
    const workshopname = document.getElementById('workshopname' + id);
    const workshopaddress = document.getElementById('workshopaddress' + id);

    workshopeditbtnsdiv.classList.remove('d-none');
    workshopname.disabled = false;
    workshopaddress.disabled = false;

}

// Admin Panel hide workshop edit
window.hideWorkshopEdit = function (id) {

    const workshopeditbtnsdiv = document.getElementById('workshopeditbtnsdiv' + id);
    const workshopname = document.getElementById('workshopname' + id);
    const workshopaddress = document.getElementById('workshopaddress' + id);

    workshopeditbtnsdiv.classList.add('d-none');
    workshopname.disabled = true;
    workshopaddress.disabled = true;

}

// Admin Panel show add workshop 
window.showAddWorkshopForm = function () {

    const adddefaulttaskbtn = document.getElementById('addworkshopbtn');
    const adddefaulttaskform = document.getElementById('addworkshopform');

    adddefaulttaskbtn.classList.add('d-none');
    adddefaulttaskform.classList.remove('d-none');

}

// Admin Panel hide add workshop
window.hideAddWorkshopForm = function () {

    const adddefaulttaskbtn = document.getElementById('addworkshopbtn');
    const adddefaulttaskform = document.getElementById('addworkshopform');

    adddefaulttaskbtn.classList.remove('d-none');
    adddefaulttaskform.classList.add('d-none');

}

// Admin Panel change workshop dropdown value
window.changeWorkshopdropdownbtnValue = function (index, v) {

    const assignmentfilterworkshopbtn = document.getElementById('assignmentfilterworkshopbtn');
    const workshopradio = document.getElementById('workshopradio' + index);

    assignmentfilterworkshopbtn.innerText = v;
    workshopradio.checked = true;

}

// Assignment change state dropdown value
window.changeStatedropdownbtnValue = function (index, v) {

    const assignmentfilterstatebtn = document.getElementById('assignmentfilterstatebtn');
    const stateradio = document.getElementById('stateradio' + index);

    assignmentfilterstatebtn.innerText = v;
    stateradio.checked = true;

}

window.changePrioritydropdownbtnValue = function (index, v) {

    const assignmentfilterprioritybtn = document.getElementById('assignmentfilterprioritybtn');
    const priorityradio = document.getElementById('priorityradio' + index);

    assignmentfilterprioritybtn.innerText = v;
    priorityradio.checked = true;

}

window.changePctypedropdownbtnValue = function (index, v) {

    const assignmentfilterpctypebtn = document.getElementById('assignmentfilterpctypebtn');
    const pctyperadio = document.getElementById('pctyperadio' + index);

    assignmentfilterpctypebtn.innerText = v;
    pctyperadio.checked = true;

}

window.changeSystemlanguagedropdownbtnValue = function (index, v) {

    const assignmentfiltersystemlanguagebtn = document.getElementById('assignmentfiltersystemlanguagebtn');
    const systemlanguageradio = document.getElementById('systemlanguageradio' + index);

    assignmentfiltersystemlanguagebtn.innerText = v;
    systemlanguageradio.checked = true;

}

window.changeCreateSLdropdownbtnValue = function (index, v) {

    const assignmentfiltersystemlanguagebtn = document.getElementById('createassignmentsystemlanguagebtn');
    const systemlanguageradio = document.getElementById('systemLanguageradio' + index);

    assignmentfiltersystemlanguagebtn.innerText = v;
    systemlanguageradio.checked = true;

}

window.changeCreatePTdropdownbtnValue = function (index, v) {

    const assignmentfilterprioritybtn = document.getElementById('createassignmentpcTypebtn');
    const priorityradio = document.getElementById('pcTyperadio' + index);

    assignmentfilterprioritybtn.innerText = v;
    priorityradio.checked = true;

}

// Assignment add task dynamically 
window.addTask = function () {

    const tasks = document.getElementById('tasks');

    let row = document.createElement('div');
    row.setAttribute('id', 'task-' + task);
    row.classList.add('row');
    tasks.appendChild(row);

    let inputcol = document.createElement('div');
    inputcol.classList.add('col-3');
    inputcol.classList.add('mb-3');
    row.appendChild(inputcol);

    let input = document.createElement('input');
    input.setAttribute('type', 'text');
    input.setAttribute('name', 'tasks[]');
    input.setAttribute('id', 'task-' + task);

    if (locale == 'en') {

        input.setAttribute('placeholder', 'Additional Task');

    } else if (locale == 'de') {

        input.setAttribute('placeholder', 'Zusätzliche Aufgabe');

    } else if (locale == 'it') {

        input.setAttribute('placeholder', 'Compito Aggiuntivo');

    }

    input.classList.add('rounded-2');
    input.classList.add('ps-2');
    input.classList.add('w-100');
    input.classList.add('bg-transparent');
    input.classList.add('i-outline-none');
    input.classList.add('border');
    input.classList.add('border-2');
    input.classList.add('bc-lightgray');
    input.classList.add('t-white');
    input.classList.add('fs-5');
    inputcol.appendChild(input);

    let buttoncol = document.createElement('div');
    buttoncol.classList.add('col-auto');
    buttoncol.classList.add('rounded-2');
    buttoncol.classList.add('p-0');
    row.appendChild(buttoncol);

    let button = document.createElement('button');
    button.classList.add('btn');
    button.classList.add('btn-primary');
    button.classList.add('m-0');
    button.classList.add('bc-orange');
    button.classList.add('th-orange');
    button.setAttribute('id', 'createassignmentdeletetaskbtn');
    button.setAttribute('onclick', 'deleteTask(' + task + ')');
    button.setAttribute('name', 'task-' + task);
    buttoncol.appendChild(button);

    let img = document.createElement('img');
    img.src = "/img/icons/gray/minus-solid.svg";
    img.alt = "Delete";
    button.appendChild(img);

    task++;

}

// Assignment remove task
window.deleteTask = function (id) {

    const row = document.getElementById('task-' + id);

    row.remove();

}

// Assignment on addTask also add hidden input field with values from task
window.addHiddenTaskField = function (id) {

    const tasks = document.getElementById('tasks');

    let input = document.createElement('input');
    input.setAttribute('type', 'text');
    input.setAttribute('name', 'deletetasks[]');
    input.setAttribute('id', id);
    input.setAttribute('value', id);
    input.hidden = true;

    tasks.appendChild(input);

}
