// let sortedRows = Array.from(table.rows)
// .slice(1)
// .sort((rowA, rowB) => rowA.cells[0].innerHTML > rowB.cells[0].innerHTML ? 1 : -1);

// table.tBodies[0].append(...sortedRows);

document.addEventListener('DOMContentLoaded', () => {


    const getSort = ({ target }) => {
        const order = (target.dataset.order = -(target.dataset.order || -1));
        const index = [...target.parentNode.cells].indexOf(target);
        const collator = new Intl.Collator(['en', 'ru'], { numeric: true });
        const comparator = (index, order) => (a, b) => order * collator.compare(
            a.children[index].innerHTML,
            b.children[index].innerHTML
        );
        
        for(const tBody of target.closest('table').tBodies)
            tBody.append(...[...tBody.rows].sort(comparator(index, order)));

        for(const cell of target.parentNode.cells)
            cell.classList.toggle('sorted', cell === target);
    };
    
    document.querySelectorAll('.table_sort thead').forEach(tableTH => tableTH.addEventListener('click', () => getSort(event)));
    
});

document.addEventListener('DOMContentLoaded', function(e){ // ждем окончание загрузки
    setTimeout(function(){
          var myElement = document.querySelector('#click') // ищем нужный элемент
          myElement.click() 
          myElement.click()
      }, 0) 
  })
