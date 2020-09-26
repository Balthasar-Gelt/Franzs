export function unsetMask(input){

    input.inputmask.remove();
    input.value = input.value.replace(/\s+/g, '');
}