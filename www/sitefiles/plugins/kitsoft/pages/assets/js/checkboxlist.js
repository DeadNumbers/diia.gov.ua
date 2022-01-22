document.addEventListener('DOMContentLoaded', function(){   

    const checkboxList = document.querySelectorAll('.field-checkboxlist');

    if(checkboxList.length > 0) {    

        const renderFilter = (container) => {
            const input = document.createElement('input');
            input.setAttribute('type', 'text');
            input.setAttribute('placeholder', 'Пошук');
            input.className = 'form-control';
            input.style.marginBottom = '15px';
            bindEvent(input,container);
            return input;
        }

        const filterList = (target, container) => {
            const elements = container.querySelectorAll('.checkbox.custom-checkbox label');
            const scrollbarContainer = container.querySelector('.control-scrollbar');
            const scrollbarThumb = container.querySelector('.scrollbar-thumb');
            
            for(let i = 0; i < elements.length; i++){
                if(elements[i].innerText.toUpperCase().indexOf(target.value.toUpperCase()) !== -1){                     
                    elements[i].parentElement.style.display = 'block';
                    elements[i].previousElementSibling.classList.add('js_visible');
                } else {
                    elements[i].parentElement.style.display = 'none';
                    elements[i].previousElementSibling.classList.remove('js_visible');
                }
            }
            container.querySelector('.control-scrollbar').style.marginTop = (target.value.length? '10px' : '0');
            container.querySelector('small').style.display = (target.value.length ? 'none' : 'block');
            scrollbarContainer.scrollTop = 0
            scrollbarThumb.style.top = 0;
        }

        const bindEvent = (target,container) => {
            target.addEventListener('keyup', ()=>{
                filterList(target, container);
            })
        }

        for(let i = 0; i < checkboxList.length; i++){
            checkboxList[i].insertBefore(renderFilter(checkboxList[i]), checkboxList[i].childNodes[1]);
        }
    }
});