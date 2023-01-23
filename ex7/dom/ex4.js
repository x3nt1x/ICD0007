import Item from "./Item.js";

const ul = document.getElementById('list');
const button = document.getElementById('button1');
const input = document.getElementById('input1');

let counter = 1;
let items = [new Item(counter++, 'item 1'), new Item(counter++, 'item 2')];

render(); // call render function after page is loaded

button.onclick = addItem;

function render()
{
    button.addEventListener('click', () => addItem);

    while (ul.hasChildNodes())
        ul.removeChild(ul.lastChild);

    for (const item of items)
        addLi(item);
}

function addLi(item)
{
    const li = document.createElement('li');
    li.innerText = item.text;

    const newButton = document.createElement('button');
    newButton.innerText = 'X';
    newButton.onclick = () => deleteItem(item.id);

    li.appendChild(newButton);
    ul.appendChild(li);
}

function addItem()
{
    items.push(new Item(counter++, input.value));

    render();
}

function deleteItem(id)
{
    items = items.filter(item => item.id !== id);

    render();
}