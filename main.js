const url = 'http://todo.ingeniero.cierva/controller.php';

function printList(list) {
    const table = document.getElementById("table");
    table.innerHTML = '';
    const ul = document.createElement('ul');
    list.forEach(item => {
        const li = document.createElement('li');
        li.innerHTML = item.item_id+ '. ' + item.content + ' <button onclick=delete_item(' + item.item_id + ')>Delete</button>'
        li.addEventListener('click', () => {
            const newTask = prompt('Nuevo texto:', item.content);
            if (newTask !== null) {
                editTask(item.item_id, newTask);
            }
        })
        ul.appendChild(li);
    });
    table.appendChild(ul);
}

async function load_list() {
    try {
        const request = new Request(url, {method: "GET", headers: {'Content-Type': 'application/json'} } )
        let response=await fetch(request);
        const jsonData=JSON.parse(await response.text());
        printList(jsonData);
    } 
    catch(error) {
            console.error('Error al cargar:', error);
    }
}

async function upload() {
    const task=document.getElementById('task_input').value;

    if (!task) {
        alert('Por favor, introduce un valor.');
        return;
    }

    const json_task= {'content': task};

    const request = new Request(url, {
        method: "POST",
        headers: {
            'Content-Type': 'application/json'
        },
        body: JSON.stringify(json_task)}
    )

    const response = await fetch(request);
    const jsonData = JSON.parse(await response.text());
    printList(jsonData);
}

async function delete_item($item_id) {
    const json_task = {'item_id': $item_id};
    console.log(json_task)
    const request = new Request(url, {
        method: "DELETE",
        headers: {
            'Content-Type': 'application/json'
        },
        body: JSON.stringify(json_task)}
    )

    const response = await fetch(request);
    const jsonData = JSON.parse(await response.text());
    printList(jsonData);
}

async function editTask(item_id, task) {
    const json = {'item_id': item_id, 'content': task};
    const request = new Request(url, {
        method: "PUT",
        headers: {
            'Content-Type': 'application/json'
        },
        body: JSON.stringify(json)}
    )

    const response = await fetch(request);
    const jsonData = JSON.parse(await response.text());
    printList(jsonData);
}

document.addEventListener('DOMContentLoaded', load_list);
