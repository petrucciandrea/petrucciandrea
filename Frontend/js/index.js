let indexTitle;
let indexContainer;
let indexNavbar;

function load()
{
    indexTitle = document.getElementById("indexTitle");
    indexContainer = document.getElementById("indexContainer");
    indexNavbar = document.getElementById("indexNavbar");

    indexTitle.innerHTML = "<a class='unclickable text-black'>Homepage</a>";
    indexContainer.innerHTML =
    '<h3>What do you whant to do?</h3>' +
    '<div id="insertC" style="margin-bottom: 0.5rem;">' +
    '</div>'+
    '<div id="insertSC" style="margin-bottom: 0.5rem;">' +
    '</div>'+
    '<div id="modifyStudent" style="margin-bottom: 0.5rem;">' +
    '</div>'+
    '<div id="modifyClass" style="margin-bottom: 0.5rem;">' +
    '</div>'+
    '<div id="getAllC" style="margin-bottom: 0.5rem;">' +
    '</div>' +
    '<div id="GetSC" style="margin-bottom: 0.5rem;">' +
    '</div>' +
    '<div id="deleteS" style="margin-bottom: 0.5rem;">' +
    '</div>'+
    '<div id="deleteC" style="margin-bottom: 0.5rem;">' +
    '</div>';
    /*'<div id="getAllS" style="margin-bottom: 0.5rem;">' +
    '</div>' +
    '<div id="insertS" style="margin-bottom: 0.5rem;">' +
    '</div>'+*/
/*
    var button;
    button = document.createElement("button");
    button.id = "btnGetAllS";
    button.className = "btn btn-primary";
    button.innerHTML = "Get all";
    button.addEventListener("click", loadUserList);
    document.getElementById("getAllS").append(button);

    var button;
    button = document.createElement("button");
    button.id = "btnInsertS";
    button.className = "btn btn-primary";
    button.innerHTML = "Insert";
    button.addEventListener("click", insertUser);
    document.getElementById("insertS").append(button);*/

    var button;//si
    button = document.createElement("button");
    button.id = "btnDeleteS";
    button.className = "btn btn-danger";
    button.innerHTML = "Delete a student";
    button.addEventListener("click", deleteUser);
    document.getElementById("deleteS").append(button);

    var button;//si
    button = document.createElement("button");
    button.id = "btnGetAllC";
    button.className = "btn btn-success";
    button.innerHTML = "All classes";
    button.addEventListener("click", loadClassList);
    document.getElementById("getAllC").append(button);

    var button;//si
    button = document.createElement("button");
    button.id = "btnInsertC";
    button.className = "btn btn-primary";
    button.innerHTML = "Insert a new class";
    button.addEventListener("click", insertClass);
    document.getElementById("insertC").append(button);

    var button;//si
    button = document.createElement("button");
    button.id = "btnDeleteC";
    button.className = "btn btn-danger";
    button.innerHTML = "Delete a class";
    button.addEventListener("click", deleteClass);
    document.getElementById("deleteC").append(button);

    var button;//si
    button = document.createElement("button");
    button.id = "btnGetSC";
    button.className = "btn btn-success";
    button.innerHTML = "Class List";
    button.addEventListener("click", loadStudent4Class);
    document.getElementById("GetSC").append(button);

    var button;//si
    button = document.createElement("button");
    button.id = "btnInsertSC";
    button.className = "btn btn-primary";
    button.innerHTML = "Add student to class";
    button.addEventListener("click", insertStudentClass);
    document.getElementById("insertSC").append(button);
    
    var button;//si
    button = document.createElement("button");
    button.id = "btnModifyStudent";
    button.className = "btn btn-primary";
    button.innerHTML = "Modify a student";
    button.addEventListener("click", modifyStudent);
    document.getElementById("modifyStudent").append(button);

    var button;//si
    button = document.createElement("button");
    button.id = "btnModifyClass";
    button.className = "btn btn-primary";
    button.innerHTML = "Modify a class";
    button.addEventListener("click", modifyClass);
    document.getElementById("modifyClass").append(button);
}/*
function loadUserList()
{
    indexTitle.innerHTML = "<a class='unclickable text-black'>All the students</a>";

    indexContainer.innerHTML= '<div id="utenti"></div>';
    indexUtenti = document.getElementById("utenti");      
    
    var table = document.createElement("table");
    var thead = document.createElement("thead");
    table.setAttribute("class", "table");
    thead.className = "thead-dark";
    table.appendChild(thead);
    document.getElementById("indexContainer").appendChild(table);
            
    var tr = document.createElement('tr');
    tr.innerHTML =
        '<th>Name</th>' +
        '<th>Surname</th>' +
        '<th>SidiCode</th>'+
        '<th>TaxCode</th>' ;
    thead.appendChild(tr);

    var xhr = new XMLHttpRequest();
    xhr.open("GET", "http://localhost:80/phprest/Backend/API/apiStudent.php", true);
    xhr.onload = function(){
        var profileInfo = JSON.parse(xhr.response);
        let tr, td;
        for(var i = 0; i < profileInfo.length; i++){
            tr = document.createElement('tr');
            tr.innerHTML =
                    '<td>' + profileInfo[i].name + '</td>' +
                    '<td>' + profileInfo[i].surname + '</td>' +
                    '<td>' + profileInfo[i].sidi_code + '</td>' +
                    '<td>' + profileInfo[i].tax_code + '</td>';
            td = document.createElement("td");
            tr.appendChild(td);
            table.appendChild(tr);
        }
    };
    xhr.onerror = function(){alert("Errore di rete");}
    xhr.send();
}

function loadUser()
{
    indexTitle.innerHTML = "<a class='unclickable text-black'>Select the student</a>";

    indexContainer.innerHTML= 'Id: <input type="text" id="inputId" name="inputId"><br><div id="getOne"></div>';

    var button;
    button = document.createElement("button");
    button.id = "btnGetOne";
    button.className = "btn btn-primary";
    button.innerHTML = "Get one";
    button.addEventListener("click", getUser);
    document.getElementById("getOne").append(button);   
}

function getUser(){
    
    var id = document.getElementById("inputId").value;
    var url = "http://localhost:80/phprest/Backend/API/apiStudent.php/"+id;
    indexContainer.innerHTML= '';
    indexTitle.innerHTML= 'Studente:' + id;

    var table = document.createElement("table");
    var thead = document.createElement("thead");
    table.setAttribute("class", "table");
    thead.className = "thead-dark";
    table.appendChild(thead);
    document.getElementById("indexContainer").appendChild(table);
    var tr = document.createElement('tr');
    tr.innerHTML =
        '<th>Name</th>' +
        '<th>Surname</th>' +
        '<th>SidiCode</th>'+
        '<th>TaxCode</th>' ;
    thead.appendChild(tr);

    
    var xhr = new XMLHttpRequest();
    xhr.open("GET", url , true);
    xhr.onload = function(){
        var profileInfo = JSON.parse(xhr.response);
        let tr, td;
        tr = document.createElement('tr');
        tr.innerHTML =
            '<td>' + profileInfo.name + '</td>' +
            '<td>' + profileInfo.surname + '</td>' +
            '<td>' + profileInfo.sidi_code + '</td>' +
            '<td>' + profileInfo.tax_code + '</td>';
        td = document.createElement("td");
        tr.appendChild(td);
        table.appendChild(tr);
    };
    xhr.onerror = function(){alert("Errore di rete");}
    xhr.send();
}
function insertUser(){
    indexTitle.innerHTML = "<a class='unclickable text-black'>New student</a>";

    indexContainer.innerHTML = 'Name: <input type="text" id="name" name="name"><br>'+ 
        'Surname: <input type="text" id="surname" name="surname"><br>'+ 
        'SidiCode: <input type="text" id="sidi_code" name="sidi_code"><br>'+ 
        'TaxCode: <input type="text" id="tax_code" name="tax_code"><br>'+    
        '<br><div id="insert"></div>';

    var button;
    button = document.createElement("button");
    button.id = "btnInsert";
    button.className = "btn btn-primary";
    button.innerHTML = "Insert";
    button.addEventListener("click", insertStudent);
    document.getElementById("insert").append(button);
}
function insertStudent(){
    var url = "http://localhost:80/phprest/Backend/API/apiStudent.php";

    var xhr = new XMLHttpRequest();
    var na = document.getElementById("name").value;
    var su = document.getElementById("surname").value;
    var si = document.getElementById("sidi_code").value;
    var ta = document.getElementById("tax_code").value;
                
    var obj = {name: na, surname: su, sidi_code: si, tax_code: ta };
    var json = JSON.stringify(obj);

    xhr.open("POST", url, true);
    xhr.onload = function() {
        alert(xhr.response);
    };
    xhr.onerror = function() {alert('Errore di rete');};
    xhr.send(json);
}*/
function deleteUser(){
    indexTitle.innerHTML = "<a class='unclickable text-black'>Select the student</a>";

    indexContainer.innerHTML= 'Id: <input type="text" id="inputId" name="inputId"><br><div id="delOne"></div>';

    var button;
    button = document.createElement("button");
    button.id = "btnDeleteOne";
    button.className = "btn btn-primary";
    button.innerHTML = "Delete one";
    button.addEventListener("click", deleteOneS);
    document.getElementById("delOne").append(button);
}
function deleteOneS(){
    
    var id = document.getElementById("inputId").value;
    var url = "http://localhost:80/phprest/Backend/API/apiStudent.php/"+id;
    indexTitle.innerHTML = 'Studente:' + id;
    
    var xhr = new XMLHttpRequest();
    xhr.open("DELETE", url , true);
    xhr.onload = function() {
        alert(xhr.response);
    };
    xhr.onerror = function(){alert("Errore di rete");}
    xhr.send();
}

