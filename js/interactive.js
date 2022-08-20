"use strick";

const classes = ["Math", "Eng", "Hist", "Chem"];
const deselect = {"home_button":"register_button", "register_button":"home_button"};



function grid(visible)
{
    var form = document.getElementById("classes");
    remove_all_child(form);
    document.getElementById("classes").style.visibility = visible;

    if (form.children.length != 0)
        return;
    
    for (let i = 0; i < classes.length; i++)
    {
        let element = document.createElement("input");
        let input = document.createElement("input");
        input.style.display = "none";
        input.setAttribute("value", "");
        form.appendChild(input);

        element.setAttribute("name", classes[i]);
        element.textContent = classes[i];
        
        element.setAttribute("type", "button");
        element.setAttribute("form", "classes");
        element.setAttribute("id", classes[i]);
        element.setAttribute("value", classes[i]);
        element.setAttribute("for", classes[i]);
        
        element.addEventListener("click", function(){
            this.style.backgroundColor = "green";
            input.setAttribute("name", this.getAttribute("name"));
            input.setAttribute("value", this.getAttribute("name"));
        }, true);

        element.addEventListener("dblclick", function(){
            this.style.backgroundColor = "white";
            input.setAttribute("value", "");
        }, true);

        form.appendChild(element);
    }

    element = document.createElement("input");
    element.textContent = "Submit";
    element.setAttribute("type", "submit");
    
    element.setAttribute("name", "submit");
    form.appendChild(element);
}

function over(id)
{
    let button = document.getElementById(id);
    let color = button.style.backgroundColor;
   
    if (color === "black")
        return;
    else
        button.style.backgroundColor = "yellow";
}

function out(id)
{
    let button = document.getElementById(id);
    let color = button.style.backgroundColor;

    if (color === "yellow")
        button.style.backgroundColor = "white";
}

function select(id)
{
    let unselect = document.getElementById(deselect[id]);
    unselect.style.color = "black";
    unselect.style.backgroundColor = "white";
    unselect.blur();

    let select = document.getElementById(id);
    select.style.color = "white";
    select.style.backgroundColor = "black";

    if (id === 'home_button')
        document.getElementById("classes").style.visibility = "hidden";
}

function dropdown(id)
{
    let list = document.getElementById(id).classList;

    if(list.contains("collapse"))
        list.remove("collapse");
    else
        list.add("collapse");
}

function logout(id)
{
    let element = document.getElementById(id);
    element.innerText = id;
    console.log(element.textContent);

    document.getElementById('exit').dispatchEvent(new Event('submit'));
}

function report(list)
{
    let title = ['id', 'midterm', 'final'];
    let form = document.getElementById("classes");
    
    let table = document.createElement("table");
    let row = document.createElement("tr");
    
    for (i=0; i<title.length; i++)
    {
        let header = document.createElement("th");
        header.innerText = title[i];
        row.appendChild(header);
    }

    table.appendChild(row);
    row = document.createElement("tr");

    for (i=0; i<title.length; i++)
    {
        let data = document.createElement("td");
        data.innerText = list[i];
        row.appendChild(data);
    }

    table.appendChild(row);
    form.appendChild(table);
}

function remove_all_child(parent)
{
    while (parent.firstChild)
        parent.removeChild(parent.firstChild);
}

