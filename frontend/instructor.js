const openModalButton = document.querySelector("#open__modal");
const instructorsTable = document.querySelector(".instructor_table tbody");
const groupSelect = document.querySelector("select");
const instructorForm = document.querySelector("#add_instructor");

instructorForm.addEventListener("submit",(e)=>{
e.preventDefault();
let instructor = {
name:instructorForm.querySelector(`[name="name"]`).value,
surname:instructorForm.querySelector(`[name="surname"]`).value,
group_id:instructorForm.querySelector(`[name="group_id"]`).value,
};

fetch(`http://127.0.0.1:8000/api/instructors`,{
method:"POST",
headers: {
"Content-Type": "application/json",
Accept: "application/json",
},
body:JSON.stringify(instructor),
}).then(a=>a.json()).then((a)=>{
console.log(a)
})

})
let cachedGroups = [];

openModalButton.addEventListener("click",()=>{
if(cachedGroups.length){
return;
}
fetch(`http://127.0.0.1:8000/api/groups`,{
method:"GET",
headers: {
"Content-Type": "application/json",
Accept: "application/json",
},
}).then(res=>res.json()).then(groups=>{
cachedGroups = groups;
groups.forEach(group=>{
const option = document.createElement("option");
option.value = group.id;
option.textContent = group.name;
groupSelect.append(option);
})
})
});


const deleteInstructor =(e,id)=>{
fetch(`http://127.0.0.1:8000/api/delete-instructor`,{
method:"POST",
headers: {
"Content-Type": "application/json",
Accept: "application/json",
},
body:JSON.stringify({id:id}),

})
.then(res=>res.json())
.then(data=>{
console.log(data.code)
if(data.code===200){
// console.log(e.target.closest("tr"));
e.target.closest("tr").remove()
};
})
}
const getInstructor =()=>{
fetch(`http://127.0.0.1:8000/api/instructors`,{
method:"GET",
headers: {
"Content-Type": "application/json",
Accept: "application/json",
},
})
.then(res=>res.json())
.then((instructors)=>{
instructors.forEach(instructor => {
const tr = document.createElement("tr");
const idTd = document.createElement("td");
const nameTd = document.createElement("td");
const surnameTd = document.createElement("td");
const groupTd = document.createElement("td");
const operationsTd = document.createElement("td");
const deleteButton = document.createElement("buttons");
deleteButton.classList.add("btn","btn-danger");
deleteButton.textContent="Delete Instructor"
deleteButton.addEventListener("click",(e)=>deleteInstructor(e,instructor.id));
operationsTd.append(deleteButton);
idTd.textContent =instructor.id;
nameTd.textContent =instructor.name;
surnameTd.textContent =instructor.surname;
groupTd.textContent =instructor.groups.map(a=>a.name);
tr.append(idTd,nameTd,surnameTd,groupTd,operationsTd);
instructorsTable.append(tr);

});
});
}

getInstructor();