function loadClassList()
{
    indexTitle.innerHTML = "<a class='unclickable text-black'>All the classes</a>";

    indexContainer.innerHTML= '<div id="classi"></div>';
    indexClassi = document.getElementById("classi");      
    
    var table = document.createElement("table");
    var thead = document.createElement("thead");
    table.setAttribute("class", "table");
    thead.className = "thead-dark";
    table.appendChild(thead);
    document.getElementById("indexContainer").appendChild(table);
            
    var tr = document.createElement('tr');
    tr.innerHTML =
        '<th>Year</th>' +
        '<th>Section</th>' ;
    thead.appendChild(tr);

    var xhr = new XMLHttpRequest();
    xhr.open("GET", "http://localhost:80/phprest/Backend/API/apiClass.php", true);
    xhr.onload = function(){
        var profileInfo = JSON.parse(xhr.response);
        let tr, td;
        for(var i = 0; i < profileInfo.length; i++){
            tr = document.createElement('tr');
            tr.innerHTML =
                    '<td>' + profileInfo[i].year + '</td>' +
                    '<td>' + profileInfo[i].section + '</td>';
            td = document.createElement("td");
            tr.appendChild(td);
            table.appendChild(tr);
        }
    };
    xhr.onerror = function(){alert("Errore di rete");}
    xhr.send();
}
function insertClass(){
    indexTitle.innerHTML = "<a class='unclickable text-black'>New student</a>";

    indexContainer.innerHTML = 'Year: <input type="text" id="year" name="year"><br>'+ 
        'Section: <input type="text" id="section" name="section"><br>'+ 
        '<br><div id="insert"></div>';

    var button;
    button = document.createElement("button");
    button.id = "btnInsert";
    button.className = "btn btn-primary";
    button.innerHTML = "Insert";
    button.addEventListener("click", newClass);
    document.getElementById("insert").append(button);
}
function newClass(){
    var url = "http://localhost:80/phprest/Backend/API/apiClass.php";

    var xhr = new XMLHttpRequest();
    var ye = document.getElementById("year").value;
    var se = document.getElementById("section").value;
                
    var obj = {year: ye, section: se};
    var json = JSON.stringify(obj);

    xhr.open("POST", url, true);
    xhr.onload = function() {
        alert(xhr.response);
    };
    xhr.onerror = function() {alert('Errore di rete');};
    xhr.send(json);
}
function deleteClass(){
    indexTitle.innerHTML = "<a class='unclickable text-black'>Select the class</a>";

    indexContainer.innerHTML= 'Id: <input type="text" id="inputId" name="inputId"><br><div id="delOne"></div>';

    var button;
    button = document.createElement("button");
    button.id = "btnDeleteOne";
    button.className = "btn btn-primary";
    button.innerHTML = "Delete one";
    button.addEventListener("click", deleteOneC);
    document.getElementById("delOne").append(button);
}
function deleteOneC(){
    
    var id = document.getElementById("inputId").value;
    var url = "http://localhost:80/phprest/Backend/API/apiClass.php?id="+id;
    indexTitle.innerHTML = 'Studente:' + id;
    
    var xhr = new XMLHttpRequest();
    xhr.open("DELETE", url , true);
    xhr.onload = function() {
        alert(xhr.response);
    };
    xhr.onerror = function(){alert("Errore di rete");}
    xhr.send();
}
function loadStudent4Class(){
    indexTitle.innerHTML = "<a class='unclickable text-black'>Select the class</a>";

    indexContainer.innerHTML= 'Id: <input type="text" id="inputId" name="inputId"><br><div id="btnGetClass"></div><div id="aa"></div>';

    var button;
    button = document.createElement("button");
    button.id = "btnGetClass";
    button.className = "btn btn-primary";
    button.innerHTML = "Select";
    button.addEventListener("click", getStudent4Class);
    document.getElementById("btnGetClass").append(button);   
}

