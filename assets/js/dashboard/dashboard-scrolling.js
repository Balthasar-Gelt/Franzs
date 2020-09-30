let arrowContainers;

export function inintializeScrolling(){

    arrowContainers = document.querySelectorAll('.dashboard_arrow_container');

    for (const container of arrowContainers) {
        container.addEventListener('click', e => changeWrapperMaxHeight(e));
    }

    window.onresize = changeHeightOnResize;

}

function changeWrapperMaxHeight(event){

    let id = event.target.id;
    let wrapper = document.querySelector("." + id);
    let content = document.querySelector("." + id + "_content");

    if(wrapper.offsetHeight < content.offsetHeight)
        wrapper.style.maxHeight = resizeToFullHeight(content);
    else
        wrapper.style.maxHeight = '0px';
}

function changeHeightOnResize(){

    let wrappers = document.querySelectorAll(".dashboard_section_content_wrapper");
    let contents = document.querySelectorAll(".dashboard_section_content");
    let i = 0;

    for (const wrapper of wrappers) {

        if(wrapper.offsetHeight != 0){
            wrapper.style.maxHeight = resizeToFullHeight(contents[i]);
            i++;
        }
    }
}

function resizeToFullHeight(element){
    return (element.offsetHeight + parseInt(getComputedStyle(element).marginBottom)) + 'px';
}