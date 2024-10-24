const url = 'http://todo.ingeniero.cierva/controller.php';

async function load_list() {
    const table = document.getElementById("table");
    table.innerHTML = '';
    try {
        const table = document.getElementById("table");
        const request = new Request(url, {method: "GET", headers: {'Content-Type': 'application/json'} } )
        let response=await fetch(request);
        const jsonData=JSON.parse(await response.text());
        console.log(jsonData);
        const ul = document.createElement('ul');

        jsonData.forEach(item => {
            const li = document.createElement('li');
            li.textContent = item.content;
            ul.appendChild(li);
        });
        table.appendChild(ul);
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

    const response1 = await fetch(request);
    console.log(response1);
    load_list();
}

document.addEventListener('DOMContentLoaded', load_list);
