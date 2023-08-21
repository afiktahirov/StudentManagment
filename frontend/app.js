

const openModalButton = document.querySelector("#open__modal");
const groupSelect = document.querySelector("select");
const studentsTbody = document.querySelector(".students__table tbody");
const studentForm = document.querySelector("#add_student");
studentForm.addEventListener("submit", (e) => {
  e.preventDefault();
  let student = {
    name: studentForm.querySelector(`[name="name"]`).value,
    surname: studentForm.querySelector(`[name="surname"]`).value,
    group_id: studentForm.querySelector(`[name="group_id"]`).value,
  };
  fetch(`http://127.0.0.1:8000/api/students`, {
    method: "POST",
    headers: {
      "Content-Type": "application/json",
      Accept: "application/json",
    },
    body: JSON.stringify(student),
  })
    .then((res) => res.json())
    .then((data) => {
      console.log(data);
    });
});
let cachedGroups = [];
openModalButton.addEventListener("click", () => {
  if (cachedGroups.length) {
    return;
  }
  fetch(`http://127.0.0.1:8000/api/groups`, {
    method: "GET",
    headers: {
      "Content-Type": "application/json",
      Accept: "application/json",
    },
  })
    .then((res) => res.json())
    .then((groups) => {
      cachedGroups = groups;
      groups.forEach((group) => {
        const option = document.createElement("option");
        option.value = group.id;
        option.textContent = group.name;
        groupSelect.append(option);
      });
    });
});
const deleteStudent = (e, id) => {
  fetch(`http://127.0.0.1:8000/api/delete-student`, {
    method: "POST",
    headers: {
      "Content-Type": "application/json",
      Accept: "application/json",
    },
    body: JSON.stringify({ id: id }),
  })
    .then((res) => res.json())
    .then((data) => {
      if (data.code === 200) {
        e.target.closest("tr").remove();
      }
    });
};
const getStudents = () => {
  fetch(`http://127.0.0.1:8000/api/students`, {
    method: "GET",
    headers: {
      "Content-Type": "application/json",
      Accept: "application/json",
    },
  })
    .then((res) => res.json())
    .then((students) => {
      students.forEach((student) => {
        const tr = document.createElement("tr");
        const idTd = document.createElement("td");
        const nameTd = document.createElement("td");
        const surnameTd = document.createElement("td");
        const groupTd = document.createElement("td");
        const instructorsTd = document.createElement("td");
        const operationsTd = document.createElement("td");
        const deleteButton = document.createElement("button");
        deleteButton.classList.add("btn", "btn-danger");
        deleteButton.addEventListener("click", (e) =>
          deleteStudent(e, student.id)
        );
        deleteButton.textContent = "Delete Student";
        operationsTd.append(deleteButton);
        idTd.textContent = student.id;
        nameTd.textContent = student.name;
        surnameTd.textContent = student.surname;
        groupTd.textContent = student.group.name;
        instructorsTd.textContent = student.group.instructors.map(
          (a) => `${a.name} ${a.surname}`
        );
        tr.append(
          idTd,
          nameTd,
          surnameTd,
          groupTd,
          instructorsTd,
          operationsTd
        );
        studentsTbody.append(tr);
      });
    });
};
getStudents();