function getStudent4Class(){
    
    var idClass = document.getElementById("inputId").value;
    var url = "http://localhost:80/phprest/Backend/API/apiStudent.php?idClass="+idClass;
    indexTitle.innerHTML= 'Classe:' + idClass;
    indexContainer.innerHTML= '<div id="aa"></div>';

    var table = document.createElement("table");
    var thead = document.createElement("thead");
    table.setAttribute("class", "table");
    thead.className = "thead-dark";
    table.appendChild(thead);
    document.getElementById("indexContainer").appendChild(table);
    var tr = document.createElement('tr');
    tr.innerHTML =
        '<th>Name</th>' +
        '<th>Surname</th>' +
        '<th>SidiCode</th>'+
        '<th>TaxCode</th>' ;
    thead.appendChild(tr);

    var xhr = new XMLHttpRequest();
    xhr.open("GET", url , true);
    xhr.onload = function(){
        var profileInfo = JSON.parse(xhr.response);
        let tr, td;
        for(var i = 0; i < profileInfo.length; i++){
            tr = document.createElement('tr');
            tr.innerHTML =
                    '<td>' + profileInfo[i].name + '</td>' +
                    '<td>' + profileInfo[i].surname + '</td>' +
                    '<td>' + profileInfo[i].sidi_code + '</td>' +
                    '<td>' + profileInfo[i].tax_code + '</td>';
            td = document.createElement("td");
            tr.appendChild(td);
            table.appendChild(tr);
        }
    };
    xhr.onerror = function(){alert("Errore di rete");}
    xhr.send();
}
insertStudentClass
function insertStudentClass(){
    indexTitle.innerHTML = "<a class='unclickable text-black'>New student</a>";

    indexContainer.innerHTML = 'Id of the student: <input type="text" id="idStudent" name="idStudent"><br>'+
        'Id of the class: <input type="text" id="idClass" name="idClass"><br>'+ 
        '<br><div id="insert"></div>';

    var button;
    button = document.createElement("button");
    button.id = "btnInsert";
    button.className = "btn btn-primary";
    button.innerHTML = "Insert";
    button.addEventListener("click", insertSC);
    document.getElementById("insert").append(button);
}
function insertSC(){
    var url = "http://localhost:80/phprest/Backend/API/apiSC.php";

    var xhr = new XMLHttpRequest();
    var idStudent = document.getElementById("idStudent").value;
    var idClass = document.getElementById("idClass").value;
                
    var obj = {id_student: idStudent, id_class: idClass};
    var json = JSON.stringify(obj);

    xhr.open("POST", url, true);
    xhr.onload = function() {
        alert(xhr.response);
    };
    xhr.onerror = function() {alert('Errore di rete');};
    xhr.send(json);
}
function modifyStudent(){
    indexTitle.innerHTML = "<a class='unclickable text-black'>New student</a>";

    indexContainer.innerHTML = 'Id: <input type="text" id="id" name="id"><br>'+
        'Name: <input type="text" id="name" name="name"><br>'+ 
        'Surname: <input type="text" id="surname" name="surname"><br>'+ 
        'SidiCode: <input type="text" id="sidi_code" name="sidi_code"><br>'+ 
        'TaxCode: <input type="text" id="tax_code" name="tax_code"><br>'+    
        '<br><div id="insert"></div>';

    var button;
    button = document.createElement("button");
    button.id = "btnInsert";
    button.className = "btn btn-primary";
    button.innerHTML = "Insert";
    button.addEventListener("click", patchStudent);
    document.getElementById("insert").append(button);
}
function patchStudent(){
    var id = document.getElementById("id").value;

    if(document.getElementById("name").value.length>0)
        var na = document.getElementById("name").value;
    else
        var na = null;
    if(document.getElementById("surname").value.length>0)
        var su = document.getElementById("surname").value;
    else
        var su = null;
    if(document.getElementById("sidi_code").value.length>0)
        var si = document.getElementById("sidi_code").value;
    else
        var si = null;
    if(document.getElementById("tax_code").value.length>0)
        var ta = document.getElementById("tax_code").value;
    else
        var ta = null;

    var url = "http://localhost:80/phprest/Backend/API/apiStudent.php/"+id;

    var obj = {name: na, surname: su, sidi_code: si, tax_code: ta};
    var json = JSON.stringify(obj);
        alert(json);

    var xhr = new XMLHttpRequest();
    xhr.open("PATCH", url, true);
    xhr.onload = function() {
        alert(xhr.response);
    };
    xhr.onerror = function() {alert('Errore di rete');};
    xhr.send(json);
}
function modifyClass(){
    indexTitle.innerHTML = "<a class='unclickable text-black'>New student</a>";

    indexContainer.innerHTML = 'Id: <input type="text" id="id" name="id"><br>'+
        'Year: <input type="text" id="year" name="year"><br>'+ 
        'Section: <input type="text" id="section" name="section"><br>'+ 
        '<br><div id="insert"></div>';

    var button;
    button = document.createElement("button");
    button.id = "btnInsert";
    button.className = "btn btn-primary";
    button.innerHTML = "Insert";
    button.addEventListener("click", patchClass);
    document.getElementById("insert").append(button);
}
function patchClass(){
    
    var id = document.getElementById("id").value;
    
    if(document.getElementById("year").value.length>0)
        var ye = document.getElementById("year").value;
    else
        var ye = null;
    if(document.getElementById("section").value.length>0)
        var se = document.getElementById("section").value;
    else
        var se = null;

    var url = "http://localhost:80/phprest/Backend/API/apiClass.php/"+id;

    var obj = {year: ye, section: se};
    var json = JSON.stringify(obj);
        alert(json);

    var xhr = new XMLHttpRequest();
    xhr.open("PATCH", url, true);
    xhr.onload = function() {
        alert(xhr.response);
    };
    xhr.onerror = function() {alert('Errore di rete');};
    xhr.send(json);
}